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

	'contributors' => Array
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

echo "<pre>";
$result = add_item($new_item);
print_r($result);
echo "</pre>";

?>
	</body>
</html>