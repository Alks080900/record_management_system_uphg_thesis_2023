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
	<title>Edit Student</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="/Capstone/css/scrollbar.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
	<link href="/Capstone/css/editstudent.css" rel="stylesheet">
</head>
<body class="square scrollbar-dusty-grass square thin">
<?php
include ('header.php');
?>
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
$table = "shsstud";

// Execute a SELECT statement to retrieve data for the specified student
$sql = "SELECT * FROM $table WHERE ID='$ID'";
$result = $conn->query($sql);

// Check if a row was returned
if ($result->num_rows == 1) {
	// Fetch the row and store the values in variables
	$row = $result->fetch_assoc();
	$Stud_ID = $row['Stud_ID'];
  $Lastname = $row['Lastname'];
  $Firstname = $row['Firstname'];
  $Middlename = $row['Middlename'];
  $Extensionname = $row['Extensionname'];
  $Gender = $row['Gender'];
  $Nationality = $row['Nationality'];
  $DoB = $row['DoB'];
  $PoB = $row['PoB'];
  $ContactNumber = $row['ContactNumber'];
  $Strand = $row['Strand'];
  $Email = $row['Email'];
  $Perm_Address = $row['Perm_Address'];
  $PSA= $row['PSA'];
  $Form138= $row['Form138'];
  $Form137= $row['Form137'];
  $Picture= $row['Picture'];
  $MOA= $row['MOA'];
  $Year= $row['Year'];
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

  date_default_timezone_set('Asia/Manila');
  $now_date = date('Y-m-d H:i:s');
  $now_ampm = date('A');
  // Prepare the SQL statement to update student data
$sql = "UPDATE shsstud SET Stud_ID=?, Lastname=?, Firstname=?, Middlename=?, Extensionname=?, Gender=?, Nationality=?, DoB=?, PoB=?, ContactNumber=?, Strand=?, Email=?, Perm_Address=?, Year=?, user_date=DATE_FORMAT(?, '%Y-%m-%d %h:%i:%s %p'), am_pm=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssi", $Stud_ID, $Lastname, $Firstname, $Middlename, $Extensionname, $Gender, $Nationality, $DoB, $PoB, $ContactNumber, $Strand, $Email, $Perm_Address, $Year, $now_date, $now_ampm, $id);

  // Get the form data
  $Stud_ID = mysqli_real_escape_string($conn, $_POST['Stud_ID']);
    $Lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
    $Firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
    $Middlename = mysqli_real_escape_string($conn, $_POST['Middlename']);
    $Extensionname = mysqli_real_escape_string($conn, $_POST['Extensionname']);
    $Gender = mysqli_real_escape_string($conn, $_POST['Gender']);
    $Nationality = mysqli_real_escape_string($conn, $_POST['Nationality']);
    $DoB = mysqli_real_escape_string($conn, $_POST['DoB']);
    $PoB = mysqli_real_escape_string($conn, $_POST['PoB']);
    $ContactNumber = mysqli_real_escape_string($conn, $_POST['ContactNumber']);
    $Strand = mysqli_real_escape_string($conn, $_POST['Strand']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Perm_Address = mysqli_real_escape_string($conn, $_POST['Perm_Address']);
    $Year = mysqli_real_escape_string($conn, $_POST['Year']);

     // Initialize an array to store the updated files
$updatedFiles = [];

// Check if PSA is updated
if (isset($_FILES["PSA"]) && $_FILES["PSA"]["name"] != "") {
  array_push($updatedFiles, "PSA");
}

// Check if Form138 is updated
if (isset($_FILES["Form138"]) && $_FILES["Form138"]["name"] != "") {
  array_push($updatedFiles, "FORM138");
}

// Check if Form137 is updated
if (isset($_FILES["Form137"]) && $_FILES["Form137"]["name"] != "") {
  array_push($updatedFiles, "FORM137");
}

// Check if Picture is updated
if (isset($_FILES["Picture"]) && $_FILES["Picture"]["name"] != "") {
  array_push($updatedFiles, "PICTURE");
}

// Check if MOA is updated
if (isset($_FILES["MOA"]) && $_FILES["MOA"]["name"] != "") {
  array_push($updatedFiles, "MOA");
}

// Construct the update action message
if (!empty($updatedFiles)) {
  $updatedFilesStr = implode(", ", $updatedFiles);
  $action = "UPDATED THE $updatedFilesStr OF $Firstname $Lastname IN SHS";
} else {
  $action = "UPDATED $Firstname $Lastname IN SHS";
}

// Insert user log details into userlog table
if (isset($_SESSION['login'])) {
  $username = $_SESSION['username'];
  $userid = $_SESSION['id'];
  $lname = $_SESSION['Lname'];
  $fname = $_SESSION['Fname'];
  mysqli_query($conn, "INSERT INTO userlog (username, user_date, userid, Lname, Fname, am_pm, actions) VALUES ('$username', DATE_FORMAT(CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'), '%Y-%m-%d %h:%i:%s'), '$userid', '$lname', '$fname', DATE_FORMAT(CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'), '%p'), '$action')") or die(mysqli_error($conn));
}

  // Execute the SQL statement to update user data
  if ($stmt->execute()) {
    $ID = $_GET['id'];
    $url = "/Capstone/searchstudent.php";
    echo '<script type="text/javascript">';
    echo 'swal("SUCCESS","User has been updated! Redirecting you...","success");';
    echo "setTimeout(function () { window.location = '$url'; }, 5000);"; // add the redirection inside the setTimeout
    echo '</script>';
  }
  
  else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("ERROR","Something went wrong!","error");';
    echo '}, 1000);</script>';
  }

 // Update the uploaded files (if any)
