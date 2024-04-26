<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link rel="stylesheet" href="/mysm/Admin/php/html/header.css">

</head>
<body>
<header>
        <h1>School logo</h1>
        <a href="/mysm/Home Page/index.html" class="home">Back home</a>
    </header>

 <div class="dashbord">
   <!--  <iframe src="dash.html" style="height:800px;width:400px" title="Iframe Example"></iframe> -->
 <div class="frame">
 <h3><a href="assignstudentInstructor.php" class="task">Assign Student to Instructor</a></h3>
    <h3><a href="addInstructor.php" class="task">Add instructor</a></h3>
    <h3><a href="viewinstructor.php" class="task">View instructors</a></h3>
    <h3><a href="updateinstructor.php" class="task">Update instructor information</a></h3>
    <h3><a href="viewstudentsassignedtoinstructor.php" class="task">view Students Assigned to Instructor </a></h3>
    <h3><a href="viewcourseassignedtoinstructor.php" class="task">view courses Assigned to Instructor </a></h3>
    <h3><a href="addStudent.php" class="task">Add Student</a></h3>
    <h3><a href="viewstudent.php" class="task">View Students</a></h3>
    <h3><a href="updatestudent.php" class="task">Update Student information</a></h3>
    <h3><a href="assignstudentInstructor.php" class="task">Assign Student to instrructor</a></h3>
    <h3><a href="addSubject.php" class="task">Add Course</a></h3>
    <h3><a href="updatecourse.php" class="task">Update Course</a></h3>
    <h3><a href="viewcourse.php" class="task">View Course</a></h3>
    <h3><a href="assigncourse_inst1.php" class="task">Assign Course to instructor</a></h3>
    <h3><a href="viewstudentcourseenroll.php" class="task">view student Course Enrollemnt</a></h3>

    <h3><a href="average.php" class="task">average </a></h3>
    <h3><a href="viewaverage.php" class="task"> View average </a></h3>
    <h3><a href="viewAverage.php" class="task">View student average</a></h3>
    <h3><a href="rank1.php" class="task">Rank </a></h3>
    <h3><a href="viewRank.php" class="task">View student rank</a></h3>
    <h3><a href="createpost.php" class="task">Post News</a></h3>
    <h3><a href="updatepost.php" class="task">Update News</a></h3>
    <h3><a href="deletenews.php" class="task">Delete News</a></h3>
    
    <h3><a href="adminchangepassword.php" class="task">Change Password</a></h3></div>




<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';
/* duplicate array primary key error */
// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Function to check if a record already exists in the table
function recordExists($conn, $student_id, $subject_id, $semester_id, $grade_idd, $section_id) {
    $query = "SELECT * FROM student_subject WHERE student_id = '$student_id' AND subject_id = '$subject_id' AND semester_id = '$semester_id' AND grade_idd = '$grade_idd' AND section_id = '$section_id'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

// Function to add a new semester
function addNewSemester($conn, $semester_name) {
    // Generate a unique semester ID
    $semester_id = generateUniqueSemesterID($conn);

    // Insert the semester into the database
    $query = "INSERT INTO semester (semester_id, semester_name) VALUES ('$semester_id', '$semester_name')";
    if (mysqli_query($conn, $query)) {
        return $semester_id; // Return the generated semester ID
    } else {
        die("Error adding new semester: " . mysqli_error($conn));
    }
}

// Function to generate a unique semester ID
function generateUniqueSemesterID($conn) {
    $semester_id = uniqid(); // Generate a unique ID
    return $semester_id;
}

// Function to add a new grade
function addNewGrade($conn, $grade_name) {
    $query = "INSERT INTO gradee (grade_idd) VALUES ('$grade_name')";
    if (mysqli_query($conn, $query)) {
        return mysqli_insert_id($conn); // Return the ID of the newly inserted grade
    } else {
        die("Error adding new grade: " . mysqli_error($conn));
    }
}

// Function to add a new section
function addNewSection($conn, $section_name) {
    $query = "INSERT INTO section (section_id) VALUES ('$section_name')";
    if (mysqli_query($conn, $query)) {
        return mysqli_insert_id($conn); // Return the ID of the newly inserted section
    } else {
        die("Error adding new section: " . mysqli_error($conn));
    }
}

// Start session
session_start();

// Check if the instructor is logged in and retrieve their ID
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];

    // Check if the form is submitted
    if (isset($_POST['Register'])) {
        $subject_ids = $_POST['subject_ids'];
        $semester_name = $_POST['semester'];
        $grade_name = $_POST['grade'];
        $section_name = $_POST['section'];

        // Initialize variables
        $semester_id = 0;
        $grade_idd = 0;
        $section_id = 0;

        // Check if the record already exists
        if (recordExists($conn, $student_id, $subject_ids, $semester_id, $grade_idd, $section_id)) {
            echo "Record already exists in the table.";
        } else {
            // Add new semester and get its ID
            $semester_id = addNewSemester($conn, $semester_name);

            // Add new grade and get its ID
            $grade_idd = addNewGrade($conn, $grade_name);

            // Add new section and get its ID
            $section_id = addNewSection($conn, $section_name);

            // Insert the record into the table
            foreach ($subject_ids as $subject_id) {
                $query = "INSERT INTO student_subject (student_id, subject_id, semester_id, grade_idd, section_id) VALUES ('$student_id', '$subject_id', '$semester_id', '$grade_idd', '$section_id')";
                mysqli_query($conn, $query);
            }

            // Check if the query was successful
            if (mysqli_affected_rows($conn) > 0) {
                echo "Registration successful!";
            } else {
                echo "Error in Registration: " . mysqli_error($conn);
            }
        }
    }

    // Fetch data for dropdowns
    $grade_query = "SELECT * FROM gradee";
    $grade_result = mysqli_query($conn, $grade_query);

    $semester_query = "SELECT * FROM semester";
    $semester_result = mysqli_query($conn, $semester_query);
    
    $section_query = "SELECT * FROM section";
    $section_result = mysqli_query($conn, $section_query);

    $subject_query = "SELECT * FROM subject";
    $subject_result = mysqli_query($conn, $subject_query);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Subjects to Register</title>
</head>
<body>
    <h1>Select Subjects to Register</h1>
    <form method="post" class="inputt">
        <label for="subject_ids[]">Select Subjects:</label><br>
        <?php while ($subject = mysqli_fetch_assoc($subject_result)) : ?>
            <input type="checkbox" name="subject_ids[]" value="<?php echo $subject['subject_id']; ?>">
            <label><?php echo $subject['Subject_name']; ?></label><br>
        <?php endwhile; ?>
        <br>

        <h2 class="ass">Select Grade</h2>
        <label for="grade">Select Grade:</label>
        <select name="grade" id="grade">
            <?php while ($grade = mysqli_fetch_assoc($grade_result)) : ?>
                <option value="<?php echo $grade['grade_idd']; ?>"><?php echo $grade['GRADE_NAME']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <h2 class="ass">Select Section</h2>
        <label for="section">Select Section:</label>
        <select name="section" id="section">
            <?php while ($section = mysqli_fetch_assoc($section_result)) : ?>
                <option value="<?php echo $section['section_id']; ?>"><?php echo $section['section_name']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <h2 class="ass">Select Semester</h2>
        <label for="semester">Select Semester:</label>
        <select name="semester" id="semester">
            <?php while ($semester = mysqli_fetch_assoc($semester_result)) : ?>
                <option value="<?php echo $semester['semester_id']; ?>"><?php echo $semester['semester_name']; ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <input type="submit" name="Register" value="Register">
    </form>
</body>
</html>
