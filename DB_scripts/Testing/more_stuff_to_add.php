<?php

function remove_hold($mediaitem_id, $patron_id)
{
	global $mysqli;
	
	clean_string($mediaitem_id);
	clean_string($patron_id);
	
	$check_for_hold_query = "SELECT * FROM `hold` WHERE `mediaitem_id` = $mediaitem_id AND `patron_id` = $patron_id"; 
	$result = $mysqli->query($check_for_hold_query);
	
	if($temp = check_sql_error($result))
		return $temp;
	
	if($result->fetch_assoc())
	{ //The book is on hold
		$query = "DELETE FROM `hold` WHERE `mediaitem_id` = $mediaitem_id AND `patron_id` = $patron_id";
	
	$result = $mysqli->query($query);
	}
	else
		return array('error'=>"Book with media item $mediaitem_id and patron id $patron_id combo is not on hold", 'error_code'=>8);
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
		return $temp;
		
	//Query for the patron
	$check_for_patron_query = "SELECT * FROM `patron` WHERE `id` = $patron_id";
	$patron_result = $mysqli->query($check_for_patron_query);	
	
	if($temp = check_sql_error($patron_result))
		return $temp;
	
	if($item = $item_result->fetch_assoc())
	{ //The item exists
		if($patron = $patron_result->fetch_assoc())
		{ //The patron exists.
			$date = new DateTime();
			$time_placed = $date;
			$date->add(DateInterval::createFromDateString("3 days"));
			
			$arr = array('patron_id'=>$patron_id, 'mediaitem_id'=>$mediaitem_id,
				'time_placed'=>$date->format('Y-m-d'), 'expiration_date'=>$date->format('Y-m-d'));
			return add_hold($arr);
		}
		
		else
		{
			return array('error'=>'The patron could not be found', 'error_code'=>6);
		}
	}
	else
		return array('error'=>"No such item exists", 'error_code'=>4);
}