if (isset($_FILES["PSA"]) && $_FILES["PSA"]["name"] != "") {
  $lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
  $firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['Middlename']);
  $Stud_ID = mysqli_real_escape_string($conn, $_POST['Stud_ID']);
  $extensionname = mysqli_real_escape_string($conn, $_POST['Extensionname']);$filename = $_FILES["PSA"]["name"];
  $filetype = $_FILES["PSA"]["type"];
  $filesize = $_FILES["PSA"]["size"];
  $filetemp = $_FILES["PSA"]["tmp_name"];
  if ($filetype == "application/pdf") {
    // Check if the user has an existing file
    $sql = "SELECT * FROM shsstud WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row["PSA"] != "") {
      unlink("C:/xampp/htdocs/Capstone/uploads/SHS/PSA/" . $row["PSA"]); // Delete the existing file
    }
    // Insert the new file
    $newfilename = $Stud_ID . ".pdf";
    move_uploaded_file($filetemp, "C:/xampp/htdocs/Capstone/uploads/SHS/PSA/" . $newfilename);
    $timestamp = date('Y-m-d H:i:s');
    $am_pm = date('A');
    $sql = "UPDATE shsstud SET PSA=?, user_date=DATE_FORMAT(?, '%Y-%m-%d %h:%i:%s %p'), am_pm=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $newfilename, $timestamp, $am_pm, $ID);

    if ($stmt->execute()) {
      $ID = $_GET['id'];
      $url = "/Capstone/searchstudent.php";
      echo '<script type="text/javascript">';
      echo 'swal("SUCCESS","User has been updated! Redirecting you...","success");';
      echo "setTimeout(function () { window.location = '$url'; }, 5000);"; // add the redirection inside the setTimeout
      echo '</script>';
    }
  
  else {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("ERROR","Something went wrong!","error");';
      echo '}, 1000);</script>';
    }
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("ERROR","Invalid file type!","error");';
    echo '}, 1000);</script>';
  }
  }

    // Update the uploaded files (if any)
