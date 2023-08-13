
<form action="" method="post" enctype="multipart/form-data">
   <!-- <label for="name">Video Name:</label>
    <input type="text" name="name" id="name"><br>
    <label for="date">Upload Date:</label>
    <input type="date" name="date" id="date"><br>-->
    <label for="video">Video File:</label>
    <input type="file" name="files[]" id="video" multiple><br>
    <input type="submit" name="submit" value="Upload">
</form>
<?php
@include 'config.php';
if(isset($_POST['submit'])){

    $files=array();

    foreach($_FILES['files']['tmp_name'] as $key=>$tmp_name){
        if($_FILES['files']['name'][$key]){
            $filename=$_FILES['files']['name'][$key];
            $extension=pathinfo($filename,PATHINFO_EXTENSION);
            $newfilename=md5($filename.time()) . "." . $extension;
            move_uploaded_file($tmp_name,'uploads/' . $newfilename);
            $files[]='uploads/' . $newfilename;
        }
        
    }
$sql = "INSERT INTO file (files) VALUES ('$file_paths')";
mysqli_query($conn, $sql);

}

$sql = "SELECT files FROM file";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error retrieving playlist information: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$video_ids = $row['files'];

// Add the new video ID to the list of video IDs
if (empty($video_ids)) {
    $video_ids = $url;
} else {
    $video_ids .= ',' . $url;
}

// Update the video IDs for the playlist in the database
$sql = "UPDATE file SET files = '$video_ids'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error updating playlist information: " . mysqli_error($conn));
}

echo "Video added to playlist successfully!";

mysqli_close($conn);
?> 
