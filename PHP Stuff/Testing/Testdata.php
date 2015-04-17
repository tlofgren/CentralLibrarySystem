<?php
	$mediaitem1 = array
		(
			'title'			=>	'The Hunger Games',
			'year'			=>	'2010',
			'isbn'			=>	'24234256',
			'media_type'	=>	'Book'
		);
	$mediaitem2 = array
		(
			'title'			=>	'The Bible',
			'year'			=>	'0'
		);
	$mediaitem3 = array
		(
			'year'			=>	'2014',
			'isbn'			=>	'213457',
			'media_type'	=>	'Book'
		);

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
					'id'=> 1
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
	
	function standard_get_user_by_id_IEO_pairs()
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
					'first' 			=> 	'Barrack',
					'last' 				=> 	'Obama',
					'email'				=>	"",
					'phone'				=>	"",
					'checkout_limit' 	=> 	3,
					'renew_limit' 		=> 	3
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
					2
				), 
				array
				(
					'error' => 'Bad user id',
					'error_code' => 3
				)
			);
			
		return $input_expected_output_pairs;
	}
	
	function standard_get_mediaitem_by_mediaItem_id_IEO_pairs()
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
					'id' 			=> 	1,
					'title' 		=> 	'The Book of Mormon',
					'year' 			=> 	1900,
					'isbn' 			=> 	0,
					'media_type'	=> 	'Book',
					'edition' 		=> 	'',
					'volume' 		=> 	'',
					'issue_no' 		=> 	'',
					'tags' => Array
						(
							0 => 'Religous',
							1 => 'Mormon'
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

								)

						)
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
	
	function standard_get_mediaitem_by_barcode_IEO_pairs()
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
					'id' 			=> 	1,
					'title' 		=> 	'The Book of Mormon',
					'year' 			=> 	1900,
					'isbn' 			=> 	0,
					'media_type'	=> 	'Book',
					'edition' 		=> 	'',
					'volume' 		=> 	'',
					'issue_no' 		=> 	'',
					'tags' => Array
						(
							0 => 'Religous',
							1 => 'Mormon'
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

								)

						),
					
					'barcode' 			=> 1,
					'mediaitem_id' 		=> 1,
					'copy_no' 			=> 1,
					'call_no' 			=> '',
					'status' 			=> 'Lost',
					'checkout_duration' => 0,
					'renew_limit' 		=> 1
				)
			);
			
		return $input_expected_output_pairs;
	}
	
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
	
	function standard_change_status_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					1,
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
					1,
					'notarealstatus'
				), 
				array
				(
					'error' => 'Not a valid enum value',
					'error_code' => 9
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
					1
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
					1,
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
					1,
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
	
	
	function standard_place_hold_IEO_pairs()
	{
		$input_expected_output_pairs = array();
		$input_expected_output_pairs[] = generate_IEO_pair
			(	
				array
				(
					1,
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
					1,
					2
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
?>