<?php

// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$session_name = $_POST['session_name']; // Assuming you have a form field for session name
$start_date = $_POST['start_date']; // Assuming you have a form field for session start date
$end_date = $_POST['end_date']; // Assuming you have a form field for session end date

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve data from form
    $session_name = mysqli_real_escape_string($conn, $_POST['session_name']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    
    // Begin transaction
    mysqli_autocommit($conn, false);

    // Insert new semester record into the database
    $insert_semester_query = "INSERT INTO semesters (session_name, start_date, end_date) VALUES ('$session_name', '$start_date', '$end_date')";
    
    if (mysqli_query($conn, $insert_semester_query)) {
        $semester_id = mysqli_insert_id($conn);

        // Copy courses from previous semester
        $copy_courses_query = "INSERT INTO courses (semester_id, course_name, instructor_id) SELECT '$semester_id', course_name, instructor_id FROM courses WHERE semester_id = (SELECT MAX(semester_id) FROM semesters)";
        mysqli_query($conn, $copy_courses_query);

        // Copy students from previous semester
        $copy_students_query = "INSERT INTO students (student_name) SELECT student_name FROM students WHERE semester_id = (SELECT MAX(semester_id) FROM semesters)";
        mysqli_query($conn, $copy_students_query);

        // Copy enrollment information from previous semester
        $copy_enrollment_query = "INSERT INTO enrollments (student_id, course_id) SELECT student_id, course_id FROM enrollments WHERE semester_id = (SELECT MAX(semester_id) FROM semesters)";
        mysqli_query($conn, $copy_enrollment_query);

        // Commit the transaction
        mysqli_commit($conn);

        echo "New semester added successfully!";
    } else {
        // Rollback if any error occurs
        mysqli_rollback($conn);
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Semester</title>
</head>
<body>
    <h2>Add New Semester</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="session_name">Session Name:</label>
        <input type="text" name="session_name" id="session_name" required><br><br>
        
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start">
        <label for="end_date">Start Date:</label>
        <input type="date" name="end_date" id="end">
