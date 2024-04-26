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
 
    $conn =mysqli_connect($hostname,$username,$password,$db_name);
    if(!$conn){
        die("Database connection failed");
    }
    else{ 
    
        if (isset($_POST['add_course'])) {
            $student_id = $_POST['student_id'];
            $subject_id = $_POST['subject_id'];
        
            // Insert into student_courses table
           /*  $query = "INSERT INTO student_subject (student_id, subject_id) VALUES ('$student_id', '$subject_id')";
            mysqli_query($conn, $query); */
            $query = "INSERT INTO student_subject (student_id, subject_id) VALUES ($student_id, $subject_id)";


                // Check if the query was successful
                if(mysqli_affected_rows($conn) > 0) {
                    echo "Course added successfully!";
                } else {
                    echo "Error adding course: " . mysqli_error($conn);
                }
        }
     
    
    }
        
        ?>
        <h1>Add Course</h1>
    <form method="post">
        <select name="student_id">
            <!-- Fetch students from the database -->
            <!-- Display student options -->
            <option value="1">Student Name 1</option>
        <option value="2">Student Name 2</option>
        </select>
        <select name="subject_id">
            <!-- Fetch courses from the database -->
            <!-- Display course options -->
            <option value="1">Subject Name 1</option>
        <option value="2">Subject Name 2</option>
        </select>
        <button type="submit" name="add_course">Add Course</button>
    </form>
</body>
</html>