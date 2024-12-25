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
	<title>Search Student</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link href="/Capstone/css/searchstudent.css" rel="stylesheet">
</head>
<body>
<?php
include ('header.php');
?>
<br>
<br>
<div class="container">
    <br>
    <br>
    <div class="filter-group row">
  <div class="col-sm-2">
    <form method="post">
    <div class="form-group" data-aos="fade-up">
      <label for="year_filter">Filter by school year:</label>
      <div class="dropdown">
        <?php
            // Get the current year
            $currentYear = date("Y");

            // Set the year range for the dropdown
            $yearRange = 20; // Change this value to adjust the range of years displayed

            // Calculate the first and last years in the range
            $firstYear = $currentYear - floor($yearRange / 2);
            $lastYear = $firstYear + $yearRange - 1;

            // Get the selected year from the form submission or set it to the current year
            $selectedYear = isset($_POST['Year']) ? $_POST['Year'] : $currentYear;
          ?>
      <input class="form-control form-control-sm" type="text" name="Year" id="year-select" oninput="this.value = this.value.replace(/[^0-9]/g, '');" style="max-width: 100px" value="<?php echo $selectedYear; ?>">
          
          <span class="caret"></span>
        </button>
        <div class="dropdown-menu" aria-labelledby="year-select">
          <?php
            // Add the options to the dropdown
            for ($year = $lastYear; $year >= $firstYear; $year--) {
              $selected = $selectedYear == $year ? 'selected' : '';
              echo '<a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById(\'year-select\').innerText=\'' . $year . '\'; document.getElementById(\'year-select-value\').value=\'' . $year . '\';">' . $year . '</a>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-2">
      <div class="form-group mb-5" data-aos="fade-up"  data-aos-delay="400">
        <label for="status_filter">Filter by status:</label>
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="status_filter_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required>
          <?php 
            if (isset($_POST['status_filter'])) {
              if ($_POST['status_filter'] == 'all') {
                echo 'All';
              } else if ($_POST['status_filter'] == 'active') {
                echo 'Active';
              } else if ($_POST['status_filter'] == 'archive') {
                echo 'Archive';
              }
            } else {
              echo 'All';
            }
          ?>
          </button>
          <div class="dropdown-menu" aria-labelledby="status_filter_dropdown">
            <button class="dropdown-item" type="submit" name="status_filter" value="all">All</button>
            <button class="dropdown-item" type="submit" name="status_filter" value="active">Active</button>
            <button class="dropdown-item" type="submit" name="status_filter" value="archive">Archive</button>
          </div>
        </div>
      </div>
    </div>


    
    <div class="col-sm-2">
      <div class="form-group" data-aos="fade-up"  data-aos-delay="600">
        <label for="table_filter">Filter by class:</label>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="table_filter_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Table  
          </button>
          <div class="dropdown-menu" aria-labelledby="type-dropdown">
            <a class="dropdown-item" onclick="selectValue('College')">College</a>
            <a class="dropdown-item" onclick="selectValue('SHS')">SHS</a>
          </div>
        </div>
      </div>
    
    </form>
  </div>
</div>
<div data-aos="fade-up"  data-aos-delay="800">
<div id='editModal' class='modal fade'>
      <div class='modal-dialog'>
          <div class='modal-content'>
              <div class='modal-header'>
                  <h5 class='modal-title'>Verification</h5>
                  <button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>
              </div>
              <div class='modal-body'>
                  <input type='password' id='passwordInput' class='form-control' placeholder='Password'>
                  
                  <div class='form-check mt-2'>
          <input class='form-check-input' type='checkbox' id='showPasswordCheck' onchange='togglePasswordVisibility()'>
          <label class='form-check-label' for='showPasswordCheck'>
            Show Password
          </label>
        </div>
        <div id='errorText' class='text-danger'></div>
              </div>
              <div class='modal-footer'>
                  <button type='button' class='btn btn-primary' onclick='verifyPassword()'>Verify</button>
              </div>
          </div>
      </div>
  </div>
    <br>
    <table id="alexx1" class="table table-hover" style="width:100%" data-empty="No data available">
        <thead>
            <tr>
                <th class="text-center">Student ID</th>
                <th class="text-center">Course</th>
                <th class="text-center">Name</th>
                <th class="text-center">PSA</th>
                <th class="text-center">Form 138</th>
                <th class="text-center">Form 137</th>
                <th class="text-center">2x2 Picture</th>
                <th class="text-center">MOA</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="table-striped ">
            <?php
            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_rms";

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $Cyear = date('Y');

// Set default filter
$filter = "WHERE Status IN (0,1) AND Year=$Cyear";

// Check if a filter has been selected
if (isset($_POST['status_filter'])) {
    $status = $_POST['status_filter'];
    if (isset($_POST['Year'])) {
        $selectedYear = $_POST['Year'];
    } else {
        $selectedYear = $Cyear;
    }
    if ($status === 'active') {
        $filter = "WHERE Status = 1 AND Year = $selectedYear";
    } else if ($status === 'archive') {
        $filter = "WHERE Status = 0 AND Year = $selectedYear";
    } else if ($status === 'all') {
        $filter = "WHERE Status IN (0,1) AND Year=$selectedYear";
    }
}

// Execute a SELECT statement with prepared statements to retrieve data from the table
$sql = "SELECT * FROM collegestud " . $filter . " ORDER BY ID DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

            // Loop through the result set and print each row
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $Student_ID = $row["Stud_ID"];
                    $Course = $row["Course"];
                    $Name = $row["Firstname"] . " " . $row["Middlename"] . " " . $row["Lastname"] . " " . $row["Extensionname"];
                    $PSA = $row["PSA"];
                    $Form138 = $row["Form138"];
                    $Form137 = $row["Form137"];
                    $Picture = $row["Picture"];
                    $MOA = $row["MOA"];
                    $Status = $row["Status"];
                    $user_date = $row["user_date"];
                    $am_pm = $row["am_pm"];
                echo "<tr data-user-date='" . $user_date . "' data-am-pm='" . $am_pm . "'>";
                echo "<td class='text-center'>" . $Student_ID . "</td>";
                echo "<td class='text-center'>" . $Course . "</td>";
                echo "<td class='text-center'>" . $Name . "</td>";
                 // Determine the icon to display based on the value of $psa
            if($row["PSA"]) {
                echo "<td><a href='http://192.168.2.246/Capstone/uploads/College/PSA/".htmlspecialchars($PSA)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
            } else {
                echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
            }
            if($row["Form138"]) {
                echo "<td><a href='http://192.168.2.246/Capstone/uploads/College/Form138/".htmlspecialchars($Form138)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
            } else {
                echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
            }
            // Determine the icon to display based on the value of $form137
            if($row["Form137"]) {
                echo "<td><a href='http://192.168.2.246/Capstone/uploads/College/Form137/".htmlspecialchars($Form137)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
            } else {
                echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
            }
            // Determine the icon to display based on the value of $picture
            if($row["Picture"]) {
                echo "<td><a href='http://192.168.2.246/Capstone/uploads/College/Picture/".htmlspecialchars($Picture)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
            } else {
                echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
            }
            if($row["MOA"]) {
                echo "<td><a href='http://192.168.2.246/Capstone/uploads/College/MOA/".htmlspecialchars($MOA)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
            } else {
                echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
            }
            if ($row["Status"] == 0) {
              echo "<td><a href='unarchive.php?id=".htmlspecialchars($row["ID"])."' class='btn btn-warning'>Unarchive</a></td>";
          } else {
              echo "<td>
                      <div class='d-flex justify-content-between'>
                      <button type='button' class='btn btn-success' onclick='showEditModal(".htmlspecialchars($row["ID"]).")'>Edit</button>
                          <a href='contact.php?id=".htmlspecialchars($row["ID"])."' class='btn btn-warning'>Contact</a>
                          <a href='delete.php?id=".htmlspecialchars($row["ID"])."' class='btn btn-danger mx-2'>Archive</a>
                      </div>
                    </td>";
          }
        }
      }


      
        ?>
    </tbody>
    
