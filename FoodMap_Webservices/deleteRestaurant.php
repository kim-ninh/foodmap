<?php
include "../private/checkToken.php";

$response = array();

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