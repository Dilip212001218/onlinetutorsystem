
<?php
error_reporting(0);
@include 'config.php';

session_start();
$username=$_SESSION['name'];
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
       
   <img src="img/<?php echo $user['image']; ?>" class= "image" id="image">
      <h1><b><?php echo $username ?></b><br></h1>
      <p class="role">Student</p>
      <a href="profile.php" class="btn" >view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      <a href="add_channel.php"><i class="fas fa-graduation-cap"></i><span>Teacher</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>

</div>

<section class="playlist-details">

   <!-- <h1 class="heading">playlist details</h1> -->

   <!-- <div class="row">

      <div class="column">
         <form action="" method="post" class="save-playlist">
            <button type="submit"><i class="far fa-bookmark"></i> <span>save playlist</span></button>
         </form>
   
         <div class="thumb">
            <img src="images/thumb-1.png" alt="">
            <span>10 videos</span>
         </div>
      </div>
      <div class="column">
         <div class="tutor">
            <img src="images/pic-2.jpg" alt="">
            <div>
               <h3>john deo</h3>
               <span>21-10-2022</span>
            </div>
         </div>
   <pre>
         <div class="details">
            <h3></h3>
            <p></p>






            <a href="teacher_profile.html" class="inline-btn">view profile</a>
         </div></pre>
      </div>
   </div> -->

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
               <span>21-10-2022</span>
         </div>
         <i class="fas fa-play"></i>
         <img src="<?php echo $row['thumbnail']; ?>" alt="">
         <h3><?php echo $row['description'];?> </h3>
      </a>
      <?php
  }
}

  mysqli_close($conn);
?>



 

      <!--  <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-3.png" alt="">
         <h3>complete HTML tutorial (part 03)</h3>
      </a>

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-4.png" alt="">
         <h3>complete HTML tutorial (part 04)</h3>
      </a>

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-5.png" alt="">
         <h3>complete HTML tutorial (part 05)</h3>
      </a>

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-6.png" alt="">
         <h3>complete HTML tutorial (part 06)</h3>
      </a>-->

   </div>

</section>



<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>