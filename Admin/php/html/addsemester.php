<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
<!--     <link rel="stylesheet" href="admin.css"> -->
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
    padding-top:5px;
    height: 2.5rem;
}
marquee{
    position: relative;
    left: 600px;
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
top: 830px;
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
   <div class="dash">






   <?php
        $hostname = 'localhost';
        $username = "root";
        $password = "";
        $db_name = "mysms";

        if (isset($_POST['submit'])) {
            if (
                isset($_POST['semesterName']) &&
                isset($_POST['startingDate']) &&
                isset($_POST['endingDate'])
            ) {
                $conn = mysqli_connect($hostname, $username, $password, $db_name);
                if (!$conn) {
                    die("Database connection failed: " . mysqli_connect_error());
                } else {
                    $semester_name = $_POST['semesterName'];
                    $starting_Date = $_POST['startingDate'];
                    $ending_Date = $_POST['endingDate'];
                    $query = "INSERT INTO semester (semester_name, starting_date, ending_date) VALUES ('$semester_name', '$starting_Date','$ending_Date')";

                    if (mysqli_query($conn, $query)) {
                        ?>
                        <p class="notification">Quarter added successfully!</p>
                        <?php
                    } else {
                        ?>
                        <p class="notification" style="color: red;">Error in adding Quarter!</p>
                        <?php
                        echo mysqli_error($conn);
                    }

                    mysqli_close($conn);
                }
            }
        }
        ?>
        <form method="POST">
            <div class="input1">
                <input type="text" name="semesterName" placeholder="Quarter Name" class="inputt"><br><br>
                <input type="date" name="startingDate" placeholder="Starting date" class="inputt"><br><br>
                <input type="date" name="endingDate" placeholder="Ending date" class="inputt"><br><br>
                <input type="submit" value="Add Quarter" name="submit"> <br>
                <button class="backk"><a href="admin.html" class="back">Back</a></button>
            </div>
        </form>
        <marquee behavior="" direction="">current session</marquee>
    </div>
</div>
</body>
</html>









