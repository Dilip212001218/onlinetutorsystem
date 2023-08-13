<?php
@include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    // user not logged in, redirect to login page
    header("Location: login_form.php");
    exit();
}


$video_id = $_GET['video_id'];
$user_id = $_SESSION['user_id'];  
$result = $conn->query("SELECT * FROM likes WHERE user_id = $user_id AND video_id = $video_id");

if (!$result) {
    echo "Error: " . $conn->error;
    exit();
}

if ($result->num_rows > 0) {
    // User has already liked the video, so delete the like
    $conn->query("DELETE FROM likes WHERE user_id = $user_id AND video_id = $video_id");

    if (!$result) {
        echo "Error: " . $conn->error;
        exit();
    }
    header("Location:watch-video.php?id=$video_id");
    echo "You have disliked the video.";
} else {
    // User has not yet liked the video, so insert a new like
    $conn->query("INSERT INTO likes (user_id, video_id) VALUES ($user_id, $video_id)");

    if (!$result) {
        echo "Error: " . $conn->error;
        exit();
    }
    header("Location:watch-video.php?id=$video_id");
    echo "You have liked the video.";
}

// Update the video's like count
$result = $conn->query("SELECT COUNT(*) FROM likes WHERE video_id = $video_id");
$likes = $result->fetch_row()[0];

$conn->query("UPDATE video SET likes = $likes WHERE video_id = $video_id");

if (!$result) {
    echo "Error: " . $conn->error;
    exit();
}

// Close database connection
$conn->close();
?>

