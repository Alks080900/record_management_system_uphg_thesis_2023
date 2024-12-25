<?php
// Start the session
session_start();

// Get the password from the POST data
$password = $_POST["password"];

// Check if the password is correct
if ($password === $_SESSION["Pword"]) {
    echo "true";
} else {
    echo "false";
}
?>
