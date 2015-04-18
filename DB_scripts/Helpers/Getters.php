<?php
require_once "Helpers.php";

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