if (isset($_FILES["Form138"]) && $_FILES["Form138"]["name"] != "") {
  $lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
  $firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['Middlename']);
  $Stud_ID = mysqli_real_escape_string($conn, $_POST['Stud_ID']);
  $extensionname = mysqli_real_escape_string($conn, $_POST['Extensionname']);$filename = $_FILES["Form138"]["name"];
  $filetype = $_FILES["Form138"]["type"];
  $filesize = $_FILES["Form138"]["size"];
  $filetemp = $_FILES["Form138"]["tmp_name"];
  if ($filetype == "application/pdf") {
    // Check if the user has an existing file
    $sql = "SELECT * FROM shsstud WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row["Form138"] != "") {
      unlink("C:/xampp/htdocs/Capstone/uploads/SHS/Form138/" . $row["Form138"]); // Delete the existing file
    }
    // Insert the new file
    $newfilename = $Stud_ID . ".pdf";
    move_uploaded_file($filetemp, "C:/xampp/htdocs/Capstone/uploads/SHS/Form138/" . $newfilename);
    $timestamp = date('Y-m-d H:i:s');
    $am_pm = date('A');
    $sql = "UPDATE shsstud SET Form138=?, user_date=DATE_FORMAT(?, '%Y-%m-%d %h:%i:%s %p'), am_pm=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $newfilename, $timestamp, $am_pm, $ID);

    if ($stmt->execute()) {
      $ID = $_GET['id'];
      $url = "/Capstone/searchstudent.php";
      echo '<script type="text/javascript">';
      echo 'swal("SUCCESS","User has been updated! Redirecting you...","success");';
      echo "setTimeout(function () { window.location = '$url'; }, 5000);"; // add the redirection inside the setTimeout
      echo '</script>';
    }
  
  else {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("ERROR","Something went wrong!","error");';
      echo '}, 1000);</script>';
    }
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("ERROR","Invalid file type!","error");';
    echo '}, 1000);</script>';
  }
  }
    
  if (isset($_FILES["Form137"]) && $_FILES["Form137"]["name"] != "") {
    $lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['Middlename']);
    $Stud_ID = mysqli_real_escape_string($conn, $_POST['Stud_ID']);
    $extensionname = mysqli_real_escape_string($conn, $_POST['Extensionname']);
    $filename = $_FILES["Form137"]["name"];
    $filetype = $_FILES["Form137"]["type"];
    $filesize = $_FILES["Form137"]["size"];
    $filetemp = $_FILES["Form137"]["tmp_name"];
    if ($filetype == "application/pdf") {
      // Check if the user has an existing file
      $sql = "SELECT * FROM shsstud WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      if ($row["Form137"] != "") {
        unlink("C:/xampp/htdocs/Capstone/uploads/SHS/Form137/" . $row["Form137"]); // Delete the existing file
      }
      // Insert the new file
      $newfilename = $Stud_ID . ".pdf";
      move_uploaded_file($filetemp, "C:/xampp/htdocs/Capstone/uploads/SHS/Form137/" . $newfilename);
      $timestamp = date('Y-m-d H:i:s');
    $am_pm = date('A');
    $sql = "UPDATE shsstud SET Form137=?, user_date=DATE_FORMAT(?, '%Y-%m-%d %h:%i:%s %p'), am_pm=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $newfilename, $timestamp, $am_pm, $ID);
      if ($stmt->execute()) {
        $ID = $_GET['id'];
        $url = "/Capstone/searchstudent.php";
        echo '<script type="text/javascript">';
        echo 'swal("SUCCESS","User has been updated! Redirecting you...","success");';
        echo "setTimeout(function () { window.location = '$url'; }, 5000);"; // add the redirection inside the setTimeout
        echo '</script>';
      }
      
      else {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("ERROR","Something went wrong!","error");';
        echo '}, 1000);</script>';
      }
    } else {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("ERROR","Invalid file type!","error");';
      echo '}, 1000);</script>';
    }
  }
  
    
  if (isset($_FILES["Picture"]) && $_FILES["Picture"]["name"] != "") {
    $lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['Middlename']);
    $Stud_ID = mysqli_real_escape_string($conn, $_POST['Stud_ID']);
    $extensionname = mysqli_real_escape_string($conn, $_POST['Extensionname']);
    $filename = $_FILES["Picture"]["name"];
    $filetype = $_FILES["Picture"]["type"];
    $filesize = $_FILES["Picture"]["size"];
    $filetemp = $_FILES["Picture"]["tmp_name"];
    if ($filetype == "image/jpeg") {
      // Check if the user has an existing file
      $sql = "SELECT * FROM shsstud WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      if ($row["Picture"] != "") {
        unlink("C:/xampp/htdocs/Capstone/uploads/SHS/Picture/" . $row["Picture"]); // Delete the existing file
      }
      // Insert the new file
      $newfilename = $Stud_ID . ".jpeg";
      move_uploaded_file($filetemp, "C:/xampp/htdocs/Capstone/uploads/SHS/Picture/" . $newfilename);
      $timestamp = date('Y-m-d H:i:s');
    $am_pm = date('A');
    $sql = "UPDATE shsstud SET Picture=?, user_date=DATE_FORMAT(?, '%Y-%m-%d %h:%i:%s %p'), am_pm=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $newfilename, $timestamp, $am_pm, $ID);
      if ($stmt->execute()) {
        $ID = $_GET['id'];
        $url = "/Capstone/searchstudent.php";
        echo '<script type="text/javascript">';
        echo 'swal("SUCCESS","User has been updated! Redirecting you...","success");';
        echo "setTimeout(function () { window.location = '$url'; }, 5000);"; // add the redirection inside the setTimeout
        echo '</script>';
      }
      
      else {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("ERROR","Something went wrong!","error");';
        echo '}, 1000);</script>';
      }
    } else {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("ERROR","Invalid file type!","error");';
      echo '}, 1000);</script>';
    }
  }

    // Update the uploaded files (if any)
if (isset($_FILES["MOA"]) && $_FILES["MOA"]["name"] != "") {
  $lastname = mysqli_real_escape_string($conn, $_POST['Lastname']);
  $firstname = mysqli_real_escape_string($conn, $_POST['Firstname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['Middlename']);
  $Stud_ID = mysqli_real_escape_string($conn, $_POST['Stud_ID']);
  $extensionname = mysqli_real_escape_string($conn, $_POST['Extensionname']);$filename = $_FILES["MOA"]["name"];
  $filetype = $_FILES["MOA"]["type"];
  $filesize = $_FILES["MOA"]["size"];
  $filetemp = $_FILES["MOA"]["tmp_name"];
  if ($filetype == "application/pdf") {
    // Check if the user has an existing file
    $sql = "SELECT * FROM shsstud WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row["MOA"] != "") {
      unlink("C:/xampp/htdocs/Capstone/uploads/SHS/MOA/" . $row["MOA"]); // Delete the existing file
    }
    // Insert the new file
    $newfilename = $Stud_ID . ".pdf";
    move_uploaded_file($filetemp, "C:/xampp/htdocs/Capstone/uploads/SHS/MOA/" . $newfilename);
    $timestamp = date('Y-m-d H:i:s');
    $am_pm = date('A');
    $sql = "UPDATE shsstud SET MOA=?, user_date=DATE_FORMAT(?, '%Y-%m-%d %h:%i:%s %p'), am_pm=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $newfilename, $timestamp, $am_pm, $ID);

    if ($stmt->execute()) {
      $ID = $_GET['id'];
      $url = "/Capstone/searchstudent.php";
      echo '<script type="text/javascript">';
      echo 'swal("SUCCESS","User has been updated! Redirecting you...","success");';
      echo "setTimeout(function () { window.location = '$url'; }, 5000);"; // add the redirection inside the setTimeout
      echo '</script>';
    }
  
  else {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal("ERROR","Something went wrong!","error");';
      echo '}, 1000);</script>';
    }
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("ERROR","Invalid file type!","error");';
    echo '}, 1000);</script>';
  }
  }
}
?>
<!-- END OF PHP CODE -->

<div class="container">
<div id="img-container"></div>

	<h2>SHS Update Student Form <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="position: absolute; margin-left: 10px;" id="EDIT"><i class="bi bi-pencil-fill" style="margin-right: 10px;"></i>Edit</button></h2> 
    <br>
    <h6>(*) Required Field</h6>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $ID; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group col-lg-3">
          <label class="required" for="student">Student ID</label>
          <input type="text" class="form-control" id="studentID" placeholder="Student ID" name="Stud_ID" value="<?php echo $Stud_ID; ?>">
        </div>
        <br>
        <div class="row">
        <div class="form-group col-lg-3">
            <label class="required" for="lastname">Last Name</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="LName" placeholder="Last Name" name="Lastname" value="<?php echo $Lastname; ?>" >
          </div>
        <div class="form-group col-lg-3">
          <label class="required" for="firstname">First Name</label>
          <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="FName" placeholder="First Name" name="Firstname" value="<?php echo $Firstname; ?>" >
        </div>
        <div class="form-group col-lg-3">
            <label class="" for="MiddleIni">Middle Name</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="MName" placeholder="Middle Name" name="Middlename" value="<?php echo $Middlename; ?>" >
          </div>
          <div class="form-group col-lg-3">
            <label class="" for="extentionname">Extension Name</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="EName" placeholder="Extension Name" name="Extensionname" value="<?php echo $Extensionname; ?>" >
          </div>
          <div class="form-group col-lg-3">
          <label class="required" for="birthday">Date of Birth</label>
          <input type="date"  class="form-control" id="birthday" name="DoB" value="<?php echo $DoB; ?>" >
          </div>
          <div class="form-group col-lg-6">
            <label class="required" for="permament">Place of Birth</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="Placeofbirth" placeholder="Place of Birth" name="PoB" value="<?php echo $PoB; ?>" >
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="extentionname">Gender</label>
            <select class="form-control form-select" id="gender" name="Gender" >
                <option selected value="<?php echo $Gender; ?>"><?php echo $Gender; ?></option>
                <option value="Rather not say">Rather not say</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
          </div>
          <div class="form-group col-lg-9">
            <label class="required" for="permament">Permanent Address</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="permanentaddress" placeholder="Permanent Address" name="Perm_Address" value="<?php echo $Perm_Address; ?>" >
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="nation">Nationality</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="nattion" placeholder="Nationality" name="Nationality" value="<?php echo $Nationality; ?>" >
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="email">Email Address</label>
            <input type="email" class="form-control" id="email" placeholder="Email Address" name="Email" value="<?php echo $Email; ?>" >
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="contactnum">Contact Number</label>
            <input type="text" class="form-control" id="contatcnum" placeholder="Contact Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength = "11" name="ContactNumber" value="<?php echo $ContactNumber; ?>" >
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="college">Strand</label>
            <select class="form-control form-select" class="course1" name="Strand" id="course123" style="margin-top:15px;">
            <option value="<?php echo $Strand; ?>"><?php echo $Strand; ?></option>
            <option value="">Choose</option>
            <option value="Accountacy & Business Management (ABM)">Accountacy & Business Management (ABM)</option>
            <option value="Science, Technology,Engineering & Mathematics (STEM)">Science, Technology,Engineering & Mathematics (STEM)</option>
            <option value="Humanities and Social Science (HUMSS)">Humanities and Social Science (HUMSS)</option>
            <option value="General Academics (GAS)">General Academics (GAS)</option>
            <option value="Computer System Servicing (ICT)">Computer System Servicing (ICT)</option>
            <option value="Home Economics (HE)">Home Economics (HE)</option>
            <option value="Arts and Design (A&D)">Arts and Design (A&D)</option>
              </select>
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="college">Year</label>
            <select class="form-control form-select" style="margin-top:15px;" name="Year" id="year-select"></select>
          </div>
    </div>
    <br>
     <hr style="height:2px;border-width:0;color:gray;background-color:gray">
     <h2>Update Requirements</h2>
     <div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="custom-file">
        <?php if ($PSA): ?>
          <label>PSA/NSO</label>
          <a href="/Capstone/uploads/SHS/PSA/<?php echo $PSA; ?>" target="_blank"><?php echo $PSA; ?></a>
        <?php else: ?>
          <label class="text-danger">PSA/NSO (NO FILE UPLOADED)</label>
        <?php endif; ?>
        <input class="avatar" type="file" name="PSA" accept=".pdf">
      </div>
    </div>
    <div class="col-md-4">
      <div class="custom-file">
        <?php if ($Form138): ?>
          <label>Form138</label>
          <a href="/Capstone/uploads/SHS/Form138/<?php echo $Form138; ?>" target="_blank"><?php echo $Form138; ?></a>
        <?php else: ?>
          <label class="text-danger">Form138 (NO FILE UPLOADED)</label>
        <?php endif; ?>
        <input class="avatar" type="file" name="Form138" accept=".pdf">
      </div>
    </div>
    <div class="col-md-4">
      <div class="custom-file">
        <?php if ($Form137): ?>
          <label>FORM 137</label>
          <a href="/Capstone/uploads/SHS/Form137/<?php echo $Form137; ?>" target="_blank"><?php echo $Form137; ?></a>
        <?php else: ?>
          <label class="text-danger">FORM 137 (NO FILE UPLOADED)</label>
        <?php endif; ?>
        <input class="avatar" type="file" name="Form137" accept=".pdf">
      </div>
    </div>
    <div class="col-md-4">
      <div class="custom-file">
        <?php if ($Picture): ?>
          <label>2x2 PICTURE</label>
          <a href="/Capstone/uploads/SHS/Picture/<?php echo $Picture; ?>" target="_blank"><?php echo $Picture; ?></a>
        <?php else: ?>
          <label class="text-danger">2x2 PICTURE (NO FILE UPLOADED)</label>
        <?php endif; ?>
        <input class="alex1" type="file" name="Picture" accept=".jpg" id="myFile">
      </div>
    </div>
    <div class="col-md-4">
      <div class="custom-file">
        <?php if ($MOA): ?>
          <label>MOA</label>
          <a href="/Capstone/uploads/SHS/MOA/<?php echo $MOA; ?>" target="_blank"><?php echo $MOA; ?></a>
        <?php else: ?>
          <label class="text-danger">MOA (NO FILE UPLOADED)</label>
        <?php endif; ?>
        <input class="avatar" type="file" name="MOA" accept=".pdf">
      </div>
    </div>
  </div>
</div>
<div class="container mt-3">
      <button type="submit" class="btn btn-primary" id="cancel"><i class="bi bi-x-lg" style="margin-right: 5px;"></i>Cancel</button>
      <button type="submit" class="btn btn-primary" id="save"><i class="bi bi-check" style="margin-right: 10px;"></i>Save</button>
</div>
</div>
<br><br>
</form>
      </div>
      </div>
      <script>
    let img = new Image();
    img.height = 200;
    img.width = 200;
    img.onerror = function() {
        document.getElementById("img-container").innerHTML = '<img src="/Capstone/img/nopicture.jpg" class="rounded float-end" style="height: 200px; width: 200px; float: right;" alt="...">';
    };
    img.src = "/Capstone/uploads/SHS/Picture/<?php echo $Picture; ?>";
    img.style.float = "right";
    img.classList.add("rounded", "float-end");
    document.getElementById("img-container").appendChild(img);
</script>
<!-- SCRIPT FOR ENABLE/DISABLE FORM -->
<script>
  // Wait for the page to finish loading
  window.addEventListener('load', function () {

    // Disable the "Choose File" button
    const fileInputs = document.querySelectorAll('.avatar, .alex1');
    fileInputs.forEach(function(fileInput) {
      fileInput.disabled = true;
    });

    // Disable select elements with IDs select1, select2, and select3
    const select1 = document.querySelector('#gender');
    const select2 = document.querySelector('#course123');
    const select3 = document.querySelector('#cancel');
    const select4 = document.querySelector('#save');
    const select5 = document.querySelector('#year-select');
    select1.disabled = true;
    select2.disabled = true;
    select3.disabled = true;
    select4.disabled = true;
    select5.disabled = true;

    // Make all text inputs and select elements readonly
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="date"], select:not(#gender):not(#course123):not(#cancel):not(#save)');
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

        // Enable the "Choose File" button
        fileInputs.forEach(function(fileInput) {
          fileInput.disabled = false;
        });

        // Enable select elements with IDs select1, select2, and select3
        select1.disabled = false;
        select2.disabled = false;
        select3.disabled = false;
        select4.disabled = false;
        select5.disabled = false;

        // Make all text inputs and select elements editable
        inputs.forEach(function (input) {
          input.readOnly = false;
        });
      } else {
        // Switch to "Locked" mode
        editButton.innerHTML = '<i class="fas fa-lock"></i> Locked';
        editButton.classList.remove('btn-primary');
        editButton.classList.add('btn-danger');

        // Disable the "Choose File" button
        fileInputs.forEach(function(fileInput) {
          fileInput.disabled = true;
        });

        // Disable select elements with IDs select1, select2, and select3
        select1.disabled = true;
        select2.disabled = true;
        select3.disabled = true;
        select4.disabled = true;
        select5.disabled = true;

        // Make all text inputs and select elements readonly
        inputs.forEach(function (input) {
          input.readOnly = true;
        });
      }
    });

    // Unlock all elements when the page first loads
    editButton.click();
  });
</script>
<!-- END OF SCRIPT -->

<!-- SCRIPT FOR VALIDATION OF FILE -->
<script>
  // Get the input file element with the ID "myFile"
  const myFile = document.getElementById("myFile");
  
  // Add an event listener to the input file element
  myFile.addEventListener("change", function() {
    // Get the file type of the selected file
    const fileType = myFile.files[0].type;
    
    // Check if the file type is not a JPEG
    if (fileType !== "image/jpeg") {
      // Show a SweetAlert with an error message
      swal("Error", "JPEG files are only allowed!", "error");
      
      // Clear the selected file
      myFile.value = "";
    }
  });

  // Get all the input file elements with the class "avatar"
  const avatarFiles = document.querySelectorAll(".avatar");

  // Loop through all the input file elements
  avatarFiles.forEach(function(avatarFile) {
    // Add an event listener to each input file element
    avatarFile.addEventListener("change", function() {
      // Get the file type of the selected file
      const fileType = avatarFile.files[0].type;

      // Check if the file type is not a PDF
      if (fileType !== "application/pdf") {
        // Show a SweetAlert with an error message
        swal("Error", "PDF files are only allowed!", "error");

        // Clear the selected file
        avatarFile.value = "";
      }
    });
  });
</script>
<!-- END OF SCRIPT -->
<script>
  // Get the current year
  const currentYear = new Date().getFullYear();

  // Set the year range for the dropdown
  const yearRange = 20; // Change this value to adjust the range of years displayed

  // Calculate the first and last years in the range
  const firstYear = currentYear - Math.floor(yearRange / 2);
  const lastYear = firstYear + yearRange - 1;

  // Create the dropdown options
  const select = document.getElementById("year-select");

  for (let year = lastYear; year >= firstYear; year--) {
    const option = document.createElement("option");
    option.value = year;
    option.text = year;
    select.add(option);
  }

  // Select the current year in the dropdown
  select.value = currentYear;

  // Select the year saved in the database, if any
  select.value = "<?php echo $Year; ?>";
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
</style>
</body>
</html>