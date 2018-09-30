<?php 
	//import library
	include "../private/database.php"
	
	class Account{
		public $username;
		public $password;
		public $name;
		public $phone_number;
		public $email;
	}
	
	//create class Restaurant
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	//create query string
	$query = "SELECT * FROM ACCOUNT WHERE USERNAME = '" . $username . "' AND PASSWORD = '" . $password . "'";
	
	//create connection
	$conn = new database();
	//connect
	$conn->connect();
	//get result
	$account = $conn->query($query);
	$response = new Account;
	foreach ($account as $row) {
		$response->username 	= $row['username'];
		$response->password 	= $row['password'];
		$response->name 		= $row['name'];
		$response->phone_number = $row['phone_number'];
		$response->email		= $row['email']);
	}
	
	
	//close conn
	$conn->disconnect();
	//response
	echo json_encode($response);
?>