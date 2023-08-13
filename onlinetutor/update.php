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

if(!isset($_SESSION['name'])){
   header('location:login_form.php');
}

?>

<header class="header">
   
   <section class="flex">

      <a href="home.html" class="logo">Educa.</a>

      <form action="search.html" method="post" class="search-form">
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
      <img src="img/<?php echo $user['image']; ?>" id = "image" class="image">
       
      <h1><b><?php echo $_SESSION['name'] ?></b><br></h1>
         <p class="role">Teacher</p>
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
   <img src="img/<?php echo $user['image']; ?>" id = "image" class="image">
      <h1><b><?php echo $_SESSION['name'] ?></b><br></h1>
      <p class="role">Teacher</p>
      <a href="adminprofile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="adminabout.php"><i class="fas fa-question"></i><span>about</span></a>
      <a href="add_channel.php"><i class="fas fa-graduation-cap"></i><span>channel</span></a>
      <a href="teacher_profile.php"><i class="fas fa-graduation-cap"></i><span>Teacher</span></a>
       
       
   </nav>

</div>


<section class="form-container">

<form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <p>update name</p>
      <input type="text" name="name" placeholder="shaikh anas" maxlength="50" class="box">
      <p>update email</p>
      <input type="email" name="email" placeholder="shaikh@gmail.come" maxlength="50" class="box">
      <p>new password</p>
      <input type="password" name="new_pass" placeholder="enter your old password" maxlength="20" class="box">
      <input type="submit" value="update profile" name="submit" class="btn">
   </form>


</section>



<script src="js/script.js"></script>

   
</body>
</html>