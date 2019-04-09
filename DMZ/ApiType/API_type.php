<?php
require_once('../path.inc');
require_once('../get_host_info.inc');
require_once('../rabbitMQLib.inc');

require_once('../api_database.php');

require_once('../../Website/bootstrap/nutrition.php');

function recipe_ingredients ($ingredients)
{
	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "ingredients";
	$request['ingredients'] = $ingredients;

	$response = $client->send_request($request);

	$size = count($response["body"]);
	
	for ($x = 0 ; $x < $size ; $x++) {

		$id = ($response["body"][$x]["id"]);
		$title = ($response["body"][$x]["title"]);
		$image = ($response["body"][$x]["image"]);
		$useIngredients = ($response["body"][$x]["usedIngredientCount"]);
		$missedIngredients = ($response["body"][$x]["missedIngredientCount"]);

		echo "Option ".($x+1)."<br>";
		echo "ID:  ".$id."<br>";
		echo "Title:  ".$title."<br>";
		echo "UsedIngredients:  ".$useIngredients."<br>";
		echo "MissedIngredients:  ".$missedIngredients."<br>";		
		
		echo "<img src='$image' alt='ingredients' />"."<br>";

		/*echo "<button type='button' onclick=window.open('../../Website/bootstrap/nutrition.php')>See nutrition</button>"."<br>";*/

		$nutrition = nutrition($title);
		//var_dump($nutrition->$raw_body);
		//var_dump($nutrition->body->status);

		if (!isset($nutrition->body->recipesUsed)){
			echo "<br>Not nutrional information for this recipe :(";
		}
		//var_dump($nutrition);
		
		else
		{
		echo "<br>";
		echo "<strong> Nutrition Value: </strong><br>";

		$valueCalories = $nutrition->body->calories->value;
		$unitCalories =  $nutrition->body->calories->unit;
		echo "Calories:  ".$valueCalories." ".$unitCalories."<br>";

		$valueFat= $nutrition->body->fat->value;
		$unitFat = $nutrition->body->fat->unit;
		echo "Fat:  ".$valueFat." ".$unitFat."<br>";

		$valueProtein = $nutrition->body->protein->value;
		$unitProtein = $nutrition->body->protein->unit;
		echo "Protein:  ".$valueProtein." ".$unitProtein."<br>";

		$valueCarbs= $nutrition->body->carbs->value;
		$unitCarbs = $nutrition->body->carbs->unit;
		echo "Carbs:  ".$valueCarbs." ".$unitCarbs."<br>";
		}
		
		echo "<br><br><br><br>"; 

		
	}
}

/*Different output for week option*/
function recipe_daily_calories($calories,$time_frame,$diet)
{
	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "calories";
	$request['calories'] = $calories;
	$request['time_frame'] = $time_frame;
	$request['diet'] = $diet;


	$response = $client->send_request($request); 
	
	$size = count($response["body"]["meals"]);

	$calories= ($response["body"]["nutrients"]["calories"]);
	$protein= ($response["body"]["nutrients"]["protein"]);
	$fat= ($response["body"]["nutrients"]["fat"]);
	$carbohydrates= ($response["body"]["nutrients"]["carbohydrates"]);

	echo "Nutrients  "."<br>";
	echo "Calories:  ".$calories."<br>";
	echo "Protein:  ".$protein."<br>";
	echo "Fat:  ".$fat."<br>";
	echo "Carbs:  ".$carbohydrates."<br><br>";


	for ($x = 0 ; $x < $size ; $x++) {
		$id = ($response["body"]["meals"][$x]["id"]);
		$title = ($response["body"]["meals"][$x]["title"]);
		$mins = ($response["body"]["meals"][$x]["readyInMinutes"]);
		$image = ($response["body"]["meals"][$x]["image"]);
		
		echo "Option ".($x+1)."<br>";
		echo "ID:  ".$id."<br>";
		echo "Title:  ".$title."<br>";
		echo "Time:  ".$mins." mins"."<br>";
	
		echo "<img src='https://spoonacular.com/recipeImages/$id-480x360.jpg' alt='ingredients' alt='recipe' />";

		echo "<br><br><br>";

		get_macro_nutrients($title);	
	}
	
}

