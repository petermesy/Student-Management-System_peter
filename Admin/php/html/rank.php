<?php
/* // Define database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
else{
    echo 'connected';
}

// Assuming you have already established a database connection

// Function to retrieve student IDs and average marks
function getStudentAverages() {
    global $conn; // Your database connection object

    // Query to retrieve student IDs and average marks
    $sql = "SELECT student_id, AVG(subject1 + subject2 + subject3 + subject4 + subject5 + subject6) AS average FROM student_average GROUP BY student_id";
    $result = $conn->query($sql);

    // Store the results in an associative array
    $averages = [];
    while ($row = $result->fetch_assoc()) {
        $averages[$row['student_id']] = $row['average'];
    }

    return $averages;
}

// Calculate ranks based on average marks
$studentAverages = getStudentAverages();
arsort($studentAverages); // Sort in descending order

// Assign ranks and insert data into 'student_rank' table
$rank = 1;
foreach ($studentAverages as $studentId => $averageMarks) {
    $insertSql = "INSERT INTO student_rank (student_id, rank) VALUES (?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ii", $studentId, $rank);
    $stmt->execute();
    $rank++;
}

// Close the database connection
$conn->close(); */
?>
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
else {
    echo 'Connected';


// Function to retrieve student IDs and average marks
function getStudentAverages($conn) {
    // Query to retrieve student IDs and average marks
    $sql = "SELECT student_id, average AS average FROM student_average GROUP BY student_id";
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if (!$result) {
        die('Error in query: ' . mysqli_error($conn));
    }

    // Store the results in an associative array
    $averages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $averages[$row['student_id']] = $row['average'];
    }

    // Free result set
    mysqli_free_result($result);

    return $averages;
}

// Calculate ranks based on average marks
$studentAverages = getStudentAverages($conn);
arsort($studentAverages); // Sort in descending order

// Assign ranks and insert data into 'student_rank' table
$rank = 1;
$insertSql = "INSERT INTO student_rank (student_id, rank) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $insertSql);
mysqli_stmt_bind_param($stmt, "ii", $studentId, $rank);

foreach ($studentAverages as $studentId => $averageMarks) {
    mysqli_stmt_execute($stmt);
    $rank++;
}

// Close the prepared statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);}
?>







    
   
    
