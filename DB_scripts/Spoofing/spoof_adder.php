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

$new_item = array();
$new_item[] = array
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


$new_item[] = array
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


$new_item[] = array
(
	'title' 		=> 	'A Christmas Carol',
	'isbn'			=>	7777,
	'media_type'	=> 	'Book',
	'edition'		=>	2,
	'volume'		=>	1,
	'issue_no'		=>	402,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'Christmas',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Charles',
				'last' 	=> 'Dickens'
			)

		)
	),
	
	'barcode' 			=> 111111,
	'call_no' 			=> 32
);

$new_item[] = array
(
	'title' 		=> 	'Chicken Soup for the Soul',
	'isbn'			=>	7778,
	'media_type'	=> 	'Book',
	'edition'		=>	2,
	'volume'		=>	1,
	'issue_no'		=>	402,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'Self-help',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Jack',
				'last' 	=> 'Canfield'
			),
			1 => Array
			(
				'first'	=> 'Mark Victor',
				'last' 	=> 'Hansen'
			)

		)
	),
	
	'barcode' 			=> 111112,
	'call_no' 			=> 33
);

$new_item[] = array
(
	'title' 		=> 	'The Sorcerer\\\'s Apprentice',
	'isbn'			=>	7779,
	'media_type'	=> 	'Book',
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'Self-help',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'John',
				'last' 	=> 'Richardson'
			)

		)
	),
	
	'barcode' 			=> 111114,
	'call_no' 			=> 34
);
$new_item[] = array
(
	'title' 		=> 	'The Book Thief',
	'media_type'	=> 	'Book',
	'barcode' 			=> 111115,
	'call_no' 			=> 35,
	'isbn'			=>	'',
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Markus',
				'last' 	=> 'Zusak'
			)

		)
	)
);
$new_item[] = array
(
	'title' 		=> 	'The Da Vinci Code',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111116,
	'call_no' 		=> 	37,
	'isbn'			=>	'',
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Dan',
				'last' 	=> 'Brown'
			)

		)
	)
);
//////////////////////////////////////////////////////////
$new_item[] = array
(
	'title' 		=> 	' The Road',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111117,
	'call_no' 		=> 	38,
	'isbn'			=>	200000,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Cormac',
				'last' 	=> 'McCarthy'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'The Girl with the Dragon Tattoo',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111118,
	'call_no' 		=> 	38,
	'isbn'			=>	200001,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Stieg',
				'last' 	=> 'Larsson'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'The Time Traveler\\\'s Wife',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111119,
	'call_no' 		=> 	39,
	'isbn'			=>	200002,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Audrey',
				'last' 	=> 'Niffenegger'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'The Kite Runner',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111120,
	'call_no' 		=> 	40,
	'isbn'			=>	200003,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Khaled',
				'last' 	=> 'Hosseini'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'The Lightning Thief',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111121,
	'call_no' 		=> 	41,
	'isbn'			=>	200004,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Rick',
				'last' 	=> 'Riordan'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'Angels & Demons',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111122,
	'call_no' 		=> 	42,
	'isbn'			=>	200005,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Dan',
				'last' 	=> 'Brown'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'Eat, Pray, Love',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111123,
	'call_no' 		=> 	43,
	'isbn'			=>	200006,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Elizabeth',
				'last' 	=> 'Gilbert'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'Freakonomics: A Rogue Economist Explores the Hidden Side of Everything',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111124,
	'call_no' 		=> 	44,
	'isbn'			=>	200007,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Steven D.',
				'last' 	=> 'Levitt'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'No Country for Old Men',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111125,
	'call_no' 		=> 	45,
	'isbn'			=>	200008,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Cormac',
				'last' 	=> 'McCarthy'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'The Blind Assassin',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111126,
	'call_no' 		=> 	46,
	'isbn'			=>	200009,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Margaret',
				'last' 	=> 'Atwood'
			)

		)
	)
);$new_item[] = array
(
	'title' 		=> 	'Fast Food Nation: The Dark Side of the All-American Meal',
	'media_type'	=> 	'Book',
	'barcode' 		=> 	111127,
	'call_no' 		=> 	47,
	'isbn'			=>	200010,
	
	'tags' => Array
	(
		0 => array
		(
			'name' => 'fiction',
			'type' => 'Subject'
		)
	),

	'contributor' => Array
	(
		'Author' => Array
		(
			0 => Array
			(
				'first'	=> 'Eric',
				'last' 	=> 'Schlosser'
			)

		)
	)
);

echo "<pre>";
//$result = add_item($new_item);
//$result = add_item($new_item2);
foreach($new_item as $book)
{
	$result = add_item($book);

	print_r($result);
}
echo "</pre>";

?>
	</body>
</html>