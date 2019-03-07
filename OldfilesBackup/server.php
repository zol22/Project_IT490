<?php

session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);    
ini_set( 'display_errors' , 1 );  

include ("account.php") ;	
include ("functions.php");


// initializing variables
$user = "";
$errors = array(); 
$logs = array();

// connect to the database
$db = mysqli_connect($hostname, $username, $password,$dbname);
if (mysqli_connect_errno())                     
  {                                           
    echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
    exit();                           
}                                 
//print "Successfully connected to MySQL.<br><br><br>";       
mysqli_select_db( $db,$dbname );  

// If the register button is clicked , Register user
if (isset($_POST['register'])) {
	$user = getdata("user");
	$pass = getdata ("pass");
	$pass_2 = getdata ("pass2");

 	//ensure that the form is correctly filled ...
 	// by adding (array_push()) corresponding error unto $errors array
 	if (empty($user)) { array_push($errors, "Username is required"); }
 	if (empty($pass)) { array_push($errors, "Password is required"); }
 	if ($pass != $pass_2) {array_push($errors, "The two passwords do not match");}

  	//If there are no erros, register user to database
  	if (count($errors) == 0) {
    array_push($logs,"Register->"."  "."User:".$user."    "."Password:".$pass);

  	//$password = md5($password_1);//encrypt the password before saving in the database
  	$query = "INSERT INTO users (username, userpassword) VALUES('$user', '$pass') ";
  	mysqli_query($db, $query); //run query

    $_SESSION["success"] = "You are now logged in";
  	$_SESSION['username'] = $user;
    //redirect("Redirecting to the website", "website.php", 2);  
     header('location:website.php'); 
  }
}
  
////Log user in from login page
if (isset($_POST['login'])) {
  $user = getdata("user");
  $pass = getdata ("pass");
  //Ensure that form fields are filled properly
  if (empty($user)) { array_push($errors, "Username is required"); }
  if (empty($pass)) { array_push($errors, "Password is required"); }

  if (count($errors) == 0) {

    $query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = mysqli_query($db, $query); //run query
   
    if (mysqli_num_rows($result) == 1){
      $_SESSION['success'] = "You are now logged in";
      $_SESSION['username'] = $user;
      array_push($logs,"Login->"."  "."User:".$user."   "."Password:".$pass);
      header('location:website.php');
    }
    else{
      array_push($errors, "Wrong Username/Password combination");
    }

  }
}

//logout
if (isset($_GET['logout'])) {

  array_push($logs,"Logout");//Not working?
  
  session_destroy();
  unset($_SESSION['username']);
  header('location:login.php');

  }


////Close database
//mysqli_close($db);                           
//exit("<br> Interaction completed.<br><br>" );           


?>
