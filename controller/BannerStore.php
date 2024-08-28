<?php
session_start();

$title = $_REQUEST['title'];
$detail = $_REQUEST['detail'];
$ctaTitle = $_REQUEST['ctaTitle'];
$ctaLink = $_REQUEST['ctaLink'];
$videoLink = $_REQUEST['videoLink'];
$bannerImage = $_FILES['banner_img'];

//  print_r($bannerImage);
//  exit();

$errors = [];

$extension = pathinfo($bannerImage['name'])['extension'] ?? null; //* png

$acceptedExtension = [
    'jpg',
    'png',
];


//* Validation Rules
if(empty($title)){
    $errors['title_error'] = 'title is missing!';
}
if(empty($detail)){
    $errors['detail_error'] = 'detail is missing!';
}

//* PHOTO VALIDATION
if($bannerImage['size'] == 0){
     $errors['bannerImage_error'] = "Banner Image is missing";
} else if(!in_array($extension,$acceptedExtension)){
    $errors['bannerImage_error'] = "$extension is not acceptable. Accepted types are " . join(', ',$acceptedExtension);
}

if(count($errors) > 0){
    //* ERROR FOUND
    $_SESSION['errors'] = $errors;
    header("Location: ../dashboard/Banner.php");
}else{
    $fileName = 'banner-' . uniqid(). '.' .$extension;
    move_uploaded_file($bannerImage['tmp_name'], '../uploads/'.$fileName);
    $uploadPath = "uploads/$fileName";


     include "../database/env.php";

    $query =  $id ? "UPDATE banners SET title='$title', detail='$detail',cta_title='$ctaTitle', cta_link='$ctaLink',
        video_link ='$videoLink',banner_img ='$uploadPath'  WHERE id='$id'"
    : "INSERT INTO banners(title, detail, cta_title, cta_link, video_link, banner_img) 
    VALUES ('$title','$detail','$ctaTitle','$ctaLink','$videoLink','$uploadPath')";

   $res = mysqli_query($conn, $query);
    
   if($res){
    $query = "SELECT * FROM banners WHERE status = 1";
    $result = mysqli_query($conn, $query);
    $banner = mysqli_fetch_assoc($result);
    $_SESSION["banner"] = $banner;
    $_SESSION['success'] = true;
    header('Location: ../dashboard/Banner.php');
   }
}

  