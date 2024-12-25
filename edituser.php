<?php 
session_start();
if(!$_SESSION['loginadmin']){
   header("location:index.php");
   die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit User</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link href="/Capstone/css/editstudent.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
			<img src="/Capstone/img/nav.png" class="navvy" href="homepage.php">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="adminlogin.php" id="homess">Home</a>
					</li>
          <li class="nav-item">
						<a class="nav-link" href="dbm.php" id="amongus">Database Management</a>
					</li>
          
                </ul>  
            </div>
                    <ul>
                    <li class="dropdown" id="imggg">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['Lname']?><img src="/Capstone/img/Profile Icon.png" alt="" class="imgg"> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="homepage.php">Employee Panel</a></li>
                          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                      </li>
                    </ul>
	</nav>
<hr class="liness">
<br>
<br>
<br>
<br>
<!-- RETRIEVE DATA PHP CODE -->

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
$table = "accounts";

// Execute a SELECT statement to retrieve data for the specified student
$sql = "SELECT * FROM $table WHERE ID='$ID'";
$result = $conn->query($sql);

// Check if a row was returned
if ($result->num_rows == 1) {
	// Fetch the row and store the values in variables
	$row = $result->fetch_assoc();
  $Lname = $row['Lname'];
  $Fname = $row['Fname'];
  $Mname = $row['Mname'];
  $Ename = $row['Ename'];
  $Uname = $row['Uname'];
  $Pword = $row['Pword'];
  $user_type = $row['user_type'];
} else {
	// If no row was returned, display an error message
	echo "Error: No data found";
	exit;
}
?>
<!-- END OF RETRIEVE DATA CODE -->
<!-- PHP CODE FOR UPDATE USERDATA / UPLOADED FILES -->
<?php
// Check if the form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "db_rms";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get the user id from the URL
  $id = $_GET["id"];

  // Prepare the SQL statement to update student data
$sql = "UPDATE accounts SET Lname=?, Fname=?, Mname=?, Ename=?, Uname=?, Pword=?, user_type=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssi", $Lname, $Fname, $Mname, $Ename, $Uname, $Pword, $user_type, $id);

  // Get the form data
    $Lname = mysqli_real_escape_string($conn, $_POST['Lname']);
    $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $Mname = mysqli_real_escape_string($conn, $_POST['Mname']);
    $Ename = mysqli_real_escape_string($conn, $_POST['Ename']);
    $Uname = mysqli_real_escape_string($conn, $_POST['Uname']);
    $Pword = mysqli_real_escape_string($conn, $_POST['Pword']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);


// Execute the SQL statement to update user data
if ($stmt->execute()) {
  $ID = $_GET['id'];
  $url = "/Capstone/adminlogin.php";
  echo '<script type="text/javascript">';
  echo 'swal("SUCCESS","Account has been updated! Redirecting you...","success");';
  echo "setTimeout(function () { window.location = '$url'; }, 5000);"; // add the redirection inside the setTimeout
  echo '</script>';
  
}

else {
  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("ERROR","Something went wrong!","error");';
  echo '}, 1000);</script>';
  
}
}
    ?>
<div class="container">
	<h2 data-aos="fade-up">Edit Account<button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="position: absolute; margin-left: 25px;" id="EDIT"><i class="bi bi-pencil-fill" style="margin-right: 10px;"></i>Edit</button></h2>
	<br>
    <h6 data-aos="fade-up">(*) Required Field</h6>
    <br>
    <form method="post" enctype="multipart/form-data">
        <div class="row" data-aos="fade-up"  data-aos-delay="400">
            <div class="form-group col-lg-3">
                <label class="required" for="lastname">Last Name</label>
                <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="LName" placeholder="Last Name" name="Lname" value="<?php echo $Lname; ?>" required>
            </div>
            <div class="form-group col-lg-3">
                <label class="required" for="firstname">First Name</label>
                <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="FName" placeholder="First Name" name="Fname" value="<?php echo $Fname; ?>" required>
            </div>
            <div class="form-group col-lg-3">
                <label >Middle Name</label>
                <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="MName" placeholder="Middle Name" name="Mname" value="<?php echo $Mname; ?>">
            </div>
            <div class="form-group col-lg-3">
                <label >Extension Name</label>
                <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="EName" placeholder="Extension Name" name="Ename" value="<?php echo $Ename; ?>">
            </div>
            <div class="form-group col-lg-3">
                <label class="required" for="">Username</label>
                <input type="text"  class="form-control" id="USER" name="Uname" placeholder="Username" value="<?php echo $Uname; ?>" required>
            </div>
            <div class="form-group col-lg-3 position-relative">
    <label class="required" for="">Password</label>
    <div class="input-group">
        <input type="password" class="form-control" id="password" name="Pword" placeholder="******" value="<?php echo $Pword; ?>" 
            required 
            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" />
            <span class="input-group-text mb-5 csss" style="  border: none;
    background-color: white;
    margin-left: 10px;">
                <i class="fa fa-fw fa-eye-slash toggle-password" aria-hidden="true"></i>
            </span>
    </div>
