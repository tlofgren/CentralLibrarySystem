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
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
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
		<li><a href="#">Catalog</a></li>
        <li><a href="#">Request a Room</a></li>
		<li><a href="#">About The Library</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </nav>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- This is the home page main background and text -->
	<div class="container">
		<header id="login" class="clear">
			<form class="clear" method="post" action="#">
				<fieldset>
				<legend>Login:</legend>
					<h2>Login</h2>
					<p><input type="text" value="" placeholder="Username"></p>
					<p><input type="password" placeholder="Password"></p>
					<button class="fa fa-sign-in" type="submit" title="Login"><em>Login</em></button>
					<p class="forgot">Forgot your password? <a href="">Click here to reset it.</a></p>
				</fieldset>
			<form>
		</div>
	</div><!-- container -->
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