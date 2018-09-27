<?php

$reponse = array();

if (isset($_GET["name"]) && isset($_GET["data"]) && isset($_GET["id"]))
{
	$img_name = $_GET["name"];
	$id = $_GET["id"];
	$upload_dir = "./images/".$id."/".$img_name;
	$data = $_GET["data"];
	$data_decode = base64_decode($data);

    if (!file_exists("./images/".$id)) {
        mkdir("./images/".$id, 0777, true);
    }
	
	try {
        file_put_contents($upload_dir, $decoded_file); // save

        $reponse["message"] = "Upload Success";
		$reponse["satus"] = 200;

    } catch (Exception $e) {
        $reponse["message"] = "Upload Fail";
		$reponse["satus"] = 404;
    }	
}
else
{
	$reponse["message"] = "invalid request";
	$reponse["satus"] = 400;
}

echo json_encode($reponse);
?>