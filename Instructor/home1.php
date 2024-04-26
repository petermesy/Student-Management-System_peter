<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
    if (isset($_SESSION['id'])) {
        $instructor_id = $_SESSION['id'];
        
        $sql = "SELECT student_id FROM instructor_student WHERE id = $instructor_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $student_id = $row['student_id'];
                $name_query = "SELECT Full_name FROM student WHERE student_id='$student_id'";
                $name_result = $conn->query($name_query);
                if(mysqli_num_rows($name_result) > 0){
                    $name_row = mysqli_fetch_assoc($name_result);
                    $student_name = $name_row["Full_name"];
                    echo "Student name: " .$student_name. "<br>";
                }
            }
        } else {
            echo "0 results";
        }





    } else {
        // Redirect to login page if not logged in
        header('location: instructorlogin.php');
        exit(); // Stop execution after redirection
    }
}








?>
