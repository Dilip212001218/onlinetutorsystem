 
<?php
error_reporting(0);
@include 'config.php';

session_start();
$username=$_SESSION['user_name'];
if(!isset($username)){
   header('location:login_form.php');
}
if (!isset($_SESSION['id'])) {
   header("Location: login_form.php");
 }
 $user=$_SESSION['user'];
 if(!isset($user)){
    header('location:login_form.php');
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
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="home.css">

</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.html" class="logo"></a>

      <form action="" method="post" class="search-form">
         <input type="text" name="search" required placeholder="search channels..." maxlength="100">
         <button type="submit" name="submit"class="fas fa-search"></button>
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
         <p class="role">student</p>
         <a href="profile.php" class="btn">view profile</a>
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
       
   <img src="admin/img/<?php echo $user['image']; ?>" class= "image" id="image">
      <h1><b><?php echo  $_SESSION['user_name'] ?></b><br></h1>
      <p class="role">Student</p>
      <a href="profile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      
      <a href="contact.php"><i class="fas fa-headset"></i><span>Feedback</span></a>
   </nav>

</div>
<section class="courses">     
   <div class="box-container">

   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `channel` WHERE channel_name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>
    <div class="box">
     <div class="tutor">
        <img src="images/pic-2.jpg" alt="">
        <div class="info">
           <h3><?php echo $fetch_product['channel_name'];?></h3>
           <span> <?php echo $fetch_product['created_at'];?></span>
        </div>
    </div>
      <div class="thumb">
        <img src="admin/<?php echo $fetch_product['thumbnail']; ?>" id = "image">
     </div>
     <a href="playlist.php?id=<?php echo $fetch_product['channel_id']; ?>" class="inline-btn" >view channel</a>
   </div>
   <?php
            }
         }else{
            echo '<p class="heading" align="center" >No result found!</p>';
         }
      }
   ?>
    
   </div>

</section>


<section class="courses">

   <h1 class="heading">our channel</h1>

   <div class="box-container">
    
<?php
  $query="SELECT* FROM channel" ;
  $resul=mysqli_query($conn,$query);

  if(mysqli_num_rows($resul)>0){
   while ($row=mysqli_fetch_assoc($resul)){
?>
    
   <div class="box">
     <div class="tutor">
        <img src="images/pic-2.jpg" alt="">
        <div class="info">
           <h3><?php echo $row['channel_name'];?></h3>
           <span><?php echo $row['created_at'];?></span>
        </div>
    </div>
      <div class="thumb">
        <img src="admin/<?php echo $row['thumbnail']; ?>" id = "image">
     </div>
     <a href="playlist.php?id=<?php echo $row['channel_id']; ?>" class="inline-btn" >view channel</a>
   </div>
   <?php
  }
}
?>

       

</section> 
<script src="js/script.js"></script>
</body>
</html>