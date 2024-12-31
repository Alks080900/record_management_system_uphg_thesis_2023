<?php
include_once 'connection.php';
session_start();
if(!$_SESSION['login']){
   header("location:index.php");
   die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Contact</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link href="/Capstone/css/contact.css" rel="stylesheet">
</head>
<body>
<?php
include ('header.php');
?>
<br>
<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_rms";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Get the ID of the student to edit from the query string
$ID = $_GET['id'];

// Define the table name
$table = "collegestud";

// Execute a SELECT statement to retrieve data for the specified student
$sql = "SELECT * FROM $table WHERE ID='$ID'";
$result = $conn->query($sql);

// Check if a row was returned
if ($result->num_rows == 1) {
	// Fetch the row and store the values in variables
	$row = $result->fetch_assoc();
  $Email = $row['Email'];
} else {
	// If no row was returned, display an error message
	echo "Error: No data found";
	exit;
}
?>
<!-- END OF RETRIEVE DATA CODE -->

<?php
// Include PHPMailer library files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Capstone\src\Exception.php';
require 'C:\xampp\htdocs\Capstone\src\PHPMailer.php';
require 'C:\xampp\htdocs\Capstone\src\SMTP.php';

// Set reCAPTCHA API keys
$site_key = '6Lc4nbgkAAAAAOz6DtmicAbaJ2r57-yAaViCe1Aq';
$secret_key = '6Lc4nbgkAAAAAK0bXSGwPpnIzcP4iNxW3dqD7SkF';

// Create a new PHPMailer object
$mail = new PHPMailer();

// Set PHPMailer to use SMTP
$mail->isSMTP();

// Configure SMTP settings
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;          // Enable SMTP authentication
$mail->Username = ''; // SMTP username
$mail->Password = ''; // SMTP password
$mail->SMTPSecure = 'tls';       // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;               // TCP port to connect to

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Set email details
    $recipientEmail = $_POST['recipientEmail'];
    $emailSubject = $_POST['topic'];
    $emailBody = $_POST['message'];

    $mail->setFrom('your_email', 'UPHS-GMA || REGISTRAR');
    $mail->addAddress($recipientEmail);     // Add a recipient
    $mail->Subject = $emailSubject;
    $mail->Body    = $emailBody;

    // Send the email and check for errors
    if (!$mail->send()) {
        echo '<script type="text/javascript">';
        echo 'swal("ERROR","Mailer Error: '.$mail->ErrorInfo.'","error");';
        echo '</script>';
    } else {
        $url = "/Capstone/searchstudent.php";
        echo '<script type="text/javascript">';
        echo 'swal("SUCCESS","Email sent successfully! Redirecting you...","success");';
        echo "setTimeout(function () { window.location = '$url'; }, 5000);"; // add the redirection inside the setTimeout
        echo '</script>';
    }
}
?>
<br>
<div class="container">
  <div class="form-container">
    <h2>SEND EMAIL</h2>
    <form action="" method="POST">
      <div class="form-group">
        <label for="recipientEmail">Recipient Email</label>
        <input type="email" id="recipientEmail" name="recipientEmail" value="<?php echo $Email; ?>" class="form-control" readonly>
      </div>
      <br>
      <div class="form-group">
        <label for="topic">Topic</label>
        <input type="text" id="topic" name="topic" class="form-control" required>
      </div>
      <br>
      <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" class="form-control" required></textarea>
      </div>
      <br>
      <br>
      <button type="submit" id="submit-button" class="btn btn-primary" >Send Email</button>
    </form>
  </div>
</div>
<script type="text/javascript">
      function callback() {
        const submitButton = document.getElementById("submit-button");
        submitButton.removeAttribute("disabled");
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" ></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<?php
include ('footer.php');
?>
</body>
</html>
