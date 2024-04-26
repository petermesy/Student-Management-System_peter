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
    die('Database connection failed: ' . mysqli_connect_error());
}

session_start();

// Check if the instructor is logged in and retrieve their ID
if (isset($_SESSION['id'])) {
    $instructor_id = $_SESSION['id'];
} else {
    // Redirect to login page or handle unauthorized access
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

?>
<!DOCTYPE html>
<html lang="en">
    <style>
        .table1 td{
            border: 1px solid gray;
        }
        .table1 th{
            border: 1px solid gray;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Student Marks</title>
</head>
<body>
    <h2>Select Student To See Marks</h2>
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

        <label for="student_ids[]">Select Students:</label><br>
        <?php while ($student = mysqli_fetch_assoc($assigned_students_result)) : ?>
            <input type="checkbox" name="student_ids[]" value="<?php echo $student['student_id']; ?>">
            <label><?php echo $student['Full_name']; ?></label><br>
        <?php endwhile; ?>
        <br>

        <input type="submit" name="Show_student_marks" value="Show Student Marks">
    </form>
</body>
</html>

<?php

// Check if the form is submitted for showing student marks
if (isset($_POST['Show_student_marks'])) {
    if (!empty($_POST['student_ids'])) {
        $student_ids = $_POST['student_ids'];
        $course_id = $_POST['course_id'];
        $Grade = $_POST['grade'];
        $Semester = $_POST['semester'];

               // Fetching student names, marks, subject names, semester names, and grade names
               $query = "SELECT s.Full_name, m.mark, sub.subject_name, sem.semester_name, g.GRADE_NAME
               FROM student s
               INNER JOIN Marks m ON s.student_id = m.student_id
               INNER JOIN subject sub ON m.subject_id = sub.subject_id
               INNER JOIN semester sem ON m.semester_id = sem.semester_id
               INNER JOIN gradee g ON m.grade_idd = g.grade_idd
               WHERE m.subject_id = ? AND m.semester_id = ? AND m.grade_idd = ?
               ORDER BY s.Full_name";
     $stmt = mysqli_prepare($conn, $query);
     mysqli_stmt_bind_param($stmt, 'iii', $course_id, $Semester, $Grade);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);

     if (!$result) {
         die('Error in query: ' . mysqli_error($conn));
     }

     // Outputting student names, marks, subject names, semester names, and grade names
     echo "<h2>Student Marks</h2>";
     ?>
     <h2>Student Marks</h2>
     <table class="table1">
     <tr>
        <th>Student Name</th>
        <th>Subject Name</th>
       
        <th>Grade</th>
         <th>Quarter</th>
        <th>Marks</th>
     </tr>
        <tr>
       <?php while ($row = mysqli_fetch_assoc($result)) {?>
        <td><?php  echo $row['Full_name'];?></td>
        <td><?php  echo $row['subject_name'];?></td>
        <td><?php  echo $row['GRADE_NAME'];?></td> 
        <td><?php  echo $row['semester_name'];?></td>
        <td><?php  echo $row['mark'];?></td>
        </tr>
       <?php }?>
     </table>
       
     <?php
       
     } else {
     echo "Please select at least one student.";
 }}

mysqli_close($conn);

?>
