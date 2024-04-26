<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    *{
    margin: 0;
    
}
header{
    background-color: #00205b!important; 
    color:whitesmoke;height: 100px;
}
header a{
position: absolute;
right: 100px;
    color: whitesmoke;
 font-size: 3rem;
 top: 10px;
}
header h1{
    padding-top: 30px;
}
.home{
    text-decoration: none;
}
.dashbord{
    display: grid;
    column-gap: 2rem;
    grid-template-columns: 1fr 1fr;
   
}
.dash{
    margin-top: 200px;
    display: grid;
    grid-template-columns: repeat(3,1fr);
    column-gap: 10rem;
    height: 15rem;
    
   

}
.class {
    border: black solid 0.1px;
    position: relative;
    right: 200px;
}

.frame{
    display: grid;
    width: 38%;
    height: 500px;
    margin-left: 4%;
    margin-top: 4%;
  /*   border: black solid 0.1px; */
    padding: 15px;
    border-radius: 20px;

}
.task{
    display: grid;
    border: solid black 0.1px;
    height: 4rem;
    text-decoration: none;
    color: black;
    margin: 10px;
    text-align: center;
    background-color: rgb(202, 201, 200);
    border-radius: 10px;
}
marquee{
    position: relative;
    left: 100px;
    font-size: 4rem;
    top: -2rem;
    
}
header h1{
    margin-left: 100px;
}
.inputt{
    width: 500px;
    height: 50px;
}
.input1{
   /*  display: grid; */
    
   
}
 .back{
    height: 50px;
    text-decoration: none;
    color: black;
 

}
.backk{  
    margin-left: 500px
}
.notification{
    position: absolute;
text-align: center;
top: 1000px;
}
</style>
</head>
<body>
<header>
        <h1>School logo</h1>
        <a href="/mysm/Home Page/index.html" class="home">Back home</a>
    </header>

 <div class="dashbord">
   <!--  <iframe src="dash.html" style="height:800px;width:400px" title="Iframe Example"></iframe> -->
   <div class="frame">


<?php 
    $hostname ='localhost';
    $username = "root";
    $password = "";
    $db_name = "mysms";
 
    $conn = mysqli_connect($hostname, $username, $password, $db_name);
    if (!$conn) {
        die("Database connection failed");
    } else { 
        
        session_start();
        if (isset($_SESSION['student_id'])) {
            $student_id = $_SESSION['student_id'];}
    
        if (isset($_POST['add_course'])) {
      /*       $student_id = $_POST['student_id']; */
            $subject_id = $_POST['subject_id'];
        
            // Insert into student_subject table
            $query = "INSERT INTO student_subject (student_id, subject_id) VALUES ('$student_id', '$subject_id')";
            mysqli_query($conn, $query);

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
<form method="post" class="inputt">
            <input type="number" name="student_id" class="input1" placeholder="Enter student id">
            <input type="number" name="subject_id" class="input1" placeholder="Enter Subject id">

    <button type="submit" name="add_course">Add Course</button>
</form>
</div></div></body></html>
