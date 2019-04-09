<?php

//session_set_cookie_params(0,"/~so228/");
//session_start();                    //needed to use $_SESSION
//$username = $_SESSION["username"];

//////TURN ON ERROR_REPORTING	///////////////////////////////////////									
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);			///
ini_set( 'display_errors' , 1 );									///


										///
$db = mysqli_connect("localhost","root","Rootsql2019.","NewDB");	
if (mysqli_connect_errno())											
  {																																																
	  echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
	  exit();														
}																	
//print "Successfully connected to your database.<br><br><br>";				
mysqli_select_db( $db,"NewDB" ); 												

function validateInventory($name,$inventory1, $inventory2, $inventory3 ,$inventory4){

	global $db;

	$i1 = mysqli_real_escape_string($db,$inventory1);
	$i2 = mysqli_real_escape_string($db,$inventory2);
	$i3 = mysqli_real_escape_string($db,$inventory3);
	$i4 = mysqli_real_escape_string($db,$inventory4);
	$s = "select * from users where username = '$name'";

	($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );

	$num = mysqli_num_rows($t);
		
	if( $num == 0)
	{ 
		echo "Your account doesnt exist. You dont have any database".PHP_EOL;
		return 1; 
	}
	else 
	{ 
		//$s = "UPDATE users SET I1 = '$i1', I2 = '$i2' , I3 = '$i3', I4 = '$i4' WHERE username = 		'$name' ";
		$s = "INSERT INTO inventory (id_user,I1,I2,I3,I4) 
		      VALUES ((select id_user from users where username='$name'),'$i1','$i2','$i3','$i4')";

		($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );

		return 0; 
	}


}


function search_my_ingredients($name){

	global $db;
	$s = "select I1,I2,I3,I4 from inventory where id_user in 
		  (select id_user from users where username = '$name')";
	( $t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );

	//$i1 = array();
	//$i2 = array();
	//$i3 = array();
	//$i4 = array();

	while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
	
		$i1 = $r["I1"];
		//array_push($i1,$r["I1"]);
		//array_push($i2,$r["I2"]);
		//array_push($i3,$r["I3"]);
		//array_push($i4,$r["I4"]);
		$i2 = $r["I2"];
		$i3 = $r["I3"];
		$i4 = $r["I4"];


	}

	//return array($i1,$i2,$i3,$i4);

	return array('i1' => $i1,'i2' => $i2,'i3' => $i3,'i4' => $i4 );

}


?>
