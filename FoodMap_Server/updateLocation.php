<?php

include "../private/checkToken.php";

if (isset($_POST["id_rest"]) && isset($_POST["lat"]) && isset($_POST["lon"]) && isset($_POST["token"]))
{
	$id_rest = $_POST["id_rest"];
	$lat = $_POST["lat"];
	$lon = $_POST["lon"];
	$token = $_POST["token"];

	$check = checkToken($token);

	if ($check == true)
	{
		$strQuery = "UPDATE LOCATION SET LAT = ".$lat.", LON = ".$lon." WHERE ID_REST = ". $id_rest;

		$conn = new database();
		$conn->connect();
		if ($conn->query($strQuery) == true)
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