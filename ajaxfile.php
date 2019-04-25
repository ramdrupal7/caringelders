<?php
include "config.php";

$condition = "1";

$limit = 11;
$last_id = (!empty($_GET['last_id']) ? $_GET['last_id'] : 0);
$condition = " id > ".$last_id;
$query = "select * from users WHERE ".$condition." order by id Limit $limit ";
$count_query = "select count(id) as id_count from users ";

// echo 'query : '.$query; die;

$userData = mysqli_query($con,$query);
$count_all_users = mysqli_query($con,$count_query);

$count_all_users_count = $count_all_users->fetch_assoc();
$users_count = $count_all_users_count['id_count'];
$i = 0;

 
$total_pages = $count_all_users_count['id_count'] / 10;


$last_cont_id = floor($total_pages) * 10;


if (strpos($total_pages,'.') == false) {

	$total_pages = $total_pages;
} else {
	$total_pages = ceil($total_pages);
}


$response = array();

while($row = mysqli_fetch_assoc($userData)){

   $response[] = $row;
}

echo json_encode(["users" => $response, "last_page_id" => $last_cont_id]);
exit;