</div>
            <div class="form-group col-lg-3">
                <label class="required">Select Role</label>
                <select class="form-control form-select" id="role" name="user_type" required>
                <option selected value="<?php echo $user_type; ?>">
                <?php 
                  if ($user_type === "user") {
                    echo "Employee";
                  } else if ($user_type === "admin") {
                    echo "Administrator";
                  } else {
                    echo $user_type; // Output the original value if it's not "user" or "admin"
                  }
                ?>
              </option>
                    <option value="admin">Administrator</option>
                    <option value="user">Employee</option>
                </select>
            </div>
        </div>
        <button type="reset" class="btn btn-primary" id="cancel" data-aos="fade-up"  data-aos-delay="900"><i class="bi bi-x-lg" style="margin-right: 5px;"></i>Cancel</button>
         <button type="submit" name="submit" value="Submit" class="btn btn-primary" id="save" data-aos="fade-up"  data-aos-delay="700"><i class="bi bi-check" style="margin-right: 10px;"></i>Save</button>
    </form>
</div>
      </div>
      </div>
      <script>
    // Retrieve all the password <span> elements
    var passwordElements = document.getElementsById("password");

    // Loop through each password element and replace the innerText with 6 asterisks
    for (var i = 0; i < passwordElements.length; i++) {
        passwordElements[i].innerText = "******";
    }
</script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script>
  AOS.init();

  AOS.init();

// You can also pass an optional settings object
// below listed default settings
AOS.init({
  // Global settings:
  disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
  initClassName: 'aos-init', // class applied after initialization
  animatedClassName: 'aos-animate', // class applied on animation
  useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  disableMutationObserver: false, // disables automatic mutations' detections (advanced)
  debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
  throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
  

  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 120, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 800, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: false, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});
</script>

<script>
    // Function to toggle password visibility
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).parents('.input-group').children('input')[0]);
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>

<!-- SCRIPT FOR ENABLE/DISABLE FORM -->
<script>
  // Wait for the page to finish loading
  window.addEventListener('load', function () {

    // Disable select elements with IDs select1, select2, and select3
    const select1 = document.querySelector('#role');
    const select3 = document.querySelector('#cancel');
    const select4 = document.querySelector('#save');
    select1.disabled = true;
    select3.disabled = true;
    select4.disabled = true;

    // Make all text inputs and select elements readonly
    const inputs = document.querySelectorAll('input[type="text"]');
    inputs.forEach(function (input) {
      input.readOnly = true;
    });

    // Make all text inputs and select elements readonly
    const inputss = document.querySelectorAll('input[type="password"]');
    inputs.forEach(function (input) {
      input.readOnly = true;
    });

    // Add a click event listener to the "Edit" button
    const editButton = document.querySelector('#EDIT');
    editButton.addEventListener('click', function () {
      if (editButton.innerText.trim() === "Locked") {
        // Switch to "Edit" mode
        editButton.innerHTML = '<i class="fas fa-edit"></i> Edit';
        editButton.classList.remove('btn-danger');
        editButton.classList.add('btn-primary');

        // Enable select elements with IDs select1, select2, and select3
        select1.disabled = false;
        select3.disabled = false;
        select4.disabled = false;

        // Make all text inputs and select elements editable
        inputs.forEach(function (input) {
          input.readOnly = false;
        });
        inputss.forEach(function (input) {
          input.readOnly = false;
        });
      } else {
        // Switch to "Locked" mode
        editButton.innerHTML = '<i class="fas fa-lock"></i> Locked';
        editButton.classList.remove('btn-primary');
        editButton.classList.add('btn-danger');


        // Disable select elements with IDs select1, select2, and select3
        select1.disabled = true;
        select3.disabled = true;
        select4.disabled = true;

        // Make all text inputs and select elements readonly
        inputs.forEach(function (input) {
          input.readOnly = true;
        });
        inputss.forEach(function (input) {
          input.readOnly = true;
        });
      }
    });

    // Unlock all elements when the page first loads
    editButton.click();
  });
</script>

<?php
include ('footer.php');
?>

<!-- END OF SCRIPT -->
<style>
  #LName, #FName, #MName, #USER, #password, #EName{
    margin-bottom: 50px;
}
#role {
  margin-top:15px;
}
</style>
</body>
</html>