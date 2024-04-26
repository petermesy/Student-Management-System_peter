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
        // Fetch students and their courses
        $query = "SELECT s.First_name, c.Subject_name
                  FROM student s
                  INNER JOIN student_subject sc ON s.student_id = sc.student_id
                  INNER JOIN subject c ON sc.subject_id = c.subject_id";
        $result = mysqli_query($conn, $query);
      
       
    }
    ?>
    <h1>Students and Their Courses</h1>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <li><?= $row['First_name'] ?> is enrolled in <?= $row['Subject_name'] ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>