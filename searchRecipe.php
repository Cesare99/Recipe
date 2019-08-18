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

$results = $my_member->search_recipe($my_connection, $_SESSION['search_text']);

//SORT OUT SESSIONS TO VIEW LIKE IN THE VIEW ALL RECIPES
if(isset($_POST['view_recipe'])) {
	//So you can run another stored procedure after previous select
	$my_connection->next_result();	
	   
	$_SESSION['recipe_id'] = $_POST["recipe_id"];
	
	header('Location: view_recipe.php');
}

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

        <div id="content" class="content_fix_search">
            <div class="container">

                <div class="col-md-12">

                    <div class="row products">
					
					<?php while ($recipe = $results->fetch_assoc()) { ?>
                        <div class="col-md-3 col-sm-4">
                            
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="<?php echo $recipe['image'] ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="<?php echo $recipe['image'] ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
								
                                <a href="detail.html" class="invisible">
                                    <img src="<?php echo $recipe['image'] ?>" alt="" class="img-responsive">
                                </a>
								
								
								<div class="text">
                                    <h3><a href="detail.html"><?php echo $recipe['title'] ?></a></h3>
                                    <!-- <h3><p><//?php echo $recipe['description'] ?></p></h3> -->
									
									<form method="post">
										<label for="recipe_id"></label>
										<input type="hidden" class="form-control" id="recipe_id" name="recipe_id" value="<?php echo $recipe['recipe_id'] ?>">
										
										<p class="buttons">
											<button type="submit" name="view_recipe" class="btn btn-primary"></i>View Recipe</button>
										</p>
									</form>
									

                                </div><!-- /.text -->
								
                            </div><!-- /.product -->
                            
                        </div> 
					<?php } ?>
						
                    
                    </div>
                    <!-- /.products -->

                </div>
                <!-- /.col-md-9 -->

            </div>
            <!-- /.container -->
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
