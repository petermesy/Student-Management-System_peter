<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    width: 50%;
    height: 500px;
    margin-left: 10%;
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
</style>
</head>
<body>
<header>
        <h1>School logo</h1>
        <a href="/mysm/Home Page/index.html" class="home">Back home</a>
    </header>

 <div class="dashbord"> 
   <!--  <iframe src="dash.html" style="height:800px;width:400px" title="Iframe Example"></iframe> -->

<?php
$hostname ='localhost';
$username = "root";
$password = "";
$db_name = "mysms";

// Establish a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed");
}

session_start();
if (isset($_SESSION['id'])) {
    $instructor_id = $_SESSION['id'];
    $inst = "SELECT Full_name FROM instructor WHERE id='$instructor_id'";
    $resultt = mysqli_query($conn, $inst);
    if (mysqli_num_rows($resultt) > 0) {
        while ($roww = mysqli_fetch_assoc($resultt)) {
             echo "Students Assigned to ".$roww["Full_name"];}
        }
    $sqll = "SELECT student_id FROM instructor_student WHERE id = $instructor_id";

    $resulttt = $conn->query($sqll);

    if ($resulttt->num_rows > 0) {
        // Output data of each row
        while($row = $resulttt->fetch_assoc()) {
            $student_id = $row['student_id'];
            $name_query = "SELECT Full_name FROM student WHERE student_id='$student_id'";
            $name_result = $conn->query($name_query);
            if(mysqli_num_rows($name_result) > 0){
                $name_row = mysqli_fetch_assoc($name_result);
                $student_name = $name_row["Full_name"];
                ?>
               
                <?php
                echo "Student name: " .$student_name. "<br>";
            }
        }
    } else {
        echo "0 results";
    }











// Fetch the students assigned to the instructor
$query = "SELECT s.student_id, s.Full_name
          FROM student s
          INNER JOIN instructor_student isa ON s.student_id = isa.student_id
          WHERE isa.id = $instructor_id";
$result = mysqli_query($conn, $query);

// Check if any students are assigned to the instructor
if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Student Marks</title>
    </head>
    <body>
    <div class="frame">
        <h1>Add Student Marks</h1>
        <form method="post">
            <label for="studentId">Select Student:</label>
            <select name="studentId" id="studentId">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <option value="<?= $row['student_id'] ?>">
                        <?= $row['Full_name'] ?> 
                    </option>
                <?php endwhile; ?>
            </select><br><br>
            <label for="subjectId">Enter Subject ID:</label>
            <input type="text" name="subjectId" id="subjectId"><br><br>
            <label for="studentMark">Enter Student Mark:</label>
            <input type="number" name="studentMark" id="studentMark"><br><br>
            <button type="submit" name="submit_student_mark">Add Student Mark</button>
        </form>
    </body>
    </html>
    <?php
} else {
    echo "No students assigned to this instructor.";
}

// Handle form submission
if (isset($_POST['submit_student_mark'])) {
    $student_id = $_POST['studentId'];
    $subject_id = $_POST['subjectId'];
    $student_mark = $_POST['studentMark'];

    // Insert student mark into the database
    $query = "INSERT INTO student_marklist (student_id, subject_id, student_mark)
              VALUES ('$student_id', '$subject_id', '$student_mark')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Student mark added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}





/* <div class="container"> */
            /*     <h2>View Student Marks</h2>
                <?php */
                // Query to fetch student marks assigned to the instructor
                $marks_query = "SELECT s.Full_name, sm.subject_id, sm.student_mark
                                FROM student_marklist sm
                                INNER JOIN student s ON sm.student_id = s.student_id
                                WHERE sm.student_id IN (SELECT student_id FROM instructor_student WHERE id = $instructor_id)";
                $marks_result = mysqli_query($conn, $marks_query);

                if (mysqli_num_rows($marks_result) > 0) {
                    echo "<table>";
                    echo "<tr><th>Student Name</th><th>Subject ID</th><th>Student Mark</th></tr>";
                    while ($row = mysqli_fetch_assoc($marks_result)) {
                        echo "<tr>";
                        echo "<td>" . $row['Full_name'] . "</td>";
                        echo "<td>" . $row['subject_id'] . "</td>";
                        echo "<td>" . $row['student_mark'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }







}else {
    // Redirect to login page if not logged in
    header('location: instructorlogin.php');
    exit(); // Stop execution after redirection
}
?>
   <!-- </div> --></div></body></html>