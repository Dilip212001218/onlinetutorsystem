<?php
@include 'config.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login_form.php");
  exit;
}

if (isset($_POST['submit'])) {
  // assuming you have already established a database connection
  $admin_id = $_SESSION['admin_id'];
  $channel_name = $_POST['channel_name'];
  

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
  
   
  
  $select= mysqli_query($conn, "SELECT channel_name FROM channel WHERE channel_name = '$channel_name'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $error[] = 'channel name already exist';
   } 
   else{
  $query = "INSERT INTO channel (channel_name,thumbnail, admin_id) VALUES ('$channel_name','$upload_path', '$admin_id')";
  if (mysqli_query($conn, $query)) {
    echo "New channel created successfully";
    header('location:dashboard.php');

  } else {
    echo "Error: " . $query. "<br>" . mysqli_error($conn);
  }
}
}
?>

<?php
require 'config.php';

$_SESSION["id"] = 1; // Fill session id with user's id to get user's data like name and image name
$sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sessionId"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
   <title>add channel</title>
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
      <p class="role">TEACHER</p>
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

<form method="POST" action="" enctype="multipart/form-data">
<h3>Add a channel</h3>
  <input type="text" name="channel_name" id="channel_name" placeholder="channel name" class="box"></br>
  <input type="file" name="thumbnail" id="thumbnail" accept="mp4" class="box"></br>

  <input type="submit" name="submit" value="Create Channel" class="btn">
</form>
</section>
<script src="js/script.js"></script>
</body>
</html>
