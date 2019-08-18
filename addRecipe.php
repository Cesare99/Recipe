<?php

//INCLUDE EXTERNAL FILES
require_once "constants.php";
require_once "database.php";
require_once "member_class.php";

//STARTS A SESSION
session_start();

//CREATES INSTANCE OF DATABASE
$my_database = new database();

//CONNECTS TO THE DATABASE
$my_connection = $my_database->connect_database(SERVER, USER, PASSWORD, DATABASE);

//CREATES INSTANCE OF MEMBER
$my_member = new member();

//TEST 
//if(isset($_SESSION['user_e_mail'])) {
//	echo "LOGGED IN (" . $_SESSION['user_e_mail'] . ")";
//} else echo "LOGGED OUT";

if ($_POST) {
	$my_member->add_recipe($my_connection, $_POST["title"], $_POST["description"], $_POST["image"], $_POST["category_id"], $_POST["sub_category_id"], $_POST["preparation_time"], $_POST["cooking_time"], $_POST["temperature"], $_POST["degrees"]);
	//header('Location: index.php');
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
					
                    <li class="">
                        <a href="addRecipe.php">Add Recipe</a>
                    </li>

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
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="collapse clearfix" id="search">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
						</span>
                    </div>
                </form>
            </div>

        </div><!-- /.container -->
    </div><!-- /#navbar -->
	
    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                </div>

                <div class="col-md-12">
                    <div class="box">
                        <h1>Add Recipe</h1>

                        <p>Add a new recipe to open up a new world of food and much more for others! The whole process will not take you more than a minute!</p>

                        <hr>

                        <form method="post" name="registrationForm" id="registrationForm">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="image">Image URL:</label>
                                <input type="text" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category ID:</label>
                                <input type="text" class="form-control" id="category_id" name="category_id">
                            </div>
                            <div class="form-group">
                                <label for="sub_category_id">Sub-Category ID:</label>
                                <input type="text" class="form-control" id="sub_category_id" name="sub_category_id">
                            </div>
                            <div class="form-group">
                                <label for="preparation_time">Preparation Time:</label>
                                <input type="text" class="form-control" id="preparation_time" name="preparation_time">
                            </div>
                            <div class="form-group">
                                <label for="cooking_time">Cooking Time:</label>
                                <input type="text" class="form-control" id="cooking_time" name="cooking_time">
                            </div>
                            <div class="form-group">
                                <label for="temperature">Temperature:</label>
                                <input type="text" class="form-control" id="temperature" name="temperature">
                            </div>
                            <div class="form-group">
                                <label for="degrees">Degrees Or Fahrenheit:</label>
                                <input type="text" class="form-control" id="degrees" name="degrees">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"></i>Add Recipe</button>
                            </div>
                        </form>
                        
                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        
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