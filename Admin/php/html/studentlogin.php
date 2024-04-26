<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

if(isset($_POST['login_btn'])) { 
    $conn = mysqli_connect($hostname, $username, $password, $db_name);
    if(!$conn) {
        die("Database connection failed");
    } else {
        // Initialize session
        session_start();

        // Function to sanitize input
   /*      function e($value, $conn) {
            return mysqli_real_escape_string($conn, $value);
        } */

        // Student login
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM student WHERE username='$username' AND password='$password'";
     
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $student = mysqli_fetch_assoc($result);
            $_SESSION['student_id'] = $student['student_id']; // Store student ID in session
            header('location: studentresult.php'); // Redirect to student dashboard
            exit(); // Stop further execution
        } else {
            echo "Invalid username/password combination.";
        }
    }
        // Student dashboard (studentresult.php)
        if (isset($_SESSION['student_id'])) {
            $student_id = $_SESSION['student_id'];
            // Fetch grade points for the specified student
            $query = "SELECT sm.subject_id, sm.student_mark
                      FROM student_marklist AS sm
                      WHERE sm.student_id = '$student_id'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die('Error in query: ' . mysqli_error($conn));
            }
            ?>
            
            <h1>Grade Points for Student ID <?= $student_id ?></h1>
            <table>
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Grade Point</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $row['subject_id'] ?></td>
                            <td><?= $row['student_mark'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
            <?php
            // Free result set
            mysqli_free_result($result);
            
            // Close the database connection
            mysqli_close($conn);
        } else {
            // Redirect to login page if not logged in
            header('location: studentlogin.php');
        }
    }

?>

    <div class="container">
        <h2>Student Login</h2>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" name="login_btn" value="Log In">
        </form>
    </div>
</body>
</html>
