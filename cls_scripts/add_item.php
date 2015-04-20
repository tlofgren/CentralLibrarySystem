<?php
/* add_item.php
 * CLS
 */

/**TODO
require library of php functions
check POST array for vars
call functions to check in items
*/

require_once('../DB_scripts/Queries.php');

$itemAssocArray=[];
if (isset($_POST['title']))
{
	$itemAssocArray['title'] = $_POST['title'];  
}


if (isset($_POST['year']))
{
	$itemAssocArray['year'] = $_POST['year'];  
}

if (isset($_POST['isbn']))
{
	$itemAssocArray['isbn'] = $_POST['isbn'];  
}

if (isset($_POST['media_type']))
{
	$itemAssocArray['media_type'] = $_POST['media_type'];  
}

if (isset($_POST['edition']))
{
	$itemAssocArray['edition'] = $_POST['edition'];  
}

if (isset($_POST['volume']))
{
	$itemAssocArray['volume'] = $_POST['volume'];  
}



// if (isset($_POST['tagsVal']))
// {
// 	$tagsVal = $_POST['tagsVal']; 
// 	$tagsType = $_POST['tagsType'];
// 	$numOfTags = $tagsVal;
// 	for ($i=0; $i < $numOfTags; $i++) { 
// 		$itemAssocArray["tag[$i]"'name'] = $tagsVal[$i];
// 		$itemAssocArray["tag[$i]"'type'] = $tagsType[$i];

// 	}
	 
// }

// if (isset($_POST['roles']))
// {
// 	$contRoles = $_POST['roles']; 
// 	$fnames = $_POST['fnames'];
// 	$lnames= $_POST['lnames'];
// 	$numOfCont = $contRoles;
// 	for ($i=0; $i < $numOfCont; $i++) { 
// 		$itemAssocArray["contributor"][$contRoles][$i]['first'] = $fnames[$i];
// 		$itemAssocArray["contributor"][$contRoles][$i]['last'] = $lnames[$i];
		

// 	}


	 
// }

if (isset($_POST['tag']))
{
	$tags = json_decode($_POST['tag']);
	$itemAssocArray['tag'] = $tags;  
}

if (isset($_POST['contributor']))
{
	$contributor = json_decode($_POST['contributor']);
	$itemAssocArray['contributor'] = $contributor;  
}



if (isset($_POST['barcode']))
{
	$itemAssocArray['barcode'] = $_POST['barcode'];  
}

if (isset($_POST['issue_no']))
{
	$itemAssocArray['issue_no'] = $_POST['issue_no'];  
}

if (isset($_POST['call_no']))
{
	$itemAssocArray['call_no'] = $_POST['call_no'];  
}

if (isset($_POST['copy_no']))
{
	$itemAssocArray['copy_no'] = $_POST['copy_no'];  
}

$result = add_item($itemAssocArray);

echo json_encode($result);
?>