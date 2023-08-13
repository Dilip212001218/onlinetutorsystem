<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>watch</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="home.css">
   <script>
function showReplyForm(comment_id) {
  var form = document.getElementById('reply-form-' + comment_id);
  if (form.style.display === 'none') {
    form.style.display = 'block';
  } else {
    form.style.display = 'none';
  }
}
</script>

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
      <img src="img/<?php echo $user['image']; ?>" id = "image" class="image">
         <h1><b><?php echo $username ?></b><br></h1>
         <p class="role">Teacher</p>
         <a href="adminprofile.php" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="login_form.php" class="option-btn">login</a>
            <a href="register_form.php" class="option-btn">register</a>
         </div>
      </div>

   </section>

</header>   
 <?php
 @include 'config.php';
 session_start();
$username=$_SESSION['name'];
if(!isset($username)){
   header('location:login_form.php');
}
if (!isset($_SESSION['admin_id'])) {
   header("Location: login_form.php");
 }

 // Fill session id with user's id to get user's data like name and image name
$sessionId = $_SESSION["admin_id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM userform WHERE id = $sessionId"));
?>
<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
       
   <img src="img/<?php echo $user['image']; ?>" class= "image" id="image">
      <h1><b><?php echo  $username ?></b><br></h1>
      <p class="role">Teacher</p>
      <a href="adminprofile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      <a href="add_channel.php"><i class="fas fa-graduation-cap"></i><span>Teacher</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>

</div>


<section class="watch-video">


<?php
@include 'config.php';
 
 



// assuming you have already established a database connection

$video_id = $_GET['id'];
$query = "SELECT * FROM video WHERE video_id = '$video_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
   while ($row=mysqli_fetch_assoc($result)){
?>


   <div class="video-container">
      <div class="video">
         <video src= "<?php echo $row['video_url']; ?>" controls poster="images/post-1-1.png" id="video"></video>
      </div>
      <h3 class="title">complete HTML tutorial (part 01)</h3>
      <div class="info">
         <p class="date"><i class="fas fa-calendar"></i><span> <?php echo $row['created_at']; ?></span></p>

<?php
$sql = "SELECT likes FROM video WHERE video_id = $video_id";
 $result = mysqli_query($conn, $sql);
 if(mysqli_num_rows($result)>0){
   while ($row=mysqli_fetch_assoc($result)){
?>

         <p class="date"><i class="fas fa-heart" ></i><span> <?php echo $row['likes']; ?>  likes</span></p>
      </div>
      
      <?php
      $query = "SELECT * FROM video WHERE video_id = '$video_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
   while ($row=mysqli_fetch_assoc($result)){
?>
       
         <form action="like.php" method="get"class="flex">
         <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
         <button name="submit"><i class="far fa-heart"></i><span>like</span></button>
      </form>
      
   </div>
   <?php
  }
}
   }
}
   }
}
?>
</section>

<section class="comments">


   <h1 class="heading"> comments</h1>
    
   <form method="POST" action="comment.php" class="add-comment">
   <h3>Add Comment</h3>
  <textarea id="comment_text" name="comment_text"></textarea>
  <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
  <button type="submit" class="inline-btn">Submit</button>
</form>

    
    
   <h1 class="heading">user comments</h1>
    

   <?php
// First, retrieve the comments for the current video from the database
$video_id = $_GET['id']; // assuming the video ID is passed as a GET parameter
$comments_query =  "SELECT c.*, u.name,u.image
FROM comments c
JOIN userform u ON c.user_id = u.id
WHERE c.video_id = $video_id AND c.parent_id IS NULL
ORDER BY c.created_at DESC";

$comments_result = mysqli_query($conn, $comments_query);


if ($comments_result) {
// Display the comments
while ($comment = mysqli_fetch_assoc($comments_result)) {
  // Output the comment text, user who made the comment, and creation date
   // Display the comment text and other details as before
   ?>
   <div class="box-container">

      <div class="box">
         <div class="user">
            <img src= "img/<?php echo $comment['image']; ?>" alt="">
            <div>
               <h3><?php echo $comment['name']; ?></h3>
               <span><?php echo $comment['created_at']; ?></span>
            </div>
         </div>
         <div class="comment-box"><?php echo $comment['comment_text']; ?></div>
         <form action="comment.php" method="get" class="flex-btn">
         <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
         <input type="hidden" name="id" value="<?php echo $comment['id']; ?>">
         <a href="adminedit.php?id=<?php echo $comment['id']; ?>"  class="inline-option-btn">edit</a>  
         <input type="submit" value="delete" name="delete" class="inline-delete-btn" onclick="return confirm('delete this comment?');">
          
      </form>
      </div>
       
<?php
  // Display the "reply" button and a form for adding a reply
  echo "<button class='inline-option-btn' onclick='showReplyForm(" . $comment['id'] . ")'>Reply</button>";
  echo "<div id='reply-form-" . $comment['id'] . "' class='reply-form' style='display: none;'>";
  echo "<form method='POST' action='rplycomment.php' class='add-comment'>";
  echo "<h3>Add a reply:</h3>";
  echo "<textarea id='comment_text' name='comment_text'></textarea>";
  echo "<input type='hidden' name='video_id' value='" . $video_id . "'>";
  echo "<input type='hidden' name='parent_id' value='" . $comment['id'] . "'>";
  echo "<button  name='submit' type='submit'class='inline-btn'>Submit</button>";
  echo "</form>";
  echo "</div>"; // Close the reply form div
   
 // assuming the video ID is passed as a GET parameter
 $query2 = "SELECT c.*, u.name,u.image FROM comments c JOIN userform u ON c.user_id = u.id WHERE c.parent_id =" . $comment['id'] . " ORDER BY c.created_at DESC"; 
 $result2 = mysqli_query($conn, $query2);

 if ($result2) {
   while ($reply = mysqli_fetch_assoc($result2)) {
      ?>
      <div class="box">
      <h1 class="heading">user replys</h1>
         <div class="user">
            <img src= "img/<?php echo $user['image']; ?>" alt="">
            <div>
               <h3><?php echo $reply['name']; ?></h3>
               <span><?php echo $reply['created_at']; ?></span>
            </div>
         </div>
         <div class="comment-box"><?php echo $reply['comment_text']; ?></div>
          
   </div>

         <?php
   }
 } else {
   echo "Error fetching replies: " . mysqli_error($conn);
 }

 echo "</div>"; // Close the comment div
}
} else {
echo "Error fetching comments: " . mysqli_error($conn);
}
   
?>
 

    

      
             

   </div>

</section>
<script src="js/script.js"></script>
   
</body>
</html>