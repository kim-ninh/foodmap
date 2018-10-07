<?php

include "../private/checkToken.php";

$response = array();

if (!empty($_POST))
{
	$id = "";
	$valueCol = "";
	$token = "";

	foreach ($_POST as $key => $value) 
	{
		if ($key == "id")
		{
			$id = $value;
		}
		else if ($key == "token")
		{
			$token = $_POST["token"];
		}
		else
		{
			$valueCol .= $key . "=" . $value .",";
		}
	}

	$check = checkToken($token);

	if ($check == true)
	{
		$valueCol[strlen($valueCol) - 1] = ' ';
		if ($id != '')
		{
			$strQuery = "UPDATE RESTAURANT SET ".$valueCol." WHERE ID = ".$id;

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
			$response["status"] = 404;
			$response["message"] = "Id not found";
		}
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