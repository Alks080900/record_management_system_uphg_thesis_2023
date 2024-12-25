
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
			<img src="/Capstone/img/nav.png" class="navvy" href="homepage.php">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="homepage.php" id="homess">Home</a>
					</li>
					<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="studsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Student Management
    </a>
    <div class="dropdown-menu" aria-labelledby="studsDropdown">
        <a class="dropdown-item" href="studentmanagementcollege.php">COLLEGE</a>
        <a class="dropdown-item" href="studentmanagementshs.php">SENIOR HIGH SCHOOL</a>
    </div>
</li>

					<li class="nav-item">
						<a class="nav-link" href="searchstudent.php" id="searchy">Search Student</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="insights.php" id="insights">Insights</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="ocr.php" id="ocr">OCR</a>
					</li>
					<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="recordDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Report Generator
        </a>
    <div class="dropdown-menu" aria-labelledby="studsDropdown">
        <a class="dropdown-item" href="classlist.php">COLLEGE</a>
        <a class="dropdown-item" href="classlistshs.php">SENIOR HIGH SCHOOL</a>
    </div>
</li>
					<li class="nav-item">
						<a class="nav-link" href="aboutus.php" id="amongus">About Us</a>
					</li>
                </ul>  
            </div>
    
                    <ul>
					<li class="dropdown" id="imggg">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['Lname']?><img src="/Capstone/img/Profile Icon.png" alt="" class="imgg"> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <?php
                    if(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] == true) {
                        echo '<li><a class="dropdown-item" href="adminlogin.php">Admin Panel</a></li>';
                    }
                    ?>
                          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                      </li>
                    </ul>
	</nav>
<hr class="liness">
<script>
document.querySelector(".navvy").addEventListener("click", () => {
    window.location.href = 'homepage.php';
});
</script>
<style>
 #insights:hover{
    border-radius: 0;
    color: white;
    background-color: #222e50;
}
#ocr:hover{
    border-radius: 0;
    color: white;
    background-color: #222e50;
}
    </style>