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
	

	//Clear database and repopulate it
	//	goodbye_world();
	//	generate_test_entries();

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Queries.php
	
//	/*
	
	functionTestBlock(	standard_login_IEO_pairs(), 					'login');
	functionTestBlock(	standard_get_librarian_permissions_IEO_pairs(), 'get_librarian_permissions');
	functionTestBlock(	standard_get_general_item_info_IEO_pairs(), 	'get_general_item_info');
	functionTestBlock(	standard_get_copy_info_IEO_pairs(), 			'get_copy_info');
	functionTestBlock(	standard_get_user_by_id_IEO_pairs(), 			'get_user_by_id');
	functionTestBlock(	standard_change_status_IEO_pairs(), 			'change_status');
	functionTestBlock(	standard_check_out_IEO_pairs(), 				'check_out');
	functionTestBlock(	standard_check_in_IEO_pairs(), 					'check_in');
	functionTestBlock(	standard_place_hold_IEO_pairs(), 				'place_hold');
	functionTestBlock(	standard_remove_hold_IEO_pairs(), 				'remove_hold');
	functionTestBlock(	standard_add_item_IEO_pairs(), 					'add_item');

	
//	*/
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Adders.php

//	/*

	// add_to_table
	
	functionTestBlock(standard_add_admin_IEO_pairs(), 			'add_admin');
	// add_checkedout
	functionTestBlock(standard_add_contribution_IEO_pairs(),	'add_contribution');
	functionTestBlock(standard_add_contributor_IEO_pairs(), 	'add_contributor');
	// add_fine
	functionTestBlock(standard_add_hardcopy_IEO_pairs(), 		'add_hardcopy');
	functionTestBlock(standard_add_hold_IEO_pairs(), 			'add_hold');
	functionTestBlock(standard_add_itemtag_IEO_pairs(), 		'add_itemtag');
	// add_librarian
	functionTestBlock(standard_add_mediaitem_IEO_pairs(), 		'add_mediaitem');
	// add_patron
	functionTestBlock(standard_add_role_IEO_pairs(), 			'add_role');
	functionTestBlock(standard_add_tag_IEO_pairs(), 			'add_tag');
	
//*/
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Getters.php

//	/*

	functionTestBlock(standard_select_from_table_IEO_pairs(), 		'select_from_table');

	functionTestBlock(standard_get_mediaitem_IEO_pairs(), 			'get_mediaitem');
	//	get_checkouts_by_patron_id
	//	get_hardcopy_by_barcode
	//	***get_patron_by_id
	
//	*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Removers.php

//	/*

	//	delete_from_table

	functionTestBlock(standard_delete_from_admin_IEO_pairs(), 'delete_from_admin');
	
//*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Helpers.php

//	/*

	functionTestBlock(standard_clean_exists_make_empty_if_not_IEO_pairs(), 			'clean_exists_make_empty_if_not');

//	*/

?>
	</body>
</html>