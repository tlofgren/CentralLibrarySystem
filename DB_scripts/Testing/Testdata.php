<?php
	$item1 = array
	(
		'id' 			=> 	1,
		'title' 		=> 	'The Book of Mormon',
		'year' 			=> 	1900,
		'isbn' 			=> 	0,
		'media_type'	=> 	'Book',
		'tags' => Array
		(
			0 => array
			(
				'name' => 'Religious',
				'type' => 'Subject'
			),
			1 => array
			(
				'name' => 'Religious',
				'type' => 'Genre'
			),
			2 => array
			(
				'name' => 'Mormon',
				'type' => 'Subject'
			)
		),

		'contributors' => Array
		(
			'Author' => Array
			(
				0 => Array
				(
					'first'	=> 'Jesus',
					'last' 	=> 'Christ'
				)

			),
			'Director' => Array
			(
				'0' => Array
				(
					'first' => 'Jesus',
					'last' 	=> 'Christ'
				),
				
				'1' => Array
				(
					'first' => 'Michael',
					'last' 	=> 'Bay'
				)
			)

		),
		
		'barcode' 			=> 1,
		'mediaitem_id' 		=> 1,
		'copy_no' 			=> 1,
		'call_no' 			=> '',
		'status' 			=> 'Lost',
		'checkout_duration' => 0,
		'renew_limit' 		=> 1,
		'due_date' 			=> '2015-04-18',
		'renew_count'		=> 0
	);
	$mediaitem2 = array
	(
		'title'			=>	'The Hunger Games',
		'year'			=>	'2010',
		'isbn'			=>	'24234256',
		'media_type'	=>	'Book'
	);
	$mediaitem3 = array
	(
		'year'			=>	'2014',
		'isbn'			=>	'213457',
		'media_type'	=>	'Book'
	);

