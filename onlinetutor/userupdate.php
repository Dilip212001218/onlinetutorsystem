<?php
require 'config.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login_form.php");
  }

  // Fill session id with user's id to get user's data like name and image name
$sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM userform WHERE id = $sessionId"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
   <title>profile</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="home.css">
    <style media="screen">
    .upload{
      width: 140px;
      position: relative;
      margin: auto;
      text-align: center;
    }
    .upload img{
      border-radius: 50%;
      width: 100px;
      height: 100px;
    }
    .upload .rightRound{
      position: absolute;
      bottom: 0;
      right: 0;
      background: #bb00FF;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .leftRound{
      position: absolute;
      bottom: 0;
      left: 0;
      background: red;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .fa{
      color: white;
    }
    .upload input{
      position: absolute;
      transform: scale(2);
      opacity: 0;
    }
    .upload input::-webkit-file-upload-button, .upload input[type=submit]{
      cursor: pointer;
    }
  </style> 
</head>
<body>
<?php
error_reporting(0);
@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<header class="header">
   
   <section class="flex">

      <a href="home.html" class="logo">Educa.</a>

      <form action="" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
      <img src="admin/img/<?php echo $user['image']; ?>" id = "image" class="image">
       
      <h1><b><?php echo $_SESSION['user_name'] ?></b><br></h1>
         <p class="role">Student</p>
         <a href="profile.html" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="login.html" class="option-btn">login</a>
            <a href="register.html" class="option-btn">register</a>
         </div>
      </div>

   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>
    
   <div class="profile">
   <img src="admin/img/<?php echo $user['image']; ?>" id = "image" class="image">
      <h1><b><?php echo $_SESSION['user_name'] ?></b><br></h1>
      <p class="role">Student</p>
      <a href="profile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      
      <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>
</div>
<?php
if(isset($_POST['update'])){

$id = $_GET['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['new_pass'];

mysqli_query($conn, "UPDATE `userform` SET name= '$name',email='$email', password='$pass' WHERE id = '$id'") or die('query failed');
header("Location: profile.php");
}
?>

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <p>update name</p>
      <input type="text" name="name" placeholder="name" maxlength="50" class="box">
      <p>update email</p>
      <input type="email" name="email" placeholder="email" maxlength="50" class="box">
      <p>new password</p>
      <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20" class="box">
      <input type="submit" value="update profile" name="update" class="btn">
   </form>

</section>



<script src="js/script.js"></script>

   
</body>
</html>