function inventory($name,$inventory1,$inventory2,$inventory3,$inventory4){

	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "inventory";
	$request['name'] = $name;
	$request['inventory1'] = $inventory1;
	$request['inventory2'] = $inventory2;
	$request['inventory3'] = $inventory3;
	$request['inventory4'] = $inventory4;

	$response = $client->send_request($request);
	echo "Your database is already updated :D "."<br>"; 
}



function search_my_recipes($name,$diet){

	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "myrecipes";
	$request['name'] = $name;
	$request['diet'] = $diet;

	$response = $client->send_request($request);

	# Echo what you have in your fridge..
	$ingredients = search_my_ingredients($name);
  	$i1 = $ingredients["i1"];
  	$i2 = $ingredients["i2"];
  	$i3 = $ingredients["i3"];
  	$i4 = $ingredients["i4"];

	echo "This is what you have in your fridge: ".PHP_EOL;
	echo $i1." ".$i2." ".$i3." ".$i4;
	/*foreach($i1 as $value){
	echo $value." ";
 	 }

 	foreach($i2 as $value){
	echo $value." ";
 	 }

 	foreach($i3 as $value){
	echo $value." ";
 	 }

 	foreach($i4 as $value){
	echo $value." ";
 	 }*/

	$size = count($response["body"]);
	//var_dump($response);
	echo "<br><br>";
	
	for ($x = 0 ; $x < $size ; $x++) {

		$id = ($response["body"]["results"][$x]["id"]);
		$title = ($response["body"]["results"][$x]["title"]);


		$image = ($response["body"]["results"][$x]["image"]);

		
		echo "Option ".($x+1)."<br>";
		echo "ID:  ".$id."<br>";
		echo "Title:  ".$title."<br>";
		
		
		echo "<img src='$image' alt='ingredients' />";

		echo "<br><br><br>"; 
		

	}

	
	
}

function get_macro_nutrients($title1){

	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "macro";
	$request['title1'] = $title1;

	$response = $client->send_request($request); 


	$valueCalories = ($response["body"]["calories"]["value"]);
	$unitCalories = ($response["body"]["calories"]["unit"]);

	echo "For ".$title1." you have the following macros: "."<br>";
	echo "Calories:  ".$valueCalories." ".$unitCalories."<br>";

	$valueFat= ($response["body"]["fat"]["value"]);
	$unitFat = ($response["body"]["fat"]["unit"]);

	echo "Fat:  ".$valueFat." ".$unitFat."<br>";

	$valueProtein = ($response["body"]["protein"]["value"]);
	$unitProtein = ($response["body"]["protein"]["unit"]);

	echo "Protein:  ".$valueProtein." ".$unitProtein."<br>";

	$valueCarbs= ($response["body"]["carbs"]["value"]);
	$unitCarbs = ($response["body"]["carbs"]["unit"]);

	echo "Carbs:  ".$valueCarbs." ".$unitCarbs."<br>";

	return $array1 = array('Calories' => $valueCalories,'Fat' => $valueFat, 'Protein' => $valueProtein, 'Carbs' => $valueCarbs );
}


function get_macro_nutrients2($title2){

	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "macro2";
	$request['title2'] = $title2;

	$response = $client->send_request($request); 


	$valueCalories = ($response["body"]["calories"]["value"]);
	$unitCalories = ($response["body"]["calories"]["unit"]);

	echo "<br><br>For ".$title2." you have the following macros: "."<br>";
	echo "Calories:  ".$valueCalories." ".$unitCalories."<br>";

	$valueFat= ($response["body"]["fat"]["value"]);
	$unitFat = ($response["body"]["fat"]["unit"]);

	echo "Fat:  ".$valueFat." ".$unitFat."<br>";

	$valueProtein = ($response["body"]["protein"]["value"]);
	$unitProtein = ($response["body"]["protein"]["unit"]);

	echo "Protein:  ".$valueProtein." ".$unitProtein."<br>";

	$valueCarbs= ($response["body"]["carbs"]["value"]);
	$unitCarbs = ($response["body"]["carbs"]["unit"]);

	echo "Carbs:  ".$valueCarbs." ".$unitCarbs."<br>";

	return $array1 = array('Calories' => $valueCalories,'Fat' => $valueFat, 'Protein' => $valueProtein, 'Carbs' => $valueCarbs );
}

