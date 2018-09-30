<?php
include "../private/database.php"

if (isset($_POST["id_rest"]) && isset($_POST["lat"]) && isset($_POST["lon"]))
{
	$id_rest = $_POST["id_rest"];
	$lat = $_POST["lat"];
	$lon = $_POST["lon"];

	$strQuery = "UPDATE LOCATION SET LAT = ".$lat.", LON = ".$lon." WHERE ID_REST = ". $id_rest;

	$conn = new database();
	$conn->connect();
	if ($conn->query($strQuery))
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
	$responde["message"] = "Invaild request";
}

echo json_encode($responde);

?>