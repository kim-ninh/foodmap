<?php

include "../private/database.php";

$responde = array();

if (isset($_POST["id"]))
{
	$ID = $_POST["id"];

	$strQuery = 'CALL SP_DELETE_REST('.$ID.')';
	$conn = new database();
	$conn->connect();

	$conn->query($strQuery);
	$conn->disconnect();

	$responde["status"] = 200;
	$responde["message"] = "Success";
}
else
{
	$responde["status"] = 400;
	$responde["message"] = "Invaild request";
}

echo json_encode($responde);

?>