<?php
include "../private/checkToken.php";

$response = array();

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

		$response["status"] = 200;
		$response["message"] = "Success";
		$conn->disconnect();

	}
	else
	{
		$response["status"] = 444;
		$response["message"] = "Token Invalid";
	}
}
else
{
	$response["status"] = 400;
	$response["message"] = "Invalid request";
}

echo json_encode($response);
?>