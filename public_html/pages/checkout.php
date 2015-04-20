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
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Check Out Items | My Librarian Account | CLS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/content.css" rel="stylesheet" type="text/css" media="all">

     <!-- JAVASCRIPTS -->
    <script src="../layout/scripts/jquery.min.js"></script>
    <script src="../layout/scripts/jquery.backtotop.js"></script>
    <script src="../layout/scripts/jquery.mobilemenu.js"></script>
    <script src="./scripts/checkout.js"></script>

  </head>
  <body id="top">
    <?php
      session_start();
      require_once('CLS-banner.php');
    ?>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- this is the links bar of the CLS pages -->
      <div class="wrapper row1">
        <div id="topbar" class="clear"> 
          <nav id="mainav" class="fl_left">
            <ul class="clear">
              <li><a href="CLS-home.php">Home</a></li>
              <li class="active"><a href="CLS-login.php">My Library Account</a></li>
              <li><a href="CLS-search.php">Search Catalog</a></li>
              <li><a href="#">Request a Room</a></li>
              <li><a href="about.php">About The Library</a></li>
              <li><a href="contact.php">Contact Us</a></li>
            </ul>
          </nav>
        </div>
      </div>
    <!-- ################################################################################################ -->
    <div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/02.png');">
      <div class="overlay">
        <div id="breadcrumb" class="clear"> 
          <ul>
            <li><a href="CLS-home.php">Home</a></li>
            <li><a href="CLS-login.php">My Librarian Account</a></li>
            <li><a href="checkout.php">Check out Items</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="wrapper row3">
    <!-- main body -->
    <main class="container clear">
      <?php if (isset($_SESSION['loginSuccess'])) { ?>
      <!-- ################################################################################################ -->
      <!-- sidebar nav -->
      <div class="sidebar one_quarter first"> 
        <nav class="sdb_holder">
          <ul>
            <li><a href="checkin.php">Check In</a></li>
            <li class="active"><a href="checkout.php">Check Out</a></li>
            <li><a href="holds.php">Holds</a></li>
            <li><a href="fines.php">Fines</a></li>
            <li><a href="editItems.php">Manage Catalog</a> <!-- TODO: link to same page as Edit/Remove -->
              <ul>
                <li><a href="addItem.php">Add Items</a></li>
                <li><a href="editItems.php">Edit/Remove Items</a></li>
              </ul>
            </li>
            <li><a href="addPatron.php">Manage Patrons</a>
              <ul>
                <li><a href="addPatron.php">Add New Patron</a></li>
                <li><a href="editPatron.php">Edit Patron Profile</a></li>
              </ul>
          </ul>
        </nav>
      </div>
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
      <div class="content three_quarter">         
        <h1>Check Out Items</h1>
        <fieldset id='patronSelect'>
          <form id='patron-form'>
            <div>
              <label for='patron-field'>Patron #</label>
              <input type='text' id='patron-field' name='patron-field' />
            </div>
          </form>
        </fieldset>
        <fieldset id='checkoutSelect'>
          <p id='userInfo'>

          </p>
          <form id='checkout-form'>
            <div>
              <label for='checkout-field'>Item #: </label>
              <input type='text' id='checkout-field' name='checkout-field' class='item-entry'/>
            </div>
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
      <?php } else {
          require_once 'not_logged_in.html';
        }
      ?>
      </div>
    </main>
    
    <?php require_once 'CLS-footer.php'; ?>
    <!-- ################################################################################################ -->
    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
  </body>
</html>
