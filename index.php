<?php
//set_time_limit(0);
session_start(); 
 
/*TEST 
if(isset($_SESSION['user_e_mail'])) {
	echo "LOGGED IN (" . $_SESSION['user_e_mail'] . ")";
} else echo "LOGGED OUT";
*/

//Searches For Recipe
if(isset($_POST['search'])) {
	$_SESSION['search_text'] = $_POST["search_input"];
	header('Location: search_recipes.php');
}

?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LIT Food Inc.</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/respond.min.js"></script>
</head>

<body>
    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">

            <div class="navbar-header">
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="basket.html">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">Items In Cart</span>
                    </a>
                </div>
            </div>

            <div class="navbar-collapse collapse" id="navigation">
                <ul class="nav navbar-nav navbar-left">
                    <li class="">
                        <a href="index.php">Home</a>
                    </li>
					
					<?php if(isset($_SESSION['user_e_mail'])) { ?>
                    <li class="">
                        <a href="addRecipe.php">Add Recipe</a>
                    </li>
					<?php } ?>
					
					<?php if(isset($_SESSION['user_e_mail'])) { ?>
                    <li class="">
                        <a href="recipes.php">View Recipes</a>
                    </li>
					<?php } ?>

					<?php if(!isset($_SESSION['user_e_mail'])) { ?>
                    <li class="">
                        <a href="login.php">Login</a>
                    </li>
					<?php } ?>

					<?php if(!isset($_SESSION['user_e_mail'])) { ?>
                    <li class="">
                        <a href="register.php">Register</a>
                    </li>
					<?php } ?>
					
					<?php if(isset($_SESSION['user_e_mail'])) { ?>
                    <li class="">
                        <a href="profile.php">Profile</a>
                    </li>
					<?php } ?>
					
					<?php if(isset($_SESSION['user_e_mail'])) { ?>
                    <li class="">
                        <a href="logout.php">Logout</a>
                    </li>
					<?php } ?>
                </ul>
            </div>

            <div class="navbar-buttons">
                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" name="search" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="collapse clearfix" id="search">
                <form method="post" class="navbar-form" role="search">
                    <div class="input-group">
						<!-- Search -->
                        <input type="text" name="search_input" id="search_input" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
							<button type="submit" name="search" id="search" class="btn btn-primary"><i class="fa fa-search"></i></button>
						</span>
                    </div>
                </form>
            </div>

        </div><!-- /.container -->
    </div><!-- /#navbar -->
	
    <div id="all">

        <div id="content">



            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable" >
                                <img src="img/ph_one.jpg">

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">


                                <h3><a href="#">Welcome to Dishland</a></h3>
                                <p>Explore our webstore. Feel free to register if you have not done it yet.
                                Create your profile and add a photo.
                                Browse through the recipes.
                                Feel free to add and edit a recipe.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <img src="img/ph_two.jpg">
                            </div>
                        </div>
                    </div><!-- /.row -->

                </div><!-- /.container -->

                <div class="container">
                    <div class="col-md-12">
                        <div id="main-slider">
<!--                            <div class="item">-->
<!--                                <img class="img-responsive" src="img/slider_one.jpg" alt="" >-->
<!--                            </div>-->
<!--                            <div class="item">-->
<!--                                <img class="img-responsive" src="img/slider_two.jpg" alt="">-->
<!--                            </div>-->
                            <div class="item">
                                <img class="img-responsive" src="img/slider_three.jpg" alt="">
                            </div>
                        </div><!-- /#main-slider -->
                        </div>
                </div>

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <img src="img/ph_three.jpg">

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <img src="img/ph_four.jpg">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <img src="img/ph_five.jpg">

                            </div>
                        </div>
                    </div><!-- /.row -->

                </div><!-- /.container -->

            </div><!-- /#advantages -->
   
        </div><!-- /#content -->   		
		
        <div id="footer">
            <div class="container">
                <p class="socialIcons">
                    <a href="https://www.facebook.com/" class="facebook external"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/" class="twitter external"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.instagram.com/" class="instagram external"><i class="fa fa-instagram"></i></a>

                </p>
            </div>
        </div>

    </div><!-- /#all -->

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>
</body>

</html>
