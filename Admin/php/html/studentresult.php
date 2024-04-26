<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
session_start();
$student_id = $_SESSION['student_id'];
// Assuming you have a specific student ID (e.g., '123') to retrieve data for
// $student_id = '7';

// Fetch grade points for the specified student
$query = "SELECT sm.subject_id, sm.student_mark
          FROM student_marklist AS sm
          WHERE sm.student_id = '$student_id'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error in query: ' . mysqli_error($conn));
}
?>



<h1>Grade Points for Student ID <?= $student_id ?></h1>
<table>
    <thead>
        <tr>
            <th>Course ID</th>
            <th>Grade Point</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['subject_id'] ?></td>
                <td><?= $row['student_mark'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
// Free result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>

