<?php

include "../private/database.php";
include "../private/checkToken.php";

$responde = array();

if (isset($_POST["id_rest"]) && isset($_POST["name"]) && isset($_POST["token"]))
{
	$ID_REST = $_POST["id_rest"];
	$NAME = $_POST["name"];

	$TOKEN = $_POST["token"];
	
	$check = checkToken($TOKEN);

	if ($check == true)
	{
		$conn = new database();
		$conn->connect();
		
		$strQuery = 'DELETE FROM DISH WHERE ID_REST = '.$ID_REST.' AND NAME = '.$NAME;

		$conn->query($strQuery);
		$conn->disconnect();

		$responde["status"] = 200;
		$responde["message"] = "Success";
		$conn->disconnect();

	}
	else
	{
		$responde["status"] = 444;
		$responde["message"] = "Token Invalid";
	}
}
else
{
	$responde["status"] = 400;
	$responde["message"] = "Invalid request";
}

echo json_encode($responde);
?>