<?php
include "../private/database.php"

$responde = array();

if (isset($_POST["id_rest"]) && isset($_POST["comment"]) && (isset($_POST["guest_email"]) || isset($_POST["owner_email"])))
{
	$strQuery = "";

	$date_time = new DateTime();
	$date_time = $date_time->format('Y-m-d H:i:s');
	$id_rest = $_POST["id_rest"];
	$comment = $_POST["comment"];


	if (isset($_POST["guest_email"]))
	{
		$guest_email = $_POST["guest_email"];
		$strQuery = 'INSERT INTO COMMENTS (DATE_TIME, ID_REST, GUEST_EMAIL) VALUES ("'.$data_time.'", '.$id_rest.', "'.$guest_email.'")'
	}
	else if (isset($_POST["owner_email"]))
	{
		$owner_email = $_POST["owner_email"];
		$strQuery = 'INSERT INTO COMMENTS (DATE_TIME, ID_REST, OWNER_EMAIl) VALUES ("'.$data_time.'", '.$id_rest.', "'.$owner_email.'")'
	}

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

//lose echo json_decode
echo json_encode($responde);
?>