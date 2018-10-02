<?php
include "../private/database.php";
include "../private/checkToken.php";

$responde = array();

if (isset($_POST["id_user"]) && isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["phone_number"]) && isset($_POST["describe_text"]) && isset($_POST["timeopen"]) && isset($_POST["timeclose"]) && isset($_POST["lat"]) && isset($_POST["lon"]) && isset($_POST["token"]))
{
	$ID = "";
	$ID_USER = $_POST["id_user"];
	$NAME = $_POST["name"];
	$ADDRESS = $_POST["address"];
	$PHONE_NUMBER = $_POST["phone_number"];
	$DESCRIBE_TEXT = $_POST["describe_text"];
	$TIMEOPEN = $_POST["timeopen"];
	$TIMECLOSE = $_POST["timeclose"];

	$LAT =  $_POST["lat"];
	$LON =  $_POST["lon"];

	$TOKEN = $_POST["token"];

	$check = checkToken($TOKEN);

	if ($check == true)
	{
		$conn = new database();
		$conn->connect();

		// lấy id của restaurant
		$queryStr = 'SELECT FC_GETID_REST() AS ID';

		$data = $conn->query($queryStr);
		if ($data != -1)
		{
			foreach ($data as $row) {
				$ID = $row["ID"];
				break;
			}
		}
		
		// thêm vào bảng restaurant
		$queryStr1 = 'INSERT INTO RESTAURANT (ID, ID_USER, NAME, ADDRESS, PHONE_NUMBER, DESCRIBE_TEXT, TIMEOPEN, TIMECLOSE) VALUES ('.$ID.', "'.$ID_USER.'", "'.$NAME.'", "'.$ADDRESS.'", "'.$PHONE_NUMBER.'", "'.$DESCRIBE_TEXT.'", "'.$TIMEOPEN.'", "'.$TIMECLOSE.'")';
		
		if ($conn->query($queryStr1) == true)
		{
			// thêm vị trí tọa độ của nhà hàng vào bảng location
			$queryStr2 = 'INSERT INTO LOCATION (ID_REST, LAT, LON) VALUES ('.$ID.', '.$LAT.', '.$LON.')';
			if ($conn->query($queryStr2) == true)
			{
				$responde["status"] = 200;
				$responde["message"] = "Success";
			}
			else
			{
				// trường hợp thêm tọa độ thất bại thì xóa luôn restaurant vừa ms tạo ở trên
				$queryStr = 'DELETE RESTAURANT WHERE ID = '.$ID;
				$conn->query(queryStr);
				$responde["status"] = 404;
				$responde["message"] = "Exec fail";
			}
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