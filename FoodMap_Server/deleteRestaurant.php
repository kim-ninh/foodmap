<?php

include "../private/database.php";
include "../private/checkToken.php";

$responde = array();

if (isset($_POST["id"]) && isset($_POST["token"]))
{
	$ID = $_POST["id"];
	$TOKEN = $_POST["token"];
	
	$check = checkToken($TOKEN);

	if ($check == true)
	{
		$conn = new database();
		$conn->connect();

		$strQuery = 'CALL SP_DELETE_REST('.$ID.')';
		$conn->query($strQuery);

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