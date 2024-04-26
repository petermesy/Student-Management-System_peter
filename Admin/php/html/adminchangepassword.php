<?php

session_start();

// $_SESSION["userId"] = "1"; // Set the user ID (you can replace this with your own logic)

$conn = mysqli_connect("localhost", "root", "", "mysms"); // Replace with your database credentials
if (isset($_SESSION['id'])) {
    $student_id=$_SESSION['id'];
// $_SESSION["student_id"] = "19";
if (count($_POST) > 0) {
    $sql = "SELECT * FROM admin WHERE id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $_SESSION["id"]);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentPassword = $row["password"]; // Retrieve the current password from the database

        // Validate the input fields
        $newPassword = $_POST["newPassword"];
        $confirmPassword = $_POST["confirmPassword"];

        if ($newPassword != $confirmPassword) {
            echo "New password and confirmation password do not match.";
        } else {
            // Update the password in the database
            $updateSql = "UPDATE admin SET password = ? WHERE id = ?";
            $updateStatement = $conn->prepare($updateSql);
            $updateStatement->bind_param('si', $newPassword, $_SESSION["id"]);
            $updateStatement->execute();

            echo "Password updated successfully!";
        }
    }} else {
        echo "User not found.";
    }
}
?>

<!-- HTML form for changing password -->
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
</head>
<body>
<div class="phppot-container tile-container">
    <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
        <div class="validation-message text-center">
            <?php if (isset($message)) { echo $message; } ?>
        </div>
        <h2 class="text-center">Change Password</h2>
        <div>
            <div class="row">
                <label class="inline-block">Current Password</label>
                <span id="currentPassword" class="validation-message"></span>
                <input type="password" name="currentPassword" class="full-width">
            </div>
            <div class="row">
                <label class="inline-block">New Password</label>
                <span id="newPassword" class="validation-message"></span>
                <input type="password" name="newPassword" class="full-width">
            </div>
            <div class="row">
                <label class="inline-block">Confirm Password</label>
                <span id="confirmPassword" class="validation-message"></span>
                <input type="password" name="confirmPassword" class="full-width">
            </div>
            <div class="row">
                <input type="submit" name="submit" value="Submit" class="full-width">
            </div>
        </div>
    </form>
</div>
</body>
</html>