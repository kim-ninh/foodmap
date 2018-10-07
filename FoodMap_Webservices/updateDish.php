<?php

include "../private/checkToken.php";

$response = array();

if (!empty($_POST))
{
	$id_rest = "";
	$name = "";

	$valueCol = "";
	$TOKEN = "";

	foreach ($_POST as $key => $value) 
	{
		if ($key == "id_rest")
		{
			$id = $value;
		}
		else if ($key == "name")
		{
			$name = $value;
		}
		else if ($key == "token")
		{
			$TOKEN = $value;
		}
		else
		{
			$valueCol .= $key . "=" . $value .",";
		}
	}
	//check token
	$check = checkToken($TOKEN);

	if ($check == true)
	{
		$valueCol[strlen($valueCol) - 1] = ' ';
		if ($id != '' && $name != '')
		{
			$strQuery = "UPDATE DISH SET ".$valueCol." WHERE ID = ".$id_rest ." AND NAME = ". $name;

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
			$response["message"] = "Id or name not found";
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