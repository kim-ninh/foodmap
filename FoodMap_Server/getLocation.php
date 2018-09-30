<?php 
	//import library
	include "../private/database.php";
	
	//create class Comment
	class Location{
		function Location($id_rest, $lat, $lon){
			$this->id_rest = $id_rest;
			$this->lat = $lat;
			$this->lon = $lon;
		}
	}
	
	//create query string
	$query = "SELECT * FROM LOCATION";
	
	//create connection
	$conn = new database();
	//connect
	$conn->connect();

	//get result
	$listLocations = $conn->query($query);
	
	$response = array();
	
	if ($listLocations != false)
	{
		foreach ($listLocations as $row) {
			$res =  new Location($row['id_rest'], $row['lat'], $row['lon']);

			$response["status"] = 200;
			$response["message"] = "Success";
			$response["data"] = $res;

			break; // lấy 1 địa chỉ
		}
	}
	else
	{
		$response["status"] = 404;
		$response["message"] = "Exec fail";
	}

	//close conn
	$conn->disconnect();
	//response
	echo json_encode($response);
?>