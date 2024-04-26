<?php
// Database connection parameters
$servername = "localhost";
$username = "username";
$password = "password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Instructor ID
$instructor_id = 1; // You need to replace this with the actual instructor's ID

// SQL query to fetch students assigned to the instructor
/* $sql = "SELECT students.* 
        FROM students 
        INNER JOIN instructor_student ON students.student_id = instructor_student.student_id 
        WHERE instructor_student.instructor_id = $instructor_id"; */

$query = "SELECT s.Full_name, 
          FROM student s
          JOIN instructor_student sa ON s.id = sa.id
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Student ID: " . $row["student_id"]. " - Name: " . $row["student_name"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>