<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset = "utf-8">
		<title>Test File!</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>


<?php
//error_reporting(E_ALL);

//$error_descriptions[E_ERROR]   = "A fatal error has occurred";
//$error_descriptions[E_WARNING] = "PHP issued a warning";
//$error_descriptions[E_NOTICE]  = "This is just an informal notice";

require_once "../Queries.php";
require_once "TestFunctions.php";
require_once "Testdata.php";

//	Debug stuff.
//	echo "<pre>";
//	print_r($input_expected_output_pairs);
//	echo "</pre>";
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	//Clear database and repopulate it
	//goodbye_world();
	//hello_world();

	functionTestBlock(standard_login_IEO_pairs(), 'login');
	
	functionTestBlock(standard_add_mediaitem_IEO_pairs(), 'add_mediaitem');
	
	functionTestBlock(standard_get_user_by_id_IEO_pairs(), 'get_user_by_id');
	
	functionTestBlock(standard_get_mediaitem_by_mediaItem_id_IEO_pairs(), 'get_mediaitem_by_mediaitem_id');
	
	functionTestBlock(standard_get_mediaitem_by_barcode_IEO_pairs(), 'get_mediaitem_by_barcode');
	
	functionTestBlock(standard_delete_from_admin_IEO_pairs(), 'delete_from_admin');
	
	functionTestBlock(standard_change_status_IEO_pairs(), 'change_status');
	
	functionTestBlock(standard_check_in_IEO_pairs(), 'check_in');
	
	functionTestBlock(standard_check_out_IEO_pairs(), 'check_out');
	
	functionTestBlock(standard_remove_hold_IEO_pairs(), 'remove_hold');
	
	functionTestBlock(standard_place_hold_IEO_pairs(), 'place_hold');
?>
		
<!--		<fieldset> 	<legend>	check_out()	</legend>
			<p>Success Expected</p>
			<pre><?php	//print_r(check_out(1, 1));	?></pre>
			<p>Failure Expected</p>
			<pre><?php	//print_r(check_out(0, 0));	?></pre>
		</fieldset>
-->
	</body>
</html>