</table>

<table id="alexx2" class="table table-hover" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Student ID</th>
                <th class="text-center">Strand</th>
                <th class="text-center">Name</th>
                <th class="text-center">PSA</th>
                <th class="text-center">Form 138</th>
                <th class="text-center">Form 137</th>
                <th class="text-center">2x2 Picture</th>
                <th class="text-center">MOA</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="table-striped ">
            <?php
            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_rms";

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $Cyear = date('Y');

            // Set default filter
            $filter = "WHERE Status IN (0,1) AND Year=$Cyear";
            
            // Check if a filter has been selected
            if (isset($_POST['status_filter'])) {
                $status = $_POST['status_filter'];
                if (isset($_POST['Year'])) {
                    $selectedYear = $_POST['Year'];
                } else {
                    $selectedYear = $Cyear;
                }
                if ($status === 'active') {
                    $filter = "WHERE Status = 1 AND Year = $selectedYear";
                } else if ($status === 'archive') {
                    $filter = "WHERE Status = 0 AND Year = $selectedYear";
                } else if ($status === 'all') {
                    $filter = "WHERE Status IN (0,1) AND Year=$selectedYear";
                }
            }

            // Execute a SELECT statement with prepared statements to retrieve data from the table
            $sql = "SELECT * FROM shsstud " . $filter . " ORDER BY ID DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            // Loop through the result set and print each row
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $Student_ID = $row["Stud_ID"];
                    $Strand = $row["Strand"];
                    $Name = $row["Firstname"] . " " . $row["Middlename"] . " " . $row["Lastname"] . " " . $row["Extensionname"];
                    $PSA = $row["PSA"];
                    $Form138 = $row["Form138"];
                    $Form137 = $row["Form137"];
                    $Picture = $row["Picture"];
                    $MOA = $row["MOA"];
                    $Status = $row["Status"];
                    $user_date = $row["user_date"];
                    $am_pm = $row["am_pm"];
                echo "<tr data-user-date='" . $user_date . "' data-am-pm='" . $am_pm . "'>";
                echo "<td class='text-center'>". $Student_ID . "</td>";
                echo "<td class='text-center'>" . $Strand . "</td>";
                echo "<td class='text-center'>" . $Name ."</td>";
                 // Determine the icon to display based on the value of $psa
                 if($row["PSA"]) {
                    echo "<td><a href='http://192.168.2.246/Capstone/uploads/SHS/PSA/".htmlspecialchars($PSA)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
                } else {
                    echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
                }
                if($row["Form138"]) {
                    echo "<td><a href='http://192.168.2.246/Capstone/uploads/SHS/Form138/".htmlspecialchars($Form138)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
                } else {
                    echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
                }
                // Determine the icon to display based on the value of $form137
                if($row["Form137"]) {
                    echo "<td><a href='http://192.168.2.246/Capstone/uploads/SHS/Form137/".htmlspecialchars($Form137)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
                } else {
                    echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
                }
                // Determine the icon to display based on the value of $picture
                if($row["Picture"]) {
                    echo "<td><a href='http://192.168.2.246/Capstone/uploads/SHS/Picture/".htmlspecialchars($Picture)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
                } else {
                    echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
                }
                if($row["MOA"]) {
                    echo "<td><a href='http://192.168.2.246/Capstone/uploads/SHS/MOA/".htmlspecialchars($MOA)."' target='_blank'><i class='bi bi-patch-check-fill' style='color: green;'></i></a></td>";
                } else {
                    echo "<td><i class='bi bi-x-circle-fill' style='color: red;'></i></td>";
                }
                if ($row["Status"] == 0) {
                  echo "<td><a href='unarchiveshs.php?id=".htmlspecialchars($row["ID"])."' class='btn btn-warning'>Unarchive</a></td>";
              } else {
                  echo "<td>
                          <div class='d-flex justify-content-between'>
                          <button type='button' class='btn btn-success' onclick='showEditModalshs(".htmlspecialchars($row["ID"]).")'>Edit</button>
                              <a href='contactshs.php?id=".htmlspecialchars($row["ID"])."' class='btn btn-warning'>Contact</a>
                              <a href='deleteshs.php?id=".htmlspecialchars($row["ID"])."' class='btn btn-danger mx-2'>Archive</a>
                          </div>
                        </td>";
              }       
            }
            echo "<div id='editModalshs' class='modal fade'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Verification</h5>
                        <button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <input type='password' id='passwordInputshs' class='form-control' placeholder='Password'>
                        
                        <div class='form-check mt-2'>
                        <input class='form-check-input' type='checkbox' id='showPasswordCheckshs' onchange='togglePasswordVisibilityshs()'>
                        <label class='form-check-label' for='showPasswordCheckshs'>
                          Show Password
                        </label>
                    </div>
                    <div id='errorTextshs' class='text-danger'></div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' onclick='verifyPasswordshs()'>Verify</button>
                    </div>
                </div>
            </div>
        </div>";   
        }
        ?>
    </tbody>
