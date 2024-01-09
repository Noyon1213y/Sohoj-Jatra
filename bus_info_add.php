<?php
include("log_ses_check.php");
include("function.php");
?>
<!-- start code for add_user form submit -->
<?php
if(isset($_POST['bus_info_add']))
{
	$member_id = mysql_real_escape_string($_POST['member_id']);	
	
$bord_odhidoptor = implode('~',$_POST['bord_odhidoptor']);		
	$form = mysql_real_escape_string($_POST['form']);
	$to = mysql_real_escape_string($_POST['to']);
	$distance = mysql_real_escape_string($_POST['distance']);
	$fare = mysql_real_escape_string($_POST['fare']);
	$bus_name = mysql_real_escape_string($_POST['bus_name']);
	$bl_date = mysql_real_escape_string($_POST['bl_date']);
	date_default_timezone_set('Asia/Dhaka');
	date_default_timezone_get();
	$date = date("Y-m-d H:i:s");
	$sp_machine1 = mysql_real_escape_string($_POST['sp_machine1']);	
	$sp_machine2 = mysql_real_escape_string($_POST['sp_machine2']);
	$sro_no = mysql_real_escape_string($_POST['sro_no']);	
	$sro_date = mysql_real_escape_string($_POST['sro_date']);
	$name = mysql_real_escape_string($_POST['name']);	
	$designation = mysql_real_escape_string($_POST['designation']);
	$user_id = $_SESSION["id"];
	$fileName=$_FILES["files"]["name"];	
	if($fileName)
	{
		$filePath="photo/".$fileName;
		if(file_exists($filePath))
		{
			$a=gmdate("Yzhis");
			move_uploaded_file($_FILES["files"]["tmp_name"], "photo/".$a.$_FILES["files"]["name"]);
			$fileName=$a.$_FILES["files"]["name"];		
		}
		else
		{
			move_uploaded_file($_FILES["files"]["tmp_name"], "photo/".$_FILES["files"]["name"]);
		}
	}
	//form validation
	if($form =="" || $to =="" || $distance =="")

	{
		$_SESSION['msg']="You have to fill up form, to, distance field";
		header("location:bus_info_add.php");
		exit();
	}
	// check all field not null 
	if($form !="" && $to !="" && $distance !="" )
	{
		
		mysql_query("insert into bus_add_info_tb set form = '$form',

		to = '$to',

	id = '$id',

		distance = '$distance',
		fare = '$fare',

		bus_name = '$bus_name',

		member_id = '$member_id',
		
		user_id = '$user_id',
		date = '$date' ");

		$data_insert = mysql_insert_id();
		if($data_insert == ""){
		$_SESSION['msg']="Something wrong";

		header("location:bus_info_add.php");
		exit();
		}
		$_SESSION['msg']="You successfully add City Bus Information";
		header("location:bus_info_add.php");
		exit();
	}
}
?>
<!-- end code for add_user form submit -->
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Add City Bus Information</title>

	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
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
	<!-- ajax -->
    <script>
	function showUser(str) {
		//alert(str);
	  if (str=="") {
		document.getElementById("member_id").innerHTML="";
		return;
	  }
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("jack").innerHTML=xmlhttp.responseText;
		}
	  }
	  xmlhttp.open("GET","ajax.php?member_id_spare_parts2="+str,true);
	  xmlhttp.send();
	}
	</script>
    <!-- ajax -->
</head>
<body>
<header id="header">
		<hgroup>
		  <h1 class="site_title"><a href="index.php">Admin</a></h1>
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
			<article class="breadcrumbs"><a href="#">Automation Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Add City Bus Information</a></article>
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
			<header><h3>Add Bus Route Information</h3></header>
           <form method="post" action="bus_info_add.php" name="bus_info_add">
                    <div class="module_content">  		
<fieldset>						
<select name="member_id" id="member_id" onChange="showUser(this.value)">
<option> City </option>
<?php
$sql=mysql_query("SELECT id,company_name FROM members_tb ORDER BY company_name DESC ");
while($row=mysql_fetch_array($sql)) {	 
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
<?php } ?>
</select>
</fieldset>				
			<fieldset>
<div class="col-two"><label>Form</label></div>
<div class="col-two"><label>To</label></div>
<div class="col-two"><input id="form" input type="text" name="form" required /></div>
<div class="col-two"><input id="to" input type="text" name="to" required /></div>
			</fieldset>
			<fieldset>
<div class="col-two"><label>Distance</label></div>
<div class="col-two"><label>Fare</label></div>
<div class="col-two"><input id="distance" input type="text" name="distance" required /></div>
<div class="col-two"><input id="fare" input type="text" name="fare" required /></div>
			</fieldset>						
			<fieldset>
<label>Bus Name</label>
<input id="bus_name" input type="text" name="bus_name" required />
			</fieldset>								
            </div>
			<footer>
				<div class="submit_link">					
					<input type="submit" value="Submit" name="bus_info_add" class="alt_btn">					
				</div>
			</footer>
            </form>
		</article><!-- end of post new article -->
		<div class="spacer"></div>
	</section>
</body>
</html>