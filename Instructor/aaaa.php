<?php

// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'your_database_name';

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
}

// Check if the form is submitted for adding student marks
if (isset($_POST['add_marks'])) {
    $course_id = $_POST['course_id'];
    $student_marks = $_POST['student_marks']; // array of student marks with student ID as key

    // Loop through the submitted student marks
    foreach ($student_marks as $student_id => $marks) {
        // Check if the student is assigned to the instructor
        $check_student_assignment_query = "SELECT * FROM student_instructor_assignment WHERE instructor_id = '$instructor_id' AND student_id = '$student_id'";
        $check_student_assignment_result = mysqli_query($conn, $check_student_assignment_query);
        
        // Check if the course is assigned to the instructor
        $check_course_assignment_query = "SELECT * FROM course_instructor_assignment WHERE instructor_id = '$instructor_id' AND course_id = '$course_id'";
        $check_course_assignment_result = mysqli_query($conn, $check_course_assignment_query);
        
        if(mysqli_num_rows($check_student_assignment_result) > 0 && mysqli_num_rows($check_course_assignment_result) > 0) {
            // Student is assigned to the instructor and course is assigned to the instructor, insert/update marks
            $sql = "INSERT INTO student_marks (student_id, course_id, marks) VALUES ('$student_id', '$course_id', '$marks')
                    ON DUPLICATE KEY UPDATE marks = '$marks'";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Student or course is not assigned to the instructor
            echo "You are not authorized to add marks for student with ID: $student_id for course with ID: $course_id";
        }
    }
    echo '<p class="notification">Student marks added successfully!</p>';
}

// Fetch list of courses assigned to the instructor
$courses_query = "SELECT * FROM courses WHERE course_id IN (SELECT course_id FROM course_instructor_assignment WHERE instructor_id = '$instructor_id')";
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
        // Fetch list of students assigned to the instructor
        $students_query = "SELECT s.student_name, c.course_name, m.marks
                           FROM students s
                           INNER JOIN student_instructor_assignment sia ON s.student_id = sia.student_id
                           INNER JOIN course_instructor_assignment cia ON sia.instructor_id = cia.instructor_id
                           INNER JOIN courses c ON cia.course_id = c.course_id
                           LEFT JOIN student_marks m ON s.student_id = m.student_id AND c.course_id = m.course_id
                           WHERE sia.instructor_id = '$instructor_id' AND cia.course_id = '$course_id'";
        $students_result = mysqli_query($conn, $students_query);

        while ($student = mysqli_fetch_assoc($students_result)) : ?>
            <p><?php echo "Student: " . htmlspecialchars($student['student_name']) . ", Course: " . htmlspecialchars($student['course_name']) . ", Marks: " . ($student['marks'] ?? 'Not available'); ?></p>
        <?php endwhile; ?>
        <br>

        <input type="submit" name="add_marks" value="Add Student Marks">
        <!-- Add a button to navigate back or log out -->
        <button class="backk"><a href="logout.php" class="back">Logout</a></button>
    </form>
</body>
</html>
