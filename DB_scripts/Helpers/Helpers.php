<?php
require_once "Connect.php";

function clean_string(&$arg)
{
	global $mysqli;
	htmlentities($arg);
	$mysqli->real_escape_string($arg);
}

function check_sql_error($result)
{
	global $mysqli;
	
	if(!$result)
	{
		$error_arr = array();
		$error_arr['error'] = $mysqli->error;
		$error_arr['error_code'] = 0;
		return $error_arr;
	}
	return false;
}

function surround_in_quotes(&$arr)
{
	array_walk($arr, create_function('&$str', '$str = "\'$str\'";'));
}

function surround_in_ticks(&$arr)
{
	array_walk($arr, create_function('&$str', '$str = "`$str`";'));
}

function required_fields_for_hardcopy_exist(&$arr)
{
	if(array_key_exists('barcode', $arr))
	{
//		if(array_key_exists('checkout_duration', $arr))
//		{
//			if(array_key_exists('renew_limit', $arr))
//			{
				return true;
//			}
//		}
	}
	
	return false;
}
function required_fields_for_mediaitem_exist(&$arr)
{
	if(array_key_exists('title', $arr))
	{
		if(array_key_exists('media_type', $arr))
		{
			if(array_key_exists('isbn', $arr))
			{
				return true;
			}
		}
	}
	
	return false;
}

function required_fields_for_tag_exist(&$arr)
{
	if(array_key_exists('name', $arr))
	{
		if(array_key_exists('type', $arr))
		{
//			if($arr['type'] != 'title' && $arr['type'] != 'subject' && $arr['type'] != 'genre' && $arr['type'] != 'language' && $arr['type'] != 'contributor')
//			{
//				return false;
//			}
			return true;
		}
	}
	
	return false;
}

function clean_exists_make_empty_if_not($arr, $key)
{
	if(array_key_exists($key, $arr))
	{
		clean_string($arr[$key]);
		return $arr[$key];
	}
	else
	{
		return '';
	}
}

function clean_exists_make_null_if_not($arr, $key)
{
	if(array_key_exists($key, $arr))
	{
		clean_string($arr[$key]);
		return $arr[$key];
	}
	else
	{
		return 'NULL';
	}
}

