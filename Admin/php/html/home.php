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
 /*    display: grid;
   /*  column-gap: 2rem;
    grid-template-columns: 1fr 1fr; */ 
   text-align:center;
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
   /*  display: grid; */
    
   
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
.average{
position: absolute;
top:300px;
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
  <!--  <div class="frame"> -->


<?php
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die("Database connection failed");
} else {
    session_start();
    // Student dashboard (studentresult.php)
    if (isset($_SESSION['student_id'])) {
        $student_id = $_SESSION['student_id'];


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

if (isset($_POST['average'])) {
    // $student_id = $_POST['studentId'];
    $average_grade = calculateAverageGrade($student_id, $conn);
    // echo "Student ID $student_id average grade: $average_grade";

    // Insert the average marks into another table (e.g., 'student_average')
    $insertSql = "INSERT INTO student_average (student_id, average) VALUES (?, ?) ON DUPLICATE KEY UPDATE average = ?";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("idi", $student_id, $average_grade, $average_grade);
    $stmt->execute();
}


        // Fetch grade points for the specified student
        $query = "SELECT sm.subject_id, sm.student_mark
                  FROM student_marklist AS sm
                  WHERE sm.student_id = '$student_id'";
        
        $sql = "SELECT Full_name FROM student WHERE student_id='$student_id'";
        $result = mysqli_query($conn, $query);
        $resultt = mysqli_query($conn, $sql);


        $queryy = "SELECT average FROM student_average WHERE student_id = '$student_id'";
        $que_result = mysqli_query($conn, $queryy);



        if (mysqli_num_rows($que_result) > 0) {
            $subject_row = mysqli_fetch_assoc($que_result);
            // $subject_name = $subject_row["average"];
            // Output student name

            ?>
                <p class="average">Average = <?= $subject_row['average'] ?></p>        
            <?php
        
        
        
        }

        if (!$result) {
            die('Error in query: ' . mysqli_error($conn));
        }
        if (mysqli_num_rows($resultt) > 0) {
            while ($row = mysqli_fetch_assoc($resultt)) {






?>
                <div>
                    <h1>Welcome <?php echo $row["Full_name"]; ?> Your Grade Point is:</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Grade Point</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                }
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
               
                $subject_id = $row['subject_id'];
                $subject_query = "SELECT Subject_name FROM subject WHERE subject_id = '$subject_id'";
                $subject_result = mysqli_query($conn, $subject_query);

                if (mysqli_num_rows($subject_result) > 0) {
                    $subject_row = mysqli_fetch_assoc($subject_result);
                    $subject_name = $subject_row["Subject_name"];
                    // Output student name
?>
                            <tr>
                                <td><?= $subject_name ?></td>
                                <td><?= $row['student_mark'] ?></td>
                                
                            </tr>
<?php
                }
            }
        }
?>
                        </tbody>
                    </table>
                    <form method="post">
    
    <button type="submit" name="average">Calculate Average</button>
</form>

                </div>
<?php





        // Free result set
        mysqli_free_result($result);
    } else {
        // Redirect to login page if not logged in
        header('location: login2.php');
    }
}
?>

<button class><a href="enrollsemester2.php">Register for course</a></button>
<button class><a href="changepassword.php">change Password</a></button>
<button class><a href="logout.php">Logout</a></button>
<!-- </div> --></div></body></html>