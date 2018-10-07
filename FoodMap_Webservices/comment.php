<?php
include "../private/database.php";
include "../private/checkToken.php";

$response = array();

if (isset($_POST["id_rest"]) && isset($_POST["comment"]) && (isset($_POST["guest_email"]) || isset($_POST["owner_email"])) && isset($_POST["token"]))
{
	$strQuery = "";

	$date_time = new DateTime();
	$date_time = $date_time->format('Y-m-d H:i:s');
	$id_rest = $_POST["id_rest"];
	$comment = $_POST["comment"];
	$token = $_POST["token"];

	$check = checkToken($token);

	if ($check == true)
	{
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

//lose echo json_decode
echo json_encode($response);
?>