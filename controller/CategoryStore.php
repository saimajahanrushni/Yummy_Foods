<?php
session_start();

$title = $_REQUEST['title'];
$id = empty($_REQUEST['id']) ? null : $_REQUEST['id'];



$errors = [];


//* VALIDATION RULES
if(empty($title)){
    $errors['title_error'] = 'Title is missing!';
}



if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header("Location: ../dashboard/categories.php");
} else{
    
    include "../database/env.php";
    $query = 
    $id ? "UPDATE categories SET title='$title' WHERE id='$id'"
    : "INSERT INTO categories(title) VALUES ('$title')";
    $res = mysqli_query($conn,$query);

    if($res){
        $_SESSION['success'] = true;
        header("Location: ../dashboard/categories.php");
    }




}
   