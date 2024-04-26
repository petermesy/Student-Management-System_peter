<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
<!--     <link rel="stylesheet" href="admin.css"> -->
<!-- <style>
    *{
    margin: 0;
    
}
header{
    background-color: #33000d!important; 
    color:whitesmoke;
    height: 100px;
}
header a{
position: absolute;
right: 100px;
    color: whitesmoke;
 font-size: 3rem;
 top: 10px;
}
body{
  background-color: #b3b9bf;
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
    grid-template-rows: 1fr 1fr 1fr;
   
}
.dash{
    margin-top: 200px;
    /* display: grid; */
    /* grid-template-rows: repeat(3,1fr); */
    /* column-gap: 10rem; */
    height: 15rem;
    margin-left:200px;
    
}
.class {
    border: black solid 0.1px;
    position: relative;
    right: 200px;
}

.frame{
    display: grid;
    width: 38%;
 /*    height: 500px; */
    margin-left: 4%;
    margin-top: 4%;
 /*    border: black solid 0.1px; */
    padding: 15px;
    border-radius: 20px;
    grid-template-columns: repeat(4,1fr);
}


@media screen and (max-width:900px) {
  .frame{
   grid-template-columns:1fr 1fr 1fr ;  
     /* margin-top: 5rem; */
    /*  margin-left:3rem ; */
    
      /* column-gap: 4rem;  */
  }
}
@media screen and (max-width:700px) {
  .frame{
   grid-template-columns:1fr 1fr ;  
     
  }
}
.task{
    display: grid;
    border: solid black 0.1px;
    
    text-decoration: none;
    width:250px;
    color: black;
    margin: 10px;
    text-align: center;
    background-color: rgb(202, 201, 200);
    border-radius: 10px;
    padding-top:5px;
    height: 2.5rem;
}
marquee{
    position: relative;
    /* left: 600px; */
    font-size: 4rem;
    top: 2rem;
    
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
    margin-left:200px;
    margin-right:200px;
   
}
 .back{
    height: 50px;
    text-decoration: none;
    color: black;
    width:50px;

}
 .bak{
    width: 150px;
    /* text-decoration: none; */
    color: black;

}
.backk{  
    margin-left: 100px;
   width:50px;
}
.notification{
    position: absolute;
text-align: center;
top: 830px;
}
 -->

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
   <div class="dash">






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

// SQL query to retrieve student names enrolled in all courses
$query = "SELECT s.Full_name AS student_name, sb.Subject_name AS course_name
          FROM student s
          JOIN student_subject ss ON s.student_id = ss.student_id
          JOIN subject sb ON ss.subject_id = sb.subject_id
          ORDER BY s.Full_name, sb.Subject_name";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
}

// Display student names enrolled in all courses
echo "<h2>Student Names Enrolled in All Courses</h2>";
echo "<table border='1'>";
echo "<tr><th>Student Name</th><th>Course Name</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
    echo "</tr>";
}

echo "</table>";

// Close the database connection
mysqli_close($conn);
?>
<button class="backk"><a href="admin.html" class="back">Back</a></button>
</div>
</body>
</html>