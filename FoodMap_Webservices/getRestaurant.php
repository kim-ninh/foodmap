<?php 
	//import library
	include "../private/database.php";
	
	//create class Restaurant
	class Restaurant{
		function Restaurant($id, $id_user, $name, $address, $phone_number, $describe_text, $url_image, $time_open, $time_close, $rank, $lat, $lon, $tags){
			$this->id = $id;
			$this->id_user = $id_user;
			$this->name = $name;
			$this->address = $address;
			$this->phone_number = $phone_number;
			$this->describe_text = $describe_text;
			$this->url_image = $url_image;
			$this->time_open = $time_open;
			$this->time_close = $time_close;
			if ($rank == NULL)
			    $this->rank = 0;
			else
			    $this->rank = $rank;
			$this->location["lat"] = $lat;
			$this->location["lon"] = $lon;
			$this->tags = $tags;
		}
	}
	
	//create query string
	$query = "SELECT RST.*, AVG(RNK.STAR) RANK, LC.LAT LAT, LC.LON LON FROM (RESTAURANT RST JOIN LOCATION LC ON RST.ID = LC.ID_REST) LEFT JOIN RANK RNK ON RST.ID = RNK.ID_REST GROUP BY RST.ID";
	
	//create connection
	$conn = new database();
	//connect
	$conn->connect();
	//get result
	$listRestaurants = $conn->query($query);
	$response = array();
	
	if ($listRestaurants != -1)
	{
		$res = array();
		foreach ($listRestaurants as $row) 
		{

			$query = 'SELECT T.ID_CATALOG ID_CATALOG FROM TAGS T WHERE T.ID_REST = ' . $row['ID_REST'];

			$tags = array();
			$listTag = $conn->query($query);
			if ($listTags != -1)
			{
				foreach ($listTag as $tag) 
				{
					array_push($tags, $tag["ID_CATALOG"]);
				}
			}

			array_push($res, new Restaurant($row['ID'], $row['ID_USER'], $row['NAME'], $row['ADDRESS'], $row['PHONE_NUMBER'], $row['DESCRIBE_TEXT'], $row['URL_IMAGE'], $row['TIMEOPEN'], $row['TIMECLOSE'], $row['RANK'], $row['LAT'], $row['LON'], $tags));
		}

		$response["status"] = 200;
		$response["message"] = "Success";
		$response["data"] = $res;
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