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
    <title>Logout Successful | My Librarian Account | CLS</title>
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
            <li class="drop"><a href="CLS-login.php">My Library Account</a>
              <ul>
                <li><a href="CLS-login.php">Login</a></li>
                <li><a href="CLS-login.php">Check in</a></li>
                <li><a href="CLS-login.php">Check out</a></li>
              </ul>
            </li>
            <li><a href="CLS-search.php">Search Catalog</a></li>
            <li><a href="#">Request a Room</a></li>
            <li><a href="about.php">About The Library</a></li>
            <li><a href="contact.php">Contact Us</a></li>
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
            <li><a href="#">CURRENT PAGE</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- ################################################################################################ -->
    <div class="wrapper row3">
      <!-- main body -->
      <main class="container clear">
        <h1>Logout successful.</h1>
        <h3>Click <a href="CLS-login.php">here</a> to go back to the login page.</h3>
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
    <script src="./scripts/SCRIPTNAME.js"></script> <!-- TODO: REFERENCE OUTSIDE SCRIPTS HERE -->
  </body>
</html>