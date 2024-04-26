<?php
// Database connection details
// Define database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';


// Create connection
$conn = new mysqli($hostname, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve student IDs for grade 9
$sql = "SELECT student_id, First_name FROM student WHERE grade = 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output student IDs
    while ($row = $result->fetch_assoc()) {
        echo "Student ID: " . $row["student_id"] ."student name ". $row["First_name"] . "<br>";
    }
} else {
    echo "No students found in grade 9.";
}

// Close connection
$conn->close();
?>
