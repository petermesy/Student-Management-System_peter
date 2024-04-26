<?php
// Database connection details
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
$sql = "SELECT student_id FROM student WHERE grade = 5";
$result = $conn->query($sql);

 if ($result->num_rows > 0) {
   // Create or truncate the 'grade9' table
    $createTableSQL = "CREATE TABLE IF NOT EXISTS grade10 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(20) NOT NULL
    )";
    if ($conn->query($createTableSQL) === TRUE) {
        echo "Table 'grade9' created successfully.<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Insert student IDs into 'grade9' table
    while ($row = $result->fetch_assoc()) {
        $student_id = $row["student_id"];
        $insertSQL = "INSERT INTO grade10 (student_id) VALUES ('$student_id')";
        if ($conn->query($insertSQL) === TRUE) {
            echo "Student ID '$student_id' inserted into 'grade10' table.<br>";
        } else {
            echo "Error inserting student ID: " . $conn->error;
        }
    }
} else {
    echo "No students found in grade 10.";
}

// Close connection
$conn->close();
?>
