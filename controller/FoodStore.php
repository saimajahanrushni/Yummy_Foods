<?php
session_start();

$category = $_REQUEST['category'];
$title = $_REQUEST['title'];
$detail = $_REQUEST['detail'];
$price = $_REQUEST['price'];
$foodImage = $_FILES['food_img']; 
$extension  = pathinfo($foodImage['name'])['extension'] ?? null;

$acceptedExt = [
    'png',
    'webp',
    'jpg'
];



// var_dump($foodImage);
// exit();

$errors = [];


//* VALIDATION RULES
if(empty($title)){
    $errors['title_error'] = 'Title is missing!';
}

if($foodImage['size'] == 0){
    $errors['food_img_error'] = 'Food Image is missing!';
} else if(!in_array($extension,$acceptedExt)){
    $errors['food_img_error'] = 'Accepted types are '.  join(', ', $acceptedExt);
}



if(empty($price)){
    $errors['price_error'] = 'Price is missing!';
}








if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header("Location: ../dashboard/foods.php");
} else {

    //* NO ERROR FOUND!
    if($foodImage['size'] > 0){
        define('path', '../uploads');
        if(!file_exists(path)){
            mkdir(path);
        }

        $fileName = 'Food-'.uniqid() . '.'. $extension;
       
        $uploadedFile = move_uploaded_file($foodImage['tmp_name'], path."/$fileName");

    }

    include "../database/env.php";

    $query = "INSERT INTO foods(category_id, title, detail, price, food_img) VALUES ('$category','$title','$detail','$price','uploads/$fileName')";
    $res = mysqli_query($conn, $query);

    if($res){
        header("Location: ../dashboard/foods.php");
    }

}