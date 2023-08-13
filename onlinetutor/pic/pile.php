<?php
// Display the user's profile
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profile_pic = $row['profile_pic'];
}
?>

<!-- HTML -->
<html>
    <body>
<div class="profile-pic">
    <img src="uploads/<?php echo $profile_pic; ?>">
</div>

<!-- CSS -->
<style>
    .profile-pic img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
</style>
</body>
</html>
