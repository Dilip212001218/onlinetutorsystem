<?php
@include 'config.php';
// assuming you have already established a database connection
$query = $_GET['query'];
$search = "%{$query}%";
$channels = mysqli_query($conn, "SELECT * FROM channel WHERE channel_name LIKE '$search'");
?>

<h1>Search Results</h1>

<?php if (mysqli_num_rows($channels) > 0): ?>
  <ul>
    <?php while ($row = mysqli_fetch_assoc($channels)): ?>
      <li><a href="channeley.php?id=<?php echo $row['channel_id']; ?>"><?php echo $row['channel_name']; ?></a></li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <p>No results found.</p>
<?php endif; ?>
