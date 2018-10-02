<?php
include "../private/database.php";
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