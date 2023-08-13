<?php
@include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
  }
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $user_id = $_SESSION['user_id'];
    $created_at = date('Y-m-d H:i:s');
  $comment_text = $_POST['comment_text'];
  $video_id = $_POST['video_id'];
  $parent_id = $_POST['parent_id']; // Retrieve the parent ID from the form data
  
  // Insert the new comment into the database
  $insert_query = "INSERT INTO comments (user_id, video_id, comment_text, parent_id, created_at) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $insert_query);
  mysqli_stmt_bind_param($stmt, "sssss", $user_id, $video_id, $comment_text, $parent_id, $created_at);
  
  // Execute the SQL statement
  if (mysqli_stmt_execute($stmt)) {
    echo "Comment added successfully!";
    header("Location: watch-video.php?id=$video_id");
  } else {
    echo "Error adding comment: " . mysqli_error($conn);
  }

}
?>