function get_macro_nutrients3($title3){

	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "macro3";
	$request['title3'] = $title3;

	$response = $client->send_request($request); 


	$valueCalories = ($response["body"]["calories"]["value"]);
	$unitCalories = ($response["body"]["calories"]["unit"]);

	echo "<br><br>For ".$title3." you have the following macros: "."<br>";
	echo "Calories:  ".$valueCalories." ".$unitCalories."<br>";

	$valueFat= ($response["body"]["fat"]["value"]);
	$unitFat = ($response["body"]["fat"]["unit"]);

	echo "Fat:  ".$valueFat." ".$unitFat."<br>";

	$valueProtein = ($response["body"]["protein"]["value"]);
	$unitProtein = ($response["body"]["protein"]["unit"]);

	echo "Protein:  ".$valueProtein." ".$unitProtein."<br>";

	$valueCarbs= ($response["body"]["carbs"]["value"]);
	$unitCarbs = ($response["body"]["carbs"]["unit"]);

	echo "Carbs:  ".$valueCarbs." ".$unitCarbs."<br>";

	return $array1 = array('Calories' => $valueCalories,'Fat' => $valueFat, 'Protein' => $valueProtein, 'Carbs' => $valueCarbs );
}




function ingredient_replace($ingredient_replace){

	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "replace";
	$request['ingredient_replace'] = $ingredient_replace;

	$response = $client->send_request($request); 

	$ingredient = $response["body"]["ingredient"];
	echo "Ingredient:  ".$ingredient."<br>";

	$size = count($response["body"]["substitutes"]);
	
	for ($x = 0 ; $x < $size ; $x++) {

		$substitutes = $response["body"]["substitutes"][$x];
		
		echo "Substitute ".($x+1).":  ".$substitutes."<br>";
	}

	$message = $response["body"]["message"];
	echo $message."<br>";
}

# When $auto_number is empty, it gives an error. Error in API?
# Solution: Make $auto_number required not optional!
function shopping_list($cook,$ingredients,$cruisine){

	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "shopping";
	$request['cook'] = $cook;
	$request['ingredients'] = $ingredients;
	$request['cruisine'] = $cruisine;

	$response = $client->send_request($request); 

	/*if (!empty($auto_number)){
		$size = $auto_number;		
	}
	else{
		$size = count($response["body"]["results"]);
		echo $size;
	}*/

	$size = count($response["body"]["results"]);


	for ($x = 0 ; $x < $size ; $x++) {

		$title = ($response["body"]["results"][$x]["title"]);
		$usedIngredients= ($response["body"]["results"][$x]["usedIngredients"]);
		$missedIngredients = ($response["body"]["results"][$x]["missedIngredients"]); 
		$unusedIngredients = ($response["body"]["results"][$x]["unusedIngredients"]);


		echo "Title:  ".$title."<br>";
		
		echo "<br><br>";

	}
}

