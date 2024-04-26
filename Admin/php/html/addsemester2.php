<?php
// Establish database connection
// $con = mysqli_connect("$host", "$username", "$password", "$db_name");
// / Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// if (mysqli_connect_errno($con)) {
//     echo 'Failed to connect';
// }
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
else {
    echo 'Connection established';
    echo "<BR><BR>";
}

if (isset($_POST["submit"])) {
    if ($_POST['checkbox']) {
        for ($i = 0; $i < count($_POST['checkbox']); $i++) {
            $temp = implode(',', array_fill(0, count($_POST['checkbox']), '?'));
            $query = "UPDATE student_subject SET semester = semester + 1 WHERE student_id IN ($temp)";
            $types = str_repeat('s', count($_POST['checkbox']));
            $prepare = $con->prepare($query);
            $prepare->bind_param($types, ...$_POST['checkbox']);
            $prepare->execute();
            if ($prepare->execute()) {
                echo 'The student\'s records have been updated.';
            } else {
                echo 'There was a problem updating the student\'s records. <br>';
            }
            $prepare->close();
        }
    }
}

$sql = "SELECT * FROM student_subject WHERE subject_name = 'Physics'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo 'No records found';
} else {
    echo '<form name="frmactive" method="post" action="">';
    echo '<table>';
    echo '<tr><td colspan="4"><strong>Update multiple rows in MySQL with checkboxes</strong></td></tr>';
    echo '<tr><td></td><td><strong>Roll Number</strong></td>';
    echo '<td><strong>Course</strong></td>';
    echo '<td><strong>Semester</strong></td>';
    echo '<td><strong>Year</strong></td></tr>';

    while ($rows = mysqli_fetch_array($result)) {
        echo '<tr><td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="' . $rows[0] . '"></td>';
        echo '<td>' . $rows[0] . '</td>';
        echo '<td>' . $rows[1] . '</td>';
        echo '<td>' . $rows[2] . '</td>';
        echo '<td>' . $rows[3] . '</td></tr>';
    }

    echo '<tr><td><input type="submit" name="submit" value="submit">';
    echo '</table></form>';
}
?>
<html>
<body>
</body>
</html>









