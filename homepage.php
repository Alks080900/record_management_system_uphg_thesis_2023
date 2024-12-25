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
<!--www.divinectorweb.com-->
<head>
	<meta charset="UTF-8">
	<title>Homepage</title>
    <link rel="icon" href="/Capstone/img/perps logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<link href="/Capstone/css/homepagedefault.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="/Capstone/css/homepagedefault.css" rel="stylesheet">
</head>
<body>
<?php
include ('header.php');
?>
<br>
<div class="container"  style="margin-left: 40px;">
	<h3 data-aos="fade-up" >Welcome back, <?php echo $_SESSION['Fname']?><?php
                    if(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] == true) {
                        echo ' <span>(Administrator)</span>';
                    }
                    else {
                      echo ' <span>(Employee)</span>';
                    }
                    ?></h3>
	<br>
<div class="text-uppercase" data-aos="fade-up" data-aos-delay="400">Overview</div>
<br>
<div class="row g-6 mb-6" data-aos="fade-up" data-aos-delay="400">
	<div class="col-xl-3 col-sm-6 col-12">
						<div class="card shadow border-0">
							<div class="card-body">
								<div class="row">
									<img src="/Capstone/img/student.PNG" style="width: 120px; margin-right: 50px;"alt="">
									<div class="col">
										<span class="h6 font-bold text-muted d-block mb-4">Students</span>
										<span class="h2 font-bold"><?php
										$query = "SELECT SUM(total) as counts FROM (
                      SELECT COUNT(*) as total FROM collegestud WHERE Status = 1
                      UNION ALL
                      SELECT COUNT(*) as total FROM shsstud WHERE Status = 1
                  ) as counts";
    
                      // Execute the query
                      $result = $conn->query($query);
                      
                      // Fetch the result
                      $row = $result->fetch_assoc();
                      
                      // Print the total number of rows that match the criteria
                      echo "" . $row['counts'];
                  ?>    
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
									<img src="/Capstone/img/Complete Documents.PNG" style="width: 120px; margin-right: 50px;"alt="">
                                    <div class="col">
                                        <span class="h6 font-bold text-muted d-block mb-1">Complete Documents</span>
                                        <span class="h2 font-bold">
                    <?php
											$query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        UNION ALL
                        SELECT COUNT(*) as total FROM shsstud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                    ) as counts";
            
            // Execute the query
            $result = $conn->query($query);
            
            // Fetch the result
            $row = $result->fetch_assoc();
            
            // Print the total number of rows that match the criteria
            echo "" . $row['total_count'];
?>            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
									<img src="/Capstone/img/Incomplete Documents.PNG" style="width: 120px; margin-right: 50px;"alt="">
                                    <div class="col">
                                        <span class="h6 font-bold text-muted d-block mb-1">Incomplete Documents</span>
                                        <span class="h2 font-bold">
                      <?php
											$query = "SELECT COUNT(*) as total FROM (
                        SELECT * FROM collegestud 
                        WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                            AND Status = 1
                        UNION ALL
                        SELECT * FROM shsstud 
                        WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                            AND Status = 1
                    ) as counts;";

											// Execute the query
											$result = $conn->query($query);

											// Fetch the result
											$row = $result->fetch_assoc();

											// Print the total number of rows that match the criteria
											echo "" . $row['total'];
											?></span>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-3 col-sm-6 col-12">
						<div class="card shadow border-0">
							<div class="card-body">
								<div class="row">
									<img src="/Capstone/img/Group 79.PNG" style="width: 120px; margin-right: 50px;"alt="">
									<div class="col">
										<span class="h6 font-bold text-muted d-block mb-4">Archives</span>
										<span class="h2 font-bold"><?php
											$query = "SELECT COUNT(*) as total FROM collegestud WHERE Status = 0";
                      // Execute the query
											$result = $conn->query($query);

											// Fetch the result
											$row = $result->fetch_assoc();

											// Print the total number of rows that match the criteria
											echo "" . $row['total'];
											?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
				<br>
        <div data-aos="fade-up" data-aos-delay="700">
        <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="type-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Filter by Class
    </button>
    <div class="dropdown-menu" aria-labelledby="type-dropdown">
  <a class="dropdown-item"  onclick="selectValue('College')">College</a>
  <a class="dropdown-item" onclick="selectValue('SHS')">SHS</a>
