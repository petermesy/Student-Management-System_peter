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


  if(isset ($_POST['submit']))
   { 
    $conn =mysqli_connect($hostname,$username,$password,$db_name);
    if(!$conn){
        die("Database connection failed");
    }
    else{
        echo "conected";

             
        $first_name = $_POST['FirstName'];
        $last_name = $_POST['LastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $subject = $_POST['subject'];
        $degree_level = $_POST['degreeLevel'];


        $query = "INSERT INTO instructor (First_name, Last_name, email, phone,
        address,subject,degree_level) VALUES ('$first_name','$last_name', '$email', 
       '$phone','$address','$subject','$degree_level')";
       if (mysqli_query($conn, $query))  {
        mysqli_close($conn);

    
        }
    }}
    ?>
    <form method="POST">
            <input type="text" name="FirstName" placeholder="Instructor FIrst Name"><br><br>
            <input type="text" name="LastName" placeholder="Instructor Last Name"><br><br>
            <input type="text" name="email" placeholder="Enter email"><br><br>
            <input type="number" name="phone" placeholder="Enter Phone number"><br><br>
            <input type="text" name="address" placeholder="Addrress"><br><br>
            <input type="text" name="subject" placeholder="Enter subject"><br><br>
            <input type="text" name="degreeLevel" placeholder="Enter degree level"><br><br>
            <input type="submit" value="Add Instructor" name="submit"> 
        </form> 
</body>
</html>