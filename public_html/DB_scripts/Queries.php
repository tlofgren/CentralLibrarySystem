<?php
// copyright SSD
require_once "Helpers/Connect.php";
require_once "Helpers/Hashing.php";
require_once "Helpers/Adders.php";
require_once "Helpers/Getters.php";
require_once "Helpers/Removers.php";
require_once "Helpers/Library_Defaults.php";

function login($username, $password, $table)
{
	global $mysqli;
	
	clean_string($username);
	clean_string($password);
	clean_string($table);
	
	$login_salt_query = "SELECT `salt` FROM `$table` WHERE username = '$username'";
	$result = $mysqli->query($login_salt_query);
	
	//Check for sql errors
	if($temp = check_sql_error($result))
	{
		return $temp;
	}
	
	//Check for a valid username (nonempty result on username query)
	if($row = $result->fetch_assoc())
	{
		$salt = $row['salt'];
		$password_hash = myhash($password, $salt);
		
		//Check for valid password (nonempty result on password_hash query)
		$login_query = "SELECT `id` FROM `$table` WHERE username = '$username' AND password_hash = '$password_hash'";
		$result = $mysqli->query($login_query);
		//Check for sql errors
		if($temp = check_sql_error($result))
		{
			return $temp;
		}
		if($row = $result->fetch_assoc())
		{
			$copy = $row;
			$copy['user_type'] = $table;
			return $copy;
		}
		else //Empty password query
		{
			$result = array();
			$result['error'] = "Bad password";
			$result['error_code'] = 2;
			return $result;
		}
	}
	else //Empty username query
	{
		$result = array();
		$result['error'] = "Bad username";
		$result['error_code'] = 1;
		return $result;
	}
}

