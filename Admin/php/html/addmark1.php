<?php
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

if (isset($_POST['submit_student_mark'])) {
    $conn = mysqli_connect($hostname, $username, $password, $db_name);
    if (!$conn) {
        die("Database connection failed");
    } else {
        echo 'connected';
        $student_id = $_POST['studentId'];
        $subject_id = $_POST['SubjectId'];
        $student_mark = $_POST['studentMark'];
        $query = "INSERT INTO student_marklist (student_id, subject_id, student_mark) VALUES ('$student_id','$subject_id','$student_mark')";

        mysqli_query($conn, $query);

        // Check if the query was successful
        if (mysqli_affected_rows($conn) > 0) {
            echo " student mark point added successfully!";
        } else {
            echo "Error in adding student mark point: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post">
    <br><br><input type="number" placeholder="Add Student Id" name="studentId" required><br><br>
    <input type="number" placeholder="Add Subject Id" name="SubjectId" required><br><br>
    <input type="number" placeholder="Add student Mark" name="studentMark" required><br><br>
    <button type="submit" name="submit_student_mark">Add Student Mark</button>
</form>

<?php
// Fetch students and their courses
$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die("Database connection failed");
}

$query = "SELECT s.First_name, c.Subject_name, sm.student_mark
          FROM student s
          INNER JOIN student_marklist sm ON s.student_id = sm.student_id
          INNER JOIN subject c ON sm.subject_id = c.subject_id";
$result = mysqli_query($conn, $query);
?>

<h1>Students and Their marks</h1>
<ul>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <li><?= $row['First_name'] ?>'s <?= $row['Subject_name'] ?> Mark is <?= $row['student_mark'] ?></li>
    <?php endwhile; ?>
</ul>
</body>
</html>





<?php


// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
if (isset($_POST['add_course'])) {

$student_id = $_POST['studentId'];
// Function to calculate average grade for a student
function calculateAverageGrade($student_id) {
    global $conn;

    // Fetch grades for the given student
    $query = "SELECT student_mark FROM student_marklist WHERE student_id = '$student_id'";
    $result = mysqli_query($conn, $query);

    $total_grades = 0;
    $num_grades = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $total_grades += $row['grade'];
        $num_grades++;
    }

    // Calculate average grade (avoid division by zero)
    $average_grade = ($num_grades > 0) ? $total_grades / $num_grades : 0;

    return $average_grade;
}

// Example usage:
$student_id = 1; // Replace with the actual student ID
$average_grade = calculateAverageGrade($student_id);

echo "Student ID $student_id average grade: $average_grade"; // Display the result
}


?>

<h1>check average maark</h1>
<form method="post">
            <input type="number" name="studentId" placeholder="Enter student id">     
    
            <button type="submit" name="average">Average</button>
            
</form>