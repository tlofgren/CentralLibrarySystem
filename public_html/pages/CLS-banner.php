<!-- ################################################################################################ -->
<!-- This is the banner section of the CLS pages -->
<div class="wrapper row0">
	<header id="header" class="clear"> 
		<div id="logo" class="fl_left">
			<h1><a href="CLS_home.html">Central Library System</a></h1>
		</div>	
		<!-- Search bar taken from topbar section -->
		<div id="search" class="fl_right">
			<form class="clear" method="get" action="CLS-search.php">
				<fieldset>
					<legend>Search:</legend>
					<input type="text" placeholder="Search Here" name="searchString" id="searchSting" >
					<a href="CLS-search.php?link=' . $_GET['searchSting'] . '">
						<button class="fa fa-search" type="submit" title="Search"><em>Search</em></button>
					</a>
				</fieldset>
			</form>
		</div>
	</header>
</div>
<!-- ################################################################################################ -->
