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
    <title>Login | CLS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body id="top">
    <?php session_start(); ?>
    <!-- ################################################################################################ -->
    <?php require_once "../../DB_scripts/Queries.php"; ?>
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
    <!-- This is the home page main background and text -->
    <?php if(!isset($_SESSION['loginSuccess'])) { ?>
    	<div class="container">
    		<header id="login" class="clear">
    			<form method="post" action="CLS-login.php" id="loginForm">
    				<fieldset>
    				<legend>Login:</legend>
    					<h2>Login</h2>
    					<p><input type="text" name="user" placeholder="Username"></p>
    					<p><input type="password" name="pass" placeholder="Password"></p>
    					<button class="fa fa-sign-in" type="submit" name="login" title="Login"><em>Login</em></button>
    					<p class="forgot">Forgot your password? <a href="">Click here to reset it.</a></p>
    					<!-- ########## php login code ########## -->
    					<?php
    						if(isset($_POST["login"])) {
    							if(isset($_POST["user"]) && isset($_POST["pass"])) {
    								// echo "<p>User: $_POST[user]</p>";
    								// echo "<p>Password: $_POST[pass]</p>";
    								$loginArray = login($_POST['user'], $_POST['pass'], 'librarian');
    								if (array_key_exists('error', $loginArray)) {
    									?>
    									<p class="error">Unrecognized Username or Password.</p>
    									<?php
    									// echo "<p>ERROR - Unable to login</p>";
    									// echo "<p>Error code $loginArray[error_code]</p>";
    								}
    								if (array_key_exists('id', $loginArray)) {
    									$_SESSION['loginSuccess'] = true;
    									$_SESSION['user'] = $_POST['user'];
    									$_SESSION['time'] = date(' h:i:s');
    									$_SESSION['id'] = $loginArray;
    									header("Refresh:0");
    								}
    							}
    						}
    					?>
    				</fieldset>
    			</form>
    		</div>
    	</div>
    <?php 
    } ?>
    <!-- container -->
    <!-- ################################################################################################ -->
    <?php 
    if(isset($_SESSION['loginSuccess'])) { ?>
    <div class="wrapper row2 bgded" >
      <div class="overlay">
        <div id="breadcrumb" class="clear"> 
          <ul>
            <li><a href="CLS-home.php">Home</a></li>
            <li><a href="CLS-login.php">My Librarian Account</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- ################################################################################################ -->
    <div class="wrapper row3">
      <!-- main body -->
    	<main class="container clear"> 
    	  <!-- sidebar nav -->
        <div class="sidebar one_quarter first"> 
          <nav class="sdb_holder">
            <ul>
              <li><a href="checkin.php">Check In</a></li>
              <li><a href="checkout.php">Check Out</a>
                <ul>
                  <li><a href="#">Navigation - Level 2</a></li>
                  <li><a href="#">Navigation - Level 2</a></li>
                </ul>
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
        </div>
    <div class="content three_quarter"> 
    <!-- ################################################################################################ -->
    <!-- main body content goes here -->
    <?php
      $user = $_SESSION["user"];
      $time = $_SESSION["time"];
      echo "<p>Welcome, $user!</p>";
      echo "<p>Logged in at: $time</p>";
    ?>
    <form method="post" action="CLS-login.php" id="loginForm">
    	<button class="logout" type="submit" name="logout" title="Logout"><em>Logout</em></button>
    	<?php
    		if(isset($_POST["logout"])) {
    			unset($_SESSION['loginSuccess']);
    			unset($_SESSION['user']);
    			unset($_SESSION['time']);
    			unset($_SESSION['id']);
    			session_destroy(); ?>
    			<script type="text/javascript">
    				document.getElementById('loginForm').submit(); // SUBMIT FORM
    			</script>
    			<?php
    		}
    	?>
    </form>
    <!-- ################################################################################################ -->
    </div> <!-- three quarter -->
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
    </main>
    </div> <!-- row3 -->
    <?php } //end if(isset($_SESSION['loginSuccess']))?>
    <!-- ################################################################################################ -->
    <!-- include the footer section -->
    <?php require_once "CLS-footer.php"; ?>
    <!-- ################################################################################################ -->
    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a> 
    <!-- JAVASCRIPTS -->
    <script src="../layout/scripts/jquery.min.js"></script>
    <script src="../layout/scripts/jquery.backtotop.js"></script>
    <script src="../layout/scripts/jquery.mobilemenu.js"></script>
  </body>
</html>