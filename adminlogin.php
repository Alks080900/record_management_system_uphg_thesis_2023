<?php
include_once 'connection.php';
session_start();
$ID= $_SESSION["id"];
$sql=mysqli_query($conn,"SELECT * FROM accounts where Id='$ID' ");
$row  = mysqli_fetch_array($sql);
if(!$_SESSION['loginadmin']){
   header("location:index.php");
   die;
}
?>
<!DOCTYPE html>
<html lang="en">
<!--www.divinectorweb.com-->
<head>
	<meta charset="UTF-8">
	<title>Admin Homepage</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<link href="/Capstone/css/adminlogin.css" rel="stylesheet">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body onload="document.getElementById('sched').style.display = 'none';">
<?php
	include ('headeradmin.php');
	?>
<br>
<section>
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
</section>
<div class="container" >
	<section data-aos="fade-up">
<h2 class="text-uppercase">Accounts</h2>
<button type="button" class="btn btn-primary" onclick="location.href='adduser.php';" ><i class="bi bi-person-circle" style="margin-right: 15px"></i>Add User</button>
<br>
<br>
					<?php
					$result = mysqli_query($conn,"SELECT * FROM accounts ORDER BY ID DESC");
					?>
				<?php
				if (mysqli_num_rows($result) > 0) {
				?>
				<table id="example" class="table table-hover" data-empty="No data is available" style="width:100%">
					<thead>
						<tr>
							<th class="text-center">Last Name</th>
							<th class="text-center">First Name</th>
							<th class="text-center">Middle Name</th>
							<th class="text-center">Username</th>
              				<th class="text-center">Password</th>
							  <th class="text-center">Role</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody class="table-striped ">
					<?php
						while($row = mysqli_fetch_array($result)) {
						?>
						<tr>
						<td><?php echo $row["Lname"]; ?></td>
						<td><?php echo $row["Fname"]; ?></td>
						<td><?php echo $row["Mname"]; ?></td>
						<td><?php echo $row["Uname"]; ?></td>
						<td><span class="password"><?php echo $row["Pword"]; ?></span></td>

						<td>
						<?php 
							if ($row["user_type"] == "user") {
							echo "Employee";
							} else if ($row["user_type"] == "admin") {
							echo "Administrator";
							} else {
							echo $row["user_type"];
							}
						?>
						</td>
						<td>
						<button type='button' class='btn btn-success' onclick='showEditModal("<?php echo htmlspecialchars($row["ID"]); ?>")'>Edit</button>
							<a href='deleteuser.php?id=<?php echo htmlspecialchars($row["ID"]); ?>' class='btn btn-danger mx-2'>Delete</a>
						</td>  
					</tr>
					<?php
						}
					}
						?>
					</tbody>
				</table>
				</section>
<br>
<br>

<section data-aos="fade-up" data-aos-delay="400" class="miski">
<h2 class="text-uppercase">Log History</h2>
					<?php
					$result = mysqli_query($conn,"SELECT * FROM userlog ORDER BY user_log_id DESC");
					?>
				<?php
				if (mysqli_num_rows($result) > 0) {
				?>
				<table id="example1" class="table table-hover" data-empty="No data is available" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">Last Name</th>
            <th class="text-center">First Name</th>
			<th class="text-center">Username</th>
            <th class="text-center">Date</th>
            <th class="text-center">Time</th>
			<th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody class="table-striped">
        <?php
        while($row = mysqli_fetch_array($result)) {
            $login_date = strtotime($row["user_date"]); // convert login_date to Unix timestamp
            $date = date("M d, Y", $login_date); // format the date part of login_date
            $time = date("h:i:s", $login_date); // format the time part of login_date
            $am_pm = $row["am_pm"]; // retrieve the AM/PM value from the database
			$actions = $row["actions"];
        ?>
            <tr>
                <td><?php echo $row["Lname"]; ?></td>
                <td><?php echo $row["Fname"]; ?></td>
				<td><?php echo $row["username"]; ?></td>
                <td><?php echo $date; ?></td>
                <td><?php echo $time . ' ' . $am_pm; ?></td> <!-- concatenate the AM/PM value with the time -->
				<td><?php echo $row["actions"]; ?></td>
            </tr>
        <?php
        }
	}
        ?>
    </tbody>
</table>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" ></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
	</script>
  <script>
    // Retrieve all the password <span> elements
    var passwordElements = document.getElementsByClassName("password");

    // Loop through each password element and replace the innerText with 6 asterisks
    for (var i = 0; i < passwordElements.length; i++) {
        passwordElements[i].innerText = "****";
    }
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
                var url = 'edituser.php?id=' + id;
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
		
$(document).ready(function() {
    $('#example').DataTable({
        lengthChange: false,
        pageLength: 3
    });
});
</script>
<script>
$(document).ready(function() {
    $('#example1').DataTable({
        lengthChange: false,
        pageLength: 5,
        searching: true, // show the search bar
        order: [], // disable default sorting
        columnDefs: [
            { orderable: false, targets: '_all' } // disable sorting on all columns
        ]
    });
});
</script>
<script>
// Get the query string parameters from the URL
const urlParams = new URLSearchParams(window.location.search);

// Check if the "status" parameter is set to "success"
if (urlParams.get("status") === "success") {
  // Display the success message
  swal("SUCCESS!", "Delete Complete", "success").then(() => {
    // Remove the "status" parameter from the URL
    history.replaceState(null, null, window.location.pathname);
  });
}

// Check if the "status" parameter is set to "error"
if (urlParams.get("status") === "error") {
  // Display the error message
  swal("ERROR!", "Something went wrong!", "error").then(() => {
    // Remove the "status" parameter from the URL
    history.replaceState(null, null, window.location.pathname);
  });
}
</script>
<?php
include ('footer.php');
?>


</body>
</html>