<?php

require_once "../Queries.php";

$new_item = array
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

echo "<pre>";
$result = add_item($new_item);
print_r($result);
echo "</pre>";

?>