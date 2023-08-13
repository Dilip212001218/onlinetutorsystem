<?php
// Assuming you have retrieved the comments for the video from the database and stored them in an array called $comments
foreach ($comments as $comment) {
  // Display the comment text and other details as before
  echo "<div class='comment'>";
  echo "<p class='comment-text'>" . $comment['comment_text'] . "</p>";
  echo "<p class='comment-meta'>Posted by " . $comment['user_id'] . " on " . $comment['created_at'] . "</p>";
  
  // Display the "reply" button and a form for adding a reply
  echo "<button class='reply-button' onclick='showReplyForm(" . $comment['id'] . ")'>Reply</button>";
  echo "<div id='reply-form-" . $comment['id'] . "' class='reply-form' style='display: none;'>";
  echo "<form method='POST' action='add_comment.php'>";
  echo "<label for='comment_text'>Add a reply:</label>";
  echo "<textarea id='comment_text' name='comment_text'></textarea>";
  echo "<input type='hidden' name='video_id' value='" . $video_id . "'>";
  echo "<input type='hidden' name='parent_id' value='" . $comment['id'] . "'>";
  echo "<button type='submit'>Submit</button>";
  echo "</form>";
  echo "</div>"; // Close the reply form div
  echo "</div>"; // Close the comment div
}
?>

<?php
// Check if the form has been submitted
if (isset($_POST['comment_text'])) {
  // Retrieve the form data
  $comment_text = $_POST['comment_text'];
  $video_id = $_POST['video_id'];
  $parent_id = $_POST['parent_id']; // Retrieve the parent ID from the form data
  
  // Insert the new comment into the database
  $query = "INSERT INTO comments (parent_id, video_id, user_id, comment_text, created_at) 
            VALUES (:parent_id, :video_id, :user_id, :comment_text, NOW())";
  $stmt = $pdo->prepare($query);
  $stmt->execute(array(
    ':parent_id' => $parent_id,
    ':video_id' => $video_id,
    ':user_id' => $user_id,
    ':comment_text' => $comment_text
  ));
}
?>



<?php
// First, retrieve the comments for the current video from the database
$video_id = $_GET['id']; // assuming the video ID is passed as a GET parameter
$comments_query = "SELECT * FROM comments WHERE video_id = $video_id ORDER BY created_at DESC";
$comments_result = mysqli_query($conn, $comments_query);

// Display the comments
while ($comment = mysqli_fetch_assoc($comments_result)) {
  // Output the comment text, user who made the comment, and creation date
  echo "<p>{$comment['comment_text']} - by {$comment['user_id']} on {$comment['created_at']}</p>";

  // Add a reply button for the comment
  echo "<form method='POST' action='add_comment.php'>";
  echo "<input type='hidden' name='video_id' value='$video_id'>";
  echo "<input type='hidden' name='parent_id' value='{$comment['id']}'>";
  echo "<button type='submit'>Reply</button>";
  echo "</form>";
}
?>


<?php
function display_comments($video_id, $parent_id = null, $indent_level = 0) {
  global $pdo;
  
  // Query the database for comments with the given video ID and parent ID
  $query = "SELECT * FROM comments WHERE video_id = :video_id AND parent_id = :parent_id ORDER BY created_at ASC";
  $stmt = $pdo->prepare($query);
  $stmt->execute(array(
    ':video_id' => $video_id,
    ':parent_id' => $parent_id
  ));
  
  // Display each comment
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Indent the comment based on its depth in the tree
    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $indent_level);
    echo $indent . $row['comment_text'] . '<br>';
    
    // Recursively display any replies to this comment
    display_comments($video_id, $row['id'], $indent_level + 1);
  }
}

// Display the top-level comments for the video
display_comments($video_id);
?>

