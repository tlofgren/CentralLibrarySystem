<!DOCTYPE html>
<!--
Template Name: Orizon
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html>
<head>
<title>Search</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<?php session_start(); 
?>
<!-- ################################################################################################ -->
<?php require_once "../../DB_scripts/Queries.php"; ?>
<?php require_once "../../DB_scripts/Search.php"; ?>
<!-- ################################################################################################ -->
<!-- include the banner section -->
<?php require_once "CLS-banner.php"; ?>
<!-- ################################################################################################ -->
<!-- this is the links bar of the CLS pages -->
<div class="wrapper row1">
  <div id="topbar" class="clear"> 
    <nav id="mainav" class="fl_left">
      <ul class="clear">
        <li><a href="CLS-home.php">Home</a></li>
		<li><a href="CLS-login.php">My Library Account</a></li>
		<li class="active"><a href="CLS-search.php">Search Catalog</a></li>
        <li><a href="#">Request a Room</a></li>
		<li><a href="#">About The Library</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </nav>
  </div>
</div>
<!-- ################################################################################################ -->
<?php 
if(isset($_SESSION['loginSuccess'])) { ?>
<div class="wrapper row2 bgded">
    <div class="overlay">
        <div id="breadcrumb" class="clear"> 
        <ul>
            <li><a href="CLS-home.php">Home</a></li>
            <li><a href="CLS-search.php">Search Catalog</a></li>
        </ul>
        </div>
    </div>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row3">
<main class="container clear"> 
<!-- main body -->
<!-- ################################################################################################ -->
<!-- Sidebar with list items to refine a search -->
<div class="sidebar one_quarter first"> 
	<nav class="sdb_holder">
	<p>Narrow your search</p>
		<ul>
			<li><a href="#">Format</a></li>
			<li><a href="#">Publication Date</a></li>
			<li><a href="#">Authors</a></li>
			<li><a href="#">Language</a></li>
			<li><a href="#">Subject</a></li>
			<li><a href="#">Media Type</a></li>
			<li><a href="#">Edition</a></li>
			<li><a href="#">Series</a></li>
		</ul>
	</nav>
</div>
<!-- ################################################################################################ -->
<div class="content .one_half"> 
<!-- main body content goes here -->
<!-- This page displays the results of a search -->
<?php 
if(isset($_SESSION['loginSuccess'])) {
	if(isset($_GET['searchString'])) {
		// echo $_GET['searchString'];
		$searchString = $_GET['searchString'];
	}
	else {
		$searchString = "";
	}
	$searchResult = search_all($searchString); 
	// print_r($searchResult);
	?>
	<div>
		<header>
			<form method="post" action="CLS-search.php" id="search">
				<fieldset>
				<legend>Search:</legend>
					<h2>Search Results:</h2>
					<ul>
						<?php 
						foreach($searchResult as $id) {
							$itemInfo = get_general_item_info($id); 
							echo '<li>';
							echo '<a href="CLS-item-info.php?link=' . $id . '">';
							if(isset($itemInfo['title'])) {
								echo $itemInfo['title'];
								echo " ";
							}
							echo '</a>';
							foreach(array_keys($itemInfo['contributors']) as $paramName) {
								foreach(array_keys($itemInfo['contributors'][$paramName]) as $num) {
									if(isset($itemInfo['contributors'][$paramName][$num]['first'])) {
										echo $itemInfo['contributors'][$paramName][$num]['first'];
										echo " ";
									}
									if(isset($itemInfo['contributors'][$paramName][$num]['last'])) {
										echo $itemInfo['contributors'][$paramName][$num]['last'];
										echo ", ";
									}
								}
							}
							if(isset($itemInfo['year'])) {
								echo $itemInfo['year'];
							}
							echo '</li>';
						} ?>
					</ul>
				</fieldset>
			<form>
		</div>
	</div>
<?php } ?>
<fieldset class="rightSide">
	<ul>
		<li class="rightSide">
			<button class="searchItems" type="submit" name="Print" title="Print">
				<span class="fa fa-print"> Print</span>
			</button>
		</li>
		<li class="rightSide">
			<button class="searchItems" type="submit" name="Save" title="Save">
				<span class="fa fa-save"> Save Search</span>
			</button>
		</li>
		<li class="rightSide">
			<button class="searchItems" type="submit" name="Email" title="Email">
				<span class="fa fa-envelope-o"> Email</span>
			</button>
		</li>
		<li class="rightSide">
			<button class="searchItems" type="submit" name="Share" title="Share">
				<span class="fa fa-plus-circle"> Share</span>
			</button>
		</li>
		<li class="rightSide">
			<button class="searchItems" type="submit" name="Bookmark" title="Bookmark">
				<span class="fa fa-bookmark"> Bookmark</span>
			</button>
		</li>
	</ul>
</fieldset>
</div> <!-- one half -->
<!-- ################################################################################################ -->
<div class="clear"></div>
</main>
</div> <!-- row3 -->
<?php } ?>
<!-- ################################################################################################ -->
<!-- include the footer section -->
<?php require_once "CLS-footer.php"; ?>
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a> 
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>