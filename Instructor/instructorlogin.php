<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Login</title>
</head>
<body>
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
            margin-top:150px;
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
        .log{
            text-align:center;
        }
        .option a{
            color:black; 
             /* display:grid;  */
             column-gap:1rem; 
             text-decoration:none;

        }
        .option a:hover{
            color:gray;
        }
        .a2{
            position: relative;
            left:140px;
        }
        .stdl{
            text-align:center;
             }
             .invalid{
                position: absolute;
                margin-top:250px;
                text-align:center;
                left:15%;
                right:15%;
            }
    </style>

<?php
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

$conn = mysqli_connect($hostname, $username, $password, $db_name);
if (!$conn) {
    die("Database connection failed!");
} else {
    session_start();

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM instructor WHERE usename='$username' AND password='$password'";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $instructor = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $instructor['id']; // Store instructor ID in session
            // header('location:/mysm/Admin/php/html/addmark.php'); // Redirect to instructor dashboard
            header('location:AddStudentMark1.php'); // Redirect to instructor dashboard
            exit(); // Stop further execution
        } else {
            ?><p class="invalid" style="color:red; ">Invalid username/password combination.</p><?php
        }
    }
   /*  if (isset($_SESSION['id'])) {
        $instructor_id = $_SESSION['id'];
        $query = "SELECT sm.student_id
        FROM instructor_student sm
        WHERE sm.instructor_id = $instructor_id"; // Fix the query to use instructor_id instead of id
        // You need to complete your query here and execute it
    } */
}
?>
<div class="container">
    <h2 class="log">Login as Instructor </h2> <!-- Corrected the header to match the functionality -->
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"  placeholder="Enter your Username " required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your Password " required>
        <input type="submit" name="login" value="Login">
    <div class="option">
        <br><a href="/mysm/Admin/php/html/adminlogin.php" class="a1">Login As Admin</a>
            <a href="/mysm/Admin/php/html/login2.php" class="a2">Login As Student</a>
            </div>
    </form>

</div>
</body>
</html>
