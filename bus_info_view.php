<?php
include("log_ses_check.php");
include("function.php");

?>

<!-- start code for delete -->
<?php
if(isset($_GET['delidno']))
{

	$delidno = mysql_real_escape_string($_GET['delidno']);

	$sql="select file1 from bus_add_info_tb where id='$delidno'";
	$result=mysql_query($sql);
	$path="photo/";
	while($res=mysql_fetch_array($result))

	{
					if(is_file($path.$res['file1'])){

					unlink($path.$res['file1']);

					}
	}

	mysql_query("delete from bus_add_info_tb where id = '$delidno' ");

	header("location:bus_info_view_al.php");

	exit();
}


?>

<!-- end code for delete -->

<!doctype html>

<html lang="en">


<head>


	<meta charset="utf-8"/>
	<title>Sohoj Jatra, Search City Bus route information</title>
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


    


    <script>


	function deleteUser(delid)


	{


		var res = confirm('Are you sure you want to delete?');


		if(res) {


		window.location="bus_info_view_al.php?delidno="+delid;


		}


	}


	</script>


        <!-- date picker -->


    <link rel="stylesheet" href="jquery-ui.css" />


    <script src="js/jquery-ui.js"></script>

    <script>


	  $(function() {


		$( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });

		$( ".datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });

	  });

	</script>



	<!-- date picker -->


</head>








<body>





  <header id="header">


		<hgroup>


			<h1 class="site_title"><a href="index.php">Automation Admin</a></h1>


			<h2 class="section_title">Dashboard</h2><div class="btn_view_site">


            <a href="#" target="_blank">View Information</a>


            </div>


		</hgroup>


	</header> <!-- end of header bar -->


	


	<section id="secondary_bar">


		<div class="user">


			<p><?php echo $_SESSION['name']; ?></p>


			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->


		</div>


		<div class="breadcrumbs_container">


			<article class="breadcrumbs"><a href="#">Automation Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Bus Route Search</a></article>


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


<header><h3>Bus Route Search</h3></header>

<div style="width:90%; margin:0 auto;">

<form method="post" action="bus_info_view_al.php" name="search1">

<form method="post" action="bus_info_view_al.php" name="search2">

<fieldset>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td width="80%" align="left">


<select name="member_id" id="member_id">

<option> Select City Name </option>

<?php


$sql=mysql_query("SELECT id,company_name FROM members_tb ORDER BY company_name DESC ");


while($row=mysql_fetch_array($sql)) {	 

?>

<option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
<?php } ?>

</select>
</td>
<td width="2%" align="right">&nbsp;</td>
<td width="18%" align="left">
<input type="submit" value="Search" name="member_unit_name_search" class="alt_btn" >
</td>
</tr>
</table>

</fieldset>
</form>
<form method="post" action="bus_info_view_al.php" name="search5">
<fieldset>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="40%" align="left">
<input type="text" name="bond_no" placeholder="From">
</td>
<td width="2%" align="right">&nbsp;</td>
<td width="40%" align="left">
<input type="text" name="bond_date" placeholder="To">
</td>
<td width="2%" align="right">&nbsp;</td>
<td width="16%" align="left">


<input type="submit" value="Search" name="bond_search" class="alt_btn">
</td>
</tr>
</table>
</fieldset>
</form>
</div>

		</article><!-- end of post new article -->       
    <article class="module width_full">
		<header><h3>View Bus Route Information</h3></header>

<?php

// find out how many rows are in the table 
$sql = "SELECT COUNT(*) FROM bus_add_info_tb";
$result = mysql_query($sql);
$r = mysql_fetch_row($result);
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 10;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default

if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {

   // cast var as int

   $currentpage = (int) $_GET['currentpage'];

} else {

   // default page num

   $currentpage = 1;

} // end if

// if current page is greater than total pages...

if ($currentpage > $totalpages) {

   // set current page to last page

   $currentpage = $totalpages;

} // end if

// if current page is less than first page...

if ($currentpage < 1) {

   // set current page to first page

   $currentpage = 1;

} // end if

//the offset of the list, based on current page 

$offset = ($currentpage - 1) * $rowsperpage;

?>           
<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 

        <th>Serial</th>
        <th>City</th>
        <th>From</th> 
        <th>To</th>
        <th>Distanece</th>
        <th>Fare</th>
        <th>Bus Name</th> 
        <th>Actions</th> 
				</tr> 

			</thead> 

			<tbody>

<?php 


$sql = mysql_query("select * from bus_add_info_tb order by id DESC limit $offset, $rowsperpage ");

$num_rows = mysql_num_rows($sql);


if($num_rows >= 1){


$srl_no = 1;


if(isset($_GET['currentpage'])){ $srl_no = 1+$offset; }

while($row = mysql_fetch_array($sql))

{


?>
				    <tr>
            <td><?php echo $srl_no; ?></td> 
            <td><?php echo get_company_name($row['member_id']); ?></td> 
    				<td><?php echo $row['bond_no']; ?></td> 
    				<td><?php echo $row['bond_date']; ?></td>
            <td><?php echo $row['invoice_no']; ?> km</td>
            <td><?php echo $row['invoice_date']; ?></td>
            <td><?php echo $row['bl_no']; ?></td>
    				<td>
            <?php if($_SESSION["user_status"]==1){ ?>
            <a href="javascript:deleteUser(delid=<?php echo $row['id']; ?>)">
            <input type="image" src="images/icn_trash.png" title="Trash">
            </a>
            <?php } ?>
            </td> 
				    </tr>


<?php $srl_no++; } } else { ?>  


				<tr> 


    				<td colspan="7">No Data Found</td>     				


				</tr>


<?php } ?>


			</tbody> 


			</table>


<?php if($numrows>10){ ?>


<div style="margin:10px 5px; padding:0;">





<?php


/******  build the pagination links ******/


// range of num links to show


$range = 3;





// if not on page 1, don't show back links


if ($currentpage > 1) {


   // show << link to go back to page 1


   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1' class='pagination'>First Page</a> ";


   // get previous page num


   $prevpage = $currentpage - 1;


   // show < link to go back to 1 page


   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage' class='pagination'>Previous</a> ";


} // end if 





// loop to show links to range of pages around current page


for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {


   // if it's a valid page number...


   if (($x > 0) && ($x <= $totalpages)) {


      // if we're on current page...


      if ($x == $currentpage) {


         // 'highlight' it but don't make a link


         echo " <b class='pagination_select'>$x</b> ";


      // if not current page...


      } else {


         // make it a link


         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'  class='pagination'>$x</a> ";


      } // end else


   } // end if 


} // end for


                 


// if not on last page, show forward and last page links        


if ($currentpage != $totalpages) {


   // get next page


   $nextpage = $currentpage + 1;


    // echo forward link for next page 


   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage' class='pagination'>Next Page</a> ";


   // echo forward link for lastpage


   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages' class='pagination'>Last Page</a> ";


} // end if


/****** end build pagination links ******/

?>


</div>


<?php } ?>              
</article><!-- end of post new article -->
<div class="spacer"></div>
</section>
</body>
</html>