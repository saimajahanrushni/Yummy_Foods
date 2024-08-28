<?php
include "../database/env.php";

$id = $_REQUEST['id'];
$query = "DELETE FROM `banners` WHERE id = '$id'";

$res = mysqli_query($conn , $query);

if($res){
    header("Location: ../dashboard/Banner.php");
}