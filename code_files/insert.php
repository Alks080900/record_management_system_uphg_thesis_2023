<?php
include 'connection.php';

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $Stud_ID = $_POST['Stud_ID'];
    $Lastname = $_POST['Lastname'];
    $Firstname = $_POST['Firstname'];
    $Middlename = $_POST['Middlename'];
    $Extensionname = $_POST['Extensionname'];
    $Gender = $_POST['Gender'];
    $Nationality = $_POST['Nationality'];
    $DoB = $_POST['DoB'];
    $PoB = $_POST['PoB'];
    $ContactNumber = $_POST['ContactNumber'];
    $course = $_POST['Course'];
    $Email = $_POST['Email'];
    $home = $_POST['home'];
    
    // File uploads
    $PSA = $_FILES['PSA']['name'];
    $Form137 = $_FILES['Form137']['name'];
    $Picture = $_FILES['Picture']['name'];

    // Check for allowed file types for PSA and Form137
    $allowed_pdf_types = array("application/pdf");
    $pdf_types = array("PSA", "Form137");
    foreach ($pdf_types as $pdf_type) {
        if (!in_array($_FILES[$pdf_type]["type"], $allowed_pdf_types)) {
            echo "$pdf_type must be a PDF file.<br>";
            exit();
        }
    }

    // Check for allowed file type for Picture
    $allowed_picture_types = array("image/jpeg");
    if (!in_array($_FILES["Picture"]["type"], $allowed_picture_types)) {
        echo "Picture must be a JPEG file.<br>";
        exit();
    }

    $target_dir_PSA = "C:/xampp/htdocs/Capstone/uploads/PSA/";
    $target_file_PSA = $target_dir_PSA . basename($_FILES["PSA"]["name"]);
    $target_dir_Form137 = "C:/xampp/htdocs/Capstone/uploads/Form137/";
    $target_file_Form137 = $target_dir_Form137 . basename($_FILES["Form137"]["name"]);
    $target_dir_Picture = "C:/xampp/htdocs/Capstone/uploads/Picture/";
    $target_file_Picture = $target_dir_Picture . basename($_FILES["Picture"]["name"]);

    // Upload files
    if (move_uploaded_file($_FILES["PSA"]["tmp_name"], $target_file_PSA) &&
        move_uploaded_file($_FILES["Form137"]["tmp_name"], $target_file_Form137) &&
        move_uploaded_file($_FILES["Picture"]["tmp_name"], $target_file_Picture)) {
        // Insert data into database
        $sql = "INSERT INTO collegestud (Stud_ID, Lastname, Firstname, Middlename, Extensionname, Gender, Nationality, DoB, PoB, ContactNumber, Course, Email, PSA, Form137, Picture, home)
        VALUES ('$Stud_ID', '$Lastname', '$Firstname', '$Middlename', '$Extensionname', '$Gender', '$Nationality', '$DoB', '$PoB', '$ContactNumber', '$course', '$Email', '$PSA', '$Form137', '$Picture', '$home')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "File upload failed";
    }
    }
    
    // Close connection
    mysqli_close($conn);
    
    ?>