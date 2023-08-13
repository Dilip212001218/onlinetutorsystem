<?php
require 'config.php';
session_start();
$username=$_SESSION['user_name'];
if(!isset($username)){
   header('location:login_form.php');
}
if (!isset($_SESSION['id'])) {
    header("Location: login_form.php");
  }
  if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
  }

  // Fill session id with user's id to get user's data like name and image name
$sessionId = $_SESSION["user_id"];
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

      <a href="home.html" class="logo"></a>

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
   <img src="admin/img/<?php echo $user['image']; ?>" id = "image" class="image">
      <h1><b><?php echo $_SESSION['user_name'] ?></b><br></h1>
      <p class="role">Student</p>
      <a href="profile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      
      <a href="contact.php"><i class="fas fa-headset"></i><span>Feedback</span></a>
   </nav>

</div>

<section class="user-profile">

   <h1 class="heading">your profile</h1>

   <div class="info">

      <div class="user">
      <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <div class="upload">
        <img src="admin/img/<?php echo $user['image']; ?>" id = "image">

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
         <a href="userupdate.php?id=<?php echo $sessionId ?>" class="inline-btn">update profile</a>
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

      $target = "admin/img/" . $imageName;

      move_uploaded_file($src, $target);

      $query = "UPDATE userform  SET image = '$imageName' WHERE id = $id";
      mysqli_query($conn, $query);

      header("Location:profile.php");
    }
    ?>
<script src="js/script.js"></script>
</body>
</html>