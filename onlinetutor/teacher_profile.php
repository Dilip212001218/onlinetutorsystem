 
<?php
error_reporting(0);
@include 'config.php';

session_start();

if(!isset($_SESSION['id'])){
   header('location:login_form.php');
}
if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
$sessionId = $_SESSION["id"];
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
         <h1><b><?php echo $_SESSION['admin_name'] ?></b><br></h1>
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
      <h1><b><?php echo $_SESSION['admin_name'] ?></b><br></h1>
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
           <span>12-3-2023</span>
        </div>
    </div>
      <div class="thumb">
        <img src="<?php echo $fetch_product['thumbnail']; ?>" id = "image">
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
<section class="teacher-profile">
   <?php
   if (!isset($_SESSION['admin_id'])) {
      header("Location: login.php");
      exit;
    }
    
    // assuming you have already established a database connection
    $admin_id = $_SESSION['admin_id'];
$sql = "SELECT COUNT(*) AS likes,total FROM video WHERE admin_id= $admin_id";

// execute query
$result = mysqli_query($conn, $sql);

// check if query executed successfully
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       
   
?>
   <h1 class="heading">profile details</h1>

   <div class="details">
      <div class="tutor">
      <img src="img/<?php echo $user['image']; ?>" id = "image" class="image">
         <h3><?php echo $_SESSION['admin_name'] ?></h3>
         <span>Teacher</span>
      </div>
      <div class="flex">
         
         <p>total videos : <span><?php echo $row["total"]; ?></span> </p>
         <p>total likes : <span><?php echo $row["likes"]; ?></span></p>
        
      </div>
   </div>
   <?php
}
} else {
    echo "0 results";
}
?>
</section>



      

<section class="courses">

<h1 class="heading">our channel</h1>

<div class="box-container">
 
<?php
@include 'config.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
header("Location: login.php");
exit;
}

// assuming you have already established a database connection
$admin_id = $_SESSION['admin_id'];
$query = "SELECT * FROM channel WHERE admin_id = '$admin_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
while ($row=mysqli_fetch_assoc($result)){
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
     <img src="<?php echo $row['thumbnail']; ?>" id = "image">
  </div>
  <a href="channeley.php?id=<?php echo $row['channel_id']; ?>" class="inline-btn">view profile</a>
</div>
<?php
}
}
?>
</section> 
<script src="js/script.js"></script>

   
</body>
</html>