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

function add_item($arr)//barcode, title, year, media_type, edition, volume, issue_no already, contributors, role, tags
{	
	$copy_number = 1;
	
	$query = "SELECT * FROM `hardcopy` WHERE `barcode` = $arr['barcode']";
	$result = $mysqli->query($query);
	
	if($temp = check_sql_error($result))
		return $temp;
		
	if($item = $result->fetch_assoc())	//barcode already in hardcopy
	{
		return array('error'=>"Barcode $barcode is already in mediaItem", 'error_code'=>9);
	}
		
	//Check for already existing media item 
	$query = "SELECT * FROM `mediaitem` 
		WHERE `title` = $arr['title'] AND `year` = $arr['year'] AND `media_type` = $arr['media_type'] 
			AND `edition` = $arr['edition'] AND `volume` = $arr['volume'] AND `issue_no` = $arr['issue_no']";
	$result = $mysqli->query($query);
	
	if($temp = check_sql_error($result))
		return $temp;
		
	if($result->fetch_assoc())	//The media item already exists
	{	
		//$copy_number = how many already exist
	}
	else	
		//add new mediaitem
		//add contributor
		//add role
		//add contribution
		//add tags
		//add itemtag
		
	//add hardcopy 
	
	//$arr = array( These values need to be changed:
						//'barcode'			  =>	$barcode, 
						//'mediaitem_id'	  =>	$mediaitem_id,
						//'copy_no'		      =>	$copy_no,
						//'call_no'	          =>	$call_no,
						//'status'	          =>	$status,
						//'checkout_duration' =>	$checkout_duration
						
				);
			
			return add_hardcopy($arr);
	
	

}

?>


