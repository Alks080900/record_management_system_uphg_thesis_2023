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
	<title>College Report Generator</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<link href="/Capstone/css/classlist.css" rel="stylesheet">
</head>
<body>
<?php
include ('header.php');
?>
<br>
<div class="container" style="margin-left: 160px" data-aos="fade-up">
<h3>College Report Generator</h3>
</div>
<br>
<div class="container">
  <form action="print.php" method="post" target="_blank">
  <div class="row" data-aos="fade-up"data-aos-delay="400">
  <div class="col">
    <label style="margin-right: 10px; font-weight: 500;">Department</label>
    <select class="form-select form-select-sm" style="margin-left: 52px; width: 400px; display: inline-block;" id="college" name="college">
      <option selected value="Department">Department</option>
      <option value="College of Computer Studies">College of Computer Studies</option>
      <option value="College of Engineering">College of Engineering</option>
      <option value="College of Education">College of Education</option>
      <option value="College of Criminology">College of Criminology</option>
      <option value="College of Arts and Sciences">College of Arts and Sciences</option>
      <option value="College of Business and Accountancy">College of Business and Accountancy</option>
      <option value="College of Tourism">College of Tourism</option>
    </select>
    <br>
    <label style="margin-right: 54px; font-weight: 500;">Course</label>
    <select class="form-select form-select-sm" style="margin-left: 52px; width: 400px; display: inline-block;" id="course" name="Course" disabled>
      <option selected>Course</option>
    </select>
    <br>
    <label style="font-weight: 500;">Sort By Gender</label>
    <select class="form-select form-select-sm" style=" margin-left: 39px; width: 400px; display: inline-block;" name="Gender">
      <option selected value="All">All</option>
      <option value="Rather not say">Rather not say</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    <br>
  </div>
  <div class="col">
    <label style="font-weight: 500;">Sort By Requirements</label>
    <select class="form-select form-select-sm" style="margin-left: 52px; width: 400px; display: inline-block;" name="Requirements">
      <option selected value="All">All</option>
      <option value="PSA">PSA</option>
      <option value="Form138">Form138</option>
      <option value="Form137">Form137</option>
      <option value="Picture">Picture</option>
      <option value="MOA">MOA</option>
    </select>
    <br>
    <label style="font-weight: 500;">Sort by Year</label>
    <select class="form-select form-select-sm" style="margin-left: 135px; width: 400px; display: inline-block;" name="Year" id="year-select"></select>
    <br>
    <br>
  </div>
</div>
<button type="submit" class="btn btn-primary" name="print" id="print" style="margin-left: 166px;" data-aos="fade-up"data-aos-delay="400"><i class="bi bi-printer" style="margin-right: 10px;"></i>Print</button>
  </form>
  <br>
  <br>
<div data-aos="fade-up"data-aos-delay="700">
  <?php
					$result = mysqli_query($conn,"SELECT * FROM collegestud WHERE Status = '1' ORDER BY ID DESC");
					?>
				<?php
				if (mysqli_num_rows($result) > 0) {
				?>
				<table id="example" class="table table-hover" data-empty="No data is available" style="width:100%">
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
						</tr>
					</thead>
					<tbody class="table-striped ">
					<?php
						while($row = mysqli_fetch_array($result)) {
						?>
						<tr>
						<td><?php echo $row["Stud_ID"]; ?></td>
						<td><?php echo $row["Course"]; ?></td>
						<td><?php echo $row["Firstname"] . " " . $row["Middlename"] . " " . $row["Lastname"] . " " . $row["Extensionname"] ?>
						<td>
						<?php 
							if($row["PSA"]){
								echo "<i class='bi bi-patch-check-fill' style='color: green';></i>";
							}else{
								echo "<i class='bi bi-x-circle-fill' style='color: red';></i>";
							}
						?>
					</td>
          <td>
						<?php 
							if($row["Form138"]){
								echo "<i class='bi bi-patch-check-fill' style='color: green';></i>";
							}else{
								echo "<i class='bi bi-x-circle-fill' style='color: red';></i>";
							}
						?>
					</td>
					<td>
						<?php 
							if($row["Form137"]){
								echo "<i class='bi bi-patch-check-fill' style='color: green';></i>";
							}else{
								echo "<i class='bi bi-x-circle-fill' style='color: red';></i>";;
							}
						?>
					</td>
					<td>
						<?php 
							if($row["Picture"]){
								echo "<i class='bi bi-patch-check-fill' style='color: green';></i>";
							}else{
								echo "<i class='bi bi-x-circle-fill' style='color: red';></i>";
							}
              ?>
              <td>
						<?php 
							if($row["MOA"]){
								echo "<i class='bi bi-patch-check-fill' style='color: green';></i>";
							}else{
								echo "<i class='bi bi-x-circle-fill' style='color: red';></i>";
							}
						}
        }
            else {
              echo "<p><center>No results of active students</center></p>";
            }
						?>
					</td>
					</tr>
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
	<script>$(document).ready(function () {
		$('#example').DataTable();
	});
$('#example').dataTable({
    lengthChange: false,
        pageLength: 7,
        searching: true, // show the search bar
        order: [], // disable default sorting
        columnDefs: [
            { orderable: false, targets: '_all' } // disable sorting on all columns
        ]
});</script>

<script>
    jQuery(document).ready(function() {
  var optionsMap = {

    'College of Computer Studies': [
        'BS Information Technology', 
        'BS Computer Science' 
        
      ],

      'College of Nursing': [
        'BS Nursing',
        'BS Physical Therapy',
        
      ],

      'College of Engineering': [
        'BS Civil Engineering', 
        'BS Industrial Engineering',
        'BS Computer Engineering'
      ],
      'College of Education': [
        'Bachelor of Elementary Education',
        'Bachelor of Secondary Education Major in English',
        'Bachelor of Secondary Education Major in Filipino',
        'Bachelor of Secondary Education Major in Mathematics',
        'Bachelor of Secondary Education Major in Biological Science',
        'Bachelor of Secondary Education Major in Physical Education'

      ],
      'College of Criminology': [
        'BS Criminology'
      ],
        'College of Arts and Sciences': [
          'BS Psychology',
          'AB Psychology',
          'AB Communication'
        ],

        'College of Business and Accountancy': [
          'BS Accountancy',
          'BS Business Administration Major in Marketing Management'
        ],

        'College of Tourism': [
          'BS Tourism',
          'BS Hospitality & Management'
        ],
     
    };

  jQuery('#college').change(function() {
    var category = jQuery(this).val(),
        $subCategory = jQuery('#course'),
        newOptions = optionsMap[category];
    $subCategory.attr('disabled', false)
    $subCategory.empty();
    $.each(newOptions, function() {
      $subCategory.append(jQuery("<option></option>").text(this));
    });
  })
});
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
<?php
include ('footer.php');
?>
</body>
</html>
