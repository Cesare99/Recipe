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
if(isset($_SESSION['user_e_mail'])) {
	echo "LOGGED IN (" . $_SESSION['user_e_mail'] . ")";
} else echo "LOGGED OUT";

//Fills Form Inputs
$result = $my_member->select_member($my_connection, $_SESSION['user_e_mail']);

$row = $result->fetch_array();

$id = $row['account_id'];
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];
$password = $row['password'];
$dob = $row['dob'];
$joinDate = $row['joinDate'];
$pictureURL = $row['picture'];	

//Updates Profile Details
if(isset($_POST['update'])) {
	
	//print_r($_POST);
	
	//So you can run another stored procedure after previous select
	$my_connection->next_result();	
	   
	$my_member->update_member($my_connection, $id, $_POST["firstName"], $_POST["lastName"], $_POST["eMail"], $_POST["password"], $_POST["dob"], $_POST["picture"]);
	
	$_SESSION['user_e_mail'] = $_POST["eMail"];
	header('Location: profile.php');
}

if(isset($_POST['delete'])) {
	
	//print_r($_POST);
	
	//So you can run another stored procedure after previous select
	$my_connection->next_result();	
	   
	$my_member->delete_member($my_connection, $id);
	
	session_destroy();
	header('Location: index.php');
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
                        <a href="recipes.php">View Recipes</a>
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

                <div class="col-md-6">
                    <div class="box">
                        <h1>Profile Details</h1>

                        <form method="post" name="updateProfileForm" id="updateProfileForm">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
								<span id="firstNameError" class="error">*</span>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $fname?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
								<span id="lastNameError" class="error">*</span>
                                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lname?>">
                            </div>
                            <div class="form-group">
                                <label for="eMail">E-Mail</label>
                                <input type="text" class="form-control" id="eMail" name="eMail" value="<?php echo $email?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password" value="<?php echo $password?>">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth:</label>
                                <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $dob?>">
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture URL:</label>
                                <input type="text" class="form-control" id="picture" name="picture" value="<?php echo $pictureURL?>">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="update" class="btn btn-primary"></i> Update</button>
								<button type="submit" name="delete" class="btn btn-primary"></i> Delete </button>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">




                        <hr>

						<p class = "text-center"> 
							<img src="<?php echo $pictureURL ?>">
						</p>
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