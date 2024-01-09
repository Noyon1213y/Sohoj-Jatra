<?php
include("function.php");
?>


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

</head>


<body>

  <header id="header">
		<hgroup>

            </div>

		</hgroup>

	</header> <!-- end of header bar -->


	<section id="secondary_bar">

	  <div class="breadcrumbs_container"></div>


	</section><!-- end of secondary bar -->



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

			<header><h3>View City Bus Information</h3></header>

            <table class="tablesorter" cellspacing="0"> 

			<thead> 

				<tr>


        <th>Serial</th>
        <th>City</th>
        <th>From</th> 
        <th>To</th>
        <th>Distanece</th>
        <th>Fare</th>
        <th colspan="2">Bus Name</th> 
        </tr> 

			</thead> 


			<tbody>


<?php 


if(isset($_POST['bond_search'])){
$bond_no = mysql_real_escape_string($_POST['bond_no']);
$bond_date = mysql_real_escape_string($_POST['bond_date']);
$sql = mysql_query("select * from bus_add_info_tb where bond_no = '$bond_no' and bond_date = '$bond_date' ");
}



$num_rows = mysql_num_rows($sql);
if($num_rows >= 1){
$srl_no = 1;	
while($row = mysql_fetch_array($sql))
{

?>			
			<tr>
            <td><?php echo $srl_no; ?></td> 
            <td><?php echo get_company_name($row['member_id']); ?></td> 
    		<td><?php echo $row['bond_no']; ?></td> 
    		<td><?php echo $row['bond_date']; ?></td>
            <td><?php echo $row['invoice_no']; ?> Km.</td>
            <td><?php echo $row['invoice_date']; ?> Tk.</td>
            <td colspan="2"><?php echo $row['bl_no']; ?></td>
    				</tr>

<?php $srl_no++; } } else { ?>  

				<tr> 

    				<td colspan="7">No Data Match</td>     				

				</tr>
<?php } ?>
			</tbody> 
			</table>

		</article><!-- end of post new article -->  

		<div class="spacer"></div>

	</section>
</body>
</html>