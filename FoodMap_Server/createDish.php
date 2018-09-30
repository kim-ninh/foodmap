<?php
include "../private/database.php"

$responde = array();

if (isset($_POST["name"]) && isset($_POST["id_rest"]) && isset($_POST["price"])  && isset($_POST["url_image"])  && isset($_POST["id_catalog"]))
{
	$conn = new database();
	$conn->connect();
	$name = $_POST["name"];
	$id_rest = $_POST["id_rest"];
	$price = $_POST["price"];
	$url_image = $_POST["url_image"];
	$id_catalog = $_POST["id_catalog"];

	$strQuery = 'INSERT INTO DISH (NAME, ID_REST, PRICE, URL_IMAGE, ID_CATALOG) VALUES ("' . $name.'", '.$id_rest.', '.$price.',"'.$url_image.'", "'.$id_catalog.'")';
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