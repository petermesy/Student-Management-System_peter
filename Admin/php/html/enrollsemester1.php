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
            $student_id = $_SESSION['student_id'];
        }

        if (isset($_POST['Register'])) {
            $Grade = $_POST['grade'];
            $Semester = $_POST['semester'];
            $subject_ids = $_POST['subject_ids'];
            $Section = $_POST['section'];
            foreach ($subject_ids as $subject_id) {


                $sql = "CREATE TABLE newsem (
                    student_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    subject_id INT NOT NULL,
                    semester_id INT NOT NULL,
                    grade_id INT NOT NULL,
                    student_mark DECIMAL, -- Assuming student_mark is a decimal value
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    FOREIGN KEY (student_id) REFERENCES student(student_id),
                    FOREIGN KEY (subject_id) REFERENCES subjects(id),
                    FOREIGN KEY (semester_id) REFERENCES semesters(id),
                    FOREIGN KEY (grade_id) REFERENCES grades(id)
                )";


                $query = "INSERT INTO student_subject (student_id, subject_id, semester_id, grade_idd, section_id) VALUES ('$student_id', '$subject_id', '$Semester', '$Grade','$Section')";
                mysqli_query($conn, $query);
            }

            // Check if the query was successful
            if(mysqli_affected_rows($conn) > 0) {
                echo "Registration successful!";
            } else {
                echo "Error in Registration: " . mysqli_error($conn);
            }
        }

        $grade_query = "SELECT * FROM gradee";
        $grade_result = mysqli_query($conn, $grade_query);

        $semester_query = "SELECT * FROM semester";
        $semester_result = mysqli_query($conn, $semester_query);
        
        $section_query = "SELECT * FROM section";
        $section_result = mysqli_query($conn, $section_query);


        $subject_query = "SELECT * FROM subject";
        $subject_result = mysqli_query($conn, $subject_query);

        // Close the database connection
        $sql = "SELECT Full_name FROM student WHERE student_id='$student_id'";
        $resultt = mysqli_query($conn, $sql);
        if (mysqli_num_rows($resultt) > 0) {
            while ($row = mysqli_fetch_assoc($resultt)) {
                echo "<h1>Welcome " . $row["Full_name"] . " Register course Here</h1>";
            }
        }
        mysqli_close($conn);
    }
?>
<h1>Select Subjects to Register</h1>
<form method="post" class="inputt">
    <label for="subject_ids[]">Select Subjects:</label><br>
    <?php while ($subject = mysqli_fetch_assoc($subject_result)) : ?>
        <input type="checkbox" name="subject_ids[]" value="<?php echo $subject['subject_id']; ?>">
        <label><?php echo $subject['Subject_name']; ?></label><br>
    <?php endwhile; ?>
    <br>

    <h2 class="ass">Select Grade</h2>
    <label for="grade">Select Grade:</label>
    <select name="grade" id="grade">
        <?php while ($grade = mysqli_fetch_assoc($grade_result)) : ?>
            <option value="<?php echo $grade['grade_idd']; ?>"><?php echo $grade['GRADE_NAME']; ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <h2 class="ass">Select Section</h2>
    <label for="section">Select Section:</label>
    <select name="section" id="section">
        <?php while ($section = mysqli_fetch_assoc($section_result)) : ?>
            <option value="<?php echo $section['section_id']; ?>"><?php echo $section['section_name']; ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <h2 class="ass">Select Semester</h2>
    <label for="semester">Select Semester:</label>
    <select name="semester" id="semester">
        <?php while ($semester = mysqli_fetch_assoc($semester_result)) : ?>
            <option value="<?php echo $semester['semester_id']; ?>"><?php echo $semester['semester_name']; ?></option>
        <?php endwhile; ?>
    </select><br><br>
    <input type="submit" name="Register" value="Register">
</form>
</body>
</html>
