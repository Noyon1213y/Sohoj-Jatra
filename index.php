<!DOCTYPE html>
<html lang="en">
<?php
include("function.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sohoj Jatra | Developer Team - TechDudes</title>

    <!-- Favicon icon  -->
    <link rel="icon" href="Img/favicon.png">
    <!-- Favicon icon end  -->

    <!-- all link section  -->
    <link rel="stylesheet" href="Css/all.css">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/main.css">
    <link rel="stylesheet" href="Css/responsive.css">
    <!-- all link section end  -->
<style>
      marquee{
      font-size: 20px;
      font-weight: 800;
	  color: #A30002;
	  text-align: center;
      font-family: sans-serif;
      }
    </style>




	
	<!-- Autocomplete bond_no Values -->
    <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#bond_no" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 1,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                $.getJSON("autocomplete.php", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
            }
        });
    });
    </script>




	
</head>

<body>
    <!-- header section start  -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <img src="Img/logo.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-nav">

            <nav class="navbar navbar-dark">

                <div class="container">

                    <!-- Mobile Menu Toggle Button -->

                    <button class="navbar-toggler  hidde-navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span><i class="fas fa-bars icon"></i></span>
                    </button>

                    <!-- Menus List -->

                    <div class="bg-light offcanvas offcanvas-start shadow" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-body">
                            <ul class="navbar-nav">
                                <li class="pb-3"><a href="#"> <span class="item-text">Home</span></a></li>

                                <li class="pb-3"><a href="#"><span class="item-text">About Us</span></a></li>

                                <li class="pb-3"><a href="#"><span class="item-text">Buy Ticket</span></a></li>

                                <li class="pb-3"><a href="#"><span class="item-text">Services</span></a></li>

                                <li class="pb-3"><a href="#"> <span class="item-text">Contacts</span></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="m-auto second-nav">
                        <ul class="d-flex">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="spare_parts2_search_for_genral.php">Route Information</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </div>

                </div>
            </nav>

        </div>


    </header>
    <!-- header section end  -->
 
	<marquee>৭ তারিখে নির্বাচনের কারনে বাস চলাচল বিঘ্নিত হতে পারে।</marquee>
    
	    <!-- banner section start  -->
	
<form method="post" action="bus_info_view_al_for_genral.php" target="_blank" name="search5">
   <section class="banner">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-md-6 col-sm-12 pb-sm-4">

        <input id="bond_no" type="text" class="form-control" name="bond_no" placeholder="From">

                    </div>
                    <div class="col-md-6 col-sm-12">
					<input type="text" class="form-control" name="bond_date" placeholder="To">
					</div>
                    <div class="col-sm-12 text-center pt-4">
						
						<input type="submit" value="Search" name="bond_search" class="btn">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- banner section end  -->

    <!-- footer section start  -->
    <footer>
        <p>Development By: <img src="img/Footer.png" alt=""></img></p>
    </footer>
    <!-- footer section end  -->

    <!-- all script section  -->
    <script src="Js/all.min.js"></script>
    <script src="Js/bootstrap.min.js"></script>
    <script src="Js/main.js"></script>
    <!-- all script section end  -->
</body>

</html>