//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// A template for all these.
	function standard__IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0
				), 
				array
				(
					'error' 	=> 'Not found',
					'error_code' 	=> 1
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					1
				), 
				array
				(
					
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					2
				), 
				array
				(
					'error' 	=> 'Not found',
					'error_code'	=> 1
				)
			);
			
		return $input_expected_output_pairs;
	}
	

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Queries.php	
	
	function standard_login_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					"Tester",
					"Hello World!", 
					"librarian"
				), 
				array
				(
					'id'		=> 1,
					'user_type' => 'librarian'
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					"Not the username!", 
					"Hello World!", 
					"librarian"
				), 
				array
				(
					'error' => 'Bad username',
					'error_code' => 1
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					"Tester", 
					"Not the password!", 
					"librarian"
				), 
				array
				(
					'error' => 'Bad password', 
					'error_code' => 2
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					"Not the username", 
					"Not the password!", 
					"librarian"
				), 
				array
				(
					'error' => 'Bad username',
					'error_code' => 1
				)
			);
			
		return $input_expected_output_pairs;
	}
	
	function standard_get_librarian_permissions_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0
				), 
				array
				(
					'error' 		=> 'ID not found',
					'error_code' 	=> 3
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					1		// get_librarian_permissions(1);
				), 
				array
				(
					'id' 				=>	1,
					'check_in'	 		=>	1,
					'check_out' 		=>	1,
					'add_book'			=>	1,
					'remove_book' 		=>	1,
					'add_patron' 		=>	1,
					'remove_patron' 	=>	1,
					'manage_accounts'	=>	1,
					'pay_fines' 		=>	1,
					'extend_due_date' 	=>	1,
					'waive_fines' 		=>	1,
					'edit_media_entry'	=>	1,
					'add_tag'			=>	1
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					2
				), 
				array
				(
					'error' 		=> 'ID not found',
					'error_code' 	=> 3
				)
			);
			
		return $input_expected_output_pairs;
	}
		
	function standard_get_general_item_info_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0
				), 
				array
				(
					'error' 	=> 'Not found',
					'error_code' 	=> 1
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					2
				), 
				array
				(
					'error' 	=> 'Not found',
					'error_code'	=> 1
				)
			);
			
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					145
				), 
				array
				(
					'id' => 145,
					'title' => 'Harry Potter and the Sorcerer\'s Stone',
					'year' => 1999,
					'isbn' => 131415,
					'media_type' => 'Book',
					'edition' => 1,
					'volume' => 1,
					'issue_no' => '',
					'tags' => Array
						(
							'0' => 'Harry',
							'1' => 'Potter',
							'2' => 'Sorcerers',
							'3' => 'Stone',
							'4' => 'J',
							'5' => 'K',
							'6' => 'Rowling'
						),

					'contributors' => Array
						(
						),

					'barcodes' => Array
						(
							'0' => 11111
						),

					'num_holds' => 0
				)
			);
			
		return $input_expected_output_pairs;
	}
	
	function standard_get_copy_info_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0
				), 
				array
				(
					'error' 	=> 'Not found',
					'error_code' 	=> 1
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					11111
				), 
				array
				(
					'id' => 145,
					'title' => 'Harry Potter and the Sorcerer\'s Stone',
					'year' => 1999,
					'isbn' => 131415,
					'media_type' => 'Book',
					'edition' => 1,
					'volume' => 1,
					'issue_no' => '',
					'tags' => Array
						(
							'0' => 'Harry',
							'1' => 'Potter',
							'2' => 'Sorcerers',
							'3' => 'Stone',
							'4' => 'J',
							'5' => 'K',
							'6' => 'Rowling'
						),

					'contributors' => Array
						(
						),

					'barcodes' => Array
						(
							'0' => 11111
						),

					'num_holds' => 0,
					'barcode' => 11111,
					'mediaitem_id' => 145,
					'copy_no' => 1,
					'call_no' => 131415,
					'status' => 'Normal',
					'checkout_duration' => 21,
					'renew_limit' => 1
				)
			);
			
		return $input_expected_output_pairs;
	}
	
	function standard_get_user_by_id_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					2
				), 
				array
				(
					'first' 			=> 	'Some',
					'last' 				=> 	'Guy',
					'email'				=>	"",
					'phone'				=>	"",
					'checkout_limit' 	=> 	10,
					'renew_limit' 		=> 	0
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0
				), 
				array
				(
					'error' => 'Bad user id',
					'error_code' => 3
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					10000
				), 
				array
				(
					'error' => 'Bad user id',
					'error_code' => 3
				)
			);
			
		return $input_expected_output_pairs;
	}
	
	function standard_change_status_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					11111,
					'Lost'
				), 
				array
				(
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					2,
					'Damaged/In Repair'
				), 
				array
				(
					'error' 	=> 'Barcode not found',
					'error_code' 	=> 4
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0,
					'Lost'
				), 
				array
				(
					'error' 	=> 'Barcode not found',
					'error_code' 	=> 4
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					11111,
					'notarealstatus'
				), 
				array
				(
					'error' => 'Not a valid enum value',
					'error_code' => 9
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					11111,
					'Normal'
				), 
				array
				(
				)
			);
			
		return $input_expected_output_pairs;
	}
	
	function standard_check_out_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					11111,
					2
				), 
				array
				(
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0,
					0
				), 
				array
				(
					'error' 		=> 'barcode not found',
					'error_code' 	=> 4
				)
			);
			
		return $input_expected_output_pairs;
	}

	function standard_check_in_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0
				), 
				array
				(
					'error' 		=> 'barcode not found',
					'error_code' 	=> 4
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					11111
				), 
				array
				(
					
				)
			);
			
		return $input_expected_output_pairs;
	}
	
	function standard_place_hold_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					145,
					2
				), 
				array
				(
					
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					145,
					0
				), 
				array
				(
					'error' 		=> 'The patron could not be found',
					'error_code' 	=> 6
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					2,
					1
				), 
				array
				(
					'error' 		=> 'No such item exists',
					'error_code'	=> 4
				)
			);
			
		return $input_expected_output_pairs;
	}

	function standard_remove_hold_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					0,
					1
				), 
				array
				(
					'error' 	=> 'Not found',
					'error_code' 	=> 1
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					145,
					2
				), 
				array
				(
					
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					2,
					1
				), 
				array
				(
					'error' 	=> 'Not found',
					'error_code'	=> 1
				)
			);
			
		return $input_expected_output_pairs;
	}
	
	function standard_add_item_IEO_pairs()
	{
		$input_expected_output_pairs = array();
/*		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				
				array
				(
					array
					(
						'title' 		=> 	'Test',
						'year' 			=> 	100,
						'isbn' 			=> 	0,
						'media_type'	=> 	'Book',
						'edition' 		=> 	'',
						'volume' 		=> 	'',
						'issue_no' 		=> 	'',
						'tag' => Array
							(
								0 => 'Stupid',
								1 => 'Religious',
								2 => 'Other'
							),

						'contributor' => Array
							(
								'Author' => Array
									(
										0 => Array
											(
												'first'	=> 'Jesus',
												'last' 	=> 'Christ'
											),
										1 => Array
											(
												'first'	=> 'Michael',
												'last' 	=> 'Bay'
											)

									),
								'Producer' => Array
									(
										0 => Array
											(
												'first' => 'Santa',
												'last'  => 'Claus'
											)
									)
							),
						
						'barcode' 			=> 1,
						'copy_no' 			=> 1,
						'call_no' 			=> '',
						'status' 			=> 'Normal',
						'checkout_duration' => 0,
						'renew_limit' 		=> 1,
					)
				),
				
				array
				(
					'error'			=>	"Barcode 1 is already in use",
					'error_code'	=>	10
				)
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				
				array
				(
					array
					(
						'title' 		=> 	'Test',
						'year' 			=> 	100,
						'isbn' 			=> 	0,
						'media_type'	=> 	'Book',
						'edition' 		=> 	'',
						'volume' 		=> 	'',
						'issue_no' 		=> 	'',
						'tag' => Array
							(
								0 => 'Stupid',
								1 => 'Religious',
								2 => 'Other'
							),

						'contributor' => Array
							(
								'Author' => Array
									(
										0 => Array
											(
												'first'	=> 'Jesus',
												'last' 	=> 'Christ'
											),
										1 => Array
											(
												'first'	=> 'Michael',
												'last' 	=> 'Bay'
											)

									),
								'Producer' => Array
									(
										0 => Array
											(
												'first' => 'Santa',
												'last'  => 'Claus'
											)
									)
							),
						
						'barcode' 			=> 100000,
						'copy_no' 			=> 1,
						'call_no' 			=> '',
						'status' 			=> 'Normal',
						'checkout_duration' => 0,
						'renew_limit' 		=> 1,
					)
				),
				
				array
				(
					'error'			=>	"Duplicate entry '0' for key 'isbn'",
					'error_code'	=>	0
				)
			);
			$input_expected_output_pairs[] = generate_IEO_pair
			(	
				
				array
				(
					array
					(
						'title' 		=> 	'Test',
						'year' 			=> 	100,
						'isbn' 			=> 	200,
						'media_type'	=> 	'Book',
						'edition' 		=> 	'',
						'volume' 		=> 	'',
						'issue_no' 		=> 	'',
						'tag' => Array
							(
								0 => 'Stupid',
								1 => 'Religious',
								2 => 'Other'
							),

						'contributor' => Array
							(
								'Author' => Array
									(
										0 => Array
											(
												'first'	=> 'Jesus',
												'last' 	=> 'Christ'
											),
										1 => Array
											(
												'first'	=> 'Michael',
												'last' 	=> 'Bay'
											)

									),
								'Producer' => Array
									(
										0 => Array
											(
												'first' => 'Santa',
												'last'  => 'Claus'
											)
									)
							),
						
						'copy_no' 			=> 1,
						'call_no' 			=> '',
						'status' 			=> 'Normal',
						'checkout_duration' => 0,
						'renew_limit' 		=> 1,
					)
				),
				
				array
				(
					'error'			=> 	'Required field missing',
					'error_code'	=>	11
				)
			);
			$input_expected_output_pairs[] = generate_IEO_pair
			(	
				
				array
				(
					array
					(
						'year' 			=> 	100,
						'isbn' 			=> 	200,
						'media_type'	=> 	'Book',
						'edition' 		=> 	'',
						'volume' 		=> 	'',
						'issue_no' 		=> 	'',
						'tag' => Array
							(
								0 => 'Stupid',
								1 => 'Religious',
								2 => 'Other'
							),

						'contributor' => Array
							(
								'Author' => Array
									(
										0 => Array
											(
												'first'	=> 'Jesus',
												'last' 	=> 'Christ'
											),
										1 => Array
											(
												'first'	=> 'Michael',
												'last' 	=> 'Bay'
											)

									),
								'Producer' => Array
									(
										0 => Array
											(
												'first' => 'Santa',
												'last'  => 'Claus'
											)
									)
							),
						
						'barcode' 			=> 100000,
						'copy_no' 			=> 1,
						'call_no' 			=> '',
						'status' 			=> 'Normal',
						'checkout_duration' => 0,
						'renew_limit' 		=> 1,
					)
				),
				
				array
				(
					'error'			=> 	'Required field missing',
					'error_code'	=>	11
				)
			);
			$input_expected_output_pairs[] = generate_IEO_pair
			(	
				
				array
				(
					array
					(
						'title' 			=> 	'The Book of Mormon',
						'year' 				=> 	1900,
						'isbn' 				=> 	0,
						'media_type'		=> 	'Book',
						'barcode' 			=> 100000,
						'copy_no' 			=> 1,
					)
				),
				
				array
				(
					'mediaitem'	=>	'already exists'
				)
			);
*/			$input_expected_output_pairs[] = generate_IEO_pair
			(	
				
				array
				(
					array
					(
						'title' 		=> 	'Test',
						'year' 			=> 	100,
						'isbn' 			=> 	200,
						'media_type'	=> 	'Book',
						'edition' 		=> 	'',
						'volume' 		=> 	'',
						'issue_no' 		=> 	'',
						'tag' => Array
							(
								0 => array
								(
									'name' => 'Stupid',
									'type' => 'genre'
								),
								1 => array
								(
									'name' => 'Religious',
									'type' => 'genre'
								),
								2 => array
								(
									'name' => 'Other',
									'type' => 'language'
								)
							),

						'contributor' => Array
							(
								'Author' => Array
									(
										0 => Array
											(
												'first'	=> 'Jesus',
												'last' 	=> 'Christ'
											),
										1 => Array
											(
												'first'	=> 'Michael',
												'last' 	=> 'Bay'
											)

									),
								'Producer' => Array
									(
										0 => Array
											(
												'first' => 'Santa',
												'last'  => 'Claus'
											)
									)
							),
						
						'barcode' 			=> 100000,
						'copy_no' 			=> 1,
						'call_no' 			=> '',
						'status' 			=> 'Normal',
						'checkout_duration' => 0,
						'renew_limit' 		=> 1,
					)
				),
				
				array
				(
					'mediaitem'	=>	'added',
					'hardcopy'	=>	'added',
					'barcode'	=> 	100000
				)
			);
			
			$input_expected_output_pairs[] = generate_IEO_pair
			(	
				
				array
				(
					array
					(
						'title' 		=> 	'Test',
						'year' 			=> 	100,
						'isbn' 			=> 	200,
						'media_type'	=> 	'Book',
						'edition' 		=> 	'',
						'volume' 		=> 	'',
						'issue_no' 		=> 	'',
						'tag' => Array
							(
								0 => array
								(
									'name' => 'Stupid',
									'type' => 'genre'
								),
								1 => array
								(
									'name' => 'Religious',
									'type' => 'genre'
								),
								2 => array
								(
									'name' => 'Other',
									'type' => 'language'
								)
							),

						'contributor' => Array
							(
								'Author' => Array
									(
										0 => Array
											(
												'first'	=> 'Jesus',
												'last' 	=> 'Christ'
											),
										1 => Array
											(
												'first'	=> 'Michael',
												'last' 	=> 'Bay'
											)

									),
								'Producer' => Array
									(
										0 => Array
											(
												'first' => 'Santa',
												'last'  => 'Claus'
											)
									)
							),
						
						'barcode' 			=> 1000001,
						'copy_no' 			=> 1,
						'call_no' 			=> '',
						'status' 			=> 'Normal',
						'checkout_duration' => 0,
						'renew_limit' 		=> 1,
					)
				),
				
				array
				(
					'mediaitem'	=>	'already exists',
					'hardcopy'	=>	'added',
					'barcode'	=> 	1000001
				)
			);
			$input_expected_output_pairs[] = generate_IEO_pair
			(	
				
				array
				(
					array
					(
						'title' 		=> 	'Test',
						'year' 			=> 	100,
						'isbn' 			=> 	200,
						'media_type'	=> 	'Book',
						'edition' 		=> 	'',
						'volume' 		=> 	'',
						'issue_no' 		=> 	'',
						'tag' => Array
							(
								0 => array
								(
									'name' => 'Stupid',
									'type' => 'genre'
								),
								1 => array
								(
									'name' => 'Religious',
									'type' => 'genre'
								),
								2 => array
								(
									'name' => 'Other',
									'type' => 'language'
								)
							),

						'contributor' => Array
							(
								'Author' => Array
									(
										0 => Array
											(
												'first'	=> 'Jesus',
												'last' 	=> 'Christ'
											),
										1 => Array
											(
												'first'	=> 'Michael',
												'last' 	=> 'Bay'
											)

									),
								'Producer' => Array
									(
										0 => Array
											(
												'first' => 'Santa',
												'last'  => 'Claus'
											)
									)
							),
						
						'barcode' 			=> 1000002,
						'copy_no' 			=> 1,
						'call_no' 			=> '',
						'status' 			=> 'Normal',
						'checkout_duration' => 0,
						'renew_limit' 		=> 1,
					)
				),
				
				array
				(
					'mediaitem'	=>	'already exists',
					'hardcopy'	=>	'added',
					'barcode'	=> 	1000002
				)
			);
		return $input_expected_output_pairs;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Adders.php

	function standard_add_admin_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'username' 		=> 'admin4', 
					'password_hash'	=> 'password',
					'salt' 			=> 3,
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'username' 		=> 'admin4', 
					'password_hash'	=> 'password',
					'salt' 			=> 3,
				)
			), 
			array
			(
				'error' 		=> 'Duplicate entry \'admin4\' for key \'username\'', 
				'error_code' 	=> 0
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(
			array
			(
				array
				(
					'username' 		=> 'admin5', 
					'salt' 			=> 3,
				)
			), 
			array
			(
				'error' 		=> 'Column \'password_hash\' cannot be null',
				'error_code' 	=> 0
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'password_hash'	=> 'password',
					'salt' 			=> 3,
				)
			), 
			array
			(
				'error' 		=> 'Column \'username\' cannot be null', 
				'error_code' 	=> 0
			)
		);
		
		return $input_expected_output_pairs;
	}

	function standard_add_contribution_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'role_id' 			=> 7,
					'contributor_id'	=> 1,
					'mediaitem_id'		=> 1
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'role_id' 			=> 7,
					'contributor_id'	=> 1,
					'mediaitem_id'		=> 1
				)
			), 
			array
			(
				
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'role_id' 			=> 0,
					'contributor_id'	=> 1,
					'mediaitem_id'		=> 1
				)
			), 
			array
			() 
		);
		
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'role_id' 			=> 7,
					'contributor_id'	=> 0,
					'mediaitem_id'		=> 1
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'role_id' 			=> 7,
					'contributor_id'	=> 1,
					'mediaitem_id'		=> 0
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'role_id' 			=> 0,
					'contributor_id'	=> 0,
					'mediaitem_id'		=> 0
				)
			), 
			array
			() 
		);
		
		return $input_expected_output_pairs;
	}
	
	function standard_add_contributor_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'first' 		=> 'Michael', 
					'last'			=> 'Bay'
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'first' 		=> 'Michael', 
					'last'			=> 'Bay'
				)
			), 
			array
			(
				'error' 		=> 'Duplicate entry \'Michael-Bay\' for key \'first\'', 
				'error_code' 	=> 0
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(
			array
			(
				array
				(
					'last'			=> 'Bay'
				)
			), 
			array
			()
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'first' 		=> 'Michael'
				)
			), 
			array
			(
				'error' 		=> 'Column \'last\' cannot be null', 
				'error_code' 	=> 0
			)
		);
		
		return $input_expected_output_pairs;
	}
	
	function standard_add_hardcopy_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'mediaitem_id' 		=> 0, 
					'copy_no' 			=> 1,
					'call_no' 			=> 24234256,
					'status' 			=> 'Normal',
					'checkout_duration'	=> 10,
					'renew_limit'		=> 0
				)
			), 
			array
			(
				'error' 		=> 'Column \'barcode\' cannot be null', 
				'error_code' 	=> 0
			) 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'barcode'			=> 1337,
					'mediaitem_id' 		=> 0, 
					'copy_no' 			=> 1,
					'call_no' 			=> 24234256,
					'status' 			=> 'Normal',
					'checkout_duration'	=> 10,
					'renew_limit'		=> 0
				)
			), 
			array
			(
				'error' 		=> 'Cannot add or update a child row: a foreign key constraint fails (`cls`.`hardcopy`, CONSTRAINT `hardcopy_ibfk_1` FOREIGN KEY (`mediaitem_id`) REFERENCES `mediaitem` (`id`))', 
				'error_code' 	=> 0
			) 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'barcode'			=> 1337,
					'mediaitem_id' 		=> 145
				)
			), 
			array
			(
				'error' 		=> 'Column \'copy_no\' cannot be null', 
				'error_code' 	=> 0
			) 
		);
		
		return $input_expected_output_pairs;
	}
	
	function standard_add_hold_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'patron_id' 		=> 2,
					'mediaitem_id' 		=> 149,
					'expiration_date' 	=> '2015-04-21'
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'patron_id' 		=> 2,
					'mediaitem_id' 		=> 150,
					'expiration_date' 	=> '2015-04-21'
				)
			), 
			array
			(
				
			) 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(
			array
			(
				array
				(
					'patron_id' 		=> 1,
					'mediaitem_id' 		=> 0,
					'time_placed' 		=> '2015-04-18',
					'expiration_date' 	=> '2015-04-21'
				)
			), 
			array
			(
				'error' 		=> 'Cannot add or update a child row: a foreign key constraint fails (`cls`.`hold`, CONSTRAINT `hold_ibfk_1` FOREIGN KEY (`patron_id`) REFERENCES `patron` (`id`))',
				'error_code' 	=> 0
			)
		);
		
		return $input_expected_output_pairs;
	}

	function standard_add_itemtag_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'tag_id' 		=> 73,
					'mediaitem_id' 	=> 150
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(	
					'tag_id' 		=> 73,
					'mediaitem_id' 	=> 150
				)
			), 
			array
			(
				'error' 		=>	'Duplicate entry \'73-150\' for key \'PRIMARY\'',
				'error_code' 	=> 0
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'tag_id' 		=> 0,
					'mediaitem_id' 	=> 1
				)
			), 
			array
			(
				'error' 		=> 'Cannot add or update a child row: a foreign key constraint fails (`cls`.`itemtag`, CONSTRAINT `itemtag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`))',
				'error_code' 	=> 0
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'tag_id' 		=> 1,
					'mediaitem_id' 	=> 0
				)
			), 
			array
			(
				'error' 		=> 'Cannot add or update a child row: a foreign key constraint fails (`cls`.`itemtag`, CONSTRAINT `itemtag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`))',
				'error_code' 	=> 0
			)
		);
		
		return $input_expected_output_pairs;
	}
	
	function standard_add_mediaitem_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'title' 		=> 'The Hunger Games', 
					'year' 			=> '2010',
					'isbn' 			=> '24234256',
					'media_type' 	=> 'Book'
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'title'	=> 'The Bible',
					'year' 	=> '0'
				)
			), 
			array
			(
				'error' 		=> 'Column \'media_type\' cannot be null', 
				'error_code' 	=> 0
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(
			array
			(
				array
				(
					'year' 			=> '2014',
					'isbn' 			=> '213457',
					'media_type' 	=> 'Book'
				)
			), 
			array
			(
				'error' 		=> 'Column \'title\' cannot be null',
				'error_code' 	=> 0
			)
		);
		
		return $input_expected_output_pairs;
	}
		
	function standard_add_role_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'description' 		=> 'Author'
				)
			), 
			array
			(
				'error' 		=>	'Duplicate entry \'Author\' for key \'description\'',
				'error_code' 	=> 0
			) 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'description' 			=> 'Tester'
				)
			), 
			array
			()
		);
		
		return $input_expected_output_pairs;
	}
	
	function standard_add_tag_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'name' 		=> 'Stupid',
					'type' 		=> 'Subject'
				)
			), 
			array
			() 
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(	
					'name' 		=> 'Stupid',
					'type' 		=> 'Subject'
				)
			), 
			array
			(
				'error' 		=>	'Duplicate entry \'Stupid-subject\' for key \'name\'',
				'error_code' 	=> 0
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'type' 		=> 'Subject'
				)
			), 
			array
			(
				'error' 		=> 'Column \'name\' cannot be null',
				'error_code' 	=> 0
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(	
				array
				(
					'name' 		=> 'Stupid'
				)
			), 
			array
			(
				'error' 		=> 'Column \'type\' cannot be null',
				'error_code' 	=> 0
			)
		);
		
		return $input_expected_output_pairs;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Getters.php

	function standard_select_from_table_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(
				array
				(
					'barcode' => 11111
				),
				
				'hardcopy'
			), 
			array
			(
				array
				(
					'barcode' 			=> 11111,
					'mediaitem_id' 		=> 145,
					'copy_no' 			=> 1,
					'call_no' 			=> 131415,
					'status' 			=> 'Normal',
					'checkout_duration' => 21,
					'renew_limit' 		=> 1
				)
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(
				array
				(
					'id' => 1
				),
				
				'mediaitem'
			), 
			array
			(
				'error' 		=> 'Not found',
				'error_code'	=> 1
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(
				array
				(
					'id' => 0
				),
				
				'tag'
			), 
			array
			(
				'error' 	=> 'Not found',
				'error_code'	=> 1
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(
				array
				(
					'id' => 145,
					'media_type' => 'Book'
				),
				
				'mediaitem'
			), 
			array
			(
				array
				(
					'id' 			=> 145,
					'title' 		=> 'Harry Potter and the Sorcerer\'s Stone',
					'year' 			=> 1999,
					'isbn' 			=> 131415,
					'media_type' 	=> 'Book',
					'edition' 		=> 1,
					'volume' 		=> 1,
					'issue_no' 		=> ''
				)
			)
		);
			
		return $input_expected_output_pairs;
	}
	
	function standard_get_mediaitem_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(
				array
				(
					'id' => 145
				)
			), 
			array
			(
				array
				(
					'id' 			=> 145,
					'title' 		=> 'Harry Potter and the Sorcerer\'s Stone',
					'year' 			=> 1999,
					'isbn' 			=> 131415,
					'media_type' 	=> 'Book',
					'edition' 		=> 1,
					'volume' 		=> 1,
					'issue_no' 		=> ''
				)
			)
		);
		$input_expected_output_pairs[] = generate_IEO_pair
		(	
			array
			(
				array
				(
					'id' => 145,
					'media_type' => 'Book'
				),
				
				'mediaitem'
			), 
			array
			(
				array
				(
					'id' 			=> 145,
					'title' 		=> 'Harry Potter and the Sorcerer\'s Stone',
					'year' 			=> 1999,
					'isbn' 			=> 131415,
					'media_type' 	=> 'Book',
					'edition' 		=> 1,
					'volume' 		=> 1,
					'issue_no' 		=> ''
				)
			)
		);
			
		return $input_expected_output_pairs;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Removers.php

	function standard_delete_from_admin_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					1
				), 
				array
				(
					
				)
			);
			
		return $input_expected_output_pairs;
	}
	

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//	
// Helpers.php
	
	function standard_clean_exists_make_empty_if_not_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					array
					(
						'title' => 'Book of Mormon'
					),
					'title'
				), 
				
				'Book of Mormon'
			);
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					array
					(
						'nothing' => 1
					),
					'title'
				), 
				
				''
			);
			
		return $input_expected_output_pairs;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
?>