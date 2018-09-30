// lấy tất cả thông tin của tất cả các quán ăn: lấy dữ liệu ban đầu
<?php 
	//import library
	include "../private/database.php"
	
	//create class Restaurant
	//class Restaurant{
	//	function Restaurant($id, $id_user, $name, $address, $phone_number, $describe_text, $url_image, $time_open, $time_close){
	//		$this->id = $id;
	//		$this->id_user = $id_user;
	//		$this->name = $name;
	//		$this->address = $address;
	//		$this->phone_number = $phone_number;
	//		$this->describe_text = $describe_text;
	//		$this->url_image = $url_image;
	//		$this->time_open = $time_open;
	//		$this->time_close = $time_close;
	//	}
	//}
	
	//create query string
	$query = "SELECT * FROM RESTAURANT";
	
	//create connection
	$conn = new database();
	//connect
	$conn->connect();
	//get result
	$listRestaurants = $conn->query($query);
	
	//response
	echo json_encode($responde);
?>