<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset = "utf-8">
		<title>Testing Test Functions</title>
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

?>
		<fieldset> 	<legend>	verify()		</legend>
			<?php//$result = get_librarian_permissions(1); ?>
			<?php	verify(array("Tester", "Hello World!", "librarian"), array('id'=> 1), 'login')	?>
			<?php	verify(array("Not the username!", "Hello World!", "librarian"), array('id'=> 1), 'login')	?>
			<?php	verify(array("Tester", "Not the password!", "librarian"), array('id'=> 1), 'login')	?>
			<?php	verify(array("Not the username!", "Not the password!", "librarian"), array('id'=> 1), 'login')	?>
		</fieldset>
		
		<?php
			$functionName = 'login';
		
			$input_expected_output_pairs = array();
			$input_expected_output_pairs[] = generate_IEO_pair(array("Tester", "Hello World!", "librarian"), array('id'=> 1));
			$input_expected_output_pairs[] = generate_IEO_pair(array("Not the username!", "Hello World!", "librarian"), array('id'=> 1));
			$input_expected_output_pairs[] = generate_IEO_pair(array("Tester", "Not the password!", "librarian"), array('id'=> 1));
			$input_expected_output_pairs[] = generate_IEO_pair(array("Not the username", "Not the password!", "librarian"), array('id'=> 1));
			
			echo "<pre>";
			print_r($input_expected_output_pairs);
			echo "</pre>";
			
			functionTestBlock($input_expected_output_pairs, $functionName);
			
			$functionName = 'login';
		
			$input_expected_output_pairs = array();
			$input_expected_output_pairs[] = generate_IEO_pair(	array("Tester", "Hello World!", "librarian"), 
																array('id'=> 1));
			$input_expected_output_pairs[] = generate_IEO_pair(	array("Not the username!", "Hello World!", "librarian"), 
																array('error' => 'Bad username', 'error_code' => 1));
			$input_expected_output_pairs[] = generate_IEO_pair(	array("Tester", "Not the password!", "librarian"), 
																array('error' => 'Bad password', 'error_code' => 2));
			$input_expected_output_pairs[] = generate_IEO_pair(	array("Not the username", "Not the password!", "librarian"), 
																array('error' => 'Bad username', 'error_code' => 1));
						
			functionTestBlock($input_expected_output_pairs, $functionName);
		?>
	</body>
</html>