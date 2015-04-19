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
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Check in | My Librarian Account | CLS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/content.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body id="top">
    <?php 
      session_start();
      require_once('CLS-banner.php');
    ?>
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
            <li><a href="#">About The Library</a></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- ################################################################################################ -->
    <div class="wrapper row2 bgded" >
      <div class="overlay">
        <div id="breadcrumb" class="clear"> 
          <ul>
            <li><a href="CLS-home.php">Home</a></li>
            <li><a href="CLS-login.php">My Librarian Account</a></li>
            <li><a href="checkin.php">Check in</a></li>
          </ul>
        </div>
      </div>
    </div>
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
              <li class="active"><a href="checkin.php">Check In</a></li>
              <li><a href="checkout.php">Check Out</a></li>
              <li><a href="holds.php">Holds</a></li>
              <li><a href="#">Fines</a></li>
              <li><a href="#">Manage Catalog</a>
                <ul>
                  <li><a href="#">Add Items</a></li>
                  <li><a href="#">Edit/Remove Items</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
        <!-- ################################################################################################ --><!--  <button name="submitItemID" id="submitItemID" value="Go" /> -->
        <!-- ################################################################################################ -->
        <div class="content three_quarter"> 
          <h1>Check in items</h1>
          <div class="item-entry"> <!-- TODO: make custom css for this class? -->
            <form id="checkin-form">
              <label for="checkin-field">Item ID:</label>
              <input type="text" id="checkin-field" name="checkin-field" maxlength="15" />
              <span class="input-error-msg" id="itemID-error">Please enter a valid ID.</span>
            </form>
          </div>
          <div class="scrollable">
            <table id="checkInTable">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Author(s)</th>
                  <th>Call Number</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <!-- filled in as user enters items -->
              </tbody>
            </table>
          </div> <!-- scrollable -->
          <!-- ################################################################################################ -->
        </div> <!-- three quarter -->
        <!-- ################################################################################################ -->
        <?php } else {
          require_once('not_logged_in.html');
        } ?>
        <!-- / main body -->
        <!-- <div class="clear"></div> -->
      </main>
    </div> <!-- row3 -->
    <?php require_once('CLS-footer.php'); ?>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
    
    <!-- JAVASCRIPTS -->
    <script src="../layout/scripts/jquery.min.js"></script>
    <script src="../layout/scripts/jquery.backtotop.js"></script>
    <script src="../layout/scripts/jquery.mobilemenu.js"></script>
    <script src="./scripts/checkin.js"></script>
  </body>
</html>