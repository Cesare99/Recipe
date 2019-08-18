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

//Fills Form Inputs
$result = $my_member->select_recipe($my_connection, $_SESSION['recipe_id']);

$row = $result->fetch_array();

$title = $row['title'];
$description = $row['description'];
$image = $row['image'];
$category_id = $row['category_id'];
$sub_category_id = $row['sub_category_id'];
$preparation_time = $row['preparation_time'];
$cooking_time = $row['cooking_time'];
$temperature = $row['temperature'];	
$degrees = $row['degrees'];	

$my_connection->next_result();	

$results = $my_member->select_comments($my_connection, $_SESSION['recipe_id']);

//Update Recipe Details
if(isset($_POST['update'])) {
	//So you can run another stored procedure after previous select
	$my_connection->next_result();	

	$my_member->update_recipe($my_connection, $_SESSION['recipe_id'], $_POST["title"], $_POST["description"], $_POST["image"], $_POST["category_id"], $_POST["sub_category_id"], $_POST["preparation_time"], $_POST["cooking_time"], $_POST["temperature"], $_POST["degrees"]);
	
	header('Location: view_recipe.php');
}

//Add Recipe To Favourites
if(isset($_POST['add_to_favourites'])) {
	//So you can run another stored procedure after previous select
	$my_connection->next_result();	
  
	$my_member->add_to_favourites($my_connection, $_SESSION['id'], $_SESSION['recipe_id']);
	
	header('Location: view_recipe.php');
}

//Adds Comment
if(isset($_POST['add_comment'])) {
	//So you can run another stored procedure after previous select
	$my_connection->next_result();	
  
	$my_member->add_comment($my_connection, $_SESSION['recipe_id'], $_SESSION['account_id'], $_POST["comment"]);
	
	header('Location: view_recipe.php');
}

//Search Recipe
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
                        <a href="favourites.php">Favourites</a>
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
            <div class="container">

                <div class="col-md-12">

                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Recipe (<?php echo $title?>)</h1>

                        <form method="post" name="registrationForm" id="registrationForm">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description" name="description" value="<?php echo $description?>" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Image URL:</label>
                                <input type="url" class="form-control" id="image" name="image" value="<?php echo $image?>" required>
                            </div>
                            <div class="form-group">
							<label for="category">Category:</label>
							<select class="form-control" name="category_id">
								<option value="1" <?php if($category_id == 1) echo 'selected="selected"'?>>Dinner</option>
								<option value="2" <?php if($category_id == 2) echo 'selected="selected"'?>>Breakfast</option>
								<option value="3" <?php if($category_id == 3) echo 'selected="selected"'?>>Lunch</option>
								<option value="4" <?php if($category_id == 4) echo 'selected="selected"'?>>Snack</option>
								<option value="5" <?php if($category_id == 5) echo 'selected="selected"'?>>Healthy</option>
								<option value="6" <?php if($category_id == 6) echo 'selected="selected"'?>>Vegetarian</option>
								<option value="7" <?php if($category_id == 7) echo 'selected="selected"'?>>Vegan</option>
							</select>
                            </div>
                            <div class="form-group">
                                <label for="sub_category">Sub-Category:</label>
							<select class="form-control" name="sub_category_id">
								<option value="1" <?php if($sub_category_id == 1) echo 'selected="selected"'?>>Egg</option>
								<option value="2" <?php if($sub_category_id == 2) echo 'selected="selected"'?>>Cheese</option>
								<option value="3" <?php if($sub_category_id == 3) echo 'selected="selected"'?>>Milk</option>
								<option value="4" <?php if($sub_category_id == 4) echo 'selected="selected"'?>>Fish</option>
								<option value="5" <?php if($sub_category_id == 5) echo 'selected="selected"'?>>Meat</option>
								<option value="6" <?php if($sub_category_id == 6) echo 'selected="selected"'?>>Other</option>
							</select>
                            </div>
                            <div class="form-group">
                                <label for="preparation_time">Preparation Time:</label>
                                <input type="number" class="form-control" id="preparation_time" name="preparation_time" value="<?php echo $preparation_time?>" required>
                            </div>
                            <div class="form-group">
                                <label for="cooking_time">Cooking Time:</label>
                                <input type="number" class="form-control" id="cooking_time" name="cooking_time" value="<?php echo $cooking_time?>" required>
                            </div>
                            <div class="form-group">
                                <label for="temperature">Temperature:</label>
                                <input type="number" class="form-control" id="temperature" name="temperature" value="<?php echo $temperature?>" required>
                            </div>
                            <div class="form-group">
                                <label for="degrees">Degrees Or Fahrenheit:</label>
							<select class="form-control" name="degrees">
								<option value="C" <?php if($degrees == 'C') echo 'selected="selected"'?>>Celcius</option>
								<option value="F" <?php if($degrees == 'F') echo 'selected="selected"'?>>Fahrenheit</option>
							</select>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="update" class="btn btn-primary"></i>Update Recipe</button>
								<button type="submit" name="add_to_favourites" class="btn btn-primary"></i>Add To Favourites</button>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Picture</h1>

                        <p>Description. Check daily our offers!</p>

                        <hr>

						<p class = "text-center"> 
							<img src="<?php echo $image?>">
						</p>
                    </div>
                </div>
				
                <div class="col-md-6">
                    <div class="box">
                        <h1>Comments</h1>
						
						<hr>
						
						<?php while ($comment = $results->fetch_assoc()) { ?>
						
						<p>
							Comment: <?php echo $comment['comment']  ?> 
							(By: <?php echo $comment['fname'] . " " .  $comment['lname'] ?>)
						</p>
						
						<hr>
						
						<?php } ?>

                        
						<form method="post">
							<div class="form-group">
								<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
							</div> 
							
							<div class="text-center">
								<button type="submit" name="add_comment" class="btn btn-primary"></i>Add Comment</button>
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
                    <a href="#" class="facebook external"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="twitter external"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="instagram external"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="gplus external"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="email external"><i class="fa fa-envelope"></i></a>
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