function add_item($arr)
{	
	$title = clean_string($arr['title']); //mediaitem
	$year = clean_string($arr['year']); //mediaitem
	$media_type = clean_string($arr['media_type']); //mediaitem
	$isbn = clean_string($arr['isbn']); //mediaitem
	$edition = clean_string($arr['edition']); //mediaitem
	$volume = clean_string($arr['volume']); //mediaitem
	$issue_no = clean_string($arr['issue_no']); //mediaitem
	$barcode = clean_string($arr['barcode']); //mediaitem
	$contributors = $arr['contributor']; //contributors array
	$description = $arr['role']; //
	$tags = $arr['tag'];

	$description = clean_string($arr['description']);
	$name = clean_string($arr['name']); //tag
	$type = clean_string($arr['type']); //tag
		
	$copy_number = 1;
		
	$query = "SELECT * FROM `hardcopy` WHERE `barcode` = $barcode";
	$result = $mysqli->query($query);
	
	if($temp = check_sql_error($result))
		return $temp;
		
	if($item = $result->fetch_assoc())	//barcode already in hardcopy
	{
		return array('error'=>"Barcode $barcode is already in mediaItem", 'error_code'=>10);
	}
		
	//Check for already existing media item 
	$query = "SELECT `id` FROM `mediaitem` 
		WHERE `title` = $title AND `year` = $year AND `media_type` = $media_type 
			AND `edition` = $edition AND `volume` = $volume AND `issue_no` = $issue_no";
		
	$result = $mysqli->query($query);
		
	if($temp = check_sql_error($result))
		return $temp;
		
	if($row = $result->fetch_assoc())	//The media item already exists
	{	
		$mediaitem_id = $row['id'];
		$query = "SELECT COUNT(*) AS count FROM `hardcopy` WHERE `mediaitem_id` = $mediaitem_id"
		$result = $mysqli->query($query);
		
		if($temp = check_sql_error($result))
			return $temp;
		
		if($row = $result->fetch_assoc())
			$copy_no = $row['count'] + 1;
	}
	else	
	{
		//add new mediaitem
		$arr = array(
						'title'		 =>	$title, 
						'year'	     =>	$year,
						'isbn'		 =>	$isbn,
						'media_type' =>	$media_type,
						'edition'	 =>	$edition,
						'volume'     =>	$volume,
						'issue_no'   => $issue_no
						
				);
		add_mediaitem($arr);
		//get id
		$query = "SELECT `id` FROM `media_item` WHERE `title` = $title AND `year` = $year AND `media_type` = $media_type 
			AND `edition` = $edition AND `volume` = $volume AND `issue_no` = $issue_no";
		$result = $mysqli->query($query);
				
		if($temp = check_sql_error($result))
			return $temp;
				
		if($row = $result->fetch_assoc())
			$mediaitem_id = $row['id'];
			
		//for each contributor
			//check if contributor already exists
			$query = "SELECT `id` FROM `contributor` WHERE `first` = $first AND `last` = $last";
			$result = $mysqli->query($query);
			
			if($temp = check_sql_error($result))
				return $temp;
			
			if($row = $result->fetch_assoc())//contributor already exists
			$contributor_id = $row['id'];
			
			else //add contributor
			{
				$arr = array(
								'first'		 =>	$first, 
								'last'	     =>	$last
						);
				add_contributor($arr);
				//get id
				$query = "SELECT `id` FROM `contributor` WHERE `first` = $first AND `last` = $last";
				$result = $mysqli->query($query);
				
				if($temp = check_sql_error($result))
					return $temp;
				
				if($row = $result->fetch_assoc())
					$contributor_id = $row['id'];
			}
		
			//check if role already exists
			$query = "SELECT `id` FROM `role` WHERE `description` = $description";
			$result = $mysqli->query($query);
			
			if($temp = check_sql_error($result))
				return $temp;
				
			if($row = $result->fetch_assoc()) //role already exists
				$row_id = $row['id'];
			
			else //add role
			{
				$arr = array(
								'description'		 =>	$description 
						);
				add_role($arr);
				//get id
				$query = "SELECT `id` FROM `role` WHERE ``description` = $description";
				$result = $mysqli->query($query);
				
				if($temp = check_sql_error($result))
					return $temp;
				
				if($row = $result->fetch_assoc())
					$role_id = $row['id'];
			}
			
			//add contribution
			$arr = array(
							'mediaitem_id'		 =>	$mediaitem_id, 
							'role_id'	    	 =>	$role_id,
							'contributor_id'	 =>	$contributor_id
					);
			add_contribution($arr);
			
			//add tags
			//for each tag
			//{
				//check if it already exists
				$query = "SELECT `id` FROM `tag` WHERE `name` = $name";
			$result = $mysqli->query($query);
			
			if($temp = check_sql_error($result))
				return $temp;
				
			if($row = $result->fetch_assoc()) //role already exists
				$row_id = $row['id'];
				//$name = 
				//$type = 
				$arr = array(
								'name'		 =>	$name, 
								'type'	     =>	$type
								
						);
			//end for
			
			add_tag($arr);
		
			//add itemtag
			//tag_id =
			//already have mediaitem_id
			$arr = array(
							'tag_id'		 =>	$tag_id, 
							'mediaitem_id'	 =>	$mediaitem_id
					);
			add_itemtag($arr);
		//}
	}
		
	//add hardcopy 
	//$mediaitem_id 
	//$call_no =
	//$status = 
	//$checkout_duration =
	//$renew_limit =
	
	$arr = array(
						'barcode'		    =>	$barcode, 
						'mediaitem_id'		=>	$mediaitem_id
						'copy_no'		    =>	$copy_no,
						'call_no'	        =>	$call_no,
						'status'	        =>	$status,
						'checkout_duration' =>	$checkout_duration,
						'renew_limit'       =>  $renew_limit
				);
			
	add_hardcopy($arr);
	
	return array();
}

?>


