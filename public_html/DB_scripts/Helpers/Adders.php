<?php
require_once "Helpers.php";

/////////////////////////////////////////////////////////////////////////////////////////////////
//	Basis for whole file.
function add_to_table($arr,$tablename)
{
	global $mysqli;
	
	surround_in_quotes($arr);
	
//	echo "<pre>";
//	print_r($arr);
//	echo "</pre>";
	
	append_required_fields($arr, $tablename);
	
//	echo "<pre>";
//	print_r($arr);
//	echo "</pre>";
	
	$fields = array_keys($arr);
	$vals = array_values($arr);
	
	$query = "INSERT INTO `$tablename`(`".implode("`, `", $fields)."`)
		VALUES (".implode(", ", $vals).")";
	
//	echo "<p>$query</p>";
	
	$result = $mysqli->query($query);

	if($temp = check_sql_error($result))
		return $temp;
	
	return array();
}

/////////////////////////////////////////////////////////////////////////////////////////////////

function add_admin($arr)
{
	return add_to_table($arr,'admin');
}

function add_checkedout($arr)
{
	return add_to_table($arr,'checkedout');
}

function add_contribution($arr)
{
	return add_to_table($arr,'contribution');
}

function add_contributor($arr)
{
	return add_to_table($arr,'contributor');
}

function add_fine($arr)
{
	return add_to_table($arr,'fine');
}

function add_hardcopy($arr)
{
	return add_to_table($arr,'hardcopy');
}

function add_hold($arr)
{
	return add_to_table($arr,'hold');
}

function add_itemtag($arr)
{
	return add_to_table($arr,'itemtag');
}

function add_librarian($arr)
{
	return add_to_table($arr,'librarian');
}

function add_mediaitem($arr)
{
	return add_to_table($arr,'mediaitem');
}

function add_patron($arr)
{
	return add_to_table($arr,'patron');
}

function add_role($arr)
{
	return add_to_table($arr,'role');
}

function add_tag($arr)
{
	return add_to_table($arr,'tag');
}


?>