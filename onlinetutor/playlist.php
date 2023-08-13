
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
<?php
 
@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

// Check if user is logged in
if (!isset($user_id)) {
  header('Location: login_form.php');
  exit;
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>video playlist</title>

   <!-- font awesome cdn link  -->
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
         <img src="images/pic-1.jpg " class="image" alt="">
         <h1><b><?php echo $_SESSION['user_name'] ?></b><br></h1>
         <p class="role">student</p>
         <a href="profile.php" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="login_form" class="option-btn">login</a>
            <a href="register_form" class="option-btn">register</a>
         </div>
      </div>

        

   </section>

</header>   

<?php
 
$username=$_SESSION['name'];
if(!isset($username)){
   header('location:login_form.php');
}
if (!isset($_SESSION['id'])) {
   header("Location: login_form.php");
 }

 // Fill session id with user's id to get user's data like name and image name
$sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM userform WHERE id = $sessionId"));
?>
<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
       
   <img src="admin/img/<?php echo $user['image']; ?>" class= "image" id="image">
      <h1><b><?php echo $_SESSION['user_name'] ?></b><br></h1>
      <p class="role">Student</p>
      <a href="profile.php" class="btn" >view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      <a href="add_channel.php"><i class="fas fa-graduation-cap"></i><span>Teacher</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>Feedback</span></a>
   </nav>

</div>

<section class="playlist-details">

    

</section>

<section class="playlist-videos">

   <h1 class="heading">playlist videos</h1>

   <div class="box-container">


<?php
@include 'config.php';
 

$channel_id = $_GET['id'];
$query = "SELECT * FROM video WHERE channel_id = '$channel_id'";
$result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result)>0){
   while ($row=mysqli_fetch_assoc($result)){
?>

      <a class="box" href="watch-video.php?id=<?php echo $row['video_id']; ?>">
      <div class="tutor">
               <h3><?php echo $row['video_title'];?></h3>
               <span> <?php echo $row['created_at'];?></span>
         </div>
         <i class="fas fa-play"></i>
         <img src="admin/<?php echo $row['thumbnail']; ?>" alt="">
         <h3><?php echo $row['description'];?> </h3>
      </a>
      <?php
  }
}

  mysqli_close($conn);
?>





   </div>

</section>



<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>