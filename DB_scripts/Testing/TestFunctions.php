<?php

require_once "../Queries.php";

// Do not call this function, ever, unless you REALLY mean it. It kills all records of everything in the entire database.
function goodbye_world()
{
	global $mysqli;
	
	$tables = array('admin','librarian','patron',
				'checkedout','contribution','contributor',
				'fine','hardcopy','hold','itemtag',
				'mediaitem','role','tag');
	foreach($tables as $table)
		$result = $mysqli->query("TRUNCATE `$table`");
}

function generate_test_entries()
{
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
			0 => array
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
	
	add_item($item1);
	
	add_librarian(array
	(
		'username' => 'tester',
		'password_hash' => 'Hello World!',
		'salt' 				=> 	5,
		'check_in' 			=>	1,
		'check_out'			=>	1,
		'add_book'			=>	1,
		'remove_book'		=>	1,
		'add_patron'		=> 	1,
		'remove_patron'		=>	1,
		'manage_accounts'	=>	1,
		'pay_fines'			=>	1,
		'extend_due_date'	=>	1,
		'waive_fines'		=>	1,
		'edit_media_entry'	=>	1,
		'add_tag'			=>	1
	));
}

function verify($input, $expected_output, $function_name)
{
	$parsed_input = "";
	
	$result = call_user_func_array($function_name, $input);
	
	$errorCount = 0;
	$messages = array();
	$arrays = array();
	
	if($result === $expected_output)
	{
		$messages[] = "<fieldset class = 'success'><legend>Success, exact match</legend><h3>Input :</h3><pre>";
	}
	else if($result == $expected_output)
	{
		$messages[] = "<fieldset class = 'success'><legend>Success, match</legend><h3>Input :</h3><pre>";
	}
	else
	{
		$errorCount = 1;
		$messages[] = "<fieldset class = 'failure'><legend>Failure, no match</legend><h3>Input :</h3><pre>";
	}
	$arrays[] 	= $input;
	$messages[] = "</pre><h3>Expected Output :</h3><pre>";
	$arrays[] 	= $expected_output;
	$messages[] = "</pre><h3>Produced Output :</h3><pre>";
	$arrays[] 	= $result;
	$messages[] = "</pre></fieldset>";
	
	return array('errorCount' => $errorCount, 'strings' => $messages, 'arrays' => $arrays);
}

function displayVerifyResults($strings, $arrays)
{
	$i = 0;
	for($i; $i < count($arrays); $i++)
	{
		echo $strings[$i];
		print_r($arrays[$i]);
	}
	echo $strings[$i];	
}

function functionTestBlock($input_expected_output_pairs, $functionName)
{	
	$results = array();
	$errorCount = 0;
	
	foreach($input_expected_output_pairs as $pair)
	{
		$temp = verify($pair['input'], $pair['output'], $functionName);
		$results[] = $temp;
		$errorCount += $temp['errorCount'];
	}
	
	if($errorCount > 0)
	{
		echo "<fieldset class='BlockFailure'>";
	}
	else
	{
		echo "<fieldset class='BlockSuccess'>";
	}
	
	echo "<legend>$functionName()</legend>";
	
	foreach($results as $result)
	{
		displayVerifyResults($result['strings'], $result['arrays']);
	}
	
	echo "</fieldset>";
}

function generate_IEO_Pair($input, $output)
{
	return array('input' => $input, 'output' => $output);
}

?>