#Sometimes it's given errors when displaying the prep minutes and cooking minutes
# because some response doesnt have that feature. Need to add isset() or !empty()
function random_recipes($random_number,$random_tags){

	$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "random";
	$request['random_number'] = $random_number;
	$request['random_tags'] = $random_tags;

	$response = $client->send_request($request); 

	var_dump($response);
	echo "<br><br><br>";
	$size = count($response["body"]["recipes"]);

	if (!empty($random_number)){
		$size = $random_number;		
	}
	else{
		$size = count($response["body"]["recipes"]);
	}

		for ($x = 0 ; $x < $size ; $x++) {

			# Title
			$title =$response["body"]["recipes"][$x]["title"];

			echo "Title: ".$title."<br>";

			# ID
			$id =$response["body"]["recipes"][$x]["id"];

			echo "ID: ".$id."<br>";

			# Vegetarian
			$vegetarian =$response["body"]["recipes"][$x]["vegetarian"];

			if ($vegetarian == 1){
				$vegetarian = "YES";
			}
			else
			{
				$vegetarian = "NO";
			}

			echo "Vegetarian: ".$vegetarian."<br>";

			# Vegan
			$vegan =$response["body"]["recipes"][$x]["vegan"];

			if ($vegan == 1){
				$vegan = "YES";
			}
			else
			{
				$vegan = "NO";
			}

			echo "Vegan: ".$vegan."<br>";

			# GlutenFree
			$glutenFree =$response["body"]["recipes"][$x]["glutenFree"];

			if ($glutenFree == 1){
				$glutenFree = "YES";
			}
			else
			{
				$glutenFree = "NO";
			}

			echo "Gluten Free: ".$glutenFree."<br>";

			# Very Healthy
			$veryHealthy=$response["body"]["recipes"][$x]["veryHealthy"];

			if ($veryHealthy == 1){
				$veryHealthy = "YES";
			}
			else
			{
				$veryHealthy = "NO";
			}

			echo "Very Healthy: ".$veryHealthy."<br>";

			# Cheap
			$cheap =$response["body"]["recipes"][$x]["cheap"];

			if ($cheap == 1){
				$cheap = "YES";
			}
			else
			{
				$cheap = "NO";
			}

			echo "Cheap: ".$cheap."<br>";

			# Very Popular
			$veryPopular =$response["body"]["recipes"][$x]["veryPopular"];

			if ($veryPopular == 1){
				$veryPopular = "YES";
			}
			else
			{
				$veryPopular = "NO";
			}

			echo "Very Popular: ".$veryPopular."<br>";

			# Low FodMap
			$lowFodmap =$response["body"]["recipes"][$x]["lowFodmap"];

			if ($lowFodmap == 1){
				$lowFodmap = "YES";
			}
			else
			{
				$lowFodmap = "NO";
			}

			echo "Low Fodmap: ".$lowFodmap."<br>";

			# Ketogenic
			$ketogenic =$response["body"]["recipes"][$x]["ketogenic"];

			if ($ketogenic == 1){
				$ketogenic= "YES";
			}
			else
			{
				$ketogenic = "NO";
			}

			echo "Ketogenic: ".$ketogenic."<br>";


			# Ingredients
			$sizeIngredients = count($response["body"]["recipes"][$x]["extendedIngredients"]);
			//echo $sizeIngredients."<br>";

			echo "<br>Ingredients:"."<br>";

			for($j = 0 ; $j < $sizeIngredients ; $j++)

			{

				$extendedIngredientsID = $response["body"]["recipes"][$x]["extendedIngredients"][$j]["id"];

				
			$extendedIngredientsimage =$response["body"]["recipes"][$x]["extendedIngredients"][$j]["image"];

			$extendedIngredientsname =$response["body"]["recipes"][$x]["extendedIngredients"][$j]["name"];

			$extendedIngredientsamount =$response["body"]["recipes"][$x]["extendedIngredients"][$j]["amount"];

			$extendedIngredientsunit =$response["body"]["recipes"][$x]["extendedIngredients"][$j]["unit"];

			echo "		"."Ingredient ID: ".$extendedIngredientsID."<br>";
			//echo "		"."Ingredient image: ".$extendedIngredientsimage."<br>";
			echo "		"."Ingredient name: ".$extendedIngredientsname."<br>";
			echo "		"."Ingredient amount: ".$extendedIngredientsamount." ".$extendedIngredientsunit."<br>";

			echo "<img src='https://spoonacular.com/cdn/ingredients_100x100/$extendedIngredientsimage' alt='ingredient'>";
			echo "<br><br>";
	
			}

			# Preparation Minutes
			$preparationMinutes =$response["body"]["recipes"][$x]["preparationMinutes"];

			echo "Prep. Minutes: ".$preparationMinutes." mins"."<br>";

			# Cooking Minutes
			$cookingMinutes =$response["body"]["recipes"][$x]["cookingMinutes"];

			echo "Cooking Minutes: ".$cookingMinutes." mins"."<br>";

			#ready in Minutes
			$readyInMinutes =$response["body"]["recipes"][$x]["readyInMinutes"];

			echo "Ready in Minutes: ".$readyInMinutes."mins"."<br>";

			# Servings
			$servings =$response["body"]["recipes"][$x]["servings"];

			echo "Servings: ".$servings."<br><br>";


			#image
			$image=$response["body"]["recipes"][$x]["image"];

			echo "<img src='$image' alt='image' >"."<br>";

			# Spoonacular Source url
			$spoonacularSourceUrl =$response["body"]["recipes"][$x]["spoonacularSourceUrl"];

			echo "<button type='button' onclick=window.open('$spoonacularSourceUrl')>Go website</button>"."<br>";

			echo "<br><br>";
		}	
}

?>
