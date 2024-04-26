<?php
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die("Database connection failed");
} else {
    session_start();
    // Student dashboard (studentresult.php)
    if (isset($_SESSION['student_id'])) {
        $student_id = $_SESSION['student_id'];

        // Function to calculate average grade for a student
        function calculateAverageGrade($student_id, $conn) {
            // Fetch grades for the given student
            $query = "SELECT student_mark FROM student_marklist WHERE student_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $student_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $total_grades = 0;
            $num_grades = 0;

            while ($row = $result->fetch_assoc()) {
                $total_grades += $row['student_mark'];
                $num_grades++;
            }

            // Calculate average grade (avoid division by zero)
            $average_grade = ($num_grades > 0) ? $total_grades / $num_grades : 0;

            return $average_grade;
        }

        if (isset($_POST['average'])) {
            // $student_id = $_POST['studentId'];
            $average_grade = calculateAverageGrade($student_id, $conn);
            // echo "Student ID $student_id average grade: $average_grade";

            // Insert the average marks into another table (e.g., 'student_average')
            $insertSql = "INSERT INTO student_average (student_id, average) VALUES (?, ?) ON DUPLICATE KEY UPDATE average = ?";
            $stmt = $conn->prepare($insertSql);
            $stmt->bind_param("idi", $student_id, $average_grade, $average_grade);
            $stmt->execute();
        }

        $grade_query = "SELECT * FROM gradee";
        $grade_result = mysqli_query($conn, $grade_query);

        $semester_query = "SELECT * FROM semester";
        $semester_result = mysqli_query($conn, $semester_query);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* Your CSS styles here */
    </style>
</head>
<body>
<header>
    <h1>School logo</h1>
    <a href="/mysm/Home Page/index.html" class="home">Back home</a>
</header>

<div class="dashbord">
    <div class="frame">
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
            <button type="submit" name="Show_student_marks">Show Student Marks</button>
        </form>

        <?php if (isset($_POST['Show_student_marks'])) :{
             if (!empty($_POST['student_ids'])) {
                $student_ids = $_POST['student_ids'];
                $course_id = $_POST['course_id'];
                $Grade = $_POST['grade'];
                $Semester = $_POST['semester'];
        
            ?>
            <!-- Your PHP code to display student marks here -->
            <div>
                <h1>Welcome Your Grade Point is:</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Grade Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT sm.subject_id, sm.student_mark, sub.Subject_name 
                                      FROM student_marklist AS sm 
                                      INNER JOIN subject AS sub ON sm.subject_id = sub.subject_id 
                                      WHERE sm.student_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $student_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= $row['Subject_name'] ?></td>
                                    <td><?= $row['student_mark'] ?></td>
                                </tr>
                            <?php endwhile; }?>
                    </tbody>
                </table>
                <form method="post">
                    <button type="submit" name="average">Calculate Average</button>
                </form>
            </div>
        <?php } endif; ?>
    </div>
</div>

<button><a href="enrollsemester2.php">Register for course</a></button>
<button><a href="changepassword.php">Change Password</a></button>
<button><a href="logout.php">Logout</a></button>
</body>
</html>