</div>
</div>
				<?php
					$result = mysqli_query($conn,"SELECT * FROM collegestud WHERE Status = '1' ORDER BY ID DESC");
					?>
				<?php
				if (mysqli_num_rows($result) > 0) {
				?>
				<table id="alexx1" class="table table-hover" data-empty="No data is available" style="width:100%" >
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
						?>
					</td>
					</tr>
					</tbody>
				</table>

        <?php
					$result = mysqli_query($conn,"SELECT * FROM shsstud WHERE Status = '1' ORDER BY ID DESC");
					?>
				<?php
				if (mysqli_num_rows($result) > 0) {
				?>
				<table id="alexx2" class="table table-hover" data-empty="No data is available" style="width:100%">
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
						</tr>
					</thead>
					<tbody class="table-striped ">
					<?php
						while($row = mysqli_fetch_array($result)) {
						?>
						<tr>
						<td><?php echo $row["Stud_ID"]; ?></td>
						<td><?php echo $row["Strand"]; ?></td>
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
						?>
					</td>
					</tr>
					</tbody>
				</table>
        </div>
        </div>
    <div class="container py-5" id="page-container" >
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
            <button type="button" class=" btn btn-primary" id="schedbutton" data-toggle="modal" data-target="#scheduleModal">
<i class="fas fa-plus"></i> Add Event Schedule
</button>

<!-- Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header rounded-0">
        <h5 class="modal-title">Schedule Details</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body rounded-0">
        <div class="container-fluid">
          <form action="save_schedule.php" method="post" Id="schedule-form">
            <input type="hidden" name="id" value="">
            <dl>
              <dt class="text-muted">Title</dt>
              <dd>
                <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
              </dd>
              <dt class="text-muted">Description</dt>
              <dd>
                <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
              </dd>
              <dt class="text-muted">Start</dt>
              <dd>
                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
              </dd>
              <dt class="text-muted">End</dt>
              <dd>
                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
              </dd>
            </dl>
          </form>
        </div>
      </div>
      <div class="modal-footer rounded-0">
        <div class="text-end">
          <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form" id="save-button">Save</button>
          <button type="reset" class="btn btn-secondary btn-sm rounded-0" id="reset-form">Reset</button>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                    <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>

                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <br>
                <br>
    <!-- Event Details Modal -->

<?php 
$schedules = $conn->query("SELECT * FROM `schedule_list`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
?>
<?php 
if(isset($conn)) $conn->close();
?>

<script src="./js/script.js"></script>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>

<script>
  $(document).ready(function() {
  $("#edit").click(function() {
    $("#event-details-modal").modal("hide");
    var id = $(this).data("id");
    // retrieve data from database using id
    // update the form fields with retrieved data
    $("#scheduleModal").modal("show");
  });
});
</script>
<script>
$(document).ready(function() {
  $('#reset-form').click(function(e) {
    e.preventDefault();
    $('#schedule-form')[0].reset();
  });
});
</script>
<script>
$(document).ready(function() {
  $('#save-button').click(function(e) {
    e.preventDefault();
    var form = $('#schedule-form');
    if (!form[0].checkValidity()) {
      form.find(':submit').click();
      return;
    }
    $.ajax({
      type: 'post',
      url: 'save_schedule.php',
      data: form.serialize(),
      success: function(response) {
        if (response === 'success') {
          Swal.fire({
            title: 'Schedule saved successfully',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK',
            customClass: {
              container: 'smooth-font'
            }
          }).then((result) => {
            location.reload();
          });
        } else {
          Swal.fire({
            title: 'Error: Schedule could not be saved',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK',
            customClass: {
              container: 'smooth-font'
            }
          }).then((result) => {
            location.reload();
          });
        }
      }
    });
  });
});
</script>
<script>
  const myModal= new bootstrap.Modal('#scheduleModal');
  document.querySelector('.btn-close').addEventListener('click' , () => {
    myModal.hide();
  });
  </script>
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
      }
    });
  });
</script>
<script>
    function selectValue(value) {
        // Set the value of the dropdown button to the selected value
        document.getElementById("type-dropdown").innerHTML = "Filter by Class: " + value;
    }
</script>
<style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        .fc-scrollgrid, tbody[role=rowgroup], td[role=gridcell], th[role=presentation], thead[role=rowgroup], tr[role=presentation] {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 2px !important;
        }
        #calendar{
            position: absolute;
            left: 73%;
            top: 10%;
        }
        #fc-dom-1{
            margin-left: 10px;
            margin-right: 10px;
            font-size: 17px;
        }
        #schedbutton{
            position: absolute;
            left: 82%;
            top: 55%;
        }
        #sched{
            position: absolute;
            left: 78%;
            top: 60%;
        }
    .dropdown-item:hover {
    cursor: pointer;
  }
</style>
<?php
include ('footer.php');
?>
</body>
</html>
