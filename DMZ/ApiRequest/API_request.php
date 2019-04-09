<?php 

session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);    
ini_set( 'display_errors' , 1 );  


require ('../ApiType/API_type.php');#contains login client function --GOOD!!!


if (isset($_POST["submit_ingredients"])) {

	$ingredients = $_POST [ "ingredients" ] ;

	recipe_ingredients($ingredients); 


	
}

if (isset($_POST["submit_calories"])) {

	$calories = $_POST [ "calories" ] ;
	$time_frame = $_POST [ "time_frame" ] ;
	$diet = $_POST[ "diet" ];

	recipe_daily_calories($calories,$time_frame,$diet); 

	
}

if (isset($_POST["submit_inventory"])) {

	$name = $_POST["name"];
	$inventory1 = $_POST [ "inventory1" ] ;
	$inventory2 = $_POST [ "inventory2" ] ;
	$inventory3 = $_POST [ "inventory3" ] ;
	$inventory4 = $_POST [ "inventory4" ] ;

	
	inventory($name, $inventory1,$inventory2,$inventory3,$inventory4);
}

if (isset($_POST["submit_my_recipes"])) {

	$name = $_POST [ "name" ] ;
	$diet= $_POST [ "diet" ] ;

	search_my_recipes($name,$diet); 
	
}

if (isset($_POST["submit_macro"])) {

	$title1 = $_POST [ "title1" ] ;
	$title2 = $_POST [ "title2" ] ;
	$title3 = $_POST [ "title3" ] ;

	$response = get_macro_nutrients($title1); 
	$calories1 = $response['Calories'];
	$fat1 = $response['Fat'];
	$protein1 = $response['Protein'];
	$carbs1 = $response['Carbs'];

	$response = get_macro_nutrients2($title2);
	$calories2 = $response['Calories'];
	$fat2 = $response['Fat'];
	$protein2 = $response['Protein'];
	$carbs2 = $response['Carbs'];

	$response = get_macro_nutrients3($title3); 
	$calories3 = $response['Calories'];
	$fat3 = $response['Fat'];
	$protein3 = $response['Protein'];
	$carbs3 = $response['Carbs'];

	echo "<br><br><br>Total Calories: ".($calories1+$calories2+$calories3)."<br>";
	echo " Total Fats: ".($fat1+$fat2+$fat3)."<br>";
	echo " Total Protein: ".($protein1+$protein2+$protein3)."<br>";
	echo " Total Carbs: ".($carbs1+$carbs2+$carbs3)."<br>";
}

if (isset($_POST["submit_replace"])) {

	$ingredient_replace= $_POST [ "ingredient_replace" ] ;

	ingredient_replace($ingredient_replace); 
	
}


if (isset($_POST["submit_shopping"])) {

	$cook= $_POST [ "cook" ] ;
	$ingredients= $_POST [ "ingredients" ] ;
	$cruisine = $_POST["cruisine"];

	shopping_list($cook,$ingredients,$cruisine); 
	
}

if (isset($_POST["submit_random_recipes"])) {

	$random_number= $_POST [ "random_number" ] ;
	$random_tags= $_POST [ "random_tags" ] ;

	random_recipes($random_number,$random_tags); 
	
}




?>
