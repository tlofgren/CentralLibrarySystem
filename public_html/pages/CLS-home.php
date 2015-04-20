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
    <title>Home | CLS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
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
            <li class="active"><a href="CLS-home.php">Home</a></li>
            <li><a href="CLS-login.php">My Library Account</a></li>
            <li><a href="CLS-search.php">Search Catalog</a></li>
            <li><a href="#">Request a Room</a></li>
            <li><a href="about.php">About The Library</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- ################################################################################################ -->
    <!-- This is the home page main background and text -->
    <div class="wrapper bgded" style="background-image:url('../CLS_images/CLSbook.jpg');">
      <section id="intro"> 
        <h2 class="heading uppercase">Lorem ipsum dolor</h2>
      	<h2 class="heading uppercase">sit amet do elit,</h2>
      	<h2 class="heading uppercase">adipiscing tempor</h2>
      	<h2 class="heading uppercase">do eiusmod labore</h2>
      	<h2 class="heading uppercase">incididuntut sed</h2>
      	<h2 class="heading uppercase">et dolore magna</h2>
      	<h2 class="heading uppercase">aliqua.</h2>
      </section>
    </div>
    <!-- ################################################################################################ -->
    <div class="wrapper row3">
      <main class="container clear"> 
        <!-- main body -->
        <div class="group">
          <div class="one_half first"> 
            <figure><a href="#"><img class="borderedbox inspace-10 btmspace-30" src="../CLS_images/CLSboy.jpg" alt=""></a>
              <figcaption class="borderedbox inspace-30 bg-white">
                <h2 class="heading">Curabitur eget elit sit amet purus congue lacinia</h2>
                <p>Aenean semper elementum tellus, ut placerat leo. Quisque vehicula, urna sit amet pulvinar dapibus, dui leo egestas augue, eget molestie augue diam nec ante. Fusce quis feugiat urna.</p>
                <p>Curabitur a sapien tincidunt, ullamcorper mauris sit amet, ornare augue. Suspendisse potenti. Sed eget ultricies sem. Proin quis lacus egestas, adipiscing nunc ornare, gravida diam. Donec luctus convallis rhoncus.&hellip;</p>
                <footer><a class="btn" href="#">Read More <span class="fa fa-arrow-right"></span></a></footer>
              </figcaption>
            </figure>
          </div>
          <div class="one_half"> 
            <!-- ################################################################################################ -->
            <figure class="btmspace-30"><a href="#"><img class="borderedbox inspace-10 btmspace-10" src="../CLS_images/CLStable.jpg" alt=""></a>
              <figcaption class="borderedbox inspace-30 bg-white">
                <h2 class="heading">Nulla facilisi aliquam purus urna porta non</h2>
                <p>Sed eget ultricies sem. Proin quis lacus egestas, adipiscing nunc ornare, gravida diam donec luctus.</p>
                <footer><a class="btn" href="#">Read More <span class="fa fa-arrow-right"></span></a></footer>
              </figcaption>
            </figure>
            <figure><a href="#"><img class="borderedbox inspace-10 btmspace-10" src="../CLS_images/CLSstatue.jpg" alt=""></a>
              <figcaption class="borderedbox inspace-30 bg-white">
                <h2 class="heading">Curabitur a sapien tincidunt ullamcorper mauris sit amet</h2>
                <p>Aenean semper elementum tellus, ut placerat leo. Quisque vehicula, urna sit amet pulvinar dapibus.</p>
                <footer><a class="btn" href="#">Read More <span class="fa fa-arrow-right"></span></a></footer>
              </figcaption>
            </figure>
          </div>
        </div>
        <!-- / main body -->
        <div class="clear"></div>
      </main>
    </div>
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
