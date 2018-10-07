<?php 
//import library
include "../private/database.php";

if (isset($_POST["username"]) && isset($_POST["password"]))	
{
	class Account{
		public $username;
		public $password;
		public $name;
		public $phone_number;
		public $email;
		public $token;
	}
	
	//create class Restaurant
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	//create query string
	$query = 'CALL SP_LOGIN("'.$username.'" , "'.$password.'")';
	
	//create connection
	$conn = new database();
	//connect
	$conn->connect();
	//get result
	$account = $conn->query($query);
	$response= array();

	
	if ($account != -1 && $account != null)
	{
		$res= new Account;
		foreach ($account as $row) {
			$res->username 	= $row['USERNAME'];
			$res->password 	= $row['PASSWORD'];
			$res->name 		= $row['NAME'];
			$res->phone_number = $row['PHONE_NUMBER'];
			$res->email		= $row['EMAIL'];
			break;
		}
			
		$query = 'SELECT FC_GETTOKEN("'.$res->username.'") AS TOKEN;';
		$token = $conn->query($query);
			
		foreach($token as $row)
		{
			$res->token = $row["TOKEN"];
			break;
		}
	    $response["status"] = 200;
		$response["message"] = "Success";
		$response["data"] = $res;
	}
	else
	{
		$response["status"] = 404;
		$response["message"] = "Not Found";
	}
	//close conn
	$conn->disconnect();
}
else
{
	$response["status"] = 400;
	$response["message"] = "Invalid request";
}

//response
echo json_encode($response);
?>