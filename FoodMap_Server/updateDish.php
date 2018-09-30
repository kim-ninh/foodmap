<?php
include "../private/database.php";

$responde = array();

if (!empty($_POST))
{
	$id_rest = "";
	$name = "";

	$valueCol = "";

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
		else
		{
			$valueCol .= $key . "=" . $value .",";
		}
	}

	$valueCol[strlen($valueCol) - 1] = ' ';
	if ($id != '' && $name != '')
	{
		$strQuery = "UPDATE DISH SET ".$valueCol." WHERE ID = ".$id_rest ." AND NAME = ". $name;

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
		$responde["status"] = 404;
		$responde["message"] = "Id or name not found";
	}
	
}
else
{
	$responde["status"] = 400;
	$responde["message"] = "Invaild request";
}

echo json_encode($responde);

?>