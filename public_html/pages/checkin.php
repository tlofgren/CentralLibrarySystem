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

  <title>Check in | My Librarian Account | CLS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="../layout/styles/content.css" rel="stylesheet" type="text/css" media="all">
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
        <h1>Check in items</h1>
        <div class="item-entry"> <!-- TODO: make custome css for this class? -->
          <label for="checkin-field">Item ID:</label>
          <input type="text" id="checkin-field" maxlength="15" />
          <span class="input-error-msg" id="itemID-error">Please enter a valid ID.</span>
        </div>
        <div class="scrollable">
          <table>
            <thead>
              <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Call Number</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1984</td>
                <td>George Orwell</td>
                <td>AB C12.34 1948</td>
                <td>
                  <select id="status1" class='status' name="item_status_options[]" size="1" > <!--onchange=itemStatusChanged(this)-->
          					<option value="Checked_in" selected>Checked in</option>
          					<option value="Damaged">Damaged</option>
          					<option value="Status3">Status 3</option>
        					</select>
				        </td>
                <td class="notes">notes</td>
              </tr>
              <tr>
                <td>Value 5</td>
                <td>Value 6</td>
                <td>Value 7</td>
                <td><span id="specialStatus">I'm special</span></td>
              </tr>
              <tr>
                <td>Value 9</td>
                <td>Value 10</td>
                <td>Value 11</td>
                <td>Value 12</td>
              </tr>
              <tr>
                <td>Value 13</td>
                <td><a href="#">Value 14</a></td>
                <td>Value 15</td>
                <td>Value 16</td>
              </tr>
            </tbody>
          </table>
        </div> <!-- scrollable -->
        <!-- ################################################################################################ -->
      </div> <!-- three quarter -->
      <!-- ################################################################################################ -->
      <!-- / main body -->
      <div class="clear"></div>
    </main>
  </div>
  <?php require_once('footer.html'); ?>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
  
  <!-- JAVASCRIPTS -->
  <script src="../layout/scripts/jquery.min.js"></script>
  <script src="../layout/scripts/jquery.backtotop.js"></script>
  <script src="../layout/scripts/jquery.mobilemenu.js"></script>
  <script src="./scripts/checkin.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        // $("#status1").change(function(){
        //     $(this).css("background-color", "#D6D6FF");
        // });
        $("#status1").change(function(){
          // alert("You changed status to " + $('[name="item_status_options[]"]').val());
          if ($('[name="item_status_options[]"]').val() === "Damaged")
          {
            alert("You changed status to Damaged");
            
          }

          // $(this).html() += "<option value='status4'>status 4</option>";
          // var newOpt = document.createElement("option");
          // newOpt.innerHTML = "status4";
          // $(this).append(newOpt);
        });
    });

    /* possible addons:
     * animation on rows
     */
  </script>
    </body>
</html>