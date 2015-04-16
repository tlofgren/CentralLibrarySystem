<?php

require_once "../Queries.php";

function goodbye_world()
{
	global $mysqli;
	
	$tables = array('admin','librarian','patron',
				'checkedout','contribution','contributor',
				'fine','hardcopy','hold','itemtag',
				'mediaitem','role','tag');
	foreach($tables as $table)
		$result = $mysqli->query("TRUNCATE $table");
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