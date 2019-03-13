<?php
				
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);		
ini_set( 'display_errors' , 1 );	


////INCLUDE FILES
include ("account.php") ;	
//include ("functions.php");


///////CONNECT TO MYSQL DATABASE									
$db = mysqli_connect($hostname, $username, $password,$dbname);	
if (mysqli_connect_errno())											
  {																						
	  echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
	  exit();														
}																	
print "Successfully connected to MySQL.<br><br><br>";				
mysqli_select_db( $db,$dbname ); #Selecy the database


////SQL RETRIEVAL STATEMENT
//$statement = "select * from Users ";


////INTERACT WITH DATABASE TO GET RESULTS OF SQL
//($t= mysqli_query($db,$statement)) or die (mysqli_error($db));



////ACESS THE RETRIEVED DARTA ROW-BY-ROW AND ECHO TO BROWSE
// WHILE LOOP TO SEE RESULTS	
//while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {				 
//$name = $r[ "userName" ];												 
//$password = $r[ "userPassword" ];													 
//echo "The user is $name<br>";										 
//echo "The password is $password<br><br>";								 
//};		

//$user = $_GET [ "user" ] ;
//print"user is $user";

//CALL GETDATA FUNCTIONS
//$user = getdata("user");
//$pass = getdata ("pass");



//CALL AUTHENTICATION FUNCTION
//if ( !auth($user,$pass) ) 
//{
//	print"<br>Your account doesnt match with our records. Please create an account.<br>"; 
//}



//// CLOSE DATABASE CONNECTION AND TERMINATE						 
//echo "<br><br> Bye";											     
//mysqli_free_result($t);												 
//mysqli_close($db);													 
//exit("<br> Interaction completed.<br><br>" );						


?>
