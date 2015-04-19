<?php
require_once "Helpers.php";

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Trying my hand at a basis function.

function select_from_table($arr,$tablename)
{
	$debugging = true;		// Comment this out to stop debugging.
	
	global $mysqli;
	
	if(isset($debugging))
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
	
	$newarr = array();
	
	foreach($arr as $key => $val)
	{
		if($val === 'NULL')
		{
			$newarr[] = "`$key` IS NULL";
		}
		else
		{
			$newarr[] = "`$key` = '$val'";
		}
	}
	
	$query = "SELECT * FROM `$tablename` WHERE ".implode(" AND ", $newarr);
	
	if(isset($debugging))
	{
		echo "<p>$query</p>";
	}
	
	$result = $mysqli->query($query);

	if($temp = check_sql_error($result))
		return $temp;
	
	$success = false;
	
	$final = array();
	
	while($row = $result->fetch_assoc())
	{
		/*
		if($row == array())
		{
			return array
			(
				'error'			=> 'Not found',
				'error_code'	=> 1
			);
		}*/
		$success = true;
		$final[] = $row;
	}
	
	if($success)
	{
		return $final;
	}
	
	return array
	(
		'error'			=> 'Not found',
		'error_code'	=> 1
	);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

function get_contribution($where)
{
	return select_from_table($where, 'contribution');
}

function get_contributor($where)
{
	return select_from_table($where, 'contributor');
}

function get_itemtag($where)
{
	return select_from_table($where, 'itemtag');
}

function get_mediaitem($where)
{
	return select_from_table($where, 'mediaitem');
}

function get_hardcopy($where)
{
	return select_from_table($where, 'hardcopy');
}

function get_role($where)
{
	return select_from_table($where, 'role');
}

function get_tag($where)
{
	return select_from_table($where, 'tag');
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////


function get_checkouts_by_patron_id($id)
{
	global $mysqli;
	$checkout_result = $mysqli->query("SELECT * FROM `checkedout` WHERE `patron_id` = $id");
	if(check_sql_error($checkout_result))
		return FALSE;
	$checkout_list = array();
	while($checkout_list[] = $checkout_result->fetch_assoc());
	return $checkout_list;
}

function get_hardcopy_by_barcode($barcode)
{
	global $mysqli;
	$check_for_item_query = "SELECT * FROM `hardcopy` WHERE `barcode` = $barcode";
	$item_result = $mysqli->query($check_for_item_query);
	if(check_sql_error($item_result))
		return FALSE;
	if($item = $item_result->fetch_assoc())
		return $item;
	return FALSE;
}

//	This functionality (get_patron_by_id) already exists in Queries, get_user_by_id, and I think it is in use, and tested. Should we remove this?
function get_patron_by_id($id)
{
	global $mysqli;
	$patron_result = $mysqli->query("SELECT `id`, `username`, `first`,
								`last`, `email`, `phone`, `checkout_limit`,
								`renew_limit` FROM `patron` WHERE `id`=$id");
	if(check_sql_error($patron_result))
		return FALSE;
	if($patron = $patron_result->fetch_assoc())
		return $patron;
	return FALSE;
}

?>