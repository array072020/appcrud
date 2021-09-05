<?php
include('../config/db.php');
include('function.php');
$query = '';
$output = array();
$qcache = $db->query('LOAD INDEX INTO CACHE users KEY (PRIMARY);')->execute(); 
$query .= "SELECT * FROM users ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE first_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
$allquery = $query;
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
//$statement = $db->exec("SET CHARACTER SET utf8");
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="upload/'.$row["image"].'?'.time().'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $image;
	$sub_array[] = '<h4>'.$row["first_name"].'</h4>';
	$sub_array[] = '<h4>'.$row["last_name"].'</h4>';
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning update"><span class="glyphicon glyphicon-edit"></span> แก้ไข</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> ลบ</button>';
	$path = "http://127.0.0.1/appcrud/app/users/upload/".$row["image"];
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$img = file_get_contents($path);
	$sub_array[] = 'data:image/' . $type . ';base64,' . base64_encode($img);
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records($allquery),
	"data"				=>	$data
);
echo json_encode($output);
?>