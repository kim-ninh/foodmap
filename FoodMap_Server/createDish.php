<?php
include "../private/checkToken.php";

$response = array();

if (isset($_POST["name"]) && isset($_POST["id_rest"]) && isset($_POST["price"])  && isset($_POST["url_image"])  && isset($_POST["id_catalog"]) && isset($_POST["token"]))
{
	$name = $_POST["name"];
	$id_rest = $_POST["id_rest"];
	$price = $_POST["price"];
	$url_image = $_POST["url_image"];
	$id_catalog = $_POST["id_catalog"];


	$token = $_POST["token"];
	//check token
	$check = checkToken($token);

	if ($check == true)
	{
		$conn = new database();
		$conn->connect();

		$strQuery = 'INSERT INTO DISH (NAME, ID_REST, PRICE, URL_IMAGE, ID_CATALOG) VALUES ("' . $name.'", '.$id_rest.', '.$price.',"'.$url_image.'", "'.$id_catalog.'")';
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