<?php
include "../private/database.php";

$reponse = array();

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
		$reponse["message"] = "OK";
		$reponse["status"] = 200;
	}
	$conn->disconnect();

	$reponse["message"] = "Convert fail";
	$reponse["status"] = 404;
}
else
{
	$reponse["message"] = "Invailed request";
	$reponse["status"] = 200;
}
echo json_encode($reponse);
?>