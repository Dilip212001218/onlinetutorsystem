
<?php
require 'config.php';

$_SESSION["id"] = 1; // Fill session id with user's id to get user's data like name and image name
$sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sessionId"));
?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Sliding Modal Box Style</title>
       
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="css/homestyle.css">
      <link rel="stylesheet" href="design.css">
      <script src="js/script.js"></script>
   <body>

   <?php
error_reporting(0);
@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>


    <header class="header">
   
   <section class="flex">

      <a href="home.html" class="logo"></a>

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
      <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <div class="upload">
        <img src="img/<?php echo $user['image']; ?>" id = "image">
      </div>
    </form>
      <h1><b><?php echo $_SESSION['admin_name'] ?></b><br></h1>
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
   <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <div class="upload">
        <img src="img/<?php echo $user['image']; ?>" id = "image">

         
      </div>
    </form>
   <div class="profile">

      <h1><b><?php echo $_SESSION['admin_name'] ?></b><br></h1>
      <p class="role">TEACHER</p>
      <a href="profile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>

</div>

<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Sliding Modal Box Style</title>
       
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="css/homestyle.css">
      <link rel="stylesheet" href="design.css">
      <script src="js/script.js"></script>
 

     <h1 class="heading">our channel</h1>
 
      <!-- <div class="start-btn">
         <a href="#">View Modal</a>
      </div> -->
      
      
       

             
                <form method="post" enctype="multipart/form-data">
                    <h3>Add video</h3>
                    <input type="text" placeholder="TITLE" name="video_title" class="box" required >
                    <p align="left">THUMBNAIL</p>
                    <input type="file" name="thumbnail" class="box"required>
                    <p align="left">UPLOAD</p>
                    <input type="file"placeholder="UPLOAD" name="thumb"class="box" required>
                     
                    <textarea name="description" id="description" placeholder="DESCRIPTION"class="box"></textarea>
                    <button type="submit" name="submit"class="btn">Add</button>
                  </form>
             
             
            
          

       

      <script >
        $(document).ready(function(){
   $('.start-btn').click(function(){
     $('.modal-box').toggleClass("show-modal");
     $('.start-btn').toggleClass("show-modal");
   });
   $('.fa-times').click(function(){
     $('.modal-box').toggleClass("show-modal");
     $('.start-btn').toggleClass("show-modal");
   });
 });
      </script>
   </body>
</html>