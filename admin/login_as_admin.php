<?php 
include ($_SERVER["DOCUMENT_ROOT"]."/Capstone/connection.php");
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link rel="stylesheet" href="/Capstone/css/login.css">
    <title>Login Page</title>
  </head>
  <body>
  <?php  
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['uname'];
        $pword = $_POST['pword'];
    
    if(empty($name) || empty($pword))
    {
        echo "Please complete the input.";
    }
    else 
    {
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="db_rms";
    
    $conn=mysqli_connect ($servername, $username, $password, $dbname);
    
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    $query = mysqli_query ($conn,"SELECT * FROM adminaccounts  WHERE Uname = '$name' AND Pword= '$pword'");
    $count = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    
    if ($count>0) {
     $_SESSION["id"] = $row['Id'];
     $_SESSION['login1']=true;
    header ('location:/admin/adminpage.php');
        exit();
    
        }
    
    else {
        echo "Username/Password Incorrect!";
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
                    <h4>Admin's Log in</h4>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-row">
                            <div class="col-lg-7 mx-auto">
                                <input type="text" placeholder="Username" class="form-control my-3 p-4" name="uname" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7 mx-auto">
                                <input type="password" placeholder="*******" class="form-control my-3 p-4" name="pword" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7 mx-auto">
                                <button type="submit" class="btn1 mt-3 mb-5">Login</button>
                            </div>
                        </div>
                        <p>Log in as an Employee? <a href="/Capstone/index.php">Click here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>