<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<!--     <link rel="stylesheet" href="admin.css"> -->
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
    height: 2.5rem;
    padding: 2px;
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
    display: grid;
    
   
}
 .back{
    height: 50px;
    text-decoration: none;
    color: black;
 

}
.backk{  
    margin-left: 200px
}
.notification{
    position: absolute;
text-align: center;
top: 150px;
}
.ass{
    position: absolute;
    top: 200px;
    font-size: 3rem;
  left: 400px; 
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
 <h3><a href="assignstudentInstructor.php" class="task">Assign Instructor</a></h3>
    <h3><a href="addInstructor.php" class="task">Add instructor</a></h3>
    <h3><a href="viewinstructor.php" class="task">View instructors</a></h3>
    <h3><a href="updateinstructor.php" class="task">Update instructor information</a></h3>
    <h3><a href="addStudent.php" class="task">Add Student</a></h3>
    <h3><a href="viewstudent.php" class="task">View Students</a></h3>
    <h3><a href="updatestudent.php" class="task">Update Student information</a></h3>
    <h3><a href="addSubject.php" class="task">Add Course</a></h3>
    <h3><a href="updatecourse.php" class="task">Update Course</a></h3>
    <h3><a href="average.php" class="task">average </a></h3>
    <h3><a href="viewAverage.php" class="task">View student average</a></h3>
    <h3><a href="rank1.php" class="task">Rank </a></h3>
    <h3><a href="viewRank.php" class="task">View student rank</a></h3>
    <h3><a href="createpost.php" class="task">Post News</a></h3>
    <h3><a href="updatepost.php" class="task">Update News</a></h3>
    <h3><a href="deletenews.php" class="task">Delete News</a></h3></div>
   <div class="dash">
   <?php

// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mysms';

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();

// Check if the form is submitted for assigning subjects to an instructor
if (isset($_POST['assign_students'])) {
    $instructor_id = $_POST['id'];
    $subject_ids = $_POST['subject_ids']; // array of subject IDs

    // Loop through the selected subject IDs and assign them to the instructor
    foreach ($subject_ids as $subject_id) {
        $sql = "INSERT INTO instructor_course_assignment (id, subject_id) VALUES ('$instructor_id', '$subject_id')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . mysqli_error($conn);
            ?>
            <p class="notification" style="color: red;">Error in Assigning Course</p>
            <?php
        }
    }
    ?>
    <p class="notification">Course Assigned successfully!</p>
    <?php
}

// Fetch list of instructors
$instructors_query = "SELECT * FROM instructor";
$instructors_result = mysqli_query($conn, $instructors_query);

// Fetch list of unassigned subjects
$unassigned_subjects_query = "SELECT * FROM subject"; // Fetch all subjects
$unassigned_subjects_result = mysqli_query($conn, $unassigned_subjects_query);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Subjects to Instructor</title>
</head>
<body>
    <h2 class="ass">Assign Subjects to Instructor</h2>
    <form method="post">
        <label for="id">Select Instructor:</label>
        <select name="id" id="id">
            <?php while ($instructor = mysqli_fetch_assoc($instructors_result)) : ?>
                <option value="<?php echo $instructor['id']; ?>"><?php echo htmlspecialchars($instructor['Full_name']); ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="subject_ids[]">Select Subject:</label><br>
        <?php while ($subject = mysqli_fetch_assoc($unassigned_subjects_result)) : ?>
            <input type="checkbox" name="subject_ids[]" value="<?php echo $subject['subject_id']; ?>">
            <label><?php echo htmlspecialchars($subject['Subject_name']); ?></label><br>
        <?php endwhile; ?>
        <br>

        <input type="submit" name="assign_students" value="Assign Subjects">
        <button class="backk"><a href="admin.html" class="back">Back</a></button>
    </form>
</body>
</html>
