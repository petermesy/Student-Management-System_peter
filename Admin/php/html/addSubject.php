<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
   <!--  <style>
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
    padding-top:5px;
    height: 2.5rem;
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
.form1{
    margin-top:200px;
/*     margin-right:80%; */
    margin-left:-300px;

 

}
.submit{
    margin-left:-300px;
}
@media (max-width: 768px) {
    /* Show the nav element */
    .inputt{
    width: 200px;
    height: 50px;
    margin-left:30%;
}
.course{
    /* margin-left:400px; */
    position: relative;
    left:200px;
    
}
.submit{
 
    margin-left:30%;
    position: relative;
    left:200px;
    length:100px;
}
.task{
    width:130%;
}
.backk{
    /* margin-right:200px; */
    position: relative;
   left:200px
}
*{
    margin:0
}
.course{
    margin-left:100px;
}
}
.submit{
    width:500px;
    margin-left:2px
}
.course{
    margin-left:00px;
}
 .back{
    height: 50px;
    text-decoration: none;
    color: black;
 

}
.backk{  
    width:100px;
    margin-right: 100px;
}
.notification{
    position: absolute;
text-align: center;
top: 370px;
}
</style> -->
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
   $hostname ='localhost';
   $username = "root";
   $password = "";
   $db_name = "mysms";


  if(isset ($_POST['submit']))
   { 
    $conn =mysqli_connect($hostname,$username,$password,$db_name);
    if(!$conn){
        die("Database connection failed");
    }
    else{  
        $Subject_Name	 = $_POST['SubjectName'];
       
       $query = "INSERT INTO subject (Subject_name) VALUES ('$Subject_Name')";

       if (mysqli_query($conn, $query))  {
        ?>
        <p class="notification">Subject added successfully!</p>
        <?php }
         else {
            ?>
           <p class="notification" style="color: red;">Error adding Subject!</h3>
           <?php  mysqli_error($conn);
       
        mysqli_close($conn);

    
        }
    }}
    ?>
    <div class="form1">
    <form method="POST" >
    <div class="input1">
        <h1 class="course">Add Coourse</h1><br><br>
            <input type="text" name="SubjectName" placeholder="Subject Name	" class="inputt"><br><br>
            <input type="submit" value="Add Subject" name="submit" class="submit"><br><br> 
           
            <button class="backk"><a href="admin.html" class="back">Back</a></button></div>
        </form> </div>
       <!--  <marquee behavior="" direction="">current seesion</marquee> -->
</body>
</html>