<?php
require_once 'unirest-php/src/Unirest.php';
$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/quickAnswer?q=How+much+vitamin+c+is+in+2+apples%3F",
  array(
    "X-RapidAPI-Key" => "1bd8955bb5msh20153e7d105e2d5p1138c1jsn920fe71fc5d4"
  )
);

echo $response->body->answer;
echo "<br>";
echo $response->body->image;
echo "<br>";
echo $response->body->type;

//$var = json_decode($response);

console.log($response);
?>