function get_librarian_permissions($id)
{
	global $mysqli;
	$result = $mysqli->query("SELECT `id`, `check_in`, `check_out`, `add_book`,
		`remove_book`, `add_patron`, `remove_patron`, `manage_accounts`,
		`pay_fines`, `extend_due_date`, `waive_fines`, `edit_media_entry`,
		`add_tag` FROM `librarian` WHERE `id`=$id");

	if($temp = check_sql_error($result))
		return $temp;

	if($row = $result->fetch_assoc())
		return $row;
	
	$err = array('error'=>'ID not found', 'error_code'=>3);
	return $err;
}

function get_copy_info($barcode)
{
	global $mysqli;
	
	$mediaItemIdQuery 	= "SELECT * FROM `hardcopy` WHERE `barcode` = $barcode";
	$result = $mysqli->query($mediaItemIdQuery);
	
	if($temp = check_sql_error($result))
	{
		return $temp;
	}
	else
	{
		if($row = $result->fetch_assoc())
		{
			$mediaitem_id = $row['mediaitem_id'];
			$pending_result = get_general_item_info($mediaitem_id);
			
			foreach($row as $key => $value)
			{
				$pending_result[$key] = $value;
			}
			
			$isCheckedOutQuery 	= "SELECT `due_date`, `renew_count` FROM `checkedout` WHERE `hardcopy_barcode` = $barcode";
			$result2 = $mysqli->query($isCheckedOutQuery);
			
			if($temp2 = check_sql_error($result2))
			{
				return $temp2;
			}
			else
			{
				if($row2 = $result2->fetch_assoc())
				{
					foreach($row2 as $key => $value)
					{
						$pending_result[$key] = $value;
					}
				}
			}
	
			return $pending_result;
		}
		else
		{
			return array
			(
				'error'			=>	'Not found',
				'error_code'	=> 	1
			);
		}
	}
}

function get_general_item_info($mediaitem_id)
{
	global $mysqli;

	$mediaItemInfoQuery = "SELECT * FROM `mediaitem` WHERE `id` = $mediaitem_id";
	
	$result = $mysqli->query($mediaItemInfoQuery);
	
	$mediaitem = array();
	
	if(!$result)
	{
		// bad things happen \die?
	}
	else
	{
		if($row = $result->fetch_assoc())
		{
			$mediaitem_id = $row['id'];
			
			foreach($row as $key => $value)
			{
				$mediaitem[$key] = $value;
			}
		}
		else
		{
			$mediaitem['error'] = 'Not found';
			$mediaitem['error_code'] = 1;
			return $mediaitem;
		}
	}
	
	$tagsQuery 			= "SELECT `name` FROM `tag` JOIN `itemtag` ON tag_id = tag.id WHERE mediaitem_id = $mediaitem_id";
	
	$result = $mysqli->query($tagsQuery);
	
	
	if(!$result)
	{
		// it's ok to find no tags, just don't do anything then.
	}
	else
	{
		$tags = array();
		for($i = 0; $row = $result->fetch_assoc(); $i++)
		{
			$tags[$i] = $row['name'];
		}
		
		$mediaitem['tags'] = $tags;
	}
	
	$contributors = array();
	
	$contibutionsQuery 	= "SELECT `first`, `last`, `description` FROM `contribution` JOIN `contributor` ON contributor_id = contributor.id JOIN `role` ON role_id = role.id WHERE mediaitem_id = $mediaitem_id";
	
	$result = $mysqli->query($contibutionsQuery);
	
	if(!$result)
	{
		// it's ok to find no contributors, just don't do anything then.
	}
	else
	{
		while($row = $result->fetch_assoc())
		{
			if(isset($contributors[$row['description']]))
			{
				$contributors[$row['description']][] = array('first' => $row['first'], 'last' => $row['last']);
			}
			else
			{
				$contributors[$row['description']] = array();
				$contributors[$row['description']][] = array('first' => $row['first'], 'last' => $row['last']);
			}
		}
	}
	
	$mediaitem['contributors'] = $contributors;
	
	return $mediaitem;
}

function get_user_by_id($user_id)
{
	global $mysqli;
	
	clean_string($user_id);
	
	$user_info_query = "SELECT `first`, `last`, `email`, `phone`, `checkout_limit`, `renew_limit` FROM `patron` WHERE id = '$user_id'";
	
	$result = $mysqli->query($user_info_query);
	
	if($temp = check_sql_error($result))
		return $temp;
	
	//Check for a valid username (nonempty result on user_id query)
	if($row = $result->fetch_assoc())
	{
		return $row;
	}
			
	else //Empty query
	{
		$result = array();
		$result['error'] = "Bad user id";			
		$result['error_code'] = 3;
		return $result;
	}
}

function change_status($barcode, $new_status)
{
	global $mysqli;
	
	clean_string($barcode);
	clean_string($new_status);
	
	$check_barcode_query = "SELECT * FROM `hardcopy` WHERE `barcode` = $barcode";
	$result = $mysqli->query($check_barcode_query);
	if($temp = check_sql_error($result))
	{
		return $temp;
	}
	
	if($item = $result->fetch_assoc())
	{
		if(!is_possible_enum_val($new_status,'hardcopy_status'))
		{
			return array('error'=>'Not a valid enum value', 'error_code'=>9);
		}
		$status_query = "UPDATE `hardcopy` SET `status`= '$new_status' WHERE `barcode` = $barcode";
		
		$result = $mysqli->query($status_query);
	
		if($temp = check_sql_error($result))
		{
			return $temp;
		}
		return array();
	}
	else
	{
		return array('error'=>'Barcode not found', 'error_code'=>4);
	}
}

function check_out($barcode,$patron_id)
{
	global $mysqli;
	
	clean_string($barcode);
	clean_string($patron_id);
	
	$item = get_hardcopy_by_barcode($barcode);
	if(!$item)
		return array('error'=>'barcode not found', 'error_code'=>4);
	$patron = get_patron_by_id($patron_id);
	if(!$patron)
		return array('error'=>'id not found', 'error_code'=>3);
	
	$checkout_duration	= $item['checkout_duration'];
	$renew_limit 		= $item['renew_limit'];
		
	//If checkout_duration or renew_count = 0, this mediaitem cannot be checked out
	if($checkout_duration === 0 || $renew_limit === 0)
	{
		return array(
					'error'			=>	'mediaitem cannot be checked out of library',
					'error_code'	=>	5
				);
	}
	
	$checkout_list = get_checkouts_by_patron_id($patron_id);
	if(!$checkout_list)
		return array('error'=>'unknown error','error_code'=>-1);
		
	if(sizeof($checkout_list) < $patron['checkout_limit'] )		//Go ahead and checkout the mediaitem!
	{
		$date = new DateTime();
		$date->add(DateInterval::createFromDateString("$checkout_duration days"));

		$arr = array
				(
					'patron_id'			=>	$patron_id, 
					'hardcopy_barcode'	=>	$barcode,
					'due_date'			=>	$date->format('Y-m-d'), 
					'renew_count'		=>	0
				);

		return add_checkedout($arr);
	}
	else
	{
		return array('error'=>'Checkout limit exceeded', 'error_code'=>7);
	}
}

//	needed implementation : is overdue -> make fine
function check_in($barcode)
{
	global $mysqli;
	
	clean_string($barcode);
	
	$item = get_hardcopy_by_barcode($barcode);
	if(!$item)
	{
		return array('error'=>'barcode not found', 'error_code'=>4);
	}
	
	$check_for_item_query = "SELECT * FROM `checkedout` WHERE `hardcopy_barcode` = $barcode"; 
	$result = $mysqli->query($check_for_item_query);
	
	if($temp = check_sql_error($result))
		return $temp;
	
	if($result->fetch_assoc())
	{ 	//The mediaitem is checked out, check it in
		return delete_from_table('hardcopy_barcode',$barcode,'checkedout');
	}
	
	return array('error'=>"item not checked out", 'error_code'=>9);
}


function place_hold($mediaitem_id,$patron_id)
{
	global $mysqli;
	
	clean_string($mediaitem_id);
	clean_string($patron_id);
	
	//Query for the media item
	$check_for_item_query = "SELECT * FROM `mediaitem` WHERE `id` = $mediaitem_id";
	$item_result = $mysqli->query($check_for_item_query);
	
	if($temp = check_sql_error($item_result))
	{
		return $temp;
	}
		
	//Query for the patron
	$check_for_patron_query = "SELECT * FROM `patron` WHERE `id` = $patron_id";
	$patron_result = $mysqli->query($check_for_patron_query);	
	
	if($temp = check_sql_error($patron_result))
	{
		return $temp;
	}
	
	if($item = $item_result->fetch_assoc())				//The item exists
	{ 
		if($patron = $patron_result->fetch_assoc())		//The patron exists.
		{ 
			$date 				= new DateTime();
			$time_placed 		= new DateTime();
			$date->add(DateInterval::createFromDateString("3 days"));
			
			$string1 = $time_placed->format('Y-m-d');
			$string2 = $date->format('Y-m-d');
			
			$arr = array
					(
						'patron_id'			=>	$patron_id, 
						'mediaitem_id'		=>	$mediaitem_id,
						'time_placed'		=>	$string1,
						'expiration_date'	=>	$string2
					);
					
//			echo "<pre>";
//			print_r($arr);
//			echo "</pre>";
			
			return add_hold($arr);
		}
		
		else
		{
			return array('error'=>'The patron could not be found', 'error_code'=>6);
		}
	}
	else
	{
		return array('error'=>"No such item exists", 'error_code'=>4);
	}
}

// Testing Query : "INSERT INTO `hold`(`patron_id`, `mediaitem_id`, `expiration_date`) VALUES (1, 1, '2015-04-01')"
function remove_hold($mediaitem_id, $patron_id)
{
	global $mysqli;
	
	clean_string($mediaitem_id);
	clean_string($patron_id);
	
	$check_for_hold_query = "SELECT * FROM `hold` WHERE `mediaitem_id` = $mediaitem_id AND `patron_id` = $patron_id"; 
	$result = $mysqli->query($check_for_hold_query);
	
	if($temp = check_sql_error($result))
	{
		return $temp;
	}
	
	if($result->fetch_assoc())
	{	//The mediaitem is on hold
		$query = "DELETE FROM `hold` WHERE `mediaitem_id` = $mediaitem_id AND `patron_id` = $patron_id";
	
		$result = $mysqli->query($query);
	}
	else
	{
		return array
		(
			'error'			=>	'Not found', 
			'error_code'	=>	1
		);
	}
	
	return array();
}

function add_item($arr)
{	
//	$debugging = true;

	$report = array();
	
	global $mysqli;

	global $default_checkout_duration;
	global $default_item_renew_limit;
	
	if(!required_fields_for_mediaitem_exist($arr) || !required_fields_for_hardcopy_exist($arr))
	{
		return array
		(
			'error'			=> 	'Required field missing',
			'error_code'	=>	11
		);
	}

	// Destination : mediaitem
	$title 				= clean_exists_make_null_if_not($arr, 'title'); 
	$year 				= clean_exists_make_null_if_not($arr, 'year'); 
	$media_type 		= clean_exists_make_empty_if_not($arr, 'media_type'); 
	$isbn 				= clean_exists_make_null_if_not($arr, 'isbn'); 
	$edition 			= clean_exists_make_null_if_not($arr, 'edition');
	$volume 			= clean_exists_make_null_if_not($arr, 'volume');
	$issue_no 			= clean_exists_make_null_if_not($arr, 'issue_no');
	
	if(array_key_exists('contributor', $arr))
	{
		$contributors 		= $arr['contributor']; //contributors array
	}
	
	if(array_key_exists('tag', $arr))
	{
		$tags 				= $arr['tag'];//tag array
	}
	// Destination : hardcopy
	$barcode 			= clean_exists_make_empty_if_not($arr, 'barcode');
	$call_no 			= clean_exists_make_empty_if_not($arr, 'call_no'); 
	$status 			= clean_exists_make_empty_if_not($arr, 'status');	
	$checkout_duration 	= clean_exists_make_empty_if_not($arr, 'checkout_duration'); 
	$renew_limit 		= clean_exists_make_empty_if_not($arr, 'renew_limit'); 
	
	if($isbn == '')	// recentchange
	{
		$isbn == 'NULL';
	}
	if($status == '')
	{
		$status = 'Normal';
	}
	if($checkout_duration == '')
	{
		$checkout_duration = $default_checkout_duration;
	}
	if($renew_limit == '')
	{
		$renew_limit = $default_item_renew_limit;
	}

/////////////////////////////////
	
	$barcode_is_used = get_hardcopy(array( 'barcode' => $barcode ));
	
	if(!array_key_exists('error', $barcode_is_used))
	{
		return array
		(
			'error'			=>	"Barcode $barcode is already in use",
			'error_code'	=>	10
		);
	}

// End replaced.		

	if(isset($debugging))
	{
		echo "<h2>Checkpoint #1 Reached</h2>";
	}
	
	//Check for already existing media item 
	$mediaitem_description = array
	(
		'title' 		=> 	$title,
		'year'			=>	$year,
		'media_type'	=>	$media_type,
		'isbn'			=>	$isbn,
		'edition'		=>	$edition,
		'volume'		=>	$volume,
		'issue_no'		=>	$issue_no
	);
	
	$preexisting_mediaitem = get_mediaitem($mediaitem_description);
	
	if(array_key_exists('error', $preexisting_mediaitem))	// ... Then the mediaitem needs to be created first.
	{
		if(isset($debugging))
		{
			echo "<h2>Checkpoint #1A, Creating mediaitem Reached</h2>";
		}
		
		$add_mediaitem_result = add_mediaitem($mediaitem_description);
		
		if(array_key_exists('error', $add_mediaitem_result))
		{
			return $add_mediaitem_result;
		}
		
		$preexisting_mediaitem = get_mediaitem($mediaitem_description);
		
		$report['mediaitem'] = 'added';
	}
	else
	{
		if(isset($debugging))
		{
			echo "<h2>Checkpoint #1B, Found existing mediaitem Reached</h2>";
		}
		$report['mediaitem'] = 'already exists';
	}
	
	if(isset($debugging))
	{
		echo "<h2>Checkpoint #2, after mediaitem, before copy number Reached</h2>";
		echo "<pre>";
		print_r($preexisting_mediaitem);
		echo "</pre>";	
	}
	
	// We need to find the copy number.
	
	$mediaitem_id = $preexisting_mediaitem[0]['id'];
	
	$existing_hardcopies = get_hardcopy(array('mediaitem_id' => $mediaitem_id));
	
	
	if(isset($debugging))
	{
		echo "<pre>";
		print_r($existing_hardcopies);
		echo "</pre>";	
	}
	
	$max = 0;
	
	if(!array_key_exists('error', $existing_hardcopies))
	{
		foreach($existing_hardcopies as $copy)
		{
			$temp = 0;
			
			if(array_key_exists('copy_no', $copy))
			{
				$temp = $copy['copy_no'];
			}
		
			$max = $max < $temp ? $temp : $max;
		}
	}
	
	$copy_no = $max + 1;
	
	$hardcopy_description = array
	(
		'barcode'			=> $barcode,
		'mediaitem_id' 		=> $mediaitem_id,
		'copy_no' 			=> $copy_no,
		'call_no' 			=> $call_no,
		'status' 			=> $status,
		'checkout_duration' => $checkout_duration,
		'renew_limit' 		=> $renew_limit
	);

	$add_hardcopy_result = add_hardcopy($hardcopy_description);
		
	if(array_key_exists('error', $add_hardcopy_result))
	{	//$add_hardcopy_result;
		return array
		(
			'error' => 'All that hardcopy detection has failed us.',
			'error_code' => 771
		);
	}
	if(isset($debugging))
	{
		echo "<h2>Checkpoint #3, Created hardcopy Reached</h2>";
	}
	
	$report['hardcopy'] =	'added';
	$report['barcode']	=	$barcode;	
	
	if($title != 'NULL')
	{
		$potential_tags = preg_split("/[\s,]+/", $title);
		
		foreach($potential_tags as $tag_to_be)
		{
			//ToDo : Get help with stoplisting things.
			
			$tag_description = array
			(
				'name' => $tag_to_be,
				'type' => 'title'
			);
			
			$preexisting_tag = get_tag($tag_description);
			
			if(array_key_exists('error', $preexisting_tag))	// The tag doesn't exist, so create and find it.
			{
				$add_tag_result = add_tag($tag_description);
				
				if(array_key_exists('error', $add_tag_result))
				{
					$report[] = "Failed to add $tag_description to tag.";
					continue;
				}
				
				$preexisting_tag = get_tag($tag_description);
			}
			
			$itemtag_description = array
			(
				'tag_id' 		=> $preexisting_tag[0]['id'],
				'mediaitem_id' 	=> $mediaitem_id
			);
			
			$preexisting_itemtag = get_itemtag($itemtag_description);
			
			if(array_key_exists('error', $preexisting_itemtag))	// The tag doesn't exist, so create and find it.
			{
				$add_itemtag_result = add_itemtag($itemtag_description);
				
				if(array_key_exists('error', $add_itemtag_result))
				{
					$report[] = "Failed to add $itemtag_description to contributor.";
					continue;
				}
				
				$preexisting_itemtag = get_itemtag($itemtag_description);
			}
		}
	}	
	
	if(isset($contributors))
	{
		//////////////////////////////////	
		foreach($contributors as $role => $contributors_with_role)
		{	
			$role_description = array
			(
				'description' => $role
			);
			
			$preexisting_role = get_role($role_description);
			
			if(array_key_exists('error', $preexisting_role))	// The role doesn't exist, so create and find it.
			{
				$add_role_result = add_role($role_description);
				
				if(array_key_exists('error', $add_role_result))
				{
					$add_role_result['description'] = 'Failed to add $role to role.';
					return $add_role_result;
				}
				
				$preexisting_role = get_role($role_description);
			}
		
			foreach($contributors_with_role as $individual_contributor)
			{
				$first 	= 'NULL';
				$last 	= 'NULL';
				
				if(array_key_exists('first', $individual_contributor))
				{
					$first = $individual_contributor['first'];
				}
				if(!array_key_exists('last', $individual_contributor))
				{
					$report[] = "Warning : could not add contributor $role_contributors, $individual_contributor";
					continue;
				}
				
				$last = $individual_contributor['last'];
				
				$contributor_description = array
				(
					'first'	=> $first,
					'last'	=> $last
				);
				
				$preexisting_contributor = get_contributor($contributor_description);
			
				if(array_key_exists('error', $preexisting_contributor))	// The contributor doesn't exist, so create and find him/her/it.
				{
					$add_contributor_result = add_contributor($contributor_description);
					
					if(array_key_exists('error', $add_contributor_result))
					{
						$report[] = "Failed to add $contributor_description to contributor.";
						continue;
					}
					
					$preexisting_contributor = get_contributor($contributor_description);
				}
				
				//add contribution
				$contribution_description = array
				(
					'mediaitem_id'		 =>	$mediaitem_id, 
					'role_id'	    	 =>	$preexisting_role[0]['id'],
					'contributor_id'	 =>	$preexisting_contributor[0]['id']
				);
				
				$preexisting_contribution = get_contribution($contribution_description);
				
				if(array_key_exists('error', $preexisting_contribution))
				{
					if(isset($debugging))
					{
						echo "<pre>";
						print_r($contribution_description);
						echo "</pre>";
					}
					
					$add_contribution_result = add_contribution($contribution_description);
					
					if(array_key_exists('error', $add_contribution_result))
					{
						$report[] = 'Failed to add $contribution_description to contribution.';
						continue;
					}
				}
				
				// add and link tags for these contributors.
				if($first != 'NULL')
				{
					$potential_tags = preg_split("/[\s,]+/", $first);
					
					foreach($potential_tags as $tag_to_be)
					{
						//ToDo : Get help with stoplisting things.
						
						$tag_description = array
						(
							'name' => $tag_to_be,
							'type' => 'contributor'
						);
						
						$preexisting_tag = get_tag($tag_description);
						
						if(array_key_exists('error', $preexisting_tag))	// The tag doesn't exist, so create and find it.
						{
							$add_tag_result = add_tag($tag_description);
							
							if(array_key_exists('error', $add_tag_result))
							{
								$report[] = "Failed to add $tag_description to tag.";
								continue;
							}
							
							$preexisting_tag = get_tag($tag_description);
						}
						
						$itemtag_description = array
						(
							'tag_id' 		=> $preexisting_tag[0]['id'],
							'mediaitem_id' 	=> $mediaitem_id
						);
						
						$preexisting_itemtag = get_itemtag($itemtag_description);
						
						if(array_key_exists('error', $preexisting_itemtag))	// The tag doesn't exist, so create and find it.
						{
							$add_itemtag_result = add_itemtag($itemtag_description);
							
							if(array_key_exists('error', $add_itemtag_result))
							{
								$report[] = "Failed to add $itemtag_description to itemtag.";
								continue;
							}
							
							$preexisting_itemtag = get_itemtag($itemtag_description);
						}
					}
				}
				if($last != 'NULL')
				{
					$potential_tags = preg_split("/[\s,]+/", $last);
					
					foreach($potential_tags as $tag_to_be)
					{
						//ToDo : Get help with stoplisting things.
						
						$tag_description = array
						(
							'name' => $tag_to_be,
							'type' => 'contributor'
						);
						
						$preexisting_tag = get_tag($tag_description);
						
						if(array_key_exists('error', $preexisting_tag))	// The tag doesn't exist, so create and find it.
						{
							$add_tag_result = add_tag($tag_description);
							
							if(array_key_exists('error', $add_tag_result))
							{
								$report[] = "Failed to add $tag_description to tag.";
								continue;
							}
							
							$preexisting_tag = get_tag($tag_description);
						}
						
						$itemtag_description = array
						(
							'tag_id' 		=> $preexisting_tag[0]['id'],
							'mediaitem_id' 	=> $mediaitem_id
						);
						
						$preexisting_itemtag = get_itemtag($itemtag_description);
						
						if(array_key_exists('error', $preexisting_itemtag))	// The tag doesn't exist, so create and find it.
						{
							$add_itemtag_result = add_itemtag($itemtag_description);
							
							if(array_key_exists('error', $add_itemtag_result))
							{
								$report[] = "Failed to add $itemtag_description to itemtag.";
								continue;
							}
							
							$preexisting_itemtag = get_itemtag($itemtag_description);
						}
					}
				}
			}
		}
	}
	
	if(isset($debugging))
	{
		echo "<h2>Checkpoint #4, Created/Linked/Found all contributors, roles, and contributions</h2>";
	}
	
	if(isset($tags))
	{
		foreach($tags as $single_tag)
		{
			if(!array_key_exists('name', $single_tag) || !array_key_exists('type', $single_tag))
			{
				$report[] = "Failed to add $single_tag to tag.";
				continue;
			}
			
			$tag_description = array
			(
				'name' => $single_tag['name'],
				'type' => $single_tag['type']
			);
			
			$preexisting_tag = get_tag($tag_description);
			
			if(array_key_exists('error', $preexisting_tag))	// The tag doesn't exist, so create and find it.
			{
				$add_tag_result = add_tag($tag_description);
				
				if(array_key_exists('error', $add_tag_result))
				{
					$report[] = "Failed to add $tag_description to tag.";
					continue;
				}
				
				$preexisting_tag = get_tag($tag_description);
			}
			
			$itemtag_description = array
			(
				'tag_id' 		=> $preexisting_tag[0]['id'],
				'mediaitem_id' 	=> $mediaitem_id
			);
			
			$preexisting_itemtag = get_itemtag($itemtag_description);
			
			if(array_key_exists('error', $preexisting_itemtag))	// The tag doesn't exist, so create and find it.
			{
				$add_itemtag_result = add_itemtag($itemtag_description);
				
				if(array_key_exists('error', $add_itemtag_result))
				{
					$report[] = "Failed to add $itemtag_description to contributor.";
					continue;
				}
				
				$preexisting_itemtag = get_itemtag($itemtag_description);
			}
		}
	}	
	
	return $report;
}


?>