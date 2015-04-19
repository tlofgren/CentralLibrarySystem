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

  <title>Check Out | My Librarian Account | CLS</title>
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
  <?php require_once('CLS-banner.php'); ?>
  <!-- this is the links bar of the CLS pages -->
<div class="wrapper row1">
  <div id="topbar" class="clear"> 
    <nav id="mainav" class="fl_left">
      <ul class="clear">
        <li><a href="CLS-home.php">Home</a></li>
    <li class="active"><a href="CLS-login.php">My Library Account</a></li>
    <li><a href="CLS-search.php">Search Catalog</a></li>
        <li><a href="#">Request a Room</a></li>
    <li><a href="#">About The Library</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </nav>
  </div>
</div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row3 bgded" >
    <div class="overlay">
      <div id="breadcrumb" class="clear"> 
        <!-- ################################################################################################ -->
        <ul>
          <li><a href="CLS-home.php">Home</a></li>
          <li><a href="CLS-login.php">My Librarian Account</a></li>
          <li><a href="#">Check out Items</a></li>
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
      <?php 
      session_start();
      if (isset($_SESSION['loginSuccess'])) { ?>
      <!-- main body -->
      <!-- ################################################################################################ -->
      <div class="sidebar one_quarter first"> 
        <!-- ################################################################################################ -->
        <!-- <h6>Lorem ipsum dolor</h6> -->
        <nav class="sdb_holder">
          <ul>
            <li><a href="checkin.php">Check In</a></li>
            <li><a href="checkout.php">Check Out</a>
             
            </li>
      			<li><a href="holds.php">Holds</a></li>
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
        
  
        <fieldset id='patronSelect'>
          <form id='patron-form'>
              <div>
                <label for='patron-field'>Patron#: </label>
                <input type='text' id='patron-field' name='patron-field'>
              </div>
          </form>
    </fieldset>

  
     <fieldset id='checkoutSelect'>
      <p id='userInfo'>

      </p>
      <form id='checkout-form' >
     <div>
      <label for='checkout-field'>Book#: </label>
      <input type='text' id='checkout-field' name='checkout-field'>
     </div>
     <h2>Checkout Table</h2>
     <div class="scrollable">

        <table id="checkoutTable">
          <thead>
            <tr>
              
              <th>Title</th>
              <th>Author</th>
              <th>Call Number</th>
              <th>Due Date</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
      
  
      
      </form>
      </fieldset>
      <div class="clear"></div>

      <?php } else {
          require_once('not_logged_in.html');
        } ?>
    </main>
  </div>


  <?php require_once('CLS-footer.php'); ?>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
  
 
  
    </body>
</html>