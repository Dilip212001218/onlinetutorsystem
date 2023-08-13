<?php
// Assuming you have established a database connection using $conn variable
@include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
  }
   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $user_id = $_SESSION['user_id']; // You would normally get this from a session or authentication system
  $video_id = $_POST['video_id'];
  $comment_text = $_POST['comment_text'];
  $parent_id = NULL; // This is a top-level comment, so the parent ID should be NULL
  $created_at = date('Y-m-d H:i:s');

  // Prepare the SQL statement to insert the new comment into the database
  $insert_query = "INSERT INTO comments (user_id, video_id, comment_text, parent_id, created_at) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $insert_query);
  mysqli_stmt_bind_param($stmt, "sssss", $user_id, $video_id, $comment_text, $parent_id, $created_at);
  
  // Execute the SQL statement
  if (mysqli_stmt_execute($stmt)) {
    
    header("Location:watch-video.php?id=$video_id");
  } else {
    echo "Error adding comment: " . mysqli_error($conn);
  }
}
?>
<?php
      if(isset($_GET['delete'])){
    $comment_id = $_GET['id'];
    $video_id=$_GET['video_id'];

    // Execute DELETE query to remove the comment
    $sql = "DELETE FROM comments WHERE id = $comment_id";
    $result = mysqli_query($conn, $sql);
  

    // if ($result) {
      header("Location: watch-video.php?id=$video_id");
    // } else {
    //     // Error deleting comment
    //     // Display an error message
    // }
}
?>
<?php
if(isset($_GET['update_product'])){

$update_id = $_GET['update_id'];
$v_id = $_GET['video_id'];
$update_comment = $_GET['comment_text'];

mysqli_query($conn, "UPDATE `comments` SET comment_text= '$update_comment' WHERE id = '$update_id'") or die('query failed');
header("Location: watch-video.php?id=$v_id");
}
?>