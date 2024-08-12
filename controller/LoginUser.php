<?php
session_start();

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$isValidEmail = filter_var($email,FILTER_VALIDATE_EMAIL);


//* EMPTY ERROR ARRAY INIT
$errors= [];



//* EMAIL NAME VALIDATION
if(empty($email)){
    $errors['email_error'] = 'Email is missing!';
}else if(!$isValidEmail){
    $errors['email_error'] = 'Invalid Email!';
}



//* PASSWORD VALIDATION
if(empty($password)){
    $errors['password_error'] = 'Password is missing!';
} else if (strlen($password) < 8){
    $errors['password_error'] = 'Password should be greater or equal to 8 char!';
}


//* IF ERRORS FOUND
if(count($errors) > 0){
    //* ERROR FOUND
    $_SESSION['errors'] = $errors;
    header("Location: ../signin.php");
} else{
    //* AUTH 
    ///* CHECK FOR VALID EMAIL
    include "../database/env.php";
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if($result->num_rows > 0){
        //* CHECK PASSWORD 
        $res = mysqli_fetch_assoc($result);
        $encPassword = $res['password'];
        
        if(password_verify($password, $encPassword)){
            //* AUTH USER (REDIRECT DASHBOARD)
            $_SESSION['auth'] =$res ;
            header("Location: ../dashboard/index.php");

        } else{
            $errors['password_error'] = 'Invalid Password!';
            $_SESSION['errors'] = $errors;
            header("Location: ../signin.php");
        }


    } else {
        $errors['email_error'] = 'Email not found!';
        $_SESSION['errors'] = $errors;
        header("Location: ../signin.php");
    }






}
