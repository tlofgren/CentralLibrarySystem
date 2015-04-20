<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset = "utf-8">
		<title>Test File!</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

<?php

require_once "../Queries.php";

$new_item = array
(
	'title' 		=> 	'Harry Potter and the Sorcerers Stone',
	'year' 			=> 	1999,
	'isbn'			=>	131415,
	'media_type'	=> 	'Book',
	'edition'		=>	1,
	'volume'		=>	1,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'School',
			'type' => 'Subject'
		),
		1 => array
		(
			'name' => 'Fantasy',
			'type' => 'Genre'
		),
		2 => array
		(
			'name' => 'Magic',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'J. K.',
				'last' 	=> 'Rowling'
			)

		)
	),
	
	'barcode' 			=> 11111,
	'call_no' 			=> 131415,
	'renew_limit' 		=> 1
);


$new_item2 = array
(
	'title' 		=> 	'The Journal of Highly Exciting Stuff and Things',
	'year' 			=> 	2008,
	'isbn'			=>	223322,
	'media_type'	=> 	'Book',
	'edition'		=>	2,
	'volume'		=>	1,
	'issue_no'		=>	404,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'Stuff',
			'type' => 'Subject'
		),
		1 => array
		(
			'name' => 'Journal',
			'type' => 'Genre'
		),
		2 => array
		(
			'name' => 'Things',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> '',
				'last' 	=> 'The Institute of Stuff'
			)

		)
	),
	
	'barcode' 			=> 132231,
	'call_no' 			=> 131415,
	'renew_limit' 		=> 1
);

echo "<pre>";
//$result = add_item($new_item);
$result = add_item($new_item2);
print_r($result);
echo "</pre>";

?>
	</body>
</html>