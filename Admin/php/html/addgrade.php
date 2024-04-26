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
    <div class="dash">

<?php
// Establish database connection
// $con = mysqli_connect("$host", "$username", "$password", "$db_name");
// / Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// if (mysqli_connect_errno($con)) {
//     echo 'Failed to connect';
// }


if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

else {
    if(isset($_POST['submit'])){
$grade_name=$_POST['Grade_name'];
$query="INSERT INTO gradee (GRADE_NAME) value('$grade_name')";
if(mysqli_query($conn,$query)){
    mysqli_close($conn);
    ?>  <p class="notification">Grade added successfully!</p><?php
}else{
    ?>
            <p class="notification" style="color: red;">Error adding Grade!</p>
<?php 
            echo mysqli_error($conn);
        } 
}



    if(isset($_POST['submitt'])){
$semester_name=$_POST['Semester_name'];
$starting_date=$_POST['start'];
$ending_date=$_POST['end'];
$queryy="INSERT INTO semester (semester_name,starting_date,ending_date) values('$semester_name','$starting_date','$ending_date')";
if(mysqli_query($conn,$queryy)){
    mysqli_close($conn);
    ?>  <p class="notification">Semester added successfully!</p><?php
}else{
    ?>
            <p class="notification" style="color: red;">Error adding Semester!</p>
<?php 
            echo mysqli_error($conn);
        } 
}


}

?>
    <form method="POST">
            <h1>Add grade</h1><br><br>
                <div class="input1">
                <input type="text" name="Grade_name" placeholder="Add Grade" class="inputt"><br><br>
                <input type="submit" value="Add grade" name="submit"> <br>
                    <button class="backk"><a href="admin.html" class="back">Back</a></button>
                </div>
            </form>   <br><br><br><br>
    <form method="POST">
            <h1>Add Semester</h1><br><br>
                <div class="input1">
                <input type="text" name="Semester_name" placeholder="Add Semester" class="inputt"><br><br>
                <input type="date" name="start" placeholder="Starting date" class="inputt"><br><br>
                <input type="date" name="end" placeholder="Ending date" class="inputt"><br><br>
                <input type="submit" value="Add Semester" name="submitt"> <br>
                <button class="backk"><a href="admin.html" class="back">Back</a></button>
                </div>
            </form>   
</div>
</body>
</html>