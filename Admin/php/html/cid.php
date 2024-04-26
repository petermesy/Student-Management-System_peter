<?php
// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';

// Establish a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Start session
session_start();

// Check if the instructor is logged in
if (isset($_SESSION['id'])) {
    $instructor_id = $_SESSION['id'];

    // Query to fetch the course assigned to the instructor
    $course_query = "SELECT subject_id FROM instructor_course_assignment WHERE instructor_id = $instructor_id";
    $course_result = mysqli_query($conn, $course_query);

    // Fetch the course assigned to the instructor
    if ($course_row = mysqli_fetch_assoc($course_result)) {
        $course_id = $course_row['subject_id'];

        // Query to fetch students assigned to the course and the instructor
        $student_query = "SELECT s.student_id, s.Full_name
                          FROM student s
                          INNER JOIN student_course_assignment sca ON s.student_id = sca.student_id
                          WHERE sca.subject_id = $course_id AND s.student_id IN (
                              SELECT student_id FROM instructor_student_assignment WHERE instructor_id = $instructor_id
                          )";
        $student_result = mysqli_query($conn, $student_query);

        // Check if any students are assigned to the course and the instructor
        if (mysqli_num_rows($student_result) > 0) {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Instructor Dashboard</title>
                <style>
                    /* Add your CSS styles here */
                </style>
            </head>
            <body>
                <header>
                    <h1>Instructor Dashboard</h1>
                    <a href="/mysm/Home Page/index.html" class="home">Back to Home</a>
                </header>

                <div class="container">
                    <h2>Add Student Marks</h2>
                    <form method="post" action="process_marks.php">
                        <label for="student_id">Select Student:</label>
                        <select name="student_id" id="student_id">
                            <?php while ($row = mysqli_fetch_assoc($student_result)) : ?>
                                <option value="<?= $row['student_id'] ?>"><?= $row['Full_name'] ?></option>
                            <?php endwhile; ?>
                        </select><br><br>
                        <label for="subject_id">Subject ID:</label>
                        <input type="text" name="subject_id" id="subject_id"><br><br>
                        <label for="student_mark">Student Mark:</label>
                        <input type="number" name="student_mark" id="student_mark"><br><br>
                        <button type="submit" name="submit_student_mark">Add Student Mark</button>
                    </form>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "No students assigned to this course or instructor.";
        }
    } else {
        echo "No course assigned to this instructor.";
    }
} else {
    // Redirect to login page if not logged in
    header('location: instructorlogin.php');
    exit(); // Stop execution after redirection
}
?>
