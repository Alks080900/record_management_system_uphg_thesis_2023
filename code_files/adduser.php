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
	<title>Add User</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pwstrength-bootstrap/3.0.3/pwstrength-bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pwstrength-bootstrap/3.0.3/pwstrength-bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link href="/Capstone/css/adduser.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
<div class="container">
	<h2 data-aos="fade-up">Add Account</h2>
	<br>
    <h6 data-aos="fade-up">(*) Required Field</h6>
    <br>
    <form method="post" enctype="multipart/form-data" >
        <div class="row" data-aos="fade-up"data-aos-delay="400">
            <div class="form-group col-lg-3">
                <label class="required" for="lastname">Last Name</label>
                <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="LName" placeholder="Last Name" name="Lname" value="" required>
            </div>
            <div class="form-group col-lg-3">
                <label class="required" for="firstname">First Name</label>
                <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="FName" placeholder="First Name" name="Fname" value="" required>
            </div>
            <div class="form-group col-lg-3">
                <label >Middle Name</label>
                <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="MName" placeholder="Middle Name" name="Mname" value="">
            </div>
            <div class="form-group col-lg-3">
                <label >Extension Name</label>
                <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="EName" placeholder="Extension Name" name="Ename" value="">
            </div>
            <div class="form-group col-lg-3">
                <label class="required" for="">Username</label>
                <input type="text"  class="form-control" id="USER" name="Uname" placeholder="Username" required>
            </div>
            <div class="form-group col-lg-3 position-relative">
    <label class="required" for="">Password</label>
    <div class="input-group">
        <input type="password" class="form-control" id="password" name="Pword" placeholder="******" 
            required 
            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" />
            <span class="input-group-text csse mb-5">
                <i class="fa fa-fw fa-eye-slash toggle-password" aria-hidden="true"></i>
            </span>
    </div>
    Password Strength Indicator
    <div class="progress mt-2 mb-3">
        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <small id="passwordHelp" class="form-text"></small>
</div>

            <div class="form-group col-lg-3">
                <label class="required">Select Role</label>
                <select class="form-control form-select" id="role" name="user_type" placeholder="Role" required>
                    <option value="user">Employee</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>
        </div>
        <button type="reset" class="btn btn-primary" id="cancel"  data-aos="fade-up"data-aos-delay="900"><i class="bi bi-x-lg" style="margin-right: 5px;"></i>Cancel</button>
         <button type="submit" name="submit" value="Submit" class="btn btn-primary" id="save"  data-aos="fade-up"data-aos-delay="700"><i class="bi bi-check" style="margin-right: 10px;"></i>Save</button>
    </form>
</div>
<?php
include 'connection.php';
// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data and sanitize inputs
    $Lname = mysqli_real_escape_string($conn, $_POST['Lname']);
    $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $Mname = mysqli_real_escape_string($conn, $_POST['Mname']);
    $Ename = mysqli_real_escape_string($conn, $_POST['Ename']);
    $Uname = mysqli_real_escape_string($conn, $_POST['Uname']);
    $Pword = mysqli_real_escape_string($conn, $_POST['Pword']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    // Insert form data into database
    $query = "INSERT INTO accounts (Lname, Fname, Mname, Ename, Uname, Pword, user_type) VALUES ('$Lname', '$Fname', '$Mname', '$Ename', '$Uname', '$Pword', '$user_type')";
      
    if (mysqli_query($conn, $query)) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("SUCCESS!","'.$Lname.' has been successfully registered","success");';
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
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    const password = document.getElementById('password');
    const progressBar = document.querySelector('.progress-bar');
    const passwordHelp = document.getElementById('passwordHelp');
    const lowercaseRegex = /^(?=.*[a-z])/;
    const uppercaseRegex = /^(?=.*[A-Z])/;
    const digitRegex = /^(?=.*\d)/;

    password.addEventListener('input', function () {
        if(password.value.length < 8) {
            progressBar.style.display = 'none';
            passwordHelp.style.color = 'red';
            passwordHelp.textContent = 'Password should be at least 8 characters long';
            return;
        }
        if(!lowercaseRegex.test(password.value)) {
            progressBar.style.display = 'none';
            passwordHelp.style.color = 'red';
            passwordHelp.textContent = 'Password should contain at least 1 lowercase letter';
            return;
        }
        if(!uppercaseRegex.test(password.value)) {
            progressBar.style.display = 'none';
            passwordHelp.style.color = 'red';
            passwordHelp.textContent = 'Password should contain at least 1 uppercase letter';
            return;
        }
        if(!digitRegex.test(password.value)) {
            progressBar.style.display = 'none';
            passwordHelp.style.color = 'red';
            passwordHelp.textContent = 'Password should contain at least 1 number';
            return;
        }

        progressBar.style.display = 'block';
        const result = zxcvbn(password.value);
        progressBar.style.width = result.score * 25 + '%';
        progressBar.setAttribute('aria-valuenow', result.score * 25);
        progressBar.setAttribute('aria-valuetext', `${result.score}/4`);
        progressBar.classList.remove('bg-danger', 'bg-warning', 'bg-info', 'bg-success');
        if (result.score < 2) {
            progressBar.classList.add('bg-danger');
            passwordHelp.style.color = 'red';
            passwordHelp.textContent = 'Password too weak';
        } else if (result.score < 3) {
            progressBar.classList.add('bg-warning');
            passwordHelp.style.color = 'red';
            passwordHelp.textContent = 'Password could be stronger';
        } else if (result.score < 4) {
            progressBar.classList.add('bg-info');
            passwordHelp.style.color = 'black';
            passwordHelp.textContent = 'Password good';
        } else {
            progressBar.classList.add('bg-success');
            passwordHelp.style.color = 'black';
            passwordHelp.textContent = 'Password strong';
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
<style>
  #LName, #FName, #MName, #USER, #password, #EName{
    margin-bottom: 50px;
}
#role {
  margin-top:15px;
}
</style>
<?php
include ('footer.php');
?>
</body>
</html>