</table>
</div>
      </div>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" ></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
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
  duration: 500, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: false, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});
</script>
<script>
  document.getElementById('passwordInput').addEventListener('keydown', function (event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      verifyPassword();
    }
  });

  function verifyPassword() {
    // Add your password verification logic here
    // ...
  }

  function togglePasswordVisibility() {
    var passwordInput = document.getElementById('passwordInput');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  }

  function verifyPassword() {
    // Add your password verification logic here
    // ...
  }
   $('#editModal').appendTo("body");
function showEditModal(id) {
    // Set the ID value as a data attribute in the modal
    document.getElementById('editModal').setAttribute('data-id', id);

    // Show the modal
    var modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();

    // Add event listener for the 'shown.bs.modal' event
    modal._element.addEventListener('shown.bs.modal', function () {
        // Set focus on the password input field when the modal is shown
        document.getElementById('passwordInput').focus();
    });
}

function verifyPassword() {
    // Get the password input value
    var password = document.getElementById('passwordInput').value;

    // Get the ID value from the modal's data attribute
    var id = document.getElementById('editModal').getAttribute('data-id');

    // Perform AJAX request to verify password
    $.ajax({
        url: 'verify-password.php',
        type: 'POST',
        data: { password: password },
        success: function(response) {
            if (response === 'true') {
                // If the password is correct, redirect to editstudent.php with the ID as a query parameter
                var url = 'editstudent.php?id=' + id;
                history.pushState({}, '', url);
                window.location.href = url;
            } else {
                // If the password is incorrect, display an error message in red text
                document.getElementById('errorText').innerHTML = 'Incorrect password. Please try again.';
            }

            // Hide the modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
            modal.hide();
        }
    });
}

