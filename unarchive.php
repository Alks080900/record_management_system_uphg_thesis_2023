<?php
session_start();
// Connect to the database (replace the placeholders with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_rms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the timezone to the Philippines
date_default_timezone_set('Asia/Manila');

// Get the current date and time in the desired format
$user_date = date('Y-m-d h:i:s A');

// Get the AM/PM indicator from the $am_pm variable
$am_pm = date('A');


// Get the ID of the user to update
$id = $_GET['id'];

// Retrieve the first name and last name of the user
$result = mysqli_query($conn, "SELECT Firstname, Lastname FROM collegestud WHERE id=$id");
$row = mysqli_fetch_assoc($result);
$firstname = $row['Firstname'];
$lastname = $row['Lastname'];

// Update the user's status to 0
$sql = "UPDATE collegestud SET status=1, user_date='$user_date', am_pm='$am_pm' WHERE id=" . $id;

// Insert user log details into userlog table
if(isset($_SESSION['login'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['id'];
    $lname = $_SESSION['Lname'];
    $fname = $_SESSION['Fname'];
    $action = "UNARCHIVED $firstname $lastname IN COLLEGE";
    mysqli_query($conn, "INSERT INTO userlog (username, user_date, userid, Lname, Fname, am_pm, actions) VALUES ('$username', DATE_FORMAT(CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'), '%Y-%m-%d %h:%i:%s'), '$userid', '$lname', '$fname', DATE_FORMAT(CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'), '%p'), '$action')") or die(mysqli_error($conn));
}

if ($conn->query($sql) === TRUE) {
    // Redirect to the users page with a success message
    header("Location: searchstudent.php?status=unarchive_success");
    exit();
} else {
    // Redirect to the users page with an error message
    header("Location: searchstudent.php?status=error");
    exit();
}

// Close the database connection
$conn->close();

exit();
?>
