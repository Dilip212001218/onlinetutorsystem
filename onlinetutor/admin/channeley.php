

<?php
require 'config.php';
session_start();
 
if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
if (!isset($_SESSION['admin_id'])) {
   header("Location: login_form.php");
 }
$sessionId = $_SESSION["admin_id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM userform WHERE id = $sessionId"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
   <title>add video</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="home.css">
   

<body>
<?php
error_reporting(0);
@include 'config.php';

session_start();

 

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
      <p class="role">TEACHER</p>
      <a href="adminprofile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      <a href="add_channel.php"><i class="fas fa-graduation-cap"></i><span>channels</span></a>
      <a href="teacher_profile.php"><i class="fas fa-graduation-cap"></i><span>Teacher</span></a>
       
       
   </nav>
</div>


   <?php
error_reporting(0);
@include 'config.php';

session_start();

if(!isset($_SESSION['name'])){
   header('location:login_form.php');
}

?>
<section class="form-container">
<form method="post" enctype="multipart/form-data">
  <h3>ADD VIDEO</h3>
   <p></p>
  <input type="text" name="video_title"  class="box"  placeholder="ENTER THE TITLE"required>
  <p>UPLOAD VIDEO</p>
  <input type="file" name="thumbnail"class="box" required>
  <p>THUMBNAIL</p>
  <input type="file" name="thumb"class="box" required>
   
  <textarea name="description" id="description" placeholder="description"class="box"></textarea>
  <button type="submit" name="submit"class="btn">Add</button>
</form>
</section>

<section class="playlist-videos">

<h1 class="heading">playlist videos</h1>

<div class="box-container">

<?php
@include 'config.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login_form.php");
  exit;
}

// assuming you have already established a database connection
$admin_id = $_SESSION['admin_id'];
$channel_id = $_GET['id'];
$query = "SELECT * FROM video WHERE channel_id = '$channel_id' AND admin_id = '$admin_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
   while ($row=mysqli_fetch_assoc($result)){
?>
    
    <a class="box" href="adminvideo.php?id=<?php echo $row['video_id']; ?>">
      <div class="tutor">
               <h3><?php echo $row['video_title'];?></h3>
               <span> <?php echo $row['created_at'];?></span>
         </div>
         <i class="fas fa-play"></i>
         <img src="<?php echo $row['thumbnail']; ?>" alt="">
         <h3><?php echo $row['description'];?> </h3>
      </a>
   <?php
  }
}
?>
 </div>
</section>

<?php
if (isset($_POST['submit'])) {

  $video_title = $_POST['video_title'];
  $desc=$_POST['description'];


  $thumbnail = $_FILES['thumbnail']['name'];
  $thumbnail_temp = $_FILES['thumbnail']['tmp_name'];
  $thumbnail_type = $_FILES['thumbnail']['type'];
  $thumbnail_size = $_FILES['thumbnail']['size'];
  $thumbnail_error = $_FILES['thumbnail']['error'];
  
  // Check for errors
  if ($thumbnail_error === UPLOAD_ERR_OK) {
    // Move uploaded file to a permanent location
    $upload_path = 'uploads/' . $thumbnail;
    move_uploaded_file($thumbnail_temp, $upload_path);
  } else {
    // Handle the error appropriately
    die('File upload error: ' . $thumbnail_error);
  }
  $thumb= $_FILES['thumb']['name'];
  $thumb_temp = $_FILES['thumb']['tmp_name'];
  $thumb_type = $_FILES['thumb']['type'];
  $thumb_size = $_FILES['thumb']['size'];
  $thumb_error = $_FILES['thumb']['error'];
  $path = 'thumbnail/' . $thumb;
    move_uploaded_file($thumb_temp, $path);
  

  $query = "INSERT INTO video (video_title,thumbnail, video_url, channel_id, admin_id,description) VALUES ('$video_title','$path', '$upload_path', '$channel_id', '$admin_id','$desc')";
  mysqli_query($conn, $query);
  $video_id=$_POST['video_id'];
   
  exit;
}
?>
<script src="js/script.js"></script>
</body>
</html>