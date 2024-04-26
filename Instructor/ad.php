<!DOCTYPE html>
<html>
<head>
    <title>Student Marks Management</title>
</head>
<body>
    <?php
    // Database connection (replace with your actual database credentials)
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysms";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Example: Insert marks for a student in a specific course and semester
    $studentID = 3; // Replace with the actual student ID
    $courseID = 9; // Replace with the actual course ID
    $semester = 2; // Replace with the actual semester
    $marks = 85; // Replace with the actual marks
    $grade=1;
    $section=1;
    $sql = "INSERT INTO student_marklist (student_id, subject_id, semester_id, student_mark, grade_idd, section_id)
            VALUES ('$studentID', '$courseID', '$semester', '$marks', '$grade', '$section')";

    if ($conn->query($sql) === TRUE) {
        echo "Marks inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>
</body>
</html>
