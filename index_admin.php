<?php
include("log_ses_check.php");
include("function.php");
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Control Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
    <!--for all jquery version and no conflict in jquery-->
	<script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
	
    
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
		  <h1 class="site_title"><a href="index_admin.php">Automation / Software Admin</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site">
            <a href="#" target="_blank">View Site</a>
            </div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $_SESSION['name']; ?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="#">Automation / Software Admin</a> <div class="breadcrumb_divider"></div> 
			<a class="current">Admin Tutorial</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include("menu_sidebar.php");?>
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Welcome to the control panel.</h4><!-- end of content manager article --><!-- end of messages article -->
		
    <div class="clear"></div><!-- end of post new article -->
		<br>
				


		  </div>
    </article><!-- end of styles article --></section>


</body>

</html>