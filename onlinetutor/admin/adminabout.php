
<?php
error_reporting(0);
@include 'config.php';

session_start();

if(!isset($_SESSION['admin_id'])){
   header('location:login_form.php');
}
if(!isset($_SESSION['name'])){
   header('location:login_form.php');
}
$sessionId = $_SESSION["admin_id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM userform WHERE id = $sessionId"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about us</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="home.css">
</head>
<body>

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
      <img src="img/<?php echo $user['image']; ?>" id = "image" class="image">
         <h1><b><?php echo $_SESSION['name'] ?></b><br></h1>
         <p class="role">Teacher</p>
         <a href="adminprofile.php" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="login_form.php" class="option-btn">login</a>
            <a href="register_form.php" class="option-btn">register</a>
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
      <a href="profile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="adminabout.php"><i class="fas fa-question"></i><span>about</span></a>
      <a href="add_channel.php"><i class="fas fa-graduation-cap"></i><span>channel</span></a>
      <a href="teacher_profile.php"><i class="fas fa-graduation-cap"></i><span>Teacher</span></a>
       
       
   </nav>

</div>

<section class="about">

  

   <div class="box-container">

      <div class="box">
         <i class="fas fa-graduation-cap"></i>
         <div>
            <h3>+10k</h3>
            <p>online channels</p>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-user-graduate"></i>
         <div>
            <h3>+40k</h3>
            <p>brilliant students</p>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-chalkboard-user"></i>
         <div>
            <h3>+2k</h3>
            <p>expert tutors</p>
         </div>
      </div>

       

   </div>
   <div class="row">

<div class="image">
   <img src="images/about-img.svg" alt="">
</div>

<div class="content">
   <h3>why choose us?</h3>
   
   <a href="dashboard.php" class="inline-btn">our channel</a>
</div>

</div>

</section> 

 


<script src="js/script.js"></script>
</body>
</html>