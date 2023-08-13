 <?php
require 'config.php';

$_SESSION["id"] = 1; // Fill session id with user's id to get user's data like name and image name
$sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sessionId"));
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Image</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/homestyle.css">
  </head>
  <body >
    
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
         <img src="images/pic-1.jpg" class="image" alt="">
         <h3 class="name">shaikh anas</h3>
         <p class="role">studen</p>
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
   <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <div class="upload">
        <img src="img/<?php echo $user['image']; ?>" id = "image">
      </div>
    </form>
      <h1><b><?php echo $_SESSION['user_name'] ?></b><br></h1>
      <p class="role">studen</p>
      <a href="profile.html" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.html"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.html"><i class="fas fa-question"></i><span>about</span></a>
      <a href="courses.html"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="teachers.html"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
      <a href="contact.html"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>

</div>

<section class="user-profile">

   <h1 class="heading">your profile</h1>

   <div class="info">

      <div class="user">
      <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <div class="upload">
        <img src="img/<?php echo $user['image']; ?>" id = "image">

        <div class="rightRound" id = "upload">
          <input type="file" name="fileImg" id = "fileImg" accept=".jpg, .jpeg, .png">
          <i class = "fa fa-camera"></i>
        </div>

        <div class="leftRound" id = "cancel" style = "display: none;">
          <i class = "fa fa-times"></i>
        </div>
        <div class="rightRound" id = "confirm" style = "display: none;">
          <input type="submit">
          <i class = "fa fa-check"></i>
        </div>
      </div>
    </form>
    <h1><b><?php echo $_SESSION['user_name'] ?></b><br></h1>
         <p>student</p>
         <a href="update.html" class="inline-btn">update profile</a>
      </div>
   
      <div class="box-container">
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-bookmark"></i>
               <div>
                  <span>4</span>
                  <p>saved playlist</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view playlists</a>
         </div>
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-heart"></i>
               <div>
                  <span>33</span>
                  <p>videos liked</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view liked</a>
         </div>
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-comment"></i>
               <div>
                  <span>12</span>
                  <p>videos comments</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view comments</a>
         </div>
   
      </div>
   </div>

</section> 


    <script type="text/javascript">
      document.getElementById("fileImg").onchange = function(){
        document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image

        document.getElementById("cancel").style.display = "block";
        document.getElementById("confirm").style.display = "block";
        document.getElementById("upload").style.display = "none";
      }
      var userImage = document.getElementById('image').src;
      document.getElementById("cancel").onclick = function(){
        document.getElementById("image").src = userImage; // Back to previous image
        document.getElementById("cancel").style.display = "none";
        document.getElementById("confirm").style.display = "none";
        document.getElementById("upload").style.display = "block";

      }
       
    </script>

    <?php
    if(isset($_FILES["fileImg"]["name"])){
      $id = $_POST["id"];

      $src = $_FILES["fileImg"]["tmp_name"];
      $imageName = uniqid() . $_FILES["fileImg"]["name"];

      $target = "img/" . $imageName;

      move_uploaded_file($src, $target);

      $query = "UPDATE tb_user SET image = '$imageName' WHERE id = $id";
      mysqli_query($conn, $query);

      header("Location:index.php");
      header("refresh: 3");
    }
    ?>
    <script src="js/script.js"></script>
  </body>
</html>
