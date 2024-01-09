<?php
include("log_ses_check.php");
include("function.php");
?>
<?php
if($_SESSION["user_status"]!=1){ 
header("location:index.php");
exit();
}
?>
<!-- start code for password_reset form submit -->
<?php
if(isset($_POST['password_reset']))
{
	$new_password = mysql_real_escape_string($_POST['new_password']);
	$confirm_password = mysql_real_escape_string($_POST['confirm_password']);
	$old_password = mysql_real_escape_string($_POST['old_password']);
	
	//form validation
	if($new_password =="" || $confirm_password =="" || $old_password =="")
	{
		$_SESSION['msg']="You have to fill up all field";
		header("location:settings.php");
		exit();
	}
	
	// check all field not null 
	if($new_password !="" && $confirm_password !="" && $old_password !="")
	{
			
		if($new_password != $confirm_password)
		{
			$_SESSION['msg']="New password and confirm password does not match";
			header("location:settings.php");
			exit();
		}
		
		$user_id = $_SESSION['id'];
		
		//get database password 
		$db_password = get_password($user_id);
		
		//check form old password matching with database password
		if($old_password != $db_password)
		{
			$_SESSION['msg']="Wrong old password";
			header("location:settings.php");
			exit();
		}
		
		mysql_query("update users_tb set user_pass = '$new_password' where id = '$user_id' ");
		//update login session password
		$_SESSION["password"] = $new_password;
		
		$_SESSION['msg']="You successfully change the password";
		header("location:settings.php");
		exit();
	}
	
}
?>
<!-- end code for password_reset form submit -->
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Settings</title>
	
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
			<h1 class="site_title"><a href="index.php">Website Admin</a></h1>
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
			<article class="breadcrumbs"><a href="#">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Settings</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php include("menu_sidebar.php");?>
	
	<section id="main" class="column">		
				
    <div class="clear"></div>
    	<?php if(isset($_SESSION['msg'])){ ?>
			<h4 class="alert_warning">
			<?php 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); 
            ?> 
            </h4>
            <?php } ?>
		
		<article class="module width_full">
			<header><h3>Password Reset</h3></header>
            <form method="post" action="settings.php" name="password_reset">
				<div class="module_content">
						<fieldset>
							<label>New Password</label>
							<input type="password" name="new_password">
						</fieldset>
                        <fieldset>
							<label>Confirm Password</label>
							<input type="password" name="confirm_password">
						</fieldset>
                        <fieldset>
							<label>Old Password</label>
							<input type="password" name="old_password">
						</fieldset>				
				</div>
			<footer>
				<div class="submit_link">					
					<input type="submit" value="Submit" name="password_reset" class="alt_btn">					
				</div>
			</footer>
            </form>
		</article><!-- end of post new article -->
        
		
		<div class="spacer"></div>
	</section>


</body>

</html>