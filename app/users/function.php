<?php

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		include('resize_image.php');
		
		
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		$image = new resize_image();
		$image->load($_FILES['user_image']['tmp_name']);
		$image->resize(300,300); // รูปภาพ ขนาด ภาพ 1 นิ้ว x 1 นิ้ว 
		$image->save($destination);

		$oldF = './upload/' .get_image_name($_POST['user_id']);
		
		unlink($oldF);
		
		
		//move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($user_id)
{
	include('../config/db.php');
	$statement = $db->prepare("SELECT image FROM users WHERE id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}

function get_total_all_records($query)
{
	include('../config/db.php');
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>