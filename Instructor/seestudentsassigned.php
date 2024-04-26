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
} else {
    $id = '1'; // Assuming you have the instructor ID

    // Fetch students assigned to the instructor
    $query = "SELECT student_id FROM instructor_student WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $student_id = $row["student_id"];

            // Fetch student name based on student_id
            $student_query = "SELECT Full_name FROM student WHERE student_id = '$student_id'";
            $student_result = mysqli_query($conn, $student_query);

            if (mysqli_num_rows($student_result) > 0) {
                $student_row = mysqli_fetch_assoc($student_result);
                $student_name = $student_row["Full_name"];

                // Output student name
                echo "<p>$student_name</p>";
            }
        }
    } else {
        echo "No students assigned to this instructor.";
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