// Add event listener for the 'hidden.bs.modal' event
document.getElementById('editModal').addEventListener('hidden.bs.modal', function () {
    // Clear password input field and error message when the modal is hidden
    document.getElementById('passwordInput').value = '';
    document.getElementById('errorText').innerHTML = '';
});
</script>


<script>
  document.getElementById('passwordInputshs').addEventListener('keydown', function (event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      verifyPasswordshs();
    }
  });

  function verifyPasswordshs() {
    // Add your password verification logic here
    // ...
  }
  function togglePasswordVisibilityshs() {
    var passwordInput = document.getElementById('passwordInputshs');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  }

  function verifyPasswordshs() {
    // Add your password verification logic here
    // ...
  }
   $('#editModalshs').appendTo("body");
function showEditModalshs(id) {
    // Set the ID value as a data attribute in the modal
    document.getElementById('editModalshs').setAttribute('data-id', id);

    // Show the modal
    var modal = new bootstrap.Modal(document.getElementById('editModalshs'));
    modal.show();

    // Add event listener for the 'shown.bs.modal' event
    modal._element.addEventListener('shown.bs.modal', function () {
        // Set focus on the password input field when the modal is shown
        document.getElementById('passwordInputshs').focus();
    });
}

function verifyPasswordshs() {
    // Get the password input value
    var password = document.getElementById('passwordInputshs').value;

    // Get the ID value from the modal's data attribute
    var id = document.getElementById('editModalshs').getAttribute('data-id');

    // Perform AJAX request to verify password
    $.ajax({
        url: 'verify-password.php',
        type: 'POST',
        data: { password: password },
        success: function(response) {
            if (response === 'true') {
                // If the password is correct, redirect to editstudent.php with the ID as a query parameter
                var url = 'editstudentshs.php?id=' + id;
                history.pushState({}, '', url);
                window.location.href = url;
            } else {
                // If the password is incorrect, display an error message in red text
                document.getElementById('errorTextshs').innerHTML = 'Incorrect password. Please try again.';
            }

            // Hide the modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('editModalshs'));
            modal.hide();
        }
    });
}

// Add event listener for the 'hidden.bs.modal' event
document.getElementById('editModalshs').addEventListener('hidden.bs.modal', function () {
    // Clear password input field and error message when the modal is hidden
    document.getElementById('passwordInputshs').value = '';
    document.getElementById('errorTextshs').innerHTML = '';
});
</script>


<script>
// Get the query string parameters from the URL
const urlParams = new URLSearchParams(window.location.search);

// Check if the "status" parameter is set to "archive_success"
if (urlParams.get("status") === "archive_success") {
  // Display the archive success message
  swal("SUCCESS!", "Archive Complete", "success").then(() => {
    // Remove the "status" parameter from the URL
    history.replaceState(null, null, window.location.pathname);
  });;
}

// Check if the "status" parameter is set to "unarchive_success"
if (urlParams.get("status") === "unarchive_success") {
  // Display the unarchive success message
  swal("SUCCESS!", "Unarchive Complete", "success").then(() => {
    // Remove the "status" parameter from the URL
    history.replaceState(null, null, window.location.pathname);
  });;
}

