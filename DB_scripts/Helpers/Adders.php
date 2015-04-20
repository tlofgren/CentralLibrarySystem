<?php
require_once "Helpers.php";

/////////////////////////////////////////////////////////////////////////////////////////////////
//	Basis for whole file.
function add_to_table($arr,$tablename)
{
	global $mysqli;
	
	foreach($arr as $key => $value)
	{
		if($value === 'NULL')
		{
			unset($arr[$key]);
		}
	}
	
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
// This function won't work if you don't properly include all files, don't even try it.
function properly_add_and_return_tag($name, $type)
{
	$tag_description = array
	(
		'name' => $name,
		'type' => $type
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
	if(isset($arr['first']))
	{
		if($arr['first'] === '')
		{
			unset($arr[$key]);
		}
	}
	
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
	foreach($arr as $key => $value)
	{
		if($value === '')
		{
			unset($arr[$key]);
		}
	}
	
	return add_to_table($arr,'tag');
}


?>