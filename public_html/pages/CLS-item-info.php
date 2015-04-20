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
<?php 
session_start(); 
?>
<!-- ################################################################################################ -->
<?php require_once "../../DB_scripts/Queries.php"; 
// This function needs to pass the integer item id (from a media item in the database) as its argument.
// The item id will be passed to this page using $_GET or $_SESSION when the link is generated on the search page.
// At the moment it is hard coded to 1 which is the BOM.
if(isset($_GET['link'])) {
	$id = $_GET['link'];
}
else {
	$id = "";
}
$itemInfo = get_general_item_info($id); 
?>
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
				<li>
					<?php
					echo '<a href="CLS-item-info.php?link=' . $id . '">';
					if(isset($itemInfo['title'])) {
						echo $itemInfo['title'];
					}
					?></a>
				</li>
			</ul>
        </div>
    </div>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row3">
<main class="container clear"> 
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
<div class="content one-half"> 
<!-- main body content goes here -->
<!-- This page displays the general information about a specific media item -->
<?php
// get_copy_info() if duedate field it is checked out - call number
if(isset($_SESSION['loginSuccess'])) { ?>
<div>
	<header>
		<form method="post" action="CLS-search.php" id="search">
			<fieldset>
			<legend>Media Item Information:</legend>
				<h2><?php
				if(isset($itemInfo['title'])) {
					echo $itemInfo['title'];
				}
				?></h2>
				<?php if(isset($itemInfo['contributors'])) { ?>
					<?php foreach(array_keys($itemInfo['contributors']) as $paramName) {
						echo "<p>";
						echo $paramName;
						echo ": ";
							foreach(array_keys($itemInfo['contributors'][$paramName]) as $num) {
								if(isset($itemInfo['contributors'][$paramName][$num]['first'])) {
									echo $itemInfo['contributors'][$paramName][$num]['first'];
									echo " ";
								}
								if(isset($itemInfo['contributors'][$paramName][$num]['last'])) {
									echo $itemInfo['contributors'][$paramName][$num]['last'];
									if(isset($itemInfo['contributors'][$paramName][$num + 1]['last'])) {
										echo ", ";
									}
								}
							}
						}
						echo "</p>";
					}
					if(isset($itemInfo['year'])) {
						echo "<p>Year: ";
						echo $itemInfo['year'];
						echo "</p>";
					}
					if(isset($itemInfo['media_type'])) {
						echo "<p>Media type: ";
						echo $itemInfo['media_type'];
						echo "</p>";
					}
					if(isset($itemInfo['edition'])) {
						echo "<p>Edition: ";
						echo $itemInfo['edition'];
						echo "</p>";
					}
					if(isset($itemInfo['volume'])) {
						echo "<p>Volume: ";
						echo $itemInfo['volume'];
						echo "</p>";
					}
					if(isset($itemInfo['issue_no'])) {
						echo "<p>Issue Number: ";
						echo $itemInfo['issue_no'];
						echo "</p>";
					}
					if(isset($itemInfo['isbn'])) {
						echo "<p>ISBN: ";
						echo $itemInfo['isbn'];
						echo "</p>";
					}
					if(isset($itemInfo['barcodes'])) {
						$barcode = $itemInfo['barcodes'];
						$checkedOut = 0;
						$numHolds = 0;
						if(isset($itemInfo['num_holds'])) {
								$numHolds = $itemInfo['num_holds'];
							}
						foreach($barcode as $item) {
							$copyInfo = get_copy_info($item);
							// print_r($copyInfo);
							if(isset($itemInfo['due_date'])) {
								$checkedOut = $checkedOut + 1;
							}
						}
						$numCoppies = count($barcode);
						$numAvailable = $numCoppies - $checkedOut - $numHolds;
						if($numAvailable < 0) {
							$numAvailable = 0;
						}
						echo "<p>Call Number: ";
						if(isset($itemInfo['call-no'])) {
							echo $itemInfo['call-no'];
						}
						echo "</p>";
						echo "<p>Number of copies: ";
						echo $numCoppies;
						echo "</p>";
						echo "<p>Number available: ";
						echo $numAvailable;
						if($numAvailable > 0) { ?>
							<button class="searchItems" type="submit" name="Hold Item" title="Hold Item" href="#">
								<span>Hold Item</span>
							</button>
						<?php }
						echo "</p>";
					}
					if(isset($itemInfo['tags'])) {
						$len = count($itemInfo['tags']);
						echo "<p>Keywords: ";
						foreach(($itemInfo['tags']) as $tags) {
							echo $tags;
							$len = $len -1;
							if ($len >= 1) {
								echo ", ";
							}
						}
					} ?>
				</ul>
			</fieldset>
		<form>
		<?php // print_r($itemInfo); ?>
	</div>
</div>
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
		<li class="rightSide">
			<button class="searchItems" type="submit" name="Cite" title="Cite">
				<span class="fa fa-copy"> Cite</span>
			</button>
		</li>
	</ul>
</fieldset>
<?php 
} ?>
</div> <!-- three quarter -->
<!-- ################################################################################################ -->
</main>
</div>
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