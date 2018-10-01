<?php

include "../private/database.php";

$responde = array();

if (isset($_POST["id_rest"]) && isset($_POST["name"]))
{
	$ID_REST = $_POST["id_rest"];
	$NAME = $_POST["name"];

	$strQuery = 'DELETE FROM DISH WHERE ID_REST = '.$ID_REST.' AND NAME = '.$NAME;
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