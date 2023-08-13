<?php
@include 'config.php';
// assuming you have already established a database connection
$query = "SELECT * FROM channel";
$result = mysqli_query($conn, $query);
?>

<h1>All Channels</h1>

<ul>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <li><a href="channel2.php?id=<?php echo $row['channel_id']; ?>"><?php echo $row['channel_name']; ?></a></li>
  <?php endwhile; ?>
</ul>

<!-- <form method="get" action="search.php">
  <label>Search:</label>
  <input type="text" name="query" required>
  <button type="submit">Search</button>
</form> -->
