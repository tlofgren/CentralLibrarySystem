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
    <?php session_start(); ?>
    <!-- ################################################################################################ -->
    <?php require_once "../../DB_scripts/Queries.php"; 
      // This function needs to pass the integer item id (from a media item in the database) as its argument.
      // The item id will be passed to this page using $_GET or $_SESSION when the link is generated on the search page.
      // At the moment it is hard coded to 1 which is the BOM.
      $id = $_GET['link'];
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
              <a href="CLS-item-info.php">
                <?php
                  if(isset($itemInfo['title'])) {
                    echo $itemInfo['title'];
                  }
                ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- ################################################################################################ -->
    <div class="wrapper row3">
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
    <!-- ################################################################################################ -->
    <div class="content three_quarter"> 
    <!-- ################################################################################################ -->
    <!-- main body content goes here -->
    <!-- This page displays the general information about a specific media item -->
    <?php 
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
            <ul>
              <?php if(isset($itemInfo['year'])) { ?>
                <li>
                Year: 
                <?php echo $itemInfo['year']; ?>
                </li>
              <?php } ?>
              <?php if(isset($itemInfo['isbn'])) { ?>
                <li>
                ISBN: 
                <?php echo $itemInfo['isbn']; ?>
                </li>
              <?php } ?>
              <?php if(isset($itemInfo['media_type'])) { ?>
                <li>
                Media type: 
                <?php echo $itemInfo['media_type']; ?>
                </li>
              <?php } ?>
              <?php if(isset($itemInfo['edition'])) { ?>
                <li>
                Edition: 
                <?php echo $itemInfo['edition']; ?>
                </li>
              <?php } ?>
              <?php if(isset($itemInfo['volume'])) { ?>
                <li>
                Volume: 
                <?php echo $itemInfo['volume']; ?>
                </li>
              <?php } ?>
              <?php if(isset($itemInfo['issue_no'])) { ?>
                <li>
                Issue Number: 
                <?php echo $itemInfo['issue_no']; ?>
                </li>
              <?php } ?>
              <?php if(isset($itemInfo['contributors'])) { ?>
                <li>
                <?php foreach(array_keys($itemInfo['contributors']) as $paramName)
                  echo $paramName;
                  echo ": ";
                  if(isset($itemInfo['contributors'][$paramName]['0']['first'])) {
                    echo $itemInfo['contributors'][$paramName]['0']['first'];
                    echo " ";
                  }
                  if(isset($itemInfo['contributors'][$paramName]['0']['last'])) {
                    echo $itemInfo['contributors'][$paramName]['0']['last'];
                  }
                ?>
                </li>
              <?php } ?>
            </ul>
          </fieldset>
        </form>
      </div>
    </div>
    <?php 
    } ?>
    <!-- ################################################################################################ -->
    </div> <!-- three quarter -->
    <!-- ################################################################################################ -->
    <!-- / main body -->
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
    <script src="../layout/scripts/jquery.min.js"></script>
    <script src="../layout/scripts/jquery.backtotop.js"></script>
    <script src="../layout/scripts/jquery.mobilemenu.js"></script>
  </body>
</html>