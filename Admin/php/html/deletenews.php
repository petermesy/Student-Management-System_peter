<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
top: 1000px;
}
        .post{
            display:grid;
            border: 1px solid gray;
            height:300px;
            width:50%;
            text-align:center;
            margin-left:25%;
            border-radius:20px;
            overflow:auto;
            padding:10px;
        }
        .h1news{
            text-align:center;
            margin-top:2%;
        }
        .title{
            text-align:center;
        }
    </style>
</head>
<body>
<header>
        <h1>School logo</h1>
        <a href="/mysm/Home Page/index.html" class="home">Back home</a>
    </header>

    <div class="dashbord">
   <!--  <iframe src="dash.html" style="height:800px;width:400px" title="Iframe Example"></iframe> -->
 <div class="frame">
 <h3><a href="assignstudentInstructor.php" class="task">Assign Instructor</a></h3>
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
    <h3><a href="viewRank.php" class="task">View student rank</a></h3></div>
    <h3><a href="createpost.php" class="task">Post News</a></h3></div>
    <h3><a href="updatepost.php" class="task">Update News</a></h3></div>
    <h3><a href="deletenews.php" class="task">Delete News</a></h3></div>
   <div class="dash">
<?php
// Establish database connection (replace with your own database credentials)
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

// Establish a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed");

}
?><h1>Delete news</h1><?php
if(isset ($_POST['Delete'])){
    $id=$_POST['id'];
    $sql="DELETE FROM news WHERE id='$id'";
    if(mysqli_query($conn,$sql)){
        if(mysqli_query($conn, $sql)){
            ?><p class="notification">News deleted successfully</p><?php

        } else{
            ?><p class="notification" style="color: red;">Error in deleting record:</p><?php mysqli_error($conn);

        }

    }}
?>
<form method="post">
        <label for="id">Enter News id to be deleted</label>
        <input type="number" name="id" required><br><br>
        <input type="submit" name="Delete" value="Delete">
    </form>

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
    
</body>
</html>