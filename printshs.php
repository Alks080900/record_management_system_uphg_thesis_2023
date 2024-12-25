<?php
require('fpdf.php');
require('connection.php');

// Get the selected course and gender values
$selectedCourse = isset($_POST['Strand']) ? $_POST['Strand'] : '';
$selectedGender = isset($_POST['Gender']) ? $_POST['Gender'] : '';
$selectedYear = isset($_POST['Year']) ? $_POST['Year'] : '';
$selectedRequirements = isset($_POST['Requirements']) ? $_POST['Requirements'] : '';

/// Build the SQL query based on the selected filters
$sql = "SELECT * FROM shsstud WHERE Status = '1'";

if ($selectedCourse && $selectedCourse != 'Strand') {
    $sql .= " AND Strand = '$selectedCourse'";
}
if ($selectedGender && $selectedGender != 'All') {
    $sql .= " AND Gender = '$selectedGender'";
}
if ($selectedYear && $selectedYear != '') {
    $sql .= " AND Year = '$selectedYear'";
}

$sql .= " ORDER BY Lastname ASC";

// Execute the query
$result = mysqli_query($conn, $sql);

// Create a new PDF instance
$pdf = new FPDF();

// Add a new page
$pdf->AddPage();

// Set the font and font size for the header title
$pdf->SetFont('Arial', 'B', 14);

// Add the University of Perpetual Help System - GMA Campus header
$pdf->Image('C:\xampp\htdocs\Capstone\img\perps logo.png', 7, 7, 22);
$pdf->Cell(0, 10, 'UNIVERSITY OF PERPETUAL HELP SYSTEM - GMA CAMPUS', 0, 1, 'C');

// Set the font and font size for the address
$pdf->SetFont('Arial', '', 9);

// Add the address
$pdf->Cell(0, 5, 'BRGY. SAN GABRIEL, GENERAL MARIANO ALVAREZ, CAVITE', 0, 1, 'C');
$pdf->Ln(10);

// Set the font and font size for the header
$pdf->SetFont('Arial', 'B', 12);

// Determine the PDF header title based on the selected filters
$headerTitle = 'All strands';
if ($selectedCourse && $selectedCourse != 'Strand') {
    $headerTitle = $selectedCourse . ' ';
}
if ($selectedGender && $selectedGender != 'All') {
    $headerTitle .= 'sorted by ' . $selectedGender;
}
if ($selectedYear && $selectedYear != '') {
    $headerTitle .= ' - ' . $selectedYear;
}

// Add the PDF header
$pdf->Cell(0, 10, $headerTitle, 0, 1, 'C');
$pdf->Ln(10);

// Set the font and font size for the table headers
$pdf->SetFont('Arial', 'B', 10);

// Define the selected requirement
$selectedRequirements = isset($_POST['Requirements']) ? $_POST['Requirements'] : '';

// Define the selected requirement
$selectedRequirements = isset($_POST['Requirements']) ? $_POST['Requirements'] : '';

// Define the table headers and widths based on the selected requirement
if ($selectedRequirements == 'PSA') {
    $header = array('No.', 'Name', 'PSA');
    $widths = array(10, 60, 20);
} elseif ($selectedRequirements == 'Form138') {
    $header = array('No.', 'Name', 'Form138');
    $widths = array(10, 60, 20);
} elseif ($selectedRequirements == 'Form137') {
    $header = array('No.', 'Name', 'Form137');
    $widths = array(10, 60, 20);
} elseif ($selectedRequirements == 'Picture') {
    $header = array('No.', 'Name', 'Picture');
    $widths = array(10, 60, 20);
} elseif ($selectedRequirements == 'MOA') {
    $header = array('No.', 'Name', 'MOA');
    $widths = array(10, 60, 20);
} else {
    $header = array('No.', 'Name', 'PSA', 'Form138', 'Form137', 'Picture', 'MOA');
    $widths = array(10, 60, 20, 25, 25, 25, 25, 45);
}

// Add the table headers
for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($widths[$i], 7, $header[$i], 1, 0, 'C');
}

// Add the table rows
$pdf->SetFont('Arial', '', 10);
$i = 1;
while ($row = mysqli_fetch_array($result)) {
    $name = $row["Lastname"] . ", " . $row["Firstname"] . " " . $row["Middlename"] . " " . $row["Extensionname"];
    $psa = $row["PSA"] ? 'Complied' : 'None';
    $form138 = $row["Form138"] ? 'Complied' : 'None';
    $form137 = $row["Form137"] ? 'Complied' : 'None';
    $picture = $row["Picture"] ? 'Complied' : 'None';
    $moa = $row["MOA"] ? 'Complied' : 'None';

    // Add the table row data based on the selected requirement
    $pdf->Ln();
    $pdf->Cell($widths[0], 6, $i, 1, 0, 'C');
    $pdf->Cell($widths[1], 6, $name, 1);
    if ($selectedRequirements == 'PSA') {
        $pdf->Cell($widths[2], 6, $psa, 1, 0, 'C');
    } elseif ($selectedRequirements == 'Form138') {
        $pdf->Cell($widths[2], 6, $form138, 1, 0, 'C');
    } elseif ($selectedRequirements == 'Form137') {
        $pdf->Cell($widths[2], 6, $form137, 1, 0, 'C');
    } elseif ($selectedRequirements == 'Picture') {
        $pdf->Cell($widths[2], 6, $picture, 1, 0, 'C');
    } elseif ($selectedRequirements == 'MOA') {
        $pdf->Cell($widths[2], 6, $moa, 1, 0, 'C');
    } else {
        $pdf->Cell($widths[2], 6, $psa, 1, 0, 'C');
        $pdf->Cell($widths[3], 6, $form138, 1, 0, 'C');
        $pdf->Cell($widths[4], 6, $form137, 1, 0, 'C');
        $pdf->Cell($widths[5], 6, $picture, 1, 0, 'C');
        $pdf->Cell($widths[6], 6, $moa, 1, 0, 'C');
    }

    $i++;
}

// Output the PDF
$pdf->Output();
?>