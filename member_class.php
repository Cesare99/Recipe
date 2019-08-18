<?php

class member {
	function insertNewMember($myConnection, $firstName, $lastName, $eMail, $password, $dob, $picture) {   		       
		$myConnection->query("CALL rb_insert_new_member('$firstName', '$lastName', '$eMail', '$password', '$dob', '$picture')");																	
	}
	
	function loginMember($myConnection, $eMail, $password) {   		       
		$sql = $myConnection->query("CALL rb_login_member('$eMail', '$password')");		
		
		if (mysqli_num_rows($sql) == 1) {
			header('Location: index.php');  
			return true;
		} else {
			echo "Login Unsuccessful";
			return false;
		}
	}

	function select_member($myConnection, $eMail) { 
		return $myConnection->query("CALL rb_get_member('$eMail')");
	}	
	
	function add_recipe($myConnection, $title, $description, $image, $category_id, $sub_category_id, $preparation_time, $cooking_time, $temperature, $degrees) {
		$myConnection->query("CALL rb_add_new_recipe('$title', '$description', '$image', '$category_id', '$sub_category_id', '$preparation_time', '$cooking_time', '$temperature', '$degrees')");
	}
	
	function select_recipes($myConnection) {
		return $myConnection->query("CALL rb_select_recipes()");
	}
	
	function update_member($myConnection, $id, $firstName, $lastName, $eMail, $password, $dob, $picture) {   		       
		$myConnection->query("CALL rb_update_member('$id', '$firstName', '$lastName', '$eMail', '$password', '$dob', '$picture')");																	
	}
	
	function delete_member($myConnection, $id) {   		       
		$myConnection->query("CALL rb_delete_member('$id')");																	
	}
	
	function select_recipe($myConnection, $recipe_id) {   		       
		return $myConnection->query("CALL rb_select_recipe('$recipe_id')");																	
	}
	
	function update_recipe($myConnection, $recipe_id, $title, $description, $image, $category_id, $sub_category_id, $preparation_time, $cooking_time, $temperature, $degrees) {   		       
		$myConnection->query("CALL rb_update_recipe('$recipe_id', '$title', '$description', '$image', '$category_id', '$sub_category_id', '$preparation_time', '$cooking_time', '$temperature', '$degrees')");				
	}
	
	function search_recipe($myConnection, $search_text) {   		       
		return $myConnection->query("CALL rb_search_recipe('$search_text')");
	}
	
	function add_to_favourites($myConnection, $id, $recipe_id) {   		       
		return $myConnection->query("CALL rb_add_to_favourites('$id', '$recipe_id')");
	}
	
	function rb_get_favourites($myConnection, $id) {   		       
		return $myConnection->query("CALL rb_get_favourites('$id')");
	}
	
	function select_comments($myConnection, $recipe_id) { 
		return $myConnection->query("CALL rb_get_recipe_comments('$recipe_id')");
	}	
	
	function add_comment($myConnection, $recipe_id, $account_id, $comment) { 
		return $myConnection->query("CALL rb_add_recipe_comment('$recipe_id', '$account_id', '$comment')");
	}	
}
   
?>