function append_required_fields(&$arr,$tablename)
{ 
	if($tablename == 'admin')
	{
		if(!array_key_exists('username',$arr))
			$arr['username'] = 'NULL';
		if(!array_key_exists('password_hash',$arr))
			$arr['password_hash'] = 'NULL';
		if(!array_key_exists('salt',$arr))
			$arr['salt'] = 'NULL';
	}
	if($tablename == 'checkedout')
	{
		if(!array_key_exists('patron_id',$arr))
			$arr['patron_id'] = 'NULL';
		if(!array_key_exists('hardcopy_barcode',$arr))
			$arr['hardcopy_barcode'] = 'NULL';
		if(!array_key_exists('due_date',$arr))
			$arr['due_date'] = 'NULL';
		if(!array_key_exists('renew_count',$arr))
			$arr['renew_count'] = 'NULL';
	}
	if($tablename == 'contribution')
	{
		if(!array_key_exists('mediaitem_id',$arr))
			$arr['mediaitem_id'] = 'NULL';
		if(!array_key_exists('contributor_id',$arr))
			$arr['contributor_id'] = 'NULL';
		if(!array_key_exists('role_id',$arr))
			$arr['role_id'] = 'NULL';
	}
	if($tablename == 'contributor')
	{
		if(!array_key_exists('last',$arr))
			$arr['last'] = 'NULL';
	}

	if($tablename == 'fine')
	{
		if(!array_key_exists('patron_id',$arr))
			$arr['patron_id'] = 'NULL';
		if(!array_key_exists('hardcopy_barcode',$arr))
			$arr['hardcopy_barcode'] = 'NULL';
		if(!array_key_exists('amount',$arr))
			$arr['amount'] = 'NULL';
		if(!array_key_exists('reason',$arr))
			$arr['reason'] = 'NULL';
		if(!array_key_exists('date',$arr))
			$arr['date'] = 'NULL';
		if(!array_key_exists('paid',$arr))
			$arr['paid'] = 'NULL';
	}
	if($tablename == 'hardcopy')
	{
		if(!array_key_exists('barcode',$arr))
			$arr['barcode'] = 'NULL';
		if(!array_key_exists('mediaitem_id',$arr))
			$arr['mediaitem_id'] = 'NULL';
		if(!array_key_exists('copy_no',$arr))
			$arr['copy_no'] = 'NULL';
		if(!array_key_exists('renew_limit',$arr))
			$arr['renew_limit'] = 'NULL';
	}
	if($tablename == 'hold')
	{
		if(!array_key_exists('patron_id',$arr))
			$arr['patron_id'] = 'NULL';
		if(!array_key_exists('mediaitem_id',$arr))
			$arr['mediaitem_id'] = 'NULL';
		if(!array_key_exists('time_placed',$arr))
			$arr['time_placed'] = 'NULL';
		if(!array_key_exists('expiration_date',$arr))
			$arr['expiration_date'] = 'NULL';
	}
	if($tablename == 'itemtag')
	{
		if(!array_key_exists('mediaitem_id',$arr))
			$arr['mediaitem_id'] = 'NULL';
		if(!array_key_exists('tag_id',$arr))
			$arr['tag_id'] = 'NULL';
	}
	if($tablename == 'librarian')
	{
		if(!array_key_exists('username',$arr))
			$arr['username'] = 'NULL';
		if(!array_key_exists('password',$arr))
			$arr['password'] = 'NULL';
		if(!array_key_exists('salt',$arr))
			$arr['salt'] = 'NULL';
		if(!array_key_exists('check_in',$arr))
			$arr['check_in'] = 'NULL';
		if(!array_key_exists('check_out',$arr))
			$arr['check_out'] = 'NULL';
		if(!array_key_exists('add_book',$arr))
			$arr['add_book'] = 'NULL';
		if(!array_key_exists('remove_book',$arr))
			$arr['remove_book'] = 'NULL';
		if(!array_key_exists('add_patron',$arr))
			$arr['add_patron'] = 'NULL';
		if(!array_key_exists('remove_patron',$arr))
			$arr['remove_patron'] = 'NULL';
		if(!array_key_exists('manage_account',$arr))
			$arr['manage_account'] = 'NULL';
		if(!array_key_exists('pay_fines',$arr))
			$arr['pay_fines'] = 'NULL';
		if(!array_key_exists('extend_due_date',$arr))
			$arr['extend_due_date'] = 'NULL';
		if(!array_key_exists('waive_fines',$arr))
			$arr['waive_fines'] = 'NULL';
		if(!array_key_exists('edit_media_entry',$arr))
			$arr['edit_media_entry'] = 'NULL';
		if(!array_key_exists('add_tag',$arr))
			$arr['add_tag'] = 'NULL';
	}
	if($tablename == 'mediaitem')
	{
		if(!array_key_exists('title',$arr))
			$arr['title'] = 'NULL';
		if(!array_key_exists('media_type',$arr))
			$arr['media_type'] = 'NULL';
	}
	if($tablename == 'patron')
	{
		if(!array_key_exists('username',$arr))
			$arr['username'] = 'NULL';
		if(!array_key_exists('password',$arr))
			$arr['password'] = 'NULL';
		if(!array_key_exists('salt',$arr))
			$arr['salt'] = 'NULL';
		if(!array_key_exists('first',$arr))
			$arr['first'] = 'NULL';
		if(!array_key_exists('last',$arr))
			$arr['last'] = 'NULL';
		if(!array_key_exists('checkout_limit',$arr))
			$arr['checkout_limit'] = 'NULL';
		if(!array_key_exists('renew_limit',$arr))
			$arr['renew_limit'] = 'NULL';
	}
	if($tablename == 'role')
		if(!array_key_exists('description',$arr))
			$arr['description'] = 'NULL';

	if($tablename == 'tag')
	{
		if(!array_key_exists('name',$arr))
			$arr['name'] = 'NULL';
		if(!array_key_exists('type',$arr))
			$arr['type'] = 'NULL';
	}
}

function is_possible_enum_val($val,$field)
{
	//Enum possibilities
	$hardcopy_status = array('Damaged/In Repair', 'Lost', 'In Transit', 'Out of Circulation', 'Normal');
	$tags_type = array('title','subject','genre','language');
	$fine_reason = array('Damage','Lost','Overdue','Other');
	$mediaitem_media_type = array('Book','DVD','VHS','CD','Cassette','Projected Medium',
							'Posters and Art','Newspaper','Periodical','Musical Score',
							'Software','Map');

	$possibilities = array();
	if($field == "hardcopy_status")
		$possibilities = $hardcopy_status;
	if($field == "tags_type")
		$possibilities = $tags_type;
	if($field == "fine_reason")
		$possibilities = $fine_reason;
	if($field == "mediaitem_media_type")
		$possibilities = $mediaitem_media_type;
	foreach($possibilities as $option)
	{
		if($val == $option)
		{
			return true;
		}
	}
	return false;
}

function get_hits($str,$tag_type,$results = array())
{
	global $mysqli;
	
	//Throws out useless words and parses string
	$str = strtolower($str);
	include "Stoplist.php";
	$str = preg_replace($stoplist, "", $str);
	$str = preg_replace("/[^0-9^a-zA-Z^\s]+/","",$str);
	$words = preg_split("/[\s,]+/",$str);
	
	//Build results array
	foreach($words as $word)
	{
		$query_result = $mysqli->query("SELECT mediaitem_id FROM itemtag
										JOIN tag ON tag_id = tag.id
										JOIN mediaitem ON mediaitem_id = mediaitem.id
										WHERE name = '$word' AND tag.type = '$tag_type'");
		if($error = check_sql_error($query_result))
			return $error;
		while($row = $query_result->fetch_assoc())
		{
			$id = $row['mediaitem_id'];
			if(array_key_exists($id,$results))
				$results[$id]++;
			else
				$results[$id] = 1;
		}
	}
	arsort($results);
	return $results;
}
?>