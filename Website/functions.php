<?php
function auth( $user, $pass)
{
	global $db;
	//pass = sha1 ($pass)
	$s   =  "select * from  Users where userName = '$user' and userPassword = '$pass' " ;
	//print "<br>SQL statement is: $s<br>";
		
	($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );
	
	$num = mysqli_num_rows($t);
		
	if( $num == 0){ 
		return false; 
	}
	else{
		//echo "<br>num is $num <br><br>";
		print "<br>You have sucessfully signed in.<br>";
		return true;
	}
}


function getdata( $name )
{
	global $db;
	$temp = $_POST [ "$name" ] ;
	$temp=trim($temp);
	$temp= mysqli_real_escape_string( $db, $temp); // revents SQL injection attacks 	which is by using the ' char to append malicious code to an SQL query.
	//print "<br>Temp is: $temp";
	return $temp;
}

function redirect( $message, $url , $delay)
{
	echo "$message"; // visible because of delay

	header ("refresh:$delay; url = $url"); // sends 'refresh' HTTP header to browser
												// argument is a single STRING "..."
												//see header in developer tools network tab
												
	exit();								


}
?>
