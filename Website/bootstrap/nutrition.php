<?php

require_once ('../../DMZ/unirest-php/src/Unirest.php');
?>
<!DOCTYPE html5>
<html>
<head>
<title>Nutrition/Ingredient</title>
</head>
<body>

<?php 

function nutrition($title){
$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/guessNutrition?title=$title",
  array(
    "X-RapidAPI-Host" => "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
    "X-RapidAPI-Key" => "1bd8955bb5msh20153e7d105e2d5p1138c1jsn920fe71fc5d4"
  )
);

	return $response;
}

?>

</body>
</html>
