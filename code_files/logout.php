<?php
include ('connection.php');
session_start();

// Insert user logout details into userlog table
if(isset($_SESSION['login']) && isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['id'];
    $lname = $_SESSION['Lname'];
    $fname = $_SESSION['Fname'];
    mysqli_query($conn, "INSERT INTO userlog (username, user_date, userid, Lname, Fname, am_pm, actions) VALUES ('$username', DATE_FORMAT(CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'), '%Y-%m-%d %h:%i:%s'), '$userid', '$lname', '$fname', DATE_FORMAT(CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'), '%p'), 'LOGGED OUT')") or die(mysqli_error($conn));

}

// Clear session data
session_unset();
session_destroy();

// Set cache headers
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to login page
header("Location: index.php");
exit;
?>
