<?php
include "../private/database.php";
include "../private/checkToken.php";

$responde = array();

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
			$responde["message"] = "Id or name not found";
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