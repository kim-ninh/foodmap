<?php
include "../private/database.php";

$response = array();

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["phone_number"]) && isset($_POST["email"]))
{
	$USERNAME = $_POST["username"];
	$PASSWORD = $_POST["password"];
	$NAME = $_POST["name"];
	$PHONE_NUMBER = $_POST["phone_number"];
	$EMAIL = $_POST["email"];

	$queryStr = 'INSERT INTO ACCOUNT (USERNAME, PASSWORD, NAME, PHONE_NUMBER, EMAIL) VALUES ("'.$USERNAME.'", "'.$PASSWORD.'", "'.$NAME.'", "'.$PHONE_NUMBER.'", "'.$EMAIL.'")';

	$conn = new database();
	$conn->connect();
	if ($conn->query($queryStr) == true)
	{
		$response["status"] = 200;
		$response["message"] = "Success";
	}
	else
	{
		$response["status"] = 404;
		$response["message"] = "Exec fail";
	}

	$conn->disconnect();
}
else
{
	$response["status"] = 400;
	$response["message"] = "Invailed request";
}
echo json_encode($response);
?>