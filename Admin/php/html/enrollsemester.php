<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    $hostname ='localhost';
    $username = "root";
    $password = "";
    $db_name = "mysms";
 
    $conn = mysqli_connect($hostname, $username, $password, $db_name);
    if (!$conn) {
        die("Database connection failed");
    } else { 
        echo 'connected';
if(isset($_POST['enroll_semester'])){
    $student_id = $_POST['student_id'];
    $semester_id=$_POST['semester_id'];
    
    $query="INSERT INTO current_semester(student_id, semester_id) values ('$student_id','$semester_id')";
    mysqli_query($conn, $query);

    // Check if the query was successful
    if(mysqli_affected_rows($conn) > 0) {
        ?>
        <p>Semester added successfully</p>
        <?php
       }
        else{
            ?>
            <p>Error in adding semester</p> 
            <?php
            mysqli_error($conn);
        }


    }
}
?>
<h1>Add Semester</h1>
<form method="post">
            <input type="number" name="student_id" placeholder="Enter student id">
            <input type="number" name="semester_id" placeholder="Enter Semester id">

    <button type="submit" name="enroll_semester">Register</button>
</form>
</body>
</html>
