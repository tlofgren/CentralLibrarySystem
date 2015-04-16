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
			
			//$arr = array('patron_id'=>$patron_id, 'mediaitem_id'=>$mediaitem_id,
			//	'time_placed'=>$date->format('Y-m-d'), 'expiration_date'=>$date->format('Y-m-d'));
			//	return add_hold($arr);
			$query = "INSERT INTO hold('patron_id', 'mediaitem_id', 'time_placed', 'expiration_date')
				VALUES($patron_id, $mediaitem_id, $time_placed->format('Y-m-d'), $date->format('Y-m-d'))";
				
			$mysqli->query($query);
		}
		
		else
		{
			return array('error'=>'The patron could not be found', 'error_code'=>6);
		}
	}
	else
		return array('error'=>"No such item exists", 'error_code'=>4);
}

?>

