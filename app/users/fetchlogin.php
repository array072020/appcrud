<?php
include('../config/db.php');
function get_total_all_records()
{
	include('../config/db.php');
	$statement = $db->prepare("SELECT * FROM loginusers");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM loginusers ";
$col_tb = ['username','email','created','updated','status'];
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE username LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR email LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$col_tb[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	
	$sub_array = array();
	$sub_array[] = $row["username"];
	$sub_array[] = $row["email"];
	$sub_array[] = $row["created"];
	$sub_array[] = $row["updated"];
	$stachk=$row["status"];
	if ($stachk=='1') {	$sub_array[] = "กำลังใช้ระบบ"; } else {	$sub_array[] = " "; }
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>