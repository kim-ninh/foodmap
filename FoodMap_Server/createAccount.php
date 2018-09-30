<?php
include "../private/database.php";

$responde = array();

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
	if ($conn->query($queryStr))
	{
		$responde["status"] = 200;
		$responde["message"] = "Success";
	}
	else
	{
		$responde["status"] = 404;
		$responde["message"] = "Exec fail";
	}

	$conn->disconnect();
}
else
{
	$responde["status"] = 400;
	$responde["message"] = "Invailed request";
}
echo json_encode($responde);
?>