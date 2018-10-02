<?php
include "../private/database.php";
include "../private/checkToken.php";

$responde = array();

//requirement
if (!empty($_POST))
{
	$id = "";
	$valueCol = "";
	
	$TOKEN = "";
	
	//create update string
	foreach ($_POST as $key => $value) 
	{
		if ($key == "username")
		{
			//get username
			$id = $value;
		}
		else if ($key == "token")
		{
			$TOKEN = $value;
		}
		else
		{
			//get value
			$valueCol .= $key . "=" . $value .",";
		}
	}

	
	$check = checkToken($TOKEN);

	if ($check == true)
	{
		$valueCol[strlen($valueCol) - 1] = ' ';
		if ($id != '')
		{
			//create query string
			$strQuery = "UPDATE ACCOUNT SET ".$valueCol." WHERE ID = ".$id;

			$conn = new database();
			$conn->connect();

			if ($conn->query($strQuery) == true)
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
			$responde["status"] = 404;
			$responde["message"] = "Id not found";
		}
	}
	else
	{
		$responde["status"] = 444;
		$responde["message"] = "Token Invalid";
	}
	
}
else
{
	$responde["status"] = 400;
	$responde["message"] = "Invalid request";
}

echo json_encode($responde);

?>