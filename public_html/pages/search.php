/*
	Fake search page, to test placing holds

*/


<!DOCTYPE html>
<!--
Template Name: Orizon
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="CoffeeCup HTML Editor (www.coffeecup.com)">
    <meta name="dcterms.created" content="Wed, 08 Apr 2015 19:50:53 GMT">
    <meta name="description" content="">
    <meta name="keywords" content="">

  <title>Search Results | CLS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="../layout/styles/content.css" rel="stylesheet" type="text/css" media="all">

   <!-- JAVASCRIPTS -->
  <script src="../layout/scripts/jquery.min.js"></script>
  <script src="../layout/scripts/jquery.backtotop.js"></script>
  <script src="../layout/scripts/jquery.mobilemenu.js"></script>
  <script src="./scripts/checkout.js"></script>


  </head>
  <body id="top">
  <?php require_once('banner.html'); ?>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/02.png');">
    <div class="overlay">
      <div id="breadcrumb" class="clear"> 
        <!-- ################################################################################################ -->
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">My Librarian Account</a></li>
          <li><a href="#">Check In Items</a></li>
        </ul>
        <!-- ################################################################################################ -->
      </div>
    </div>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row3">
    <main class="container clear"> 
      <!-- main body -->
      <!-- ################################################################################################ -->
      <div class="sidebar one_quarter first"> 
        <!-- ################################################################################################ -->
        <!-- <h6>Lorem ipsum dolor</h6> -->
        <nav class="sdb_holder">
          <ul>
            <li><a href="#">Check In</a></li>
            <li><a href="#">Check Out</a>
              <ul>
                <li><a href="#">Navigation - Level 2</a></li>
                <li><a href="#">Navigation - Level 2</a></li>
              </ul>
            </li>
      			<li><a href="#">Holds</a></li>
      			<li><a href="#">Fines</a></li>
            <li><a href="#">Manage Catalog</a>
              <ul>
                <li><a href="#">Navigation - Level 2</a></li>
                <li><a href="#">Navigation - Level 2</a>
                  <ul>
                    <li><a href="#">Navigation - Level 3</a></li>
                    <li><a href="#">Navigation - Level 3</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- ################################################################################################ -->
      </div>
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
      <div class="content three_quarter"> 
        <!-- ################################################################################################ -->
        
        <form id='searchBar' >
        	<label for='search-bar'>Search For: 
      		<input type='text' id='search-bar' name='search-bar'>
      		</label>
        </form>

        <form action='search.php' method='post'>
        	<fieldset>
        		<?php 
        			$callNum = 1;
        			?>
        	<div>
        		<label>Title: Book of Mormon</label>
        	</div>
        	<div>
        		<label>Author: Christ, Jesus</label>
        	</div>
        	<div>
        		<label>Call #: 1</label>
        	</div>
        	<div>
        		<label>Holds: 0</label>
        	</div>
        	<div>
        		<label>Holds: 0</label>
        	</div>

        	<div>
        		
        		<input type='submit' id='placeHold' name='placeHold' value='Place Hold'/>

        	</div>

        	</fieldset>
        </form>
  
        
      <div class="clear"></div>
    </main>
  </div>
  <?php require_once('footer.html'); ?>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
  
 
  
    </body>
</html>