<?php
include_once 'connection.php';
session_start();
if(!$_SESSION['loginadmin']){
   header("location:index.php");
   die;
}
?>

<?php
// If the export button was clicked
if (isset($_POST['export'])) {
    // Set the filename for the exported SQL file
    $filename = 'db_rms' . '-' . date('Y-m-d') . '.sql';

    // Get the tables in the database
    $tables = array();
    $result = $conn->query('SHOW TABLES');
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }

    // Loop through each table and create the SQL file
    $sql = '';
    foreach ($tables as $table) {
        $result = $conn->query('SELECT * FROM ' . $table);
        $num_fields = $result->field_count;

        // Add the table creation statement to the SQL file
        $sql .= 'DROP TABLE IF EXISTS ' . $table . ';';
        $row2 = $conn->query('SHOW CREATE TABLE ' . $table)->fetch_array();
        $sql .= "\n\n" . $row2[1] . ";\n\n";

        // Add the table data to the SQL file
        while ($row = $result->fetch_array()) {
            $sql .= 'INSERT INTO ' . $table . ' VALUES(';
            for ($i = 0; $i < $num_fields; $i++) {
                $row[$i] = addslashes($row[$i]);
                $row[$i] = str_replace("\n", "\\n", $row[$i]);
                if (isset($row[$i])) {
                    $sql .= '"' . $row[$i] . '"';
                } else {
                    $sql .= '""';
                }
                if ($i < $num_fields - 1) {
                    $sql .= ',';
                }
            }
            $sql .= ");\n";
        }
        $sql .= "\n\n\n";
    }

    // Download the SQL file
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $filename);
    echo $sql;
    exit;
}
?>

<?php

// Check if the connection was successful
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// If the import button was clicked
if (isset($_POST['import'])) {
    // Check if a file was selected
    if ($_FILES['file']['size'] == 0) {
        // Show an error message using sweetalert
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("ERROR","Please insert a file","error");';
                echo '}, 1000);</script>';
    } else {
        // Get the filename of the uploaded SQL file
        $filename = $_FILES['file']['tmp_name'];

        // Read the contents of the SQL file
        $sql = file_get_contents($filename);

        // Execute the SQL commands
        if ($conn->multi_query($sql)) {
            do {
                // Check for errors in each command
                if ($result = $conn->store_result()) {
                    $result->free();
                }
                if ($conn->errno) {
                    die('Error executing SQL: ' . $conn->error);
                }
            } while ($conn->more_results() && $conn->next_result());

            // Show a success message using sweetalert
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("SUCCESS","Database Import Successfully","success");';
                echo '}, 1000);</script>';
        } else {
            // Show an error message using sweetalert
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("ERROR,"Please use a valid file type","error");';
                echo '}, 1000);</script>';
        }
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Database Management</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link href="/Capstone/css/dbm.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
<?php
include ('headeradmin.php');
?>
<br>

<div class="container-fluid mt-5">
  <div class="row" >
    <div class="col-md-5" data-aos="fade-up">
      <div class="card" sty>
        <div class="card-header">
          Export Database
        </div>
        <div class="card-body text-center">
          <form method="post">
            <button type="submit" name="export" class="btn btn-primary ">Click to Download</button>
          </form>
        </div>
      </div>
      <br>
      <br>
    </div>
   
    <div class="col-md-5" data-aos="fade-up" data-aos-delay="400">
      <div class="card">
        <div class="card-header">
          Import Database
        </div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <div class="file-input">
              <input type="file" name="file">
              <button type="submit" name="import" class="btn btn-primary float-end">Import Database</button>
            </div>
          </form>
        </div>
      </div>
    </div>
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
<?php
include ('footer.php');
?>
<style>

</style>
</body>
</html>