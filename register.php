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

$firstNameError = false;
$lastNameError = false;

if ($_POST) {
	//TODO: USE IF TO CHECK TO MAKE SURE EVERYTHING IS ENTERED CORRECTLY BELOW
	if (empty($_POST['firstName'])){
		$firstNameError = true;
	} else if(empty($_POST['lastName'])){
		$lastNameError = true;
	} else {
		$my_member->insertNewMember($my_connection, $_POST["firstName"], $_POST["lastName"], $_POST["eMail"], $_POST["password"], $_POST["dob"], $_POST["picture"]);
		$_SESSION['user_e_mail'] = $_POST["eMail"];
		header('Location: index.php');
	}
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
                    <li class="">
                        <a href="login.php">Sign In</a>
                    </li>
                    </li>
                    <li class="">
                        <a href="register.php">Register</a>
                    </li>
                    </li>
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
                        <h1>New Account</h1>

                        <p>Welcome to our website. Please proceed with your registration details.</p>

                        <hr>

                        <form method="post" name="registrationForm" id="registrationForm">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
								<?php if($firstNameError) { ?>
								<span id="firstNameError" class="error">*</span>
								<?php } ?>
                                <input type="text" class="form-control" id="firstName" name="firstName"
								<?php if($firstNameError) { ?>
								value="<?php echo  $_POST["firstName"]?>"
								<?php } ?>
								>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
								<?php if($lastNameError) { ?>
								<span id="lastNameError" class="error">*</span>
								<?php } ?>
                                <input type="text" class="form-control" id="lastName" name="lastName"
								<?php if($lastNameError) { ?>
								value="<?php echo  $_POST["lastName"]?>"
								<?php } ?>
								>
                            </div>
                            <div class="form-group">
                                <label for="eMail">E-Mail</label>
                                <input type="text" class="form-control" id="eMail" name="eMail">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth:</label>
                                <input type="dob" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture URL:</label>
                                <input type="picture" class="form-control" id="picture" name="picture">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"></i> Register</button>
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