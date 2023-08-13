 <div class="video">
    <h2>Video Title</h2>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe>
    <button class="like-btn" data-id="VIDEO_ID" name="submit">Like</button>
    <span class="like-count">0</span>
</div>
<script>

$(document).ready(function() {
 $('.like-btn').click(function() {
        var video_id = $(this).data('id');
         $.ajax({
             url: 'like.php',
             method: 'POST',
             data: {
                 'video_id': video_id
             },
             success: function(response) {
                 $('.like-count[data-id="' + video_id + '"]').text(response);
             }
         });
     });
 });
</script>
<?php
// Connect to the database
@include 'config.php';
if(isset($_POST['submit'])){
// Get the video ID from the POST data
$video_id = $_POST['video_id'];

// Update the like count for the video in the database
$sql = "UPDATE video SET likes = likes + 1 WHERE video_id = $video_id";
mysqli_query($conn, $sql);

// Get the new like count for the video
$sql = "SELECT likes FROM video WHERE video_id = $video_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$like_count = $row['likes'];

// Return the new like count as the response
echo $like_count;
}
?>

