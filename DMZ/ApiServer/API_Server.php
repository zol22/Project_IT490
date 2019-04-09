#!/usr/bin/php
<?php
require_once('../path.inc');
require_once('../get_host_info.inc');
require_once('../rabbitMQLib.inc');

//require_once('../api_database.php.inc');

require_once('../api_database.php');

require_once ('../unirest-php/src/Unirest.php');

function doFavIngredients($ingredients)
{

  $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?ingredients=$ingredients",array( "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
    )
  );
  return $response;
}



function doCalories($calories,$time_frame,$diet)
{

 //Get recipe according to your diet requirements from spoonacular
 $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/mealplans/generate?targetCalories=$calories&timeFrame=$time_frame&diet=$diet",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5",
  )
);
  return $response;

}


# Problem: It doesnt make requests for array's (if user has more than 4 ingredients..)
function doMyRecipes($name,$diet){

  $ingredients = search_my_ingredients($name);
  //var_dump($ingredients);
  $i1 = $ingredients["i1"];
  $i2 = $ingredients["i2"];
  $i3 = $ingredients["i3"];
  $i4 = $ingredients["i4"];



  $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/searchComplex?diet=$diet&includeIngredients=$1%2C+$i2%2C+$i3%2C+$i4",
  array(
    "X-RapidAPI-Host" => "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);


  return $response;
  
}


function doMacro($title1)
{
  //Track your macros from spoonacular
  $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/guessNutrition?title=$title1",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
  return $response;
}



function doMacro2($title2)
{
  //Track your macros from spoonacular
  $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/guessNutrition?title=$title2",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
  return $response;
}


function doMacro3($title3)
{
  //Track your macros from spoonacular
  $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/guessNutrition?title=$title3",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
  return $response;
}

function doInventory($name,$inventory1, $inventory2, $inventory3 ,$inventory4){

   //$inventory = new apiDB();
    //return $inventory->validateInventory($name,$inventory1, $inventory2, //$inventory3,$inventory4);
  validateInventory($name,$inventory1, $inventory2, $inventory3 ,$inventory4);
}


function doIngredientReplace($ingredient_replace){

  $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/food/ingredients/substitutes?ingredientName=$ingredient_replace",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
  return $response;
}

function doShopping($cook,$ingredients,$cruisine){
    $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/searchComplex?query=$cook&cuisine=$cruisine&includeIngredients=$ingredients&fillingredients=true&addRecipeInformation=true" ,
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
    return $response;
}

function doRandomRecipes($random_number,$random_tags){



$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/random?number=$random_number&tags=$random_tags",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);

  return $response;

}




function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "ingredients":
	   return doFavIngredients($request["ingredients"]);
    case "calories":
  	 return doCalories($request["calories"], $request["time_frame"] , $request["diet"]);
    case "macro":
  	 return doMacro($request["title1"]);
    case "macro2":
     return doMacro2($request["title2"]);
     case "macro3":
     return doMacro2($request["title3"]);
    case "inventory":
     return doInventory($request["name"],$request["inventory1"],$request["inventory2"],$request["inventory3"],$request["inventory4"]);
    case "myrecipes":
      return doMyRecipes($request["name"],$request["diet"]);
    case "replace":
     return doIngredientReplace($request["ingredient_replace"]);
    case "shopping":
     return doShopping($request["cook"],$request["ingredients"],$request["cruisine"]);
    case "random":
     return doRandomRecipes($request["random_number"],$request["random_tags"]);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("../testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

