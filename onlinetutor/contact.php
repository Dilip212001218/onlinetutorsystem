
<?php
@include 'config.php';
session_start();
$username=$_SESSION['user_name'];
if(!isset($username)){
   header('location:login_form.php');
}
if (!isset($_SESSION['user_id'])) {
   header("Location: login_form.php");
 }

 // Fill session id with user's id to get user's data like name and image name
$sessionId = $_SESSION["user_id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM userform WHERE id = $sessionId"));
?>
<?php
error_reporting(0);


session_start();

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact us</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="home.css">
</head>
<body>

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
      <img src="admin/img/<?php echo $user['image']; ?>" class= "image" id="image">
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
       
   <img src="admin/img/<?php echo $user['image']; ?>" class= "image" id="image">
      <h1><b><?php echo  $username ?></b><br></h1>
      <p class="role">Student</p>
      <a href="profile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>About</span></a>
      
      <a href="contact.php"><i class="fas fa-headset"></i><span>Feedback</span></a>
   </nav>

</div>

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

     <?php 
if(isset($_POST['submit'])){


      
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$msg = $_POST['msg'];
 

 
      $insert = "INSERT INTO feedback (name, email,msg) VALUES('$name','$email','$msg')";
      mysqli_query($conn, $insert);
      header('location:home.php');
   
    
};
?>

      <form action="" method="post">
         <h3>FEEDBACK</h3>
         <input type="text" placeholder="enter your name" name="name" required maxlength="50" class="box">
         <input type="email" placeholder="enter your email" name="email" required maxlength="50" class="box">
         
         <textarea name="msg" class="box" placeholder="enter your message" required maxlength="1000" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" class="inline-btn" name="submit">
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>phone number</h3>
         <a href="tel:1234567890">9025847314</a>
         <a href="tel:1112223333">9790925901</a>
      </div>
      
      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>email address</h3>
         <a href="mailto:shaikhanas@gmail.com">dilip@gmail.come</a>
         <a href="mailto:anasbhai@gmail.com">dilipmohanbabu@gmail.come</a>
      </div>

      

   </div>

</section>
<script src="js/script.js"></script>

   
</body>
</html>