<?php
include_once 'connection.php';
session_start();
$ID= $_SESSION["id"];
$sql=mysqli_query($conn,"SELECT * FROM accounts where Id='$ID' ");
$row  = mysqli_fetch_array($sql);
if(!$_SESSION['login']){
   header("location:index.php");
   die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Student Management College</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="/Capstone/css/studentmanagement.css" rel="stylesheet">
  <link href="/Capstone/css/scrollbar.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="square scrollbar-dusty-grass square thin">
<?php
include ('header.php');
?>
<br>
<div class="container">
	<h2>College Add Student Form</h2>
	<br>
    <h6>(*) Required Field</h6>
    <br>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group col-lg-3">
          <label class="required" for="student">Student ID</label>
          <input type="text" class="form-control" id="studentID" placeholder="Student ID" name="Stud_ID" required>
        </div>
        <br>
        <div class="row">
        <div class="form-group col-lg-3">
            <label class="required" for="lastname">Last Name</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="LName" placeholder="Last Name" name="Lastname" required>
          </div>
        <div class="form-group col-lg-3">
          <label class="required" for="firstname">First Name</label>
          <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="FName" placeholder="First Name" name="Firstname" required>
        </div>
        <div class="form-group col-lg-3">
            <label >Middle Name</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="MName" placeholder="Middle Name" name="Middlename">
          </div>
          <div class="form-group col-lg-3">
            <label >Extension Name</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="EName" placeholder="Extension Name" name="Extensionname">
          </div>
          <div class="form-group col-lg-3">
          <label class="required" for="birthday">Date of Birth</label>
          <input type="date"  class="form-control" id="birthday" name="DoB" required>
          </div>
          <div class="form-group col-lg-6">
            <label class="required" for="permament">Place of Birth</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="Placeofbirth" placeholder="Place of Birth" name="PoB" required>
          </div>
          <div class="form-group col-lg-3">
            <label class="required">Gender</label>
            <select class="form-control form-select" id="gender" name="Gender" required>
            <option value="">Choose</option>
                <option value="Rather not say">Rather not say</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
          </div>
          <div class="form-group col-lg-9">
            <label class="required" for="permament">Permanent Address</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="permanentaddress" placeholder="Permanent Address" name="Perm_Address" required>
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="nation">Nationality</label>
            <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="nattion" placeholder="Nationality" name="Nationality" required>
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="email">Email Address</label>
            <input type="email" class="form-control" id="email" placeholder="Email Address" name="Email" required>
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="contactnum">Contact Number</label>
            <input type="text" class="form-control" id="contatcnum" placeholder="Contact Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength = "11" name="ContactNumber" required>
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="college">Course</label>
            <select class="form-control form-select" class="course1" name="Course" style="margin-top:15px;"required>
            <option value="">Choose</option>
            <option value = "BS Information Technology">BS Information Technology</option>
            <option value = "BS Computer Science">BS Computer Science</option>
            <option value = "BS Civil Engineering">BS Civil Engineering</option>
            <option value = "BS Industrial Engineering">BS Industrial Engineering</option>
            <option value = "BS Computer Engineering">BS Computer Engineering</option>
            <option value = "BS Nursing">BS Nursing</option>
            <option value = "BS Physical Therapy">BS Physical Therapy</option>
            <option value = "BS Accountancy">BS Accountancy</option>
            <option value = "BS Business Administration Major in Marketing Management">BS Business Administration Major in Marketing Management</option>
            <option value = "BS Tourism">BS Tourism</option>
            <option value = "BS Hospitality & Management">BS Hospitality & Management </option>
            <option value = "BS Criminology">BS Criminology</option>
            <option value = "BS Psychology">BS Psychology</option>
            <option value = "AB Psychology">AB Psychology</option>
            <option value = "AB Communication">AB Communication</option>
            <option value = "Bachelor of Secondary Education Major in English">Bachelor of Secondary Education Major in English</option>
            <option value = "Bachelor of Secondary Education Major in Filipino">Bachelor of Secondary Education Major in Filipino</option>
            <option value = "Bachelor of Secondary Education Major in Mathematics">Bachelor of Secondary Education Major in Mathematics</option>
            <option value = "Bachelor of Secondary Education Major in Biological Science">Bachelor of Secondary Education Major in Biological Science</option>
            <option value = "Bachelor of Secondary Education Major in Physical Education">Bachelor of Secondary Education Major in Physical Education</option>
            <option value = "Bachelor of Elementary Education">Bachelor of Elementary Education</option>
              </select>
          </div>
          <div class="form-group col-lg-3">
            <label class="required" for="college">School Year</label>
            <select class="form-control form-select" style="margin-top:15px;" name="Year" id="year-select" required></select>
          </div>
          </div>
    <br>
     <hr style="height:2px;border-width:0;color:gray;background-color:gray">
     <h2>Requirements</h2>
     <div class="container">
        <div class="custom-file">
        <label style="margin-right: 315px;">PSA/NSO</label>
          <input type="file" class="custom-file-input col-lg-8" id="customFile" name="PSA" accept=".pdf">
        </div>
        <div class="custom-file">
        <label style="margin-right: 175px;">FORM 138 (Report Card)</label>
          <input type="file" class="custom-file-input col-lg-8" id="customFile" name="Form138" accept=".pdf">
        </div>
        <div class="custom-file">
            <label style="margin-right: 50px;">FORM 137 (TOR / SHS Perma. Record)</label>
              <input type="file" class="custom-file-input col-lg-8" id="customFile" name="Form137" accept=".pdf">
            </div>
            <div class="custom-file">
                <label style="margin-right: 283px;">2x2 PICTURE</label>
                  <input type="file" class="custom-file-input col-lg-8" id="customFile" name="Picture" accept=".jpg">
                </div>
                <div class="custom-file">
                <label style="margin-right: 356px;">MOA</label>
                  <input type="file" class="custom-file-input col-lg-8" id="customFile" name="MOA" accept=".pdf">
                </div>
                <br><br>
        <button type="reset" class="btn btn-primary" id="cancel"><i class="bi bi-x-lg" style="margin-right: 5px;"></i>Cancel</button>
         <button type="submit" name="submit" value="Submit" class="btn btn-primary" id="save"><i class="bi bi-check" style="margin-right: 10px;"></i>Save</button>
</form>
<?php
include 'connection.php';
// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data and sanitize inputs
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
    $Course = mysqli_real_escape_string($conn, $_POST['Course']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Perm_Address = mysqli_real_escape_string($conn, $_POST['Perm_Address']);
    $Year = mysqli_real_escape_string($conn, $_POST['Year']);

    // File uploads
    $PSA = null;
    $Form138= null;
    $Form137 = null;
    $Picture = null;
    $MOA = null;

    if (!empty($_FILES['PSA']['name'])) {
        $PSA = $_FILES['PSA']['name'];
    }

    if (!empty($_FILES['Form138']['name'])) {
      $Form138 = $_FILES['Form138']['name'];
  }

    if (!empty($_FILES['Form137']['name'])) {
        $Form137 = $_FILES['Form137']['name'];
    }

    if (!empty($_FILES['Picture']['name'])) {
        $Picture = $_FILES['Picture']['name'];
    }

    if (!empty($_FILES['MOA']['name'])) {
      $MOA = $_FILES['MOA']['name'];
  }

    // Check for allowed file types for PSA and Form137
    $allowed_pdf_types = array("application/pdf");
    $pdf_types = array("PSA", "Form137", "Form138", "MOA");
    foreach ($pdf_types as $pdf_type) {
        if (isset($_FILES[$pdf_type]['name']) && !empty($_FILES[$pdf_type]['name']) && !in_array($_FILES[$pdf_type]['type'], $allowed_pdf_types)) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("ERROR!","Please use JPEG for picture and PDF for documents","error");';
            echo '}, 1000);</script>';
            exit();
        }
    }

    // Check for allowed file type for Picture
    $allowed_picture_types = array("image/jpeg");
    if (isset($_FILES["Picture"]) && !empty($_FILES["Picture"]["name"]) && !in_array($_FILES["Picture"]["type"], $allowed_picture_types)) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("ERROR!","Please use JPEG for picture and PDF for documents","error");';
        echo '}, 1000);</script>';
        exit();
    }

    $target_dir_PSA = "C:/xampp/htdocs/Capstone/uploads/College/PSA/";
    $target_dir_Form138 = "C:/xampp/htdocs/Capstone/uploads/College/Form138/";
    $target_dir_Form137 = "C:/xampp/htdocs/Capstone/uploads/College/Form137/";
    $target_dir_Picture = "C:/xampp/htdocs/Capstone/uploads/College/Picture/";
    $target_dir_MOA = "C:/xampp/htdocs/Capstone/uploads/College/MOA/";

    // Rename files based on user's last name (need first and lastname)
    $FullName = $Stud_ID;
    if (!empty($PSA)) {
        $PSA = $FullName . ".pdf";
        $target_file_PSA = $target_dir_PSA . basename($PSA);
        $PSA_path = move_uploaded_file($_FILES["PSA"]["tmp_name"], $target_file_PSA);
        }if (!empty($Form137)) {
          $Form137 = $FullName . ".pdf";
          $target_file_Form137 = $target_dir_Form137 . basename($Form137);
          $Form137_path = move_uploaded_file($_FILES["Form137"]["tmp_name"], $target_file_Form137);
      }
      if (!empty($Form138)) {
        $Form138 = $FullName . ".pdf";
        $target_file_Form138 = $target_dir_Form138 . basename($Form138);
        $Form138_path = move_uploaded_file($_FILES["Form138"]["tmp_name"], $target_file_Form138);
    }
    if (!empty($MOA)) {
      $MOA = $FullName . ".pdf";
      $target_file_MOA = $target_dir_MOA . basename($MOA);
      $MOA_path = move_uploaded_file($_FILES["MOA"]["tmp_name"], $target_file_MOA);
  }
      
      if (!empty($Picture)) {
          $Picture = $FullName . ".jpg";
          $target_file_Picture = $target_dir_Picture . basename($Picture);
          $Picture_path = move_uploaded_file($_FILES["Picture"]["tmp_name"], $target_file_Picture);
      }
      
      // Insert form data into database
      $query = "INSERT INTO collegestud (Stud_ID, Lastname, Firstname, Middlename, Extensionname, Gender, Nationality, DoB, PoB, ContactNumber, Course, Email, Perm_Address, PSA, Form138, Form137, Picture, MOA, Status, Year, user_date, am_pm) VALUES ('$Stud_ID', '$Lastname', '$Firstname', '$Middlename', '$Extensionname', '$Gender', '$Nationality', '$DoB', '$PoB', '$ContactNumber', '$Course', '$Email', '$Perm_Address', '$PSA', '$Form138', '$Form137', '$Picture', '$MOA', '1', '$Year', DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s'), DATE_FORMAT(NOW(), '%p'))";

      // Insert user log details into userlog table
      if(isset($_SESSION['login'])) {
        $username = $_SESSION['username'];
        $userid = $_SESSION['id'];
        $lname = $_SESSION['Lname'];
        $fname = $_SESSION['Fname'];
        $action = "ADDED $Firstname $Lastname IN COLLEGE";
        mysqli_query($conn, "INSERT INTO userlog (username, user_date, userid, Lname, Fname, am_pm, actions) VALUES ('$username', DATE_FORMAT(CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'), '%Y-%m-%d %h:%i:%s'), '$userid', '$lname', '$fname', DATE_FORMAT(CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'), '%p'), '$action')") or die(mysqli_error($conn));
      }
      
      if (mysqli_query($conn, $query)) {
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal("SUCCESS!","'.$Lastname.' has been successfully registered","success");';
          echo '}, 1000);</script>';
      } else {
          echo '<script type="text/javascript">';
          echo 'setTimeout(function () { swal("ERROR!","Failed to add record!","error");';
          echo '}, 1000);</script>';
      }
      }
      ?>
      </div>
      </div>


      <!-- SCRIPT FOR VALIDATION OF FILE -->
