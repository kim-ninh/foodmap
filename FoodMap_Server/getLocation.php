<?php 
	//import library
	include "../private/database.php"
	
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
	foreach ($listLocations as $row) {
		array_push($response, new Location($row['id_rest'], $row['lat'], $row['lon']));
	}
	
	//close conn
	$conn->disconnect();
	//response
	echo json_encode($response);
?>