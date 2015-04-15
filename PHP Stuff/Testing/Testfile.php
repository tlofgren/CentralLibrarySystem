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
?>
		<fieldset> 	<legend>	login()		</legend>
			<?php//$result = get_librarian_permissions(1); ?>
			<pre><?php	print_r(login("Tester", "Hello World!", "librarian"));	?><pre>
		</fieldset>
		<fieldset> 	<legend>	add_mediaitem()	</legend>
			<?php
			$book1 = array('title'=>'The Hunger Games',
						'year'=>'2010','isbn'=>'24234256',
						'media_type'=>'book');
			$book2 = array('title'=>'The Bible',
						'year'=>'0');
			$book3 = array('year'=>'2014','isbn'=>'213457',
						'media_type'=>'book');
			?>
			<pre><?php 	print_r(add_mediaitem($book1)); ?></pre>
			<pre><?php 	print_r(add_mediaitem($book2)); ?></pre>
			<pre><?php print_r(add_mediaitem($book3)); ?></pre>
		</fieldset>
		<fieldset> 	<legend>	get_user_by_id()	</legend>
			<pre><?php	print_r(get_user_by_id(1));	?></pre>
			<pre><?php	print_r(get_user_by_id(0)); ?></pre>
		</fieldset>
		<fieldset> 	<legend>	Test : get_book_by_mediaItem_id()	</legend>
			<h4>get_book_by_mediaItem_id(0)</h4>
			<p>Failure Expected</p>
			<pre><?php 	print_r(get_book_by_mediaItem_id(0)); ?></pre>
			<p>Success Expected</p>
			<pre><?php	print_r(get_book_by_mediaItem_id(1)); ?></pre>
			<p>Success Expected</p>
			<pre><?php 	print_r(get_book_by_mediaItem_id(2)); ?></pre>
		</fieldset>
		<fieldset> 	<legend>	get_book_by_barcode()	</legend>
			<p>Success Expected</p>
			<pre><?php	print_r(get_book_by_barcode(1));	?></pre>
			<p>Failure Expected</p>
			<pre><?php	print_r(get_book_by_barcode(0));	?></pre>
		</fieldset>
		<fieldset> 	<legend>	delete_from_admin()	</legend>
			<p>Failure Expected</p>
			<pre><?php	print_r(delete_from_admin(1));	?></pre>
			<p>Success Expected</p>
			<pre><?php	print_r(delete_from_admin(3));	?></pre>
			<p>Empty Expected</p>
			<pre><?php	print_r(delete_from_admin(-1));	?></pre>
		</fieldset>
	</body>
</html>