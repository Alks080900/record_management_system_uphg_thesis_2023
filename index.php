<?php 
include "connection.php";
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link rel="stylesheet" href="/Capstone/css/login.css" >
    <link rel="stylesheet" href="/path/to/font-awesome/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <title>Log In</title>
  </head>
  <body>
  <?php  
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['uname'];
        $pword = $_POST['pword'];
    
        if(empty($name) || empty($pword)) {
            echo "Please complete the input.";
        }
        else {
            $servername="localhost";
            $username="root";
            $password="";
            $dbname="db_rms";
    
            $conn=mysqli_connect ($servername, $username, $password, $dbname);
    
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
    
            $stmt = mysqli_prepare($conn, "SELECT * FROM accounts WHERE uname = ? AND pword = ?");
            mysqli_stmt_bind_param($stmt, "ss", $name, $pword);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);
    
            if ($count > 0) {
                $_SESSION['id'] = $row['userid'];
                $_SESSION["id"] = $row['Id'];
                $_SESSION['username'] = $name;
                $_SESSION["Pword"] = $row['Pword'];
                $_SESSION["Lname"] = $row['Lname']; 
                $_SESSION["Fname"] = $row['Fname'];
                $_SESSION["Mname"] = $row['Mname'];
                $_SESSION['login'] = true;
                
                // Insert user login details into userlog table
                $lname = $row['Lname'];
                $fname = $row['Fname'];
                $userid = $row['userid'];
                mysqli_query($conn, "INSERT INTO userlog (username, user_date, userid, Lname, Fname, am_pm, actions) VALUES ('$name', DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s'), $userid, '$lname', '$fname', DATE_FORMAT(NOW(), '%p'), 'LOGGED IN')") or die(mysqli_error());
                
                if($row['user_type'] == 'admin') {
                    $_SESSION['loginadmin'] = true;
                    header ('location:homepage.php');
                    exit();
                } else if ($row['user_type'] == 'user') {
                    header ('location:homepage.php');
                    exit();
                }
            }
    
            else {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("LOG IN FAILED","Username / Password is incorrect","error");';
                echo '}, 1000);</script>';
            }
    
            mysqli_close($conn);
        }
    }
    
?>



    <div class="d-flex flex-column">
    <section class="Form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <img src="/Capstone/img/Cover of login.jpg" class ="img-fluid" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <img src="/Capstone/img/perps logo.png" class="logo" alt="">
                    <h4>Sign in to your account</h4>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-row">
                            <div class="col-lg-7 mx-auto">
                                <input type="text" placeholder="Username" class="form-control my-3 p-4" name="uname" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-row">
    <div class="col-lg-7 mx-auto position-relative">
        <input type="password" placeholder="*****" class="form-control my-3 p-4" name="pword" id="password-field" autocomplete="off" required>
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></span>
    </div>
</div>
                        <div class="form-row">
                            <div class="col-lg-7 mx-auto">
                                <button type="submit" class="btn1 mt-3 mb-5">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    // Function to toggle password visibility
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>