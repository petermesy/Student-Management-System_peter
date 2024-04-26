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
if (isset($_SESSION['id'])) {
    $instructor_id = $_SESSION['id'];
} else {
    // Redirect to login page or handle unauthorized access
}

$queryy = "SELECT Full_name FROM instructor WHERE id=?";
$stmt = mysqli_prepare($conn, $queryy);
mysqli_stmt_bind_param($stmt, 'i', $instructor_id);
mysqli_stmt_execute($stmt);
$queryy_result = mysqli_stmt_get_result($stmt);

// Check if the form is submitted for adding student marks
if (isset($_POST['add_marks'])) {
    $course_id = $_POST['course_id'];
    $Grade = $_POST['grade'];
    $Semester = $_POST['semester'];
    $student_marks = $_POST['student_marks']; // array of student marks with student ID as key

    // Prepare and execute queries
    $insert_query = "INSERT INTO Marks (student_id, subject_id, grade_idd, semester_id, mark ) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE mark = ?";
    $stmt = mysqli_prepare($conn, $insert_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'iiiiii', $student_id, $course_id, $Grade, $Semester, $marks, $marks);

        // Loop through the submitted student marks
        foreach ($student_marks as $student_id => $marks) {
            // Execute the prepared statement
            mysqli_stmt_execute($stmt);
        }

        echo '<p class="notification">Student marks added successfully!</p>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch list of courses assigned to the instructor
$courses_query = "SELECT * FROM subject WHERE subject_id IN (SELECT subject_id FROM instructor_course_assignment WHERE id = ?)";
$stmt = mysqli_prepare($conn, $courses_query);
mysqli_stmt_bind_param($stmt, 'i', $instructor_id);
mysqli_stmt_execute($stmt);
$courses_result = mysqli_stmt_get_result($stmt);

// Fetch list of assigned students
$assigned_students_query = "SELECT * FROM student  WHERE student_id IN (SELECT student_id FROM instructor_student WHERE id = ?)";
$stmt = mysqli_prepare($conn, $assigned_students_query);
mysqli_stmt_bind_param($stmt, 'i', $instructor_id);
mysqli_stmt_execute($stmt);
$assigned_students_result = mysqli_stmt_get_result($stmt);

$grade_query = "SELECT * FROM gradee";
$grade_result = mysqli_query($conn, $grade_query);

$semester_query = "SELECT * FROM semester";
$semester_result = mysqli_query($conn, $semester_query);

// Close the database connection




// Fetch data from the Marks table
// $selectQuery = "SELECT * FROM Marks WHERE  student_id = $student_id AND subject_id = $course_id AND semester_id = $Semester AND grade_idd =$Grade";
// $result = mysqli_query($conn, $selectQuery);

// if (mysqli_num_rows($result) > 0) {
//     echo "<table>";
//     echo "<tr><th>Student ID</th><th>Subject ID</th><th>Semester ID</th><th>Marks</th></tr>";

//     while ($row = mysqli_fetch_assoc($result)) {
//         echo "<tr>";
//         echo "<td>" . $row['student_id'] . "</td>";
//         echo "<td>" . $row['subject_id'] . "</td>";
//         echo "<td>" . $row['semester_id'] . "</td>";
//         echo "<td>" . $row['mark'] . "</td>";
//         echo "</tr>";
//     }

//     echo "</table>";
// } else {
//     echo "No records found.";
// }

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
    if (mysqli_num_rows($queryy_result) > 0) {
        while ($row = mysqli_fetch_assoc($queryy_result)) {
            echo "Welcome " . $row["Full_name"];
        }
    }
    ?>
    <h2>Add Student Marks</h2>
    <form method="post">
        <label for="grade">Select Grade:</label>
        <select name="grade" id="grade">
            <?php while ($grade = mysqli_fetch_assoc($grade_result)) : ?>
                <option value="<?php echo $grade['grade_idd']; ?>"><?php echo $grade['GRADE_NAME']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="semester">Select Quarter:</label>
        <select name="semester" id="semester">
            <?php while ($semester = mysqli_fetch_assoc($semester_result)) : ?>
                <option value="<?php echo $semester['semester_id']; ?>"><?php echo $semester['semester_name']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="course_id">Select Course:</label>
        <select name="course_id" id="course_id">
            <?php while ($course = mysqli_fetch_assoc($courses_result)) : ?>
                <option value="<?php echo $course['subject_id']; ?>"><?php echo htmlspecialchars($course['Subject_name']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="student_marks[]">Student Marks:</label><br>
        <!-- Assuming you have a list of students assigned to this instructor for the selected course -->
        <?php while ($student = mysqli_fetch_assoc($assigned_students_result)) : ?>
            <input type="number" name="student_marks[<?php echo $student['student_id']; ?>]" placeholder="Marks for <?php echo htmlspecialchars($student['Full_name']); ?>"><br><br>
        <?php endwhile; ?>
        <br>

        <input type="submit" name="add_marks" value="Add Student Marks">
        <!-- Add a button to navigate back or log out -->
        <!-- <button class="backk"><a href="logout.php" class="back">Logout</a></button> -->
    </form>

    <button><a href="changeinstpassword.php">Change Password</a></button>
    <button><a href="fetchstudentmark.php"> Check student marks</a></button>
 <?php
// $conn = mysqli_connect($hostname, $username, $password, $db_name);
// if (!$conn) {
//     die('Database connection failed: ' . mysqli_connect_error());
// }


?>

</body>
</html>
