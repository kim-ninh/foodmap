<?php
include "../private/database.php";

$responde = array();

//requirement
if (!empty($_POST))
{
	$id = "";
	$valueCol = "";

	//create update string
	foreach ($_POST as $key => $value) 
	{
		if ($key == "username")
		{
			//get username
			$id = $value;
		}
		else
		{
			//get value
			$valueCol .= $key . "=" . $value .",";
		}
	}

	$valueCol[strlen($valueCol) - 1] = ' ';
	if ($id != '')
	{
		//create query string
		$strQuery = "UPDATE ACCOUNT SET ".$valueCol." WHERE ID = ".$id;

		$conn = new database();
		$conn->connect();

		if ($conn->query($strQuery) != -1)
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
	$responde["status"] = 400;
	$responde["message"] = "Invaild request";
}

echo json_encode($responde);

?>