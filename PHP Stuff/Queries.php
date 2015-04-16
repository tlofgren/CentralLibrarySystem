<?php
// copyright SSD
require_once "Connect.php";
include_once "Hashing.php";
include_once "Helpers.php";

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
			return $row;
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

function add_to_table($arr,$tablename)
{
	global $mysqli;
	
	surround_in_quotes($arr);
	append_required_fields($arr, $tablename);
	$fields = array_keys($arr);
	$vals = array_values($arr);
	
	$query = "INSERT INTO `$tablename`(`".implode("`, `", $fields)."`)
		VALUES (".implode(", ", $vals).")";
	
	$result = $mysqli->query($query);

	if($temp = check_sql_error($result))
		return $temp;
	
	return array();
}

function delete_from_table($fieldname,$key,$tablename)
{
	global $mysqli;
	
	$query = "DELETE FROM $tablename WHERE $fieldname='$key'";
	
	$result = $mysqli->query($query);

	if($temp = check_sql_error($result))
		return $temp;
	
	return array();
}

function delete_from_admin($id)
{
	return delete_from_table('id',$id,'admin');
}

function add_mediaitem($arr)
{
	return add_to_table($arr,'mediaitem');
}

function add_patron($arr)
{
	return add_to_table($arr,'patron');
}

function add_admin($arr)
{
	return add_to_table($arr,'admin');
}

function add_tag($arr)
{
	return add_to_table($arr,'tag');
}

function add_librarian($arr)
{
	return add_to_table($arr,'librarian');
}

function add_itemtag($arr)
{
	return add_to_table($arr,'itemtag');
}

function add_fine($arr)
{
	return add_to_table($arr,'fine');
}

function add_checkedout($arr)
{
	return add_to_table($arr,'checkedout');
}

function add_hold($arr)
{
	return add_to_table($arr,'hold');
}

function add_hardcopy($arr)
{
	return add_to_table($arr,'hardcopy');
}

function add_contributor($arr)
{
	return add_to_table($arr,'contributor');
}

function add_contribution($arr)
{
	return add_to_table($arr,'contribution');
}

function add_role($arr)
{
	return add_to_table($arr,'role');
}

function get_book_by_barcode($barcode)
{
	global $mysqli;
	
	$mediaItemIdQuery 	= "SELECT * FROM `hardcopy` WHERE `barcode` = $barcode";
	
	$result = $mysqli->query($mediaItemIdQuery);
	
	if(!$result)
	{
		// bad things happen \die?
	}
	else
	{
		$row = $result->fetch_assoc();
		$mediaitem_id = $row['mediaitem_id'];
	}
	
	return get_book_by_mediaItem_id($mediaitem_id);
}

function get_book_by_mediaItem_id($mediaitem_id)
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
	
	//Query for the hardcopy
	$check_for_item_query = "SELECT * FROM `hardcopy` WHERE `barcode` = $barcode";
	$item_result = $mysqli->query($check_for_item_query);
	if($temp = check_sql_error($item_result))
		return $temp;
		
	//Query for the patron
	$check_for_patron_query = "SELECT * FROM `patron` WHERE `id` = $patron_id";
	$patron_result = $mysqli->query($check_for_patron_query);	
	if($temp = check_sql_error($patron_result))
		return $temp;
	
	if($item = $item_result->fetch_assoc())
	{ //The book is exists. Check it out.
		$checkout_duration = $item['checkout_duration'];
		$renew_count = $item['renew_count'];
		
		//If checkout_duration or renew_count = 0, this book cannot be checked out
		if($checkout_duration === 0 || $renew_count === 0)
			return array('error'=>'Book cannot be checked out of library', 'error_code'=>5);
		
		if($patron = $patron_result->fetch_assoc())
		{ //The patron exists. Have they exceeded checkout limit?
			$checkout_list = $mysqli->query("SELECT * FROM `checkedout` WHERE `id` = $patron_id");
			if($temp = check_sql_error($checkout_list))
				return $temp;
			if($checkout_list->num_rows < $patron['checkout_limit'] )
			{//Go ahead and checkout the book!
				$date = new DateTime();
				$date->add(DateInterval::createFromDateString("$checkout_duration days"));
				$arr = array('patron_id'=>$patron_id, 'hardcopy_barcode'=>$barcode,
					'due_date'=>$date->format('Y-m-d'), 'renew_count'=>$renew_count);
				return add_checkedout($arr);
			}
			else
			{
				return array('error'=>'Checkout limit exceeded', 'error_code'=>7);
			}
		}
		else
		{
			return array('error'=>'The patron could not be found', 'error_code'=>6);
		}
	}
	else
		return array('error'=>"No such book exists", 'error_code'=>4);
}

function check_in($barcode)
{
	global $mysqli;
	
	clean_string($barcode);
	
	$check_for_item_query = "SELECT * FROM `checkedout` WHERE `hardcopy_barcode` = $barcode"; 
	$result = $mysqli->query($check_for_item_query);
	
	if($temp = check_sql_error($result))
		return $temp;
	
	if($result->fetch_assoc)
	{ 	//The book is checked out, check it in
		return delete_from_table('hardcopy_barcode',$barcode,'checked_out');
	}
	else
		return array('error'=>"Book with barcode $barcode is not checked out", 'error_code'=>4);
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
	{	//The book is on hold
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

?>