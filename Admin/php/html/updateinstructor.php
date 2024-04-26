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
    height: 2.5rem;
    padding:2px;
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
    width: 400px;
    height: 35px;
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
top: 130px;
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

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    
    // Initialize an array to store the updates
    $updates = array();

    // Check each field if it's set and add it to the updates array
    if (!empty($_POST['new_name'])) {
        $updates[] = "Full_name='" . $_POST['new_name'] . "'";
    }

    if (!empty($_POST['new_email'])) {
        $updates[] = "email='" . $_POST['new_email'] . "'";
    }

    if (!empty($_POST['new_phone'])) {
        $updates[] = "phone='" . $_POST['new_phone'] . "'";
    }

    if (!empty($_POST['new_address'])) {
        $updates[] = "address='" . $_POST['new_address'] . "'";
    }

    if (!empty($_POST['new_subject'])) {
        $updates[] = "subject='" . $_POST['new_subject'] . "'";
    }

    if (!empty($_POST['new_degree_level'])) {
        $updates[] = "degree_level='" . $_POST['new_degree_level'] . "'";
    }

    if (!empty($_POST['new_Username'])) {
        $updates[] = "usename='" . $_POST['new_Username'] . "'";
    }
    
    if (!empty($_POST['new_Password'])) {
        $updates[] = "password='" . $_POST['new_Password'] . "'";
    }

    // If there are updates, construct the SQL query and execute it
    if (!empty($updates)) {
        $updateString = implode(", ", $updates);
        $sql = "UPDATE instructor SET $updateString WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            ?>
            <p class="notification">Record updated successfully!</p>
            <?php
        } else {
            ?>
            <p class="notification" style="color: red;">Error in updating record: <?php echo mysqli_error($conn); ?></p>
            <?php
        }
    } else {
        ?>
        <p class="notification" style="color: red;">No fields to update!</p>
        <?php
    }
}
?>

 <h1 class="info">Update Instructor information Records</h1> 
<form method="POST">
    <label for="id">Record ID:</label>
    <input type="number" name="id" required class="inputt" >
    <br><br>
    <label for="new_name">New Name:</label>
    <input type="text" name="new_name" class="inputt" >
    <br><br>
    <label for="new_email">New Email:</label>
    <input type="text" name="new_email" class="inputt" >
    <br><br>
    <label for="new_phone">New Phone:</label>
    <input type="text" name="new_phone" class="inputt" >
    <br><br>
    <label for="new_address">New Address:</label>
    <input type="text" name="new_address" class="inputt" >
    <br><br>
    <label for="new_subject">New Subject:</label>
    <input type="text" name="new_subject" class="inputt" >
    <br><br>
    <label for="new_degree_level">New Degree level:</label>
    <input type="text" name="new_degree_level" class="inputt" >
    <br><br>
    <label for="new_Username">New Username:</label>
    <input type="text" name="new_Username" class="inputt" >
    <br><br>
    <label for="new_Password">New Password:</label>
    <input type="text" name="new_Password" class="inputt" >
    <br><br>
    <input type="submit" value="Update" name="update"><br><br>
    <button class="backk"><a href="admin.html" class="back">Back</a></button>
</form>

</div>
</div>
</body>
<!-- https://stackoverflow.com/questions/58201356/how-to-avoid-duplicated-entry-when-adding-on-database -->
</html>