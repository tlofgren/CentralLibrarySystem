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
    <title>Holds | My Librarian Account | CLS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/content.css" rel="stylesheet" type="text/css" media="all">

   <!-- JAVASCRIPTS -->
  <script src="../layout/scripts/jquery.min.js"></script>
  <script src="../layout/scripts/jquery.backtotop.js"></script>
  <script src="../layout/scripts/jquery.mobilemenu.js"></script>
  <script src="./scripts/holds.js"></script>

  </head>
  <body id="top">
  <?php require_once('CLS-banner.php'); ?>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/02.png');">
    <div class="overlay">
      <div id="breadcrumb" class="clear"> 
        <!-- ################################################################################################ -->
        <ul>
          <li><a href="CLS-home.php">Home</a></li>
          <li><a href="CLS-login.php">My Librarian Account</a></li>
          <li><a href="holds.php">Manage Holds</a></li>
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
            <li class="active"><a href="holds.php">Holds</a></li>
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
      <!-- ################################################################################################ -->
      <div class="content three_quarter"> 
        <!-- ################################################################################################ -->
        
  
        <fieldset id='patronSelect'>
    <div>
      <label>Patron#: </label>
      <input type='text' id='patronId'>
    </div>
    </fieldset>

  
     <fieldset id='availableHoldsField'>
      <form id='available-holds-form' >
    
     <h2>Available Holds</h2>
     <div class="scrollable">

        <table id="availableHoldsTable">
          <thead>
            <tr>
              <th>Select</th>
              <th>Title</th>
              <th>Author</th>
              <th>Call Number</th>
              <th>Available Until</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
      <div>
        <button>Cancel Holds</button>
      </div>
  
      
      </form>
      </fieldset>


      <fieldset id='unavailableHoldsField'>
      <form id='unavailable-holds-form' >
     <h2>Unavailable Holds</h2>
     <div class="scrollable">

        <table id="unavailableHoldsTable">
          <thead>
            <tr>
              <th>Select</th>
              <th>Title</th>
              <th>Author</th>
              <th>Call Number</th>
              <th>Position in queue</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
      <div>
        <button>Cancel Holds</button>
      </div>
  
      
      </form>
      </fieldset>
      <div class="clear"></div>
    </main>
  </div>
  <?php require_once('CLS-footer.php'); ?>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
  
 
  
    </body>
</html>