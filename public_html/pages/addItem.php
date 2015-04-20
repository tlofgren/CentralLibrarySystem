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

  <title>Add Item | My Librarian Account | CLS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="../layout/styles/content.css" rel="stylesheet" type="text/css" media="all">

   <!-- JAVASCRIPTS -->
  <script src="../layout/scripts/jquery.min.js"></script>
  <script src="../layout/scripts/jquery.backtotop.js"></script>
  <script src="../layout/scripts/jquery.mobilemenu.js"></script>
  <script src="./scripts/addItem.js"></script>


  </head>
  <body id="top">
    <?php
    $title='';
    $titleError='';
    $year='';
    $yearError='';
    $isbn='';
    $isbnError='';
    $edition='';
    $editionError='';
    $volume='';
    $volumeError='';
    $issueNo='';
    $issueNoError='';
    $tagError='';
    $tag='';
    $contributor='';
    $contributorError='';
    $role='';
    $roleError='';
    $fname='';
    $fnameError='';
    $lname='';
    $lnameError='';
    $barcode='';
    $barcodeError='';
    $copyNo='';
    $copyNoError='';
    $callNo='';
    $callNoError='';
    $checkoutDur='';
    $checkoutDurError='';
    $renewLim='';
    $renewLimError='';



    ?>
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
          <li><a href="#">Add Items</a></li>
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
      </div>
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
      <div class="content three_quarter"> 
        <!-- ################################################################################################ -->

        <form action="addItem.php" method="post" id="addItemForm">
          <fieldset>
            <legend>Add a media item</legend>

            <div>
              <label for='title'>Title: </label>
              <input type='text' id='title' name='title' <?php echo "$title" ?> class='title' />
              <span><?php echo "<p> $titleError </p>" ?></span>
            </div>

            <div>
              <label for='year'>Year: </label>
              <input type='text' id='year' name='year' <?php echo "$year" ?> class='year' />
              <span><?php echo "<p> $yearError </p>" ?></span>
            </div>

            <div>
              <label for='isbn'>ISBN: </label>
              <input type='text' id='isbn' name='isbn' <?php echo "$isbn" ?> class='isbn' />
              <span><?php echo "<p> $isbnError </p>" ?></span>
            </div>

            <div>
              <label for='mediaType'>Media Type: </label>
              <select id='mediaType' name='mediaType'>
                <option value='book'>Book</option>
                <option value='dvd'>DVD</option>
                <option value='vhs'>VHS</option>
                <option value='cd'>CD</option>
                <option value='cassette'>Cassette</option>
                <option value='projectedMedium'>Projected Medium</option>
                <option value='poster&art'>Posters and Art</option>
                <option value='newspaper'>Newspaper</option>
                <option value='periodical'>Periodical</option>
                <option value='musicScore'>Muscial Score</option>
                <option value='Software'>Software</option>
                <option value='Map'>Map</option>
               </select>
            </div>

            <div>
              <label for='edition'>Edition: </label>
              <input type='text' id='edition' name='edition' <?php echo "$edition" ?> class='edition' />
              <span><?php echo "<p> $editionError </p>" ?></span>
            </div>

            <div>
              <label for='volume'>Volume: </label>
              <input type='text' id='volume' name='volume' <?php echo "$volume" ?> class='volume' />
              <span><?php echo "<p> $volumeError </p>" ?></span>
            </div>

            <div>
              <label for='issueNo'>Issue #: </label>
              <input type='text' id='issueNo' name='issueNo' <?php echo "$issueNo" ?> class='issueNo' />
              <span><?php echo "<p> $issueNoError </p>" ?></span>
            </div>

            <div id='tagsDiv'>
              <label for='tag0'>Tags: </label>
              <select name='tag0' id="tagSelect0">
              <option value='title'>Title</option>
              <option value='subject'>Subject</option>
              <option value='genre'>Genre</option>
              <option value='language'>Language</option>
              <option value='contributor'>Contributor</option>
              </select>
              <input type='text' id='tag0' name='tag0' <?php echo "$tag" ?> class='tag0' />
              <span><?php echo "<p> $tagError </p>" ?></span>
              <button type='button' id="addTagButton" onclick="addTag(); return false;">Add another tag</button>
            </div>


            <div id='contributorsDiv'>
              <label for='contributor0'>Contributor: </label>
              <label for='role0'>Role: </label>
              <input type='text' id='role0' name='role0' <?php echo "$role" ?> class='role0' />
              <span><?php echo "<p> $roleError </p>" ?></span>

              <label for='fname0'>First Name: </label>
              <input type='text' id='fname0' name='fname0' <?php echo "$fname" ?> class='fname0' />
              <span><?php echo "<p> $fnameError </p>" ?></span>

              <label for='lname0'>Last Name: </label>
              <input type='text' id='lname0' name='lname0' <?php echo "$lname" ?> class='lname0' />
              <span><?php echo "<p> $lnameError </p>" ?></span>
              <button type='button' id='addContributorButton' onclick="addContributor(); return false;">Add another Contributor</button>
            </div>

            <div>
              <label for='barcode'>Barcode: </label>
              <input type='text' id='barcode' name='barcode' <?php echo "$barcode" ?> class='barcode' />
              <span><?php echo "<p> $barcodeError </p>" ?></span>
            </div>

            <div>
              <label for='copyNo'>Copy#: </label>
              <input type='text' id='copyNo' name='copyNo' <?php echo "$copyNo" ?> class='copyNo' />
              <span><?php echo "<p> $copyNoError </p>" ?></span>
            </div>

            <div>
              <label for='callNo'>Call#: </label>
              <input type='text' id='callNo' name='callNo' <?php echo "$callNo" ?> class='callNo' />
              <span><?php echo "<p> $callNoError </p>" ?></span>
            </div>

            <div>
              <label for='status'> Status: </label>
              <select>
                <option value='damaged'>Damaged/In Repair</option>
                <option value='lost'>Lost</option>
                <option value='inTransit'>In Transit</option>
                <option value='outOfCirc'>Out of Circulation</option>
                <option value='normal'>Normal</option>
              </select>
            </div>

            <div>
              <label for='checkoutDur'> Checkout Duration: </label>
              <input type='text' id='checkoutDur' name='checkoutDur' <?php echo "$checkoutDur" ?> class='checkoutDur' />
              <span><?php echo "<p> $checkoutDurError </p>" ?></span>
            </div>

            <div>
              <label for='renewLim'> Renew Limit: </label>
              <input type='text' id='renewLim' name='renewLim' <?php echo "$renewLim" ?> class='renewLim' />
              <span><?php echo "<p> $renewLimError </p>" ?></span>
            </div>

            <div>
              <label for='submit'>Submit Item</label>
              <input type='submit' id='subItem' name='subItem' value='Submit Item'>
            </div>






          </fieldset>
        </form>


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