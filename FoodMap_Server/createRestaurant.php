<?php
include "../private/database.php";

$responde = array();

if (isset($_POST["id_user"]) && isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["phone_number"]) && isset($_POST["describe_text"]) && isset($_POST["timeopen"]) && isset($_POST["timeclose"]))
{
	$ID_USER = $_POST["id_user"];
	$NAME = $_POST["name"];
	$ADDRESS = $_POST["address"];
	$PHONE_NUMBER = $_POST["phone_number"];
	$DESCRIBE_TEXT = $_POST["describe_text"];
	$TIMEOPEN = $_POST["timeopen"];
	$TIMECLOSE = $_POST["timeclose"];

	$queryStr = 'INSERT INTO RESTAURANT (ID_USER, NAME, ADDRESS, PHONE_NUMBER, DESCRIBE_TEXT, TIMEOPEN, TIMECLOSE) VALUES ("'.$ID_USER.'", "'.$NAME.'", "'.$ADDRESS.'", "'.$PHONE_NUMBER.'", "'.$DESCRIBE_TEXT.'", "'.$TIMEOPEN.'", "'.$TIMECLOSE.'")';

	$conn = new database();
	$conn->connect();
	if ($conn->query($queryStr))
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
	$responde["message"] = "Invailed request";
}
echo json_encode($responde);
?>