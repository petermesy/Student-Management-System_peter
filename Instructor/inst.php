<?php
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

/* if(isset($_POST['login_btn'])) { 
    $conn = mysqli_connect($hostname, $username, $password, $db_name);
    if(!$conn) {
        die("Database connection failed");
    } else {
        $instid=1;
        $sql="SELECT student_id FROM instructor_student WHERE id=$instid";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)){
                echo $row["student_id"];
                echo "kjfojw ";
           } } else {
                echo "0 results";
            }
            $conn->close();}} */


            
// Database connection parameters
/* $host = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database"; */

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:hostname=$hostname;db_name=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

// Instructor ID (replace with the actual instructor ID)
$instructorId = 3;

// Query to fetch students assigned to the instructor
$sql = "SELECT s.student_id, /* s.student_name */
        FROM instructor_student AS is
        INNER JOIN student AS s ON is.student_id = s.student_id
        WHERE is.id = :instructorId";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":instructorId", $instructorId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the results
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Print the students
    foreach ($students as $student) {
        echo "Student ID: " . $student['student_id'] ;
        /* . ", Student Name: " . $student['student_name'] . */ 
    }
} catch (PDOException $e) {
    die("Error executing the query: " . $e->getMessage());
}
?>