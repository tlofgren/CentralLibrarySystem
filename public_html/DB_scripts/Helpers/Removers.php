<?php
require_once "Helpers.php";
require_once "Getters.php";

/////////////////////////////////////////////////////////////////////////////////////////////////
//	Basis for whole file.
function delete_from_table($fieldname,$key,$tablename)
{
	global $mysqli;
	
	$query = "DELETE FROM $tablename WHERE $fieldname='$key'";
	
	$result = $mysqli->query($query);

	if($temp = check_sql_error($result))
		return $temp;
	
	return array();
}

/////////////////////////////////////////////////////////////////////////////////////////////////

function delete_from_admin($id)
{
	return delete_from_table('id',$id,'admin');
}








?>