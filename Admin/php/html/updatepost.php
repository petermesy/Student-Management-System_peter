<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/mysm/Admin/php/html/header.css">

    <!-- <style>
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
    margin-left: 0px
}
.notification{
    position: absolute;
text-align: center;
top: 140px;
}
.info{
    position: absolute;
text-align: center;
top: 200px;
right: 400px;

}
</style> -->
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
    <h3><a href="adminchangepassword.php" class="task">Change Password</a></h3>
</div>
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

if(isset($_POST['update'])){
    $id=$_POST['id'];
    $newPost=$_POST['new_post'];
    $newTitle=$_POST['new_title'];
    $sql="UPDATE news 
    SET Post='$newPost',
        Title='$newTitle'
        WHERE id='$id'";
         if(mysqli_query($conn, $sql)){
            ?><p class="notification">News updated successfully</p><?php
            // echo "Record updated successfully";
        } else{
            ?><p class="notification" style="color: red;">Error updating record:</p><?php mysqli_error($conn);
            // echo "Error updating record: " . mysqli_error($conn);
        }
}
?>
<h1 class="info">Update News</h1> 
<form method="POST">
    <label for="id">News Id:</label>
    <input type="number" name="id" >
    <br><br>
    <p><label for="new_post">Update News</label></p>
<textarea name="new_post" id="new_post" cols="50" rows="20" required></textarea><br><br>
    <br><br>
    <label for="title">Title of news</label>
<input type="text" name="new_title" id="new_title" ><br><br>
<input type="submit" name="update" value="Update">
</body>
</html><br><br><br>
<?php
    $query="SELECT id, Title,Post FROM news";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 1) {
        echo '<h2>Existing Records</h2>';
        echo '<table border="1">';
        echo '<tr>
              <th>ID</th>
              <th>Title</th>
              <th>Posts</th>
              </tr>';
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['Title'] . '</td>';
                echo '<td>' . $row['Post'] . '</td>';}
                echo '</table>';
            } else {
                echo 'No records found.';
            }
        
            mysqli_close($conn); 
            ?>
</div>
        </body>
        </html>