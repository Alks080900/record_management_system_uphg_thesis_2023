
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
			<img src="/Capstone/img/nav.png" class="navvy" href="adminlogin.php">
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
<script>
document.querySelector(".navvy").addEventListener("click", () => {
    window.location.href = 'adminlogin.php';
});
</script>