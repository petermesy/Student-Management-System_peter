<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/mysm/Admin/css/homestudent.css">
</head>
<body>
    <header>
        <h1>School logo</h1>
        <a href="/mysm/Home Page/index.html" class="home">Back home</a>
    </header>

    <div class="page">
        <div class="sidee"> 
            <button class="toggle" id="toggle">SMS</button>
            <nav class="nav" id="nav">
                <a class="tog" href="exam1.php">Take exam</a><br>
                <a class="tog" href="enrollsemester2.php">Register for course</a><br>
                <a class="tog" href="changepassword.php">change Password</a><br>
                <a class="tog" href="logout.php">Logout</a><br>
            </nav>
            <script>
                var toggle = document.getElementById("toggle");
                var nav = document.getElementById("nav");
                toggle.addEventListener("click", function() {
                    nav.classList.toggle("show");
                });
            </script>
        </div>   

        <div class="main">
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

            // Check if the student is logged in and retrieve their ID
            if (isset($_SESSION['student_id'])) {
                $student_id = $_SESSION['student_id'];
            } else {
                // Redirect to login page or handle unauthorized access
            }

            $semester_query = "SELECT * FROM semester";
            $semester_result = mysqli_query($conn, $semester_query);

            $grade_query = "SELECT * FROM gradee";
            $grade_result = mysqli_query($conn, $grade_query);

            $sql = "SELECT Full_name FROM student WHERE student_id='$student_id'";
            $resultt = mysqli_query($conn, $sql);

            if (mysqli_num_rows($resultt) > 0) {
                while ($row = mysqli_fetch_assoc($resultt)) {
                    ?>
                    <br><br><h1 class="wellcome">Welcome Dear <?php echo $row["Full_name"]; ?></h1>
                    <?php
                }
            }
            ?>

            <div class="wellcome">
                <br><br><h2>Select Grade and Semester to See Your Marks</h2><br><br>
                <form method="post">
                    <label for="semester">Select Semester:</label>
                    <select name="semester" id="semester">
                        <?php while ($semester = mysqli_fetch_assoc($semester_result)) : ?>
                            <option value="<?php echo $semester['semester_id']; ?>"><?php echo $semester['semester_name']; ?></option>
                        <?php endwhile; ?>
                    </select><br><br><br>

                    <label for="grade">Select Grade:</label>
                    <select name="grade" id="grade">
                        <?php while ($grade = mysqli_fetch_assoc($grade_result)) : ?>
                            <option value="<?php echo $grade['grade_idd']; ?>"><?php echo $grade['GRADE_NAME']; ?></option>
                        <?php endwhile; ?>
                    </select><br><br><br>

                    <input type="submit" name="view_marks" value="View Marks">
                </form>
            </div>

            <?php
            // Check if the form is submitted for viewing student marks
            if (isset($_POST['view_marks'])) {
                $selected_semester = $_POST['semester'];
                $selected_grade = $_POST['grade'];

                // Fetch marks for the selected semester and grade
                $marks_query = "SELECT m.mark, sub.subject_name
                                FROM marks m
                                INNER JOIN subject sub ON m.subject_id = sub.subject_id
                                WHERE m.student_id = ? AND m.semester_id = ? AND m.grade_idd = ?";
                $stmt_marks = mysqli_prepare($conn, $marks_query);
                mysqli_stmt_bind_param($stmt_marks, 'iii', $student_id, $selected_semester, $selected_grade);
                mysqli_stmt_execute($stmt_marks);
                $marks_result = mysqli_stmt_get_result($stmt_marks);

                if (isset($marks_result) && mysqli_num_rows($marks_result) > 0) {
                    ?>
                    <h3>Student Marks</h3>
                    <table>
                        <tr>
                            <th>Subject</th>
                            <th>Mark</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($marks_result)) : ?>
                            <tr>
                                <td><?php echo $row['subject_name']; ?></td>
                                <td><?php echo $row['mark']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                    <!-- Form for calculating average -->
                    <form method="post">
                        <button type="submit" name="average">Calculate Average</button>
                        <input type="hidden" name="selected_semester" value="<?php echo $selected_semester; ?>">
                        <input type="hidden" name="selected_grade" value="<?php echo $selected_grade; ?>">
                    </form>
                    <?php
                }
            }

            // Check if the average calculation form is submitted
            if (isset($_POST['average'])) {
                $selected_semester = $_POST['selected_semester'];
                $selected_grade = $_POST['selected_grade'];

                // Call the function to calculate the average grade
                $average_grade = calculateAverageGrade($student_id, $conn, $selected_semester, $selected_grade);
                // Insert the average marks into another table (e.g., 'student_average')
                $insertSql = "INSERT INTO student_average (student_id, average) VALUES (?, ?) ON DUPLICATE KEY UPDATE average = ?";
                $stmt = $conn->prepare($insertSql);
                $stmt->bind_param("idi", $student_id, $average_grade, $average_grade);
                $stmt->execute();

                // Display the calculated average grade
                $queryy = "SELECT average FROM student_average WHERE student_id = '$student_id'";
                $que_result = mysqli_query($conn, $queryy);
                if (mysqli_num_rows($que_result) > 0) {
                    $subject_row = mysqli_fetch_assoc($que_result);
                    ?>
                    <p class="average">Average = <?= $subject_row['average'] ?></p>
                    <?php
                }
            }

            // Function to calculate average grade for a student
            function calculateAverageGrade($student_id, $conn, $selected_semester, $selected_grade) {
                // Fetch grades for the given student
                $query = "SELECT mark FROM marks WHERE student_id = ? AND semester_id = ? AND grade_idd = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("iii", $student_id, $selected_semester, $selected_grade);
                $stmt->execute();
                $result = $stmt->get_result();

                $total_grades = 0;
                $num_grades = 0;

                while ($row = $result->fetch_assoc()) {
                    $total_grades += $row['mark'];
                    $num_grades++;
                }

                // Calculate average grade (avoid division by zero)
                $average_grade = ($num_grades > 0) ? $total_grades / $num_grades : 0;

                return $average_grade;
            }
            ?>

        </div>
    </div>

    <?php
    mysqli_close($conn);
    ?>
</body>
</html>
