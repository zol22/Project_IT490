#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//include ("account.php");
include("main.php");

function doLogin($username,$password)
{
   $s = "select * from Users where UserName='$username' and UserPassword='$password'";
   ($t = mysql_query ( $s  ) ) or die ( mysql_error() );

   if ( mysql_num_rows ($t) > 0 )
      
        return true;
   else
        return false;

    // lookup username in databas
    // check password
    //return true;
    //return false if not valid
	
}

#Add $email in parameter
function doRegister($username,$password)
{
   #or Email = '$email'....";
    $s = "select * from Users where Username='$username' ";
    ( $t = mysql_query ( $s  ) ) or die ( mysql_error() );
    
    if ( mysql_num_rows ($t) < 1 )
    {
        $x = "INSERT INTO Users (userName,UserPassword) VALUES ('$username','$password')";
	( $y = mysql_query ( $x  ) ) or die ( mysql_error() );	
	return true;
    }
    else
	return false;	
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
    case "login":
      return doLogin($request['username'],$request['password']);
    
    case "register":
      return doRegister($request['email'],$request['password'],$request['firstName'],$request['lastName']);

    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}



$server = new rabbitMQServer("testRabbitMQ.ini","SendServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

