<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <style>
    *{
    margin: 0;
    
}
header{
    background-color: #00205b!important; 
    color:whitesmoke;height: 100px;
}
header a{
position: absolute;
right: 100px;
    color: whitesmoke;
 font-size: 3rem;
 top: 10px;
}
header h1{
    padding-top: 30px;
}
.home{
    text-decoration: none;
}
.dashbord{
    display: grid;
    column-gap: 2rem;
    grid-template-columns: 1fr 1fr;
   
}
.dash{
    margin-top: 200px;
    display: grid;
    grid-template-columns: repeat(3,1fr);
    column-gap: 10rem;
    height: 15rem;
    
   

}
.class {
    border: black solid 0.1px;
    position: relative;
    right: 200px;
}

.frame{
    display: grid;
    width: 38%;
    height: 500px;
    margin-left: 4%;
    margin-top: 4%;
  /*   border: black solid 0.1px; */
    padding: 15px;
    border-radius: 20px;

}
.task{
    display: grid;
    border: solid black 0.1px;
    height: 4rem;
    text-decoration: none;
    color: black;
    margin: 10px;
    text-align: center;
    background-color: rgb(202, 201, 200);
    border-radius: 10px;
}
marquee{
    position: relative;
    left: 100px;
    font-size: 4rem;
    top: -2rem;
    
}
header h1{
    margin-left: 100px;
}
.inputt{
    width: 500px;
    height: 50px;
}
.input1{
    display: grid;
    
   
}
 .back{
    height: 50px;
    text-decoration: none;
    color: black;
 

}
.backk{  
    margin-left: 500px
}
.notification{
    position: absolute;
text-align: center;
top: 370px;
}</style>
</head>
<body>
<h1>School logo</h1>
        <a href="/mysm/Home Page/index.html" class="home">Back home</a>
    </header>

 <div class="dashbord">
   <!--  <iframe src="dash.html" style="height:800px;width:400px" title="Iframe Example"></iframe> -->
  <div class="frame">
  <h3><a href="addInstructor.php" class="task">Add instructor</a></h3>
    <h3><a href="viewinstructor.php" class="task">View instructors</a></h3>
    <h3><a href="updateinstructor.php" class="task">Update instructor information</a></h3>
    <h3><a href="addStudent.php" class="task">Add Student</a></h3>
    <h3><a href="viewstudent.php" class="task">View Students</a></h3>
    <h3><a href="updatestudent.php" class="task">Update Student information</a></h3>
    <h3><a href="addSubject.php" class="task">Add Course</a></h3>
    <h3><a href="updatecourse.php" class="task">Update Course</a></h3>
    <h3><a href="average.php" class="task">average </a></h3>
    <h3><a href="viewAverage.php" class="task">View student average</a></h3>
    <h3><a href="rank1.php" class="task">Rank </a></h3>
    <h3><a href="viewRank.php" class="task">View student rank</a></h3>
    <h3><a href="createpost.php" class="task">Post News</a></h3>
    <h3><a href="updatepost.php" class="task">Update News</a></h3>
    <h3><a href="deletenews.php" class="task">Delete News</a></h3></div>
   <div class="dash">

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

// Check if the form is submitted
if (isset($_POST['average'])) {
    $student_id = $_POST['studentId'];
    $average_grade = calculateAverageGrade($student_id, $conn);
    echo "Student ID $student_id average grade: $average_grade";

    // Insert the average marks into another table (e.g., 'student_average')
    $insertSql = "INSERT INTO student_average (student_id, average) VALUES (?, ?) ON DUPLICATE KEY UPDATE average = ?";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("idi", $student_id, $average_grade, $average_grade);
    $stmt->execute();
}

// Close the database connection
$conn->close();
?>

<h1>Check Average Mark</h1>
<form method="post">
    <input type="number" name="studentId" placeholder="Enter student id">     
    <button type="submit" name="average">Average</button>
</form>

</body>
</html>