<script>
  // Get the input file element with the name "myFile"
  const myFile = document.querySelector("input[name='Picture']");
  
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

  // Get all the input file elements with the name "avatar"
  const avatarFiles = document.querySelectorAll("input[name='PSA'], input[name='Form137'], input[name='Form138'], input[name='MOA']");

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
// Get the college and strand dropdown elements
const collegeDropdown = document.querySelector('select[name="Course"]');
const strandDropdown = document.querySelector('select[name="Strand"]');

// Add a change event listener to the college dropdown
collegeDropdown.addEventListener('change', () => {
  if (collegeDropdown.value !== '') {
    // If a college is selected, disable the strand dropdown and reset its value
    strandDropdown.disabled = true;
    strandDropdown.value = '';
  } else {
    // Otherwise, enable the strand dropdown
    strandDropdown.disabled = false;
  }
});

// Add a change event listener to the strand dropdown
strandDropdown.addEventListener('change', () => {
  if (strandDropdown.value !== '') {
    // If a strand is selected, disable the college dropdown and reset its value
    collegeDropdown.disabled = true;
    collegeDropdown.value = '';
  } else {
    // Otherwise, enable the college dropdown
    collegeDropdown.disabled = false;
  }
});
</script>
<script>
window.onload = function() {
  const forms = document.querySelectorAll('form');
  forms.forEach(form => {
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      const randomString = Math.random().toString(36).substring(2, 15);
      input.setAttribute('autocomplete', randomString);
    });
  });
};
</script>
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
</script>

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
include ('footer.php');
?>
</style>
</body>
</html>