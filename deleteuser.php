<?php
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

// Get the ID of the user to update
$id = $_GET['id'];

// Update the user's status to 0
$sql = "DELETE FROM accounts WHERE ID=" . $id;

if ($conn->query($sql) === TRUE) {
    // Redirect to the users page with a success message
    header("Location: adminlogin.php?status=success");
    exit();
} else {
    // Redirect to the users page with an error message
    header("Location: adminlogin.php?status=error");
    exit();
}

// Close the database connection
$conn->close();
?>