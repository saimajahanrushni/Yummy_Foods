<?php
include "../database/env.php";
$id = $_REQUEST['id'];
$status = $_REQUEST['status'] == 0 ? true : false;

$query = "UPDATE foods SET status='$status' WHERE id = '$id'";
$res = mysqli_query($conn, $query);


if($res){
    header('Location: ../dashboard/foods.php');
}
