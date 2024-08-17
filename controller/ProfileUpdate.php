<?php
session_start();
include "../database/env.php";

// echo "<pre>";
// print_r($_FILES);
//  echo "</pre>";

$userId  = $_SESSION['auth']['id'];

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$profileImage = $_FILES['profileImage']; //* array
$extension = pathinfo($profileImage['name'])['extension'] ?? null; //* png
$isValidEmail = filter_var($email,FILTER_VALIDATE_EMAIL);



$acceptedExtension = [
    'jpg',
    'png',
];




//* EMPTY ERROR ARRAY INIT
$errors= [];

//* VALIDATION RULES
//* USER NAME VALIDATION
if(empty($name)){
    $errors['name_error'] = 'User Name is missing!';
}

//* EMAIL NAME VALIDATION
if(empty($email)){
    $errors['email_error'] = 'Email is missing!';
}else if(!$isValidEmail){
    $errors['email_error'] = 'Invalid Email!';
} else{
    $id = $_SESSION['auth']['id'];
    $query = "SELECT email FROM users WHERE email = '$email' AND id != '$id'";
    $res = mysqli_query($conn, $query);
    
    if($res->num_rows > 0){
        $errors['email_error'] = 'Email already exists!';
    }

    
}

//* PHOTO VALIDATION
if($profileImage['size'] > 0){

    if(!in_array($extension,$acceptedExtension)){
        $errors['profileImage_error'] = "$extension is not acceptable. Accepted types are " . join(', ',$acceptedExtension);
    }
}



//* IF ERRORS FOUND
if(count($errors) > 0){
    //* ERROR FOUND
    $_SESSION['errors'] = $errors;
    header("Location: ../dashboard/profile.php");

} else{
    //* NO ERRORS FOUND
    if($profileImage['size'] > 0){
    define('UPLOADS_PATH', '../uploads');
    if(!file_exists(UPLOADS_PATH)){
        mkdir(UPLOADS_PATH);
    }
    
        //* REMOVE OLD PROFILE IMAGE
 
        $oldProfileImage = "../".$_SESSION['auth']['profile_img'];
    
        if (!empty($oldProfileImage) && file_exists($oldProfileImage)) {
            unlink($oldProfileImage);
        }
    
        //* UPLOADS FOLDER IMAGE SAVE
        $fileName = pathinfo($profileImage['name'])['filename'] . uniqid() . '.' .  $extension;
        move_uploaded_file($profileImage['tmp_name'], UPLOADS_PATH."/$fileName");
       
         $query = "UPDATE users SET name='$name',email='$email',profile_img='uploads/$fileName' WHERE id = '$userId'";
    
    } else{
        $query = "UPDATE users SET name='$name',email='$email'  WHERE id = '$userId'";
    
    }
    
        $res = mysqli_query($conn, $query);
    
       if($res){
        $_SESSION['auth']['name'] = $name;
        $_SESSION['auth']['email'] = $email;
        if($profileImage['size'] > 0){
    
            $_SESSION['auth']['profile_img'] = "uploads/$fileName";
        }
        $_SESSION['success'] = true;
        header('Location: ../dashboard/profile.php');
       }
    }
    