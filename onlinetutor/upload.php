<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login_form.php');
}
$channel_id = $_SESSION['channel_id'];

if(!isset($channel_id)){
   header('location:admin.php');
}

 
$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);



// Move uploaded file to designated folder
$filename = $_FILES['video']['name'];
$tmpname = $_FILES['video']['tmp_name'];
$extension = pathinfo($filename, PATHINFO_EXTENSION);
$newfilename = uniqid() . '.' . $extension;
$upload_dir = 'thumbnail/';
move_uploaded_file($tmpname, $upload_dir . $newfilename);



    // Prepare the SQL statement with a placeholder for the foreign key value
    $insert =  "INSERT INTO videos (title, description,url,user_id) VALUES ('$title', '$description','$newfilename','$user_id')";
         mysqli_query($conn, $insert);
         header('location:home.php');

         
      
?>


