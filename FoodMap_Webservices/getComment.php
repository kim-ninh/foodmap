<?php 
	//import library
	include "../private/database.php";
	
	$id_rest = $_POST['id_rest'];
	//create class Comment
	class Comment{
		function Comment($date_time, $id_rest, $guest_email, $owner_email){
			$this->date_time = $date_time;
			$this->id_rest = $id_rest;
			$this->guest_email = $guest_email;
			$this->owner_email = $owner_email;
		}
	}
	
	//create query string
	$query = "SELECT * FROM COMMENTS WHERE ID_REST = " . $id_rest . " ORDER BY DATE_TIME";
	
	//create connection
	$conn = new database();
	//connect
	$conn->connect();
	//get result
	$listComments = $conn->query($query);
	$response = array();
	
	if ($listComments != -1)
	{	
		$res = array();
		foreach ($listComments as $row) {
			array_push($res, new Comment($row['DATE_TIME'], $row['ID_REST'], $row['GUEST_EMAIL'], $row['OWNER_EMAIL']));
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