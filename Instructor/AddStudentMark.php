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

// Start session
session_start();

// Check if the instructor is logged in and retrieve their ID
if(isset($_SESSION['instructor_id'])) {
    $instructor_id = $_SESSION['instructor_id'];
} else {
    // Redirect to login page or handle unauthorized access




$sql1 = "SELECT Full_name FROM instructor WHERE id='$instructor_id'";

$resultt = mysqli_query($conn, $sql1);

// Check if the form is submitted for adding student marks
if (isset($_POST['add_marks'])) {
    $course_id = $_POST['course_id'];
    $student_marks = $_POST['student_marks']; // array of student marks with student ID as key






    // Loop through the submitted student marks
    foreach ($student_marks as $student_id => $marks) {
        // Check if the student is assigned to the instructor for the given course
        $check_query = "SELECT * FROM instructor_course_assignment WHERE id = '$instructor_id' AND course_id = '$course_id' AND student_id = '$student_id'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0) {
            // Student is assigned to the instructor for the given course, insert/update marks
            $sql = "INSERT INTO student_marks (student_id, course_id, marks) VALUES ('$student_id', '$course_id', '$marks')
                    ON DUPLICATE KEY UPDATE marks = '$marks'";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Student is not assigned to the instructor for the given course
            echo "You are not authorized to add marks for student with ID: $student_id for course with ID: $course_id";
        }
    }
    echo '<p class="notification">Student marks added successfully!</p>';
}

// Fetch list of courses assigned to the instructor
$courses_query = "SELECT * FROM courses WHERE id IN (SELECT subject_id FROM instructor_course_assignment WHERE id = '$instructor_id')";
$courses_result = mysqli_query($conn, $courses_query);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student Marks</title>
</head>
<body>
    <?php
if (mysqli_num_rows($resultt) > 0) {
            while ($row = mysqli_fetch_assoc($resultt)) {
?>
                <div>
                    <h1>Welcome <?php echo $row["Full_name"]; }}?> </h1>
           
    <h2>Add Student Marks</h2>
    <form method="post">
        <label for="course_id">Select Course:</label>
        <select name="course_id" id="course_id">
            <?php while ($course = mysqli_fetch_assoc($courses_result)) : ?>
                <option value="<?php echo $course['course_id']; ?>"><?php echo htmlspecialchars($course['course_name']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="student_marks[]">Student Marks:</label><br>
        <!-- Assuming you have a list of students assigned to this instructor for the selected course -->
        <?php
        // Fetch list of students assigned to the instructor for the selected course
        $students_query = "SELECT * FROM students WHERE student_id IN (SELECT student_id FROM instructor_course_assignment WHERE id = '$instructor_id' AND course_id = '$course_id')";
        $students_result = mysqli_query($conn, $students_query);

        while ($student = mysqli_fetch_assoc($students_result)) : ?>
            <input type="number" name="student_marks[<?php echo $student['student_id']; ?>]" placeholder="Marks for <?php echo htmlspecialchars($student['student_name']); ?>"><br>
        <?php endwhile; 
        }?>
        <br>

        <input type="submit" name="add_marks" value="Add Student Marks">
        <!-- Add a button to navigate back or log out -->
        <button class="backk"><a href="logout.php" class="back">Logout</a></button>
    </form>
</body>
</html>