// Check if the "status" parameter is set to "error"
if (urlParams.get("status") === "error") {
  // Display the error message
  swal("ERROR!", "Something went wrong!", "error").then(() => {
    // Remove the "status" parameter from the URL
    history.replaceState(null, null, window.location.pathname);
  });;
}
</script>

  <!-- Attach the hover event listener to the table rows -->
  <script>
    $(function() {
        $('#alexx1 tbody tr td:nth-child(1), #alexx1 tbody tr td:nth-child(2), #alexx1 tbody tr td:nth-child(3)').hover(function(e) {
            var user_date = $(this).parent().data('user-date');
            var am_pm = $(this).parent().data('am-pm');
            var bubble = $('<div>').addClass('bubble').html('<strong>UPDATED:</strong> ' + user_date + " " + am_pm);
            $('body').append(bubble);
            bubble.css({
                'left': e.pageX + 10,
                'top': e.pageY - 30
            });
        }, function() {
            $('.bubble').remove();
        });
    });
</script>


<!-- Attach the hover event listener to the table rows -->
<script>
    $(function() {
        $('#alexx2 tbody tr td:nth-child(1), #alexx2 tbody tr td:nth-child(2), #alexx2 tbody tr td:nth-child(3)').hover(function(e) {
            var user_date = $(this).parent().data('user-date');
            var am_pm = $(this).parent().data('am-pm');
            var bubble = $('<div>').addClass('bubble').html('<strong>UPDATED:</strong> ' + user_date + " " + am_pm);
            $('body').append(bubble);
            bubble.css({
                'left': e.pageX + 10,
                'top': e.pageY - 30
            });
        }, function() {
            $('.bubble').remove();
        });
    });
</script>

<script>
    // Select the current year option by default
    var currentYearOption = document.querySelector("#year-select option[value='<?php echo $currentYear; ?>']");
    currentYearOption.setAttribute("selected", "");
</script>
  
  <script>
  $(document).ready(function() {
    // Initialize the tables and hide the SHS table
    var collegeTable = $("#alexx1");
    var shsTable = $("#alexx2");
    collegeTable.DataTable({
      "lengthChange": false,
      "pageLength": 7,
      "searching": true,
      "order": [],
      "columnDefs": [
        { "orderable": false, "targets": "_all" }
      ]
    });
    $("#alexx1_filter").show();
    shsTable.DataTable().destroy();
    $("#alexx2_filter").hide();
    shsTable.hide();

    // Disable the College option by default
    $("a:contains('College')").addClass("disabled");

    // Add a click event handler to the dropdown menu items
    $(".dropdown-item").click(function() {
      // Determine which option was selected
      var selectedOption = $(this).text().trim();

      // Hide/show the tables based on the selected option
      if (selectedOption == "College") {
        // Destroy the SHS table if it exists
        if ($.fn.DataTable.isDataTable(shsTable)) {
          shsTable.DataTable().destroy();
        }
        // Show the College table
        collegeTable.DataTable({
          "lengthChange": false,
          "pageLength": 7,
          "searching": true,
          "order": [],
          "columnDefs": [
            { "orderable": false, "targets": "_all" }
          ]
        });
        collegeTable.show();
        $("#alexx1_filter").show();
        shsTable.hide();
        $("#alexx2_filter").hide();
        $("a:contains('College')").addClass("disabled");
        $("a:contains('SHS')").removeClass("disabled");

        // Set the selected value of the dropdown
        $("#table_filter_dropdown").text(selectedOption);
      } else if (selectedOption == "SHS") {
        // Destroy the College table if it exists
        if ($.fn.DataTable.isDataTable(collegeTable)) {
          collegeTable.DataTable().destroy();
        }
        // Show the SHS table
        shsTable.DataTable({
          "lengthChange": false,
          "pageLength": 7,
          "searching": true,
          "order": [],
          "columnDefs": [
            { "orderable": false, "targets": "_all" }
          ]
        });
        shsTable.show();
        $("#alexx2_filter").show();
        collegeTable.hide();
        $("#alexx1_filter").hide();
        $("a:contains('SHS')").addClass("disabled");
        $("a:contains('College')").removeClass("disabled");

        // Set the selected value of the dropdown
        $("#table_filter_dropdown").text(selectedOption);
      }
    });
  });
</script>

<?php
include ('footer.php');
?>
<style>
.dropdown-item {
  cursor: pointer;
}
.bubble {
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        z-index: 999;
    }
    #alexx1 tbody tr td:hover {
        cursor: pointer;
    }
    #alexx2 tbody tr td:hover {
        cursor: pointer;
    }
</style>
</body>
</html>
