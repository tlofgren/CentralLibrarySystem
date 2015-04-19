<?php
require_once 'Helpers/Helpers.php'

function search_by_subject($str)
{
	return array_keys(get_hits($str,'subject'));
}

function search_by_title($str)
{
	return array_keys(get_hits($str,'title'));
}

function search_by_genre($str)
{
	return array_keys(get_hits($str,'genre'));
}

function search_by_language($str)
{
	return array_keys(get_hits($str,'language'));
}

function search_by_contributor($str)
{
	return array_keys(get_hits($str,'contributor'));
}

function search_all($str)
{
	$results = get_hits($str,'subject');
	$results = get_hits($str,'title',$results);
	$results = get_hits($str,'genre',$results);
	$results = get_hits($str,'language',$results);
	$results = get_hits($str,'contributor',$results);
	return array_keys($results);
	return array_keys($results);
}
?>