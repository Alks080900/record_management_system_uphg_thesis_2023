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
	<title>OCR</title>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link href="/Capstone/css/ocr.css" rel="stylesheet">
</head>
<body>
<?php
include ('header.php');
?>
<br>
<br>

<?php

require_once 'C:\xampp\htdocs\Capstone\vendor\autoload.php';

if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext_array = explode('.', $_FILES['image']['name']);
    $file_ext_array = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($file_ext_array));

    if (count($file_ext_array) < 2) {
        $errors[] = "Invalid file name, please choose a file with a valid extension.";
    }

    if(empty($errors)==true){
        $image_path = "C:\\Users\\xande\\Downloads\\".$file_name;

        // Load the image using GD library
        $img = imagecreatefromstring(file_get_contents($file_tmp));

        // Save the image to a file
        imagejpeg($img, $image_path);

        // Extract text using Tesseract OCR
        $text = (new thiagoalessio\TesseractOCR\TesseractOCR($image_path))
            ->lang('eng')
            ->executable('C:\Program Files (x86)\Tesseract-OCR\tesseract.exe')
            ->run();
    }else{
        echo '<script type="text/javascript">';
            echo 'swal("ERROR","The file could not be read!","error").then(function() {
            window.location.href = "/Capstone/ocr.php";});';
            echo '</script>';

    }
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6" data-aos="fade-up">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group" >
                    <label for="fileToUpload">Select image file to upload:</label>
                    <input type="file" name="image" id="fileToUpload" class="form-control-file" accept="image/*" required>
                </div>
                <input type="submit" value="Extract Text" name="submit" class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-6" data-aos="fade-up"  data-aos-delay="400">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Result:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="min-height: 600px; max-height: 600px; "><?php if(isset($text)) { echo $text; } ?></textarea>
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
</body>
</html>