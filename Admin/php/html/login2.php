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
            
            margin-top:150px;
        }
        input[type="text"], input[type="password"] {
            width: 93%;
            padding: 10px;
            
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px ;
            border-radius: 3px;
            cursor: pointer;
          
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
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
</head>
<body>
<?php
$hostname = 'localhost';
$username = "root";
$password = "";
$db_name = "mysms";

$conn = mysqli_connect($hostname, $username, $password, $db_name);
if(!$conn){
    die("Database connection failed!");
}
else{
    session_start();

    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM student WHERE username='$username' AND password='$password'";
        
        
        $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) == 1){
                $student = mysqli_fetch_assoc($result);
                $_SESSION['student_id'] = $student['student_id']; // Store student ID in session
                header('location: homestudent.php'); /1/ Redirect to student dashboard
                exit(); // Stop further execution
            } else {
                ?><p class="invalid" style="color:red; ">Invalid username/password combination.</p><?php
          
            }
    }

}
?>
<div class="container">
    <h2 class="stdl">Student Login</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your Username " required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your Password " required>
        <input type="submit" name="login" value="Log In"><br>
        <div class="option">
            <br><a href="adminlogin.php" class="a1">Login As Admin</a>
            <a href="/mysm/Instructor/instructorlogin.php" class="a2">Login As Instructor</a>
        </div>
        
    </form>
</div>
</body>
</html>
