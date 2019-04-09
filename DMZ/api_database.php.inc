<?php

class apiDB
{
private $apidb;

public function __construct()
{
	$this->apidb = new mysqli("localhost","root","Rootsql2019.","NewDB");

	if ($this->apidb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->apidb->connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
}


public function validateInventory($name,$inventory1, $inventory2, $inventory3 ,$inventory4)
{
	$name = $this->apidb->real_escape_string($name);
	$i1 = $this->apidb->real_escape_string($inventory1);
	$i2 = $this->apidb->real_escape_string($inventory2);
	$i3 = $this->apidb->real_escape_string($inventory3);
	$i4 = $this->apidb->real_escape_string($inventory4);

	/*$statement0 = "ALTER TABLE users 
				ADD COLUMN I5 VARCHAR(255) after I4
				ADD COLUMN I6 VARCHAR(255) after I5,
				ADD COLUMN I7 VARCHAR(255) after I6,
				ADD COLUMN I8 VARCHAR(255)";

	$this->apidb->query($statement0) or die ($this->apidb->error);*/

	$statement = "select * from users where username = '$name'";
	$response = $this->apidb->query($statement);

	if( $response->num_rows == 0) # Name is not in the database? Error!
	{
	
		echo "Your account doesnt exist".PHP_EOL;
		return 1;
	}

	else
	{

		# INSERT cant take a WHERE clause because WHERE refers to existing records and an INSERT created new ones.
		//$statement = "INSERT INTO `users` (`I1`, `I2`, `I3`, `I4`) VALUES('$i1', '$i2','$i3','$i4') ";


		$statement = "UPDATE users SET I1 = '$i1', I2 = '$i2' , I3 = '$i3', I4 = '$i4' WHERE username = '$name' ";


		//$statement = "INSERT INTO inventory (`I1`, `I2`, `I3`, `I4`) 
		//			VALUES  ('$i1', '$i2','$i3','$i4')" ;

		$this->apidb->query($statement) or die ($this->apidb->error);


		echo "Adding these ingredients to your database...".PHP_EOL;
		return 0;
	}


}




}
?>
