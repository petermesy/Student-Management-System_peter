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

// Function to retrieve student IDs and average marks
function getStudentAverages($conn) {
    // Query to retrieve student IDs and average marks
    $sql = "SELECT student_id,  average AS average FROM student_average GROUP BY student_id";
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

if(isset($_POST['submit'])) { 
    // Calculate ranks based on average marks
    $studentAverages = getStudentAverages($conn);
    arsort($studentAverages); // Sort in descending order

    // Assign ranks and insert data into 'student_rank' table
    $rank = 1;
    $prevAvg = null;
    $insertSql = "INSERT INTO student_rank (student_id, rank) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $insertSql);
    mysqli_stmt_bind_param($stmt, "si", $studentId, $rank);

    foreach ($studentAverages as $studentId => $averageMarks) {
        if ($averageMarks !== $prevAvg) {
            $prevAvg = $averageMarks;
            $rank++;
        }
        mysqli_stmt_execute($stmt);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
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
        <br><br><input type="submit" name="submit" value="Calculate Rank">
    </form>
</body>
</html>
