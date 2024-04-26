<?php
// Define database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Fetch students and their courses
$query = "SELECT s.Full_name, sa.rank 
          FROM student s
          JOIN student_rank sa ON s.student_id = sa.student_id
          WHERE sa.rank BETWEEN 1 AND 100
          ORDER BY sa.rank";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error in query: ' . mysqli_error($conn));
}

?>
    
<h1>Students and Their rank</h1>
<ul>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <li><?= $row['Full_name'] ?>'s rank is <?= $row['rank'] ?></li>
    <?php endwhile; ?>
</ul>

<?php
// Free result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>
