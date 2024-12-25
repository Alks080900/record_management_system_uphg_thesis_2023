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
	<title>Insights</title>
    <link rel="icon" href="/CAPSTONE/img/perps logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.2/css/perfect-scrollbar.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.2/js/perfect-scrollbar.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<link href="/Capstone/css/insights.css" rel="stylesheet">
    <link href="/Capstone/css/scrollbar.css" rel="stylesheet">
</head>
<body class="square scrollbar-dusty-grass square thin">
<?php
include ('header.php');
?>
    <br>
    <div class="container">
        <section data-aos="fade-up">
        <h2 class="mb-5">Insights</h2>
        <div class="row">
            <div class="col-12">
                <h5 class="mb-3">Spotlights</h5>
            </div>
            <div class="col-12 text-right" >
                <a class="btn btn-primary mb-3" href="#carouselExampleIndicators2" id="lefft"role="button" data-slide="prev">
                    <i class="fa fa-arrow-left" style="color:black"></i>
                </a>
                <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" id="rigght"role="button" data-slide="next">
                    <i class="fa fa-arrow-right" style="color:black"></i>
                </a>
            </div>
            <div class="col-12">
            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel" data-interval="10000">

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row g-6 mb-6">
                            <div class="col-xl-3 col-sm-6 col-12">
                            <div class="cs shadow p-3 mb-5 bg-white rounded">
                            <span class="h6 font-bold text-muted d-block mb-3">Requirements</span>
                                <div class="row no-gutters">
                               <div class="col-md-4">
                                <img src="/Capstone/img/docu.PNG" class="card-img m-3"style="width: 70px; margin-right:20px"alt="">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                <?php

                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $dbname = "db_rms";
                                            $conn = new mysqli($servername, $username, $password, $dbname);

                                            // Check connection
                                            if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                            }

                                            $sql = "SELECT COUNT(*) as count FROM (SELECT * FROM collegestud WHERE user_date >= DATE_FORMAT(NOW() ,'%Y-%m-01') AND (PSA != '' OR Form137 != '' OR Form138 != '' OR Picture != '' OR MOA != '') AND Status = 1 UNION SELECT * FROM shsstud WHERE user_date >= DATE_FORMAT(NOW() ,'%Y-%m-01') AND (PSA != '' OR Form137 != '' OR Form138 != '' OR Picture != '' OR MOA != '') AND Status = 1) AS total";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            $count = $row["count"];

                                            // Display the result
                                            echo '<p><b>' . $count . ' Students</b> were able to submit their requirements this month.</p>';
                                            ?>
                                    </div>
                                </div>
                                </div>
						</div>
					</div>
                    <div class="col-xl-3 col-sm-6 col-12">
                            <div class="cs shadow p-3 mb-5 bg-white rounded">
                            <span class="h6 font-bold text-muted d-block mb-3">Requirements</span>
                                <div class="row no-gutters">
                               <div class="col-md-4">
                                <img src="/Capstone/img/docu.PNG" class="card-img m-3"style="width: 70px; margin-right:20px"alt="">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                <?php
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "db_rms";


                                        $conn = new mysqli($servername, $username, $password, $dbname);


                                        if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                        }


                                        $sql = "SELECT COUNT(NULLIF(PSA, '')) + COUNT(NULLIF(Form137, '')) + COUNT(NULLIF(Form138, '')) + COUNT(NULLIF(Picture, '')) + COUNT(NULLIF(MOA, '')) as count FROM (SELECT PSA, Form137, Form138, Picture, MOA FROM collegestud UNION SELECT PSA, Form137, Form138, Picture, MOA FROM shsstud) as all_reqs";


                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {

                                            echo "<p><strong>" . $row["count"] . " requirements</strong> have been submitted this month.</p>";
                                        }
                                        } else {
                                        echo "<p><strong>0 requirements</strong> have been submitted this month</p>";
                                        }
                                        ?>

                                    </div>
                                </div>
                                </div>
						</div>
					</div>
                    <div class="col-xl-3 col-sm-6 col-12">
                            <div class="cs shadow p-3 mb-5 bg-white rounded">
                            <span class="h6 font-bold text-muted d-block mb-3">Requirements</span>
                                <div class="row no-gutters">
                               <div class="col-md-4">
                                <img src="/Capstone/img/docu.PNG" class="card-img m-3"style="width: 70px; margin-right:20px"alt="">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                <?php

                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "db_rms";

                                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                                        if (!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }


                                        $query = "SELECT column_name, count FROM (
                                            SELECT 'PSA' AS column_name, COUNT(*) AS count FROM (
                                                SELECT user_date, PSA FROM collegestud WHERE PSA <> '' AND PSA IS NOT NULL
                                                UNION ALL
                                                SELECT user_date, PSA FROM shsstud WHERE PSA <> '' AND PSA IS NOT NULL
                                            ) AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                            UNION ALL
                                            SELECT 'Form137' AS column_name, COUNT(*) AS count FROM (
                                                SELECT user_date, Form137 FROM collegestud WHERE Form137 <> '' AND Form137 IS NOT NULL
                                                UNION ALL
                                                SELECT user_date, Form137 FROM shsstud WHERE Form137 <> '' AND Form137 IS NOT NULL
                                            ) AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                            UNION ALL
                                            SELECT 'Form138' AS column_name, COUNT(*) AS count FROM (
                                                SELECT user_date, Form138 FROM collegestud WHERE Form138 <> '' AND Form138 IS NOT NULL
                                                UNION ALL
                                                SELECT user_date, Form138 FROM shsstud WHERE Form138 <> '' AND Form138 IS NOT NULL
                                            ) AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                            UNION ALL
                                            SELECT 'Picture' AS column_name, COUNT(*) AS count FROM (
                                                SELECT user_date, Picture FROM collegestud WHERE Picture <> '' AND Picture IS NOT NULL
                                                UNION ALL
                                                SELECT user_date, Picture FROM shsstud WHERE Picture <> '' AND Picture IS NOT NULL
                                            ) AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                            UNION ALL
                                            SELECT 'MOA' AS column_name, COUNT(*) AS count FROM (
                                                SELECT user_date, MOA FROM collegestud WHERE MOA <> '' AND MOA IS NOT NULL
                                                UNION ALL
                                                SELECT user_date, MOA FROM shsstud WHERE MOA <> '' AND MOA IS NOT NULL
                                            ) AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                        ) AS counts
                                        WHERE count > 0
                                        ORDER BY count DESC
                                        LIMIT 1";

                                        $result = mysqli_query($conn, $query);


                                        if (!$result) {
                                            echo "Error: " . $query . "<br>" . mysqli_error($conn);
                                        }

                                        if (mysqli_num_rows($result) > 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            echo "<p><strong>". $row['column_name'] . "</strong> is often submitted by students in recent months.</p>";
                                        } else {
                                            echo "<strong>No one</strong> still submitting.";
                                        }

                                        mysqli_close($conn);
                                        ?>

                                    </div>
                                </div>
                                </div>
						</div>
					</div>
                    <div class="col-xl-3 col-sm-6 col-12">
                            <div class="cs shadow p-3 mb-5 bg-white rounded">
                            <span class="h6 font-bold text-muted d-block mb-3">Requirements</span>
                                <div class="row no-gutters">
                               <div class="col-md-4">
                                <img src="/Capstone/img/docu.PNG" class="card-img m-3"style="width: 70px; margin-right:20px"alt="">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                <?php

                                                $servername = "localhost";
                                                $username = "root";
                                                $password = "";
                                                $dbname = "db_rms";

                                                $conn = mysqli_connect($servername, $username, $password, $dbname);

                                                if (!$conn) {
                                                    die("Connection failed: " . mysqli_connect_error());
                                                }

                                                $query = "SELECT 'PSA' AS column_name, COUNT(*) AS count FROM (SELECT user_date, PSA FROM collegestud WHERE PSA <> '' UNION ALL SELECT user_date, PSA FROM shsstud WHERE PSA <> '') AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                                    UNION ALL
                                                    SELECT 'Form137' AS column_name, COUNT(*) AS count FROM (SELECT user_date, Form137 FROM collegestud WHERE Form137 <> '' UNION ALL SELECT user_date, Form137 FROM shsstud WHERE Form137 <> '') AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                                    UNION ALL
                                                    SELECT 'Form138' AS column_name, COUNT(*) AS count FROM (SELECT user_date, Form138 FROM collegestud WHERE Form138 <> '' UNION ALL SELECT user_date, Form138 FROM shsstud WHERE Form138 <> '') AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                                    UNION ALL
                                                    SELECT 'Picture' AS column_name, COUNT(*) AS count FROM (SELECT user_date, Picture FROM collegestud WHERE Picture <> '' UNION ALL SELECT user_date, Picture FROM shsstud WHERE Picture <> '') AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                                    UNION ALL
                                                    SELECT 'MOA' AS column_name, COUNT(*) AS count FROM (SELECT user_date, MOA FROM collegestud WHERE MOA <> '' UNION ALL SELECT user_date, MOA FROM shsstud WHERE MOA <> '') AS user_data WHERE user_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                                                    ORDER BY count ASC LIMIT 1";

                                                $result = mysqli_query($conn, $query);

                                                if (!$result) {
                                                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                                                }


                                                $row = mysqli_fetch_assoc($result);
                                                if ($row['count'] > 0) {
                                                    echo "<p><strong>". $row['column_name'] . "</strong> is the most rarely submitted document in recent months.</p>";
                                                } else {
                                                    echo "<strong>Insufficient data</strong> to determine the most rarely submitted document(s).";
                                                }


                                                mysqli_close($conn);
                                            ?>


                                    </div>
                                </div>
                                </div>
						</div>
					</div>
                            </div>
                        </div>
                        <div class="carousel-item">
                        <div class="row justify-content-center">
                        <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                            <div class="cs shadow p-3 mb-5 bg-white rounded">
                            <span class="h6 font-bold text-muted d-block mb-2">Submissions</span>
                                <div class="row no-gutters">
                               <div class="col-md-4">
                                <img src="/Capstone/img/check.PNG" class="card-img m-3"style="width: 70px; margin-right:20px"alt="">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                <?php

                                $conn = mysqli_connect("localhost", "root", "", "db_rms");


                                if (mysqli_connect_errno()) {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                    exit();
                                }


                                $sql = "(SELECT Firstname, Lastname, user_date, PSA, Form137, Form138, Picture, MOA FROM collegestud)
                                UNION
                                (SELECT Firstname, Lastname, user_date, PSA, Form137, Form138, Picture, MOA FROM shsstud)
                                ORDER BY user_date DESC
                                LIMIT 1";


                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);


                                    $num_docs = 0;
                                    $doc_names = ['PSA', 'Form137', 'Form138', 'Picture', 'MOA'];
                                    foreach ($doc_names as $doc_name) {
                                        if (!empty($row[$doc_name]) && $row[$doc_name] !== NULL) {
                                            $num_docs++;
                                        }
                                    }


                                    if ($num_docs > 0) {
                                        echo "<p><strong>" . $row['Firstname'] . " " . $row['Lastname'] . "</strong> already submitted " . $num_docs . " document(s) and has been updated recently.</p>";
                                    } else {
                                        echo "<p><strong>" . $row['Firstname'] . " " . $row['Lastname'] . "</strong> has not submitted any documents recently.</p>";
                                    }
                                } else {
                                    echo "<strong>No users</strong> found in the database.";
                                }
                                ?>
                                    </div>
                                </div>
                                </div>
						</div>
					</div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                            <div class="cs shadow p-3 mb-5 bg-white rounded">
                            <span class="h6 font-bold text-muted d-block mb-2">Submissions</span>
                                <div class="row no-gutters">
                               <div class="col-md-4">
                                <img src="/Capstone/img/check.PNG" class="card-img m-3"style="width: 70px; margin-right:20px"alt="">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                <?php

                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "db_rms";

                                    $conn = mysqli_connect($servername, $username, $password, $dbname);


                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    $query = "SELECT Course, COUNT(*) as count FROM (
                                                SELECT * 
                                                FROM collegestud 
                                                WHERE Status = 1 
                                                AND Year = YEAR(NOW()) 
                                                AND (
                                                    PSA <> '' 
                                                    OR Form137 <> '' 
                                                    OR Form138 <> '' 
                                                    OR Picture <> '' 
                                                    OR MOA <> ''
                                                )
                                            ) AS user_data
                                            WHERE (
                                                LENGTH(PSA) > 0 
                                                AND LENGTH(Form137) > 0 
                                                AND LENGTH(Form138) > 0 
                                                AND LENGTH(Picture) > 0 
                                                AND LENGTH(MOA) > 0
                                            )
                                            GROUP BY Course
                                            ORDER BY count DESC
                                            LIMIT 1";

                                    $result = mysqli_query($conn, $query);

                                    if (!$result) {
                                        echo "Error: " . $query . "<br>" . mysqli_error($conn);
                                    }


                                    if ($row = mysqli_fetch_assoc($result)) {
                                        $course = $row['Course'];
                                        switch ($course) {
                                            case 'BS Information Technology':
                                                $course = 'BSIT';
                                                break;
                                            case 'BS Computer Science':
                                                $course = 'BSCS';
                                                break;
                                            case 'BS Civil Engineering':
                                                $course = 'BSCE';
                                                break;
                                            case 'BS Industrial Engineering':
                                                $course = 'BSIE';
                                                break;
                                            case 'BS Computer Engineering':
                                                $course = 'BSCompE';
                                                break;
                                            case 'BS Nursing':
                                                $course = 'BSN';
                                                break;
                                            case 'BS Physical Therapy':
                                                $course = 'BSPT';
                                                break;
                                            case 'BS Accountancy':
                                                $course = 'BSA';
                                                break;
                                            case 'BS Business Administration Major in Marketing Management':
                                                $course = 'BSBA-Marketing Management';
                                                break;
                                            case 'BS Tourism':
                                                $course = 'BST';
                                                break;
                                            case 'BS Hospitality & Management':
                                                $course = 'BSHM';
                                                break;
                                            case 'BS Criminology':
                                                $course = 'BSCrim';
                                                break;
                                            case 'BS Psychology':
                                                $course = 'BSPsych';
                                                break;
                                            case 'AB Psychology':
                                                $course = 'ABPysch';
                                                break;
                                            case 'AB Communication':
                                                $course = 'ABComm';
                                                break;
                                            case 'Bachelor of Secondary Education Major in English':
                                                $course = 'BSED-Major in English';
                                                break;
                                            case 'Bachelor of Secondary Education Major in Filipino':
                                                $course = 'BSED-Major in Filipino';
                                                break;
                                            case 'Bachelor of Secondary Education Major in Mathematics':
                                                $course = 'BSED-Major in Mathematics';
                                                break;
                                            case 'Bachelor of Secondary Education Major in Biological Science':
                                                $course = 'BSED-Major in Biological Science';
                                                break;
                                            case 'Bachelor of Secondary Education Major in Physical Education':
                                                $course = 'BSED-Major in Physical Education';
                                                break;
                                            case 'Bachelor of Elementary Education':
                                                $course = 'BEED';
                                                break;
                                            default:
                                                break;
                                        }
                                        echo "<p><strong>$course</strong> has the most students with complete documents in College.</p>";
                                    } else {
                                        echo "<strong>No courses</strong> found with complete documents.";
                                    }
                                    ?>
                                    </div>
                                </div>
                                </div>
						</div>
					</div>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                            <div class="cs shadow p-3 mb-5 bg-white rounded">
                            <span class="h6 font-bold text-muted d-block mb-2">Submissions</span>
                                <div class="row no-gutters">
                               <div class="col-md-4">
                                <img src="/Capstone/img/check.PNG" class="card-img m-3"style="width: 70px; margin-right:20px"alt="">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                <?php

                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "db_rms";

                                $conn = mysqli_connect($servername, $username, $password, $dbname);

                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $query = "SELECT Strand, COUNT(*) as count FROM (
                                            SELECT * 
                                            FROM shsstud 
                                            WHERE Status = 1 
                                            AND Year = YEAR(NOW()) 
                                            AND (
                                                PSA <> '' 
                                                OR Form137 <> '' 
                                                OR Form138 <> '' 
                                                OR Picture <> '' 
                                                OR MOA <> ''
                                            )
                                        ) AS user_data
                                        WHERE (
                                            LENGTH(PSA) > 0 
                                            AND LENGTH(Form137) > 0 
                                            AND LENGTH(Form138) > 0 
                                            AND LENGTH(Picture) > 0 
                                            AND LENGTH(MOA) > 0
                                        )
                                        GROUP BY Strand
                                        ORDER BY count DESC
                                        LIMIT 1";

                                $result = mysqli_query($conn, $query);


                                if (!$result) {
                                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                                }


                                if ($row = mysqli_fetch_assoc($result)) {
                                    $strand = $row['Strand'];
                                    switch ($strand) {
                                        case 'Accountacy & Business Management (ABM)':
                                            $strand = 'ABM';
                                            break;
                                        case 'Science, Technology, Engineering & Mathematics (STEM)':
                                            $strand = 'STEM';
                                            break;
                                        case 'Humanities and Social Science (HUMSS)':
                                            $strand = 'HUMSS';
                                            break;
                                        case 'General Academics (GAS)':
                                            $strand = 'GAS';
                                            break;
                                        case 'Computer System Servicing (ICT)':
                                            $strand = 'ICT';
                                            break;
                                        case 'Home Economics (HE)':
                                            $strand = 'HE';
                                            break;
                                        case 'Arts and Design (A&D)':
                                            $strand = 'A&D';
                                            break;
                                        default:
                                            break;
                                    }
                                    echo "<p><strong>$strand</strong> has the most students with complete documents in SHS.</p>";
                                } else {
                                    echo "<strong>No strands</strong> found with complete documents.";
                                }

                            ?>

                                    </div>
                                </div>
                                </div>
						</div>
					</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            </section>
        <br>
        <h5 data-aos="fade-up" data-aos-delay="400"> Student Overview</h5>
        <br>
    <section data-aos="fade-up" data-aos-delay="400">
    <div class="row">
  <div class="col-sm-6 shadow p-3 mb-5 bg-white rounded" style="margin-right 100px; height: 560px; overflow-y: scroll;" id="colls">
    <div class="card-body">
      <h5 class="card-title">College</h5>
      <p class="card-text">Student's statistics based on course</p>
      <table id="example" class="table" style="width:100%">
        <thead>
            <tr>
                <th>Course</th>
                <th>Complete</th>
                <th>Incomplete</th>
            </tr>
        </thead>
        <tbody class="table-striped">
            <tr>
                <td>BS Information Technology</td>
                <td>
                <?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Information Technology') AND (Year = $current_year)
                        ) as counts";
                            

                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {
 
                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?>
                        </td>
                <td>
                    <?php

                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Information Technology' AND Year = YEAR(CURDATE())
                                    ) as counts;";


                    $result = $conn->query($query);


                    $row = $result->fetch_assoc();


                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?>
                    </td>
            </tr>
            <tr>
                <td>BS Computer Science</td>
                <td><?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Computer Science') AND (Year = $current_year)
                        ) as counts";
                            

                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {

                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?></td>
                <td><?php

                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Computer Science' AND Year = YEAR(CURDATE())
                                    ) as counts;";


                    $result = $conn->query($query);


                    $row = $result->fetch_assoc();


                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Civil Engineering</td>
                <td><?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Civil Engineering') AND (Year = $current_year)
                        ) as counts";
                            

                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {

                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?></td>
                <td><?php

                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Civil Engineering' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    $result = $conn->query($query);


                    $row = $result->fetch_assoc();


                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Industrial Engineering</td>
                <td><?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Industrial Engineering') AND (Year = $current_year)
                        ) as counts";
                            

                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {

                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?></td>
                <td><?php

                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Industrial Engineering' AND Year = YEAR(CURDATE())
                                    ) as counts;";


                    $result = $conn->query($query);


                    $row = $result->fetch_assoc();


                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Computer Engineering</td>
                <td><?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Computer Engineering') AND (Year = $current_year)
                        ) as counts";
                            

                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {

                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?></td>
                <td><?php

                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Computer Engineering' AND Year = YEAR(CURDATE())
                                    ) as counts;";


                    $result = $conn->query($query);

                    $row = $result->fetch_assoc();


                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Nursing</td>
                <td><?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Nursing') AND (Year = $current_year)
                        ) as counts";
                            

                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {

                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?></td>
                <td><?php

                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Nursing' AND Year = YEAR(CURDATE())
                                    ) as counts;";


                    $result = $conn->query($query);


                    $row = $result->fetch_assoc();

                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Physical Therapy</td>
                <td><?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Physical Therapy') AND (Year = $current_year)
                        ) as counts";
                            

                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {

                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?></td>
                <td><?php

                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Physical Therapy' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    $result = $conn->query($query);


                    $row = $result->fetch_assoc();


                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Accountancy</td>
                <td><?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Accountancy') AND (Year = $current_year)
                        ) as counts";
                            

                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {

                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?></td>
                <td><?php

                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Accountancy' AND Year = YEAR(CURDATE())
                                    ) as counts;";


                    $result = $conn->query($query);


                    $row = $result->fetch_assoc();


                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Business Administration Major in Marketing Management</td>
                <td><?php

                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Business Administration Major in Marketing Management') AND (Year = $current_year)
                        ) as counts";
                            
                    $result = $conn->query($query);
                    

                    if (mysqli_num_rows($result) > 0) {

                        $row = $result->fetch_assoc();
                                            

                        echo "" . $row['total_count'];
                    } else {

                        echo "0";
                    }
                ?></td>
                <td><?php
  
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Business Administration Major in Marketing Management' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Tourism</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Tourism') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Tourism' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Hospitality & Management</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Hospitality & Management') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Hospitality & Management' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Criminology</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Criminology') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Criminology' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>BS Psychology</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'BS Psychology') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'BS Psychology' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>AB Psychology</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'AB Psychology') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'AB Psychology' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>AB Communication</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'AB Communication') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'AB Communication' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Bachelor of Secondary Education Major in English</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'Bachelor of Secondary Education Major in English') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'Bachelor of Secondary Education Major in English' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Bachelor of Secondary Education Major in Filipino</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'Bachelor of Secondary Education Major in Filipino') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'Bachelor of Secondary Education Major in Filipino' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Bachelor of Secondary Education Major in Mathematics</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'Bachelor of Secondary Education Major in Mathematics') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'Bachelor of Secondary Education Major in Mathematics' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Bachelor of Secondary Education Major in Biological Science</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'Bachelor of Secondary Education Major in Biological Science') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'Bachelor of Secondary Education Major in Biological Science' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Bachelor of Secondary Education Major in Physical Education</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'Bachelor of Secondary Education Major in Physical Education') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'Bachelor of Secondary Education Major in Physical Education' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Bachelor of Elementary Education</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM collegestud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Course = 'Bachelor of Elementary Education') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM collegestud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Course = 'Bachelor of Elementary Education' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>

            </tbody>
      </table>
    </div>
  </div>

  <div class="col-sm-6 shadow p-3 mb-5 bg-white rounded" style="overflow-y: scroll;" id="shss">
      <div class="card-body">
        <h5 class="card-title">Senior High School</h5>
        <p class="card-text">Student's statistics based on course</p>
        <table id="example1" class="table" style="width:100%">
        <thead>
            <tr>
                <th>Strand</th>
                <th>Complete</th>
                <th>Incomplete</th>
            </tr>
        </thead>
        <tbody class="table-striped">
            <tr>
                <td>Accountacy & Business Management (ABM)</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM shsstud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Strand = 'Accountacy & Business Management (ABM)') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM shsstud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Strand = 'Accountacy & Business Management (ABM)' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Science, Technology, Engineering & Mathematics (STEM)</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM shsstud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Strand = 'Science, Technology, Engineering & Mathematics (STEM)') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM shsstud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Strand = 'Science, Technology, Engineering & Mathematics (STEM)' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Humanities and Social Science (HUMSS)</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM shsstud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Strand = 'Humanities and Social Science (HUMSS)') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM shsstud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Strand = 'Humanities and Social Science (HUMSS)' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>General Academics (GAS)</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM shsstud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Strand = 'General Academics (GAS)') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM shsstud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Strand = 'General Academics (GAS)' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Computer System Servicing (ICT)</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM shsstud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Strand = 'Computer System Servicing (ICT)') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM shsstud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Strand = 'Computer System Servicing (ICT)' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Home Economics (HE)</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM shsstud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Strand = 'Home Economics (HE)') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM shsstud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Strand = 'Home Economics (HE)' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
            <tr>
                <td>Arts and Design (A&D)</td>
                <td><?php
                    // Get the current year
                    $current_year = date('Y');

                    $query = "SELECT SUM(total) as total_count FROM (
                        SELECT COUNT(*) as total FROM shsstud 
                        WHERE (PSA IS NOT NULL) AND (Form137 IS NOT NULL) AND (Picture IS NOT NULL)
                        AND (LENGTH(PSA) > 0) AND (LENGTH(Form137) > 0) AND (LENGTH(Picture) > 0) AND (Status = 1)
                        AND (Strand = 'Arts and Design (A&D)') AND (Year = $current_year)
                        ) as counts";
                            
                    // Execute the query
                    $result = $conn->query($query);
                    
                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch the result
                        $row = $result->fetch_assoc();
                                            
                        // Print the total number of rows that match the criteria
                        echo "" . $row['total_count'];
                    } else {
                        // No results found, print "0"
                        echo "0";
                    }
                ?></td>
                <td><?php
                    // Define the query
                    $query = "SELECT COUNT(*) as total FROM (
                                SELECT * FROM shsstud 
                                WHERE (PSA IS NULL OR Form137 IS NULL OR Picture IS NULL OR LENGTH(PSA) = 0 OR LENGTH(Form137) = 0 OR LENGTH(Picture) = 0) 
                                    AND Status = 1 AND Strand = 'Arts and Design (A&D)' AND Year = YEAR(CURDATE())
                                    ) as counts;";

                    // Execute the query
                    $result = $conn->query($query);

                    // Fetch the result
                    $row = $result->fetch_assoc();

                    // Print the total number of rows that match the criteria
                    if (isset($row['total']) && $row['total'] > 0) {
                        echo $row['total'];
                    } else {
                        echo 0;
                    }
                        ?></td>
            </tr>
        </tbody>
    </table>
      </div>
  </div>
  <br>
  <section>
  <h5 class="mb-3 float-start">Requirement Overview</h5>
  <br>
  <!--<div class="float-end mb-3">
    <label for="table_filter">Filter by class:</label>
    <button class="btn btn-secondary dropdown-toggle" type="button" id="alexander" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Table  
    </button>
    <div class="dropdown-menu" aria-labelledby="type-dropdown">
      <a class="dropdown-item" onclick="selectValue('College')">College</a>
      <a class="dropdown-item" onclick="selectValue('SHS')">SHS</a>
    </div>
  </div>
                -->
  <div id="charty">
    <div data-aos="fade-up">
    <div class="inputsss">
      <form id="myForm" method="post" action="">
        <?php
          $from_year = isset($_POST['from_year']) ? $_POST['from_year'] : date('Y'); // Get the posted value or the current year
          $to_year = isset($_POST['to_year']) ? $_POST['to_year'] : date('Y') + 1; // Get the posted value or the current year + 1
        ?>
        <b class="float-start mt-4"> From </b>
        <input autocomplete="off" class="form-control form-control-sm mt-4 mb-3 float-start c1" type="text" name="from_year" id="from-year-select" value="<?php echo $from_year; ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" style="max-width: 100px" required>
        <b class="float-start mt-4 c2"> to </b>
        <input autocomplete="off" class="form-control form-control-sm mt-4 mb-3 float-start c" type="text" name="to_year" id="to-year-select" value="<?php echo $to_year; ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" style="max-width: 100px" required>
        <button type="submit" class="btn btn-primary mt-4 mb-3 ml-3 c1" name="filter_btn" onclick="validateYearInput()">Filter</button>
        <button type="reset" class="btn btn-secondary mt-4 mb-3 ml-3 c2">Reset</button>
        <div class="dropdown float-end mb-3 ml-3">
  <button class="btn btn-secondary dropdown-toggle" style="margin-right: 60px;" type="button" id="class_filter_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Filter by Dept.
  </button>
  <div class="dropdown-menu" aria-labelledby="class_filter_dropdown">
    <a class="dropdown-item" onclick="selectDeptValue('CCS')">College of Computer Studies</a>
    <a class="dropdown-item" onclick="selectDeptValue('COE')">College of Engineering</a>
    <a class="dropdown-item" onclick="selectDeptValue('CON')">College of Nursing</a>
    <a class="dropdown-item" onclick="selectDeptValue('CIHTM')">College of Tourism</a>
    <a class="dropdown-item" onclick="selectDeptValue('COED')">College of Education</a>
    <a class="dropdown-item" onclick="selectDeptValue('COC')">College of Criminology</a>
    <a class="dropdown-item" onclick="selectDeptValue('CAS')">College of Arts and Sciences</a>
    <a class="dropdown-item" onclick="selectDeptValue('CBA')">College of Business and Accountancy</a>
  </div>
</div>
    </div>
    <div id="error-message" class="text-danger"></div>
    <h5 class="mb-4">COLLEGE</h5>
    <div class="chart shadow p-3 mb-5 bg-white rounded" id="chart-container">
      <canvas id="Bar Chart College"></canvas>
    </div>
                </div>
    <br>
    <div data-aos="fade-up">
    <div class="dropdown float-left mb-3 ml-3" style="margin-left:1090px;">
  <button class="btn btn-secondary dropdown-toggle" style="margin-right: 60px;" type="button" id="class_filter_dropdownnn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Filter by Strand
  </button>
  <div class="dropdown-menu" aria-labelledby="class_filter_dropdownnn">
    <a class="dropdown-item" onclick="selectStrandValue('ABM')">Accountacy & Business Management (ABM)</a>
    <a class="dropdown-item" onclick="selectStrandValue('STEM')">Science, Technology,Engineering & Mathematics (STEM)</a>
    <a class="dropdown-item" onclick="selectStrandValue('HUMSS')">Humanities and Social Science (HUMSS)</a>
    <a class="dropdown-item" onclick="selectStrandValue('GAS')">General Academics (GAS)</a>
    <a class="dropdown-item" onclick="selectStrandValue('ICT')">Computer System Servicing (ICT)</a>
    <a class="dropdown-item" onclick="selectStrandValue('HE')">Home Economics (HE)</a>
    <a class="dropdown-item" onclick="selectStrandValue('A&D')">Arts and Design (A&D)</a>
  </div>
</div>
<div id="error-message" class="text-danger" ></div>
<h5 class="mb-4">SENIOR HIGH SCHOOL</h5>
<div class="chart shadow p-3 mb-5 bg-white rounded" id="chart-container1">
  <canvas id="Bar Chart SHS"></canvas>
</div>
</div>
</div>
                </div>
</form>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" ></script>
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
  // Function to validate year input and ensure "From Year" is before "To Year"
  function validateYearInput() {
    var fromYear = parseInt(document.getElementById('from-year-select').value);
    var toYear = parseInt(document.getElementById('to-year-select').value);
    var filterBtn = document.getElementsByName('filter_btn')[0]; // Get the "Filter" button element
    var errorElement = document.getElementById('error-message');
    var fromYearInput = document.getElementById('from-year-select');
    var toYearInput = document.getElementById('to-year-select');
    var form = document.querySelector('form');

    if (isNaN(toYear) || toYear < fromYear) {
      filterBtn.disabled = true; // Disable the "Filter" button
      errorElement.innerText = 'Invalid Input';
      fromYearInput.value = ''; // Reset the "From Year" input
      toYearInput.value = ''; // Reset the "To Year" input
    } else {
      filterBtn.disabled = false; // Enable the "Filter" button
      errorElement.innerText = '';
      form.submit(); // Submit the form if inputs are valid
    }
  }
  
  // Function to reset inputs and enable "Filter" button
  function resetInputs() {
    var filterBtn = document.getElementsByName('filter_btn')[0]; // Get the "Filter" button element
    var errorElement = document.getElementById('error-message');
    var fromYearInput = document.getElementById('from-year-select');
    var toYearInput = document.getElementById('to-year-select');

    filterBtn.disabled = false; // Enable the "Filter" button
    errorElement.innerText = '';
    fromYearInput.value = ''; // Reset the "From Year" input
    toYearInput.value = ''; // Reset the "To Year" input
  }
  
  // Add event listener to form's reset button
  document.getElementById('myForm').addEventListener('reset', resetInputs);
</script>

<?php

// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "db_rms");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set default values for 'From' and 'To' year
$current_year = date("Y"); // Get the current year
$current_year1 = date("Y")+ 1; // Get the current year +1 
$from_year = $current_year; // Use current year as default 'From' year
$to_year = $current_year1; // Use current year as default 'To' year

// Get the input years from the form if provided
if (isset($_POST['from_year']) && !empty($_POST['from_year'])) {
    $from_year = mysqli_real_escape_string($conn, $_POST['from_year']);
}

if (isset($_POST['to_year']) && !empty($_POST['to_year'])) {
    $to_year = mysqli_real_escape_string($conn, $_POST['to_year']);
}

// BS Information Technology
$sql_collegebsit = "SELECT COUNT(*) AS count_psa, 
    (SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Information Technology') AS count_form137, 
    (SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Information Technology') AS count_form138, 
    (SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Information Technology') AS count_picture, 
    (SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Information Technology') AS count_moa 
    FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Information Technology'";

$result_collegebsit = mysqli_query($conn, $sql_collegebsit);
$row_collegebsit = mysqli_fetch_assoc($result_collegebsit);

// BS Computer Science
$sql_collegebscs = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Science') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Science') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Science') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Science') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Science'";

$result_collegebscs = mysqli_query($conn, $sql_collegebscs);
$row_collegebscs = mysqli_fetch_assoc($result_collegebscs);


//BS Tourism
$sql_collegebstm = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Tourism') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Tourism') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Tourism') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Tourism') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Tourism'";

$result_collegebstm = mysqli_query($conn, $sql_collegebstm);
$row_collegebstm = mysqli_fetch_assoc($result_collegebstm);

//BS Hospitality & Management	
$sql_collegebshm = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Hospitality & Management') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Hospitality & Management') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Hospitality & Management') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Hospitality & Management') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Hospitality & Management'";

$result_collegebshm = mysqli_query($conn, $sql_collegebshm);
$row_collegebshm = mysqli_fetch_assoc($result_collegebshm);

// BS Civil Engineering
$sql_collegebsce = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Civil Engineering') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Civil Engineering') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Civil Engineering') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Civil Engineering') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Civil Engineering'";

$result_collegebsce = mysqli_query($conn, $sql_collegebsce);
$row_collegebsce = mysqli_fetch_assoc($result_collegebsce);

// BS Industrial Engineering
$sql_collegebsie = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Industrial Engineering') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Industrial Engineering') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Industrial Engineering') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Industrial Engineering') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Industrial Engineering'";

$result_collegebsie = mysqli_query($conn, $sql_collegebsie);
$row_collegebsie = mysqli_fetch_assoc($result_collegebsie);

// BS Computer Engineering
$sql_collegebscomp = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Engineering') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Engineering') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Engineering') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Engineering') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Computer Engineering'";

$result_collegebscomp = mysqli_query($conn, $sql_collegebscomp);
$row_collegebscomp = mysqli_fetch_assoc($result_collegebscomp);

// BS Nursing
$sql_collegebsn = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Nursing') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Nursing') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Nursing') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Nursing') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Nursing'";

$result_collegebsn = mysqli_query($conn, $sql_collegebsn);
$row_collegebsn = mysqli_fetch_assoc($result_collegebsn);

// BS Physical Therapy
$sql_collegebspt = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Physical Therapy') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Physical Therapy') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Physical Therapy') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Physical Therapy') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Physical Therapy'";

$result_collegebspt = mysqli_query($conn, $sql_collegebspt);
$row_collegebspt = mysqli_fetch_assoc($result_collegebspt);

// Bachelor of Elementary Education
$sql_collegebee = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Elementary Education') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Elementary Education') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Elementary Education') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Elementary Education') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Elementary Education'";

$result_collegebee = mysqli_query($conn, $sql_collegebee);
$row_collegebee = mysqli_fetch_assoc($result_collegebee);

// Bachelor of Secondary Education Major in English
$sql_collegebsedme = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in English') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in English') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in English') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in English') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in English'";

$result_collegebsedme = mysqli_query($conn, $sql_collegebsedme);
$row_collegebsedme = mysqli_fetch_assoc($result_collegebsedme);


// Bachelor of Secondary Education Major in Filipino
$sql_collegebsedmf = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Filipino') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Filipino') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Filipino') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Filipino') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Filipino'";

$result_collegebsedmf = mysqli_query($conn, $sql_collegebsedmf);
$row_collegebsedmf = mysqli_fetch_assoc($result_collegebsedmf);

// Bachelor of Secondary Education Major in Mathematics
$sql_collegebsedmm = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Mathematics') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Mathematics') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Mathematics') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Mathematics') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Mathematics'";

$result_collegebsedmm = mysqli_query($conn, $sql_collegebsedmm);
$row_collegebsedmm = mysqli_fetch_assoc($result_collegebsedmm);


// Bachelor of Secondary Education Major in Biological Science
$sql_collegebsedbs = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Biological Science') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Biological Science') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Biological Science') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Biological Science') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Biological Science'";

$result_collegebsedbs = mysqli_query($conn, $sql_collegebsedbs);
$row_collegebsedbs = mysqli_fetch_assoc($result_collegebsedbs);

// Bachelor of Secondary Education Major in Physical Education
$sql_collegebsedpe = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Physical Education') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Physical Education') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Physical Education') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Physical Education') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'Bachelor of Secondary Education Major in Physical Education'";

$result_collegebsedpe = mysqli_query($conn, $sql_collegebsedpe);
$row_collegebsedpe = mysqli_fetch_assoc($result_collegebsedpe);


// BS Criminology
$sql_collegebscrim = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Criminology') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Criminology') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Criminology') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Criminology') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Criminology'";

$result_collegebscrim = mysqli_query($conn, $sql_collegebscrim);
$row_collegebscrim = mysqli_fetch_assoc($result_collegebscrim);


// BS Psychology
$sql_collegebspsy = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Psychology') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Psychology') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Psychology') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Psychology') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Psychology'";

$result_collegebspsy = mysqli_query($conn, $sql_collegebspsy);
$row_collegebspsy = mysqli_fetch_assoc($result_collegebspsy);

// AB Psychology
$sql_collegeabpsy = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Psychology') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Psychology') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Psychology') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Psychology') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Psychology'";

$result_collegeabpsy = mysqli_query($conn, $sql_collegeabpsy);
$row_collegeabpsy = mysqli_fetch_assoc($result_collegeabpsy);

// AB Communication
$sql_collegeabcom = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Communication') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Communication') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Communication') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Communication') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'AB Communication'";

$result_collegeabcom = mysqli_query($conn, $sql_collegeabcom);
$row_collegeabcom = mysqli_fetch_assoc($result_collegeabcom);


// BS Accountancy
$sql_collegebsacc = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Accountancy') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Accountancy') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Accountancy') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Accountancy') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Accountancy'";

$result_collegebsacc = mysqli_query($conn, $sql_collegebsacc);
$row_collegebsacc = mysqli_fetch_assoc($result_collegebsacc);


// BS Business Administration Major in Marketing Management
$sql_collegebsaccm = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM collegestud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Business Administration Major in Marketing Management') AS count_form137, 
(SELECT COUNT(*) FROM collegestud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Business Administration Major in Marketing Management') AS count_form138, 
(SELECT COUNT(*) FROM collegestud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Business Administration Major in Marketing Management') AS count_picture, 
(SELECT COUNT(*) FROM collegestud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Business Administration Major in Marketing Management') AS count_moa 
FROM collegestud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Course = 'BS Business Administration Major in Marketing Management'";

$result_collegebsaccm = mysqli_query($conn, $sql_collegebsaccm);
$row_collegebsaccm = mysqli_fetch_assoc($result_collegebsaccm);
?>

<script>
// Function to handle dropdown selection for Filter by Dept.
function selectDeptValue(value) {
  const chart = Chart.getChart('Bar Chart College'); // Get the chart instance
  const errorMessage = document.getElementById('error-message'); // Get the error message element
  const chartContainer = document.getElementById('chart-container'); // Get the chart container element

  if (!value) {
    // If no value is selected, hide the chart container and display error message
    chartContainer.style.display = 'none';
    errorMessage.textContent = 'Select a Department to view';
    document.getElementById('class_filter_dropdown').textContent = 'Filter by Dept.'; // Update the text of the dropdown button with default value
  } else {
    // If a value is selected, show the chart container and hide error message
    chartContainer.style.display = 'block';
    errorMessage.textContent = '';
    document.getElementById('class_filter_dropdown').textContent = value; // Update the text of the dropdown button with selected value
  }

  chart.data.datasets.forEach(dataset => {
    // Hide all datasets by default
    dataset.hidden = true;
    // Show respective datasets based on selected value
    if (value === 'CCS' && (dataset.label === 'BSIT' || dataset.label === 'BSCS')) {
      dataset.hidden = false;
    } else if (value === 'CIHTM' && (dataset.label === 'BS Tourism' || dataset.label === 'BS Hospitality & Management')) {
      dataset.hidden = false;
    }
     else if (value === 'COE' && (dataset.label === 'BSCE' || dataset.label === 'BSIE' || dataset.label === 'BSCOMPE')) {
      dataset.hidden = false;
    }
    else if (value === 'CON' && (dataset.label === 'BSN' || dataset.label === 'BSPT')) {
      dataset.hidden = false;
    }
    else if (value === 'COED' && (dataset.label === 'BEED' || dataset.label === 'BSED-Major in English' || dataset.label === 'BSED-Major in Mathematics' || dataset.label === 'BSED-Major in Filipino' || dataset.label === 'BSED-Major in Biological Science' || dataset.label === 'BSED-Major in Physical Education')) {
      dataset.hidden = false;
    } 
    else if (value === 'COC' && (dataset.label === 'BSCRIM')) {
      dataset.hidden = false;
    } 
    else if (value === 'CAS' && (dataset.label === 'BSPSYCH' || dataset.label === 'ABPSYCH' || dataset.label === 'ABCOMM')) {
      dataset.hidden = false;
    } 
    else if (value === 'CBA' && (dataset.label === 'BSA' || dataset.label === 'BSBA-Marketing Management')) {
      dataset.hidden = false;
    } 

  });
  chart.update(); // Update the chart to reflect changes
}

const ctx = document.getElementById('Bar Chart College').getContext('2d');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['PSA', 'Form 137', 'Form 138', '2x2 Picture', 'MoA'],
    datasets: [{
      label: 'BSIT',
      data: [
        <?php echo $row_collegebsit['count_psa']; ?>,
        <?php echo $row_collegebsit['count_form137']; ?>,
        <?php echo $row_collegebsit['count_form138']; ?>,
        <?php echo $row_collegebsit['count_picture']; ?>,
        <?php echo $row_collegebsit['count_moa']; ?>
      ],
    },{
      label: 'BSCS',
      data: [
        <?php echo $row_collegebscs['count_psa']; ?>,
        <?php echo $row_collegebscs['count_form137']; ?>,
        <?php echo $row_collegebscs['count_form138']; ?>,
        <?php echo $row_collegebscs['count_picture']; ?>,
        <?php echo $row_collegebscs['count_moa']; ?>
      ],
    },{
        label: 'BS Tourism',
      data: [
        <?php echo $row_collegebstm['count_psa']; ?>,
        <?php echo $row_collegebstm['count_form137']; ?>,
        <?php echo $row_collegebstm['count_form138']; ?>,
        <?php echo $row_collegebstm['count_picture']; ?>,
        <?php echo $row_collegebstm['count_moa']; ?>
      ],
    },{
        label: 'BS Hospitality & Management',
      data: [
        <?php echo $row_collegebshm['count_psa']; ?>,
        <?php echo $row_collegebshm['count_form137']; ?>,
        <?php echo $row_collegebshm['count_form138']; ?>,
        <?php echo $row_collegebshm['count_picture']; ?>,
        <?php echo $row_collegebshm['count_moa']; ?>
      ],
    },{
      label: 'BSCE',
      data: [
        <?php echo $row_collegebsce['count_psa']; ?>,
        <?php echo $row_collegebsce['count_form137']; ?>,
        <?php echo $row_collegebsce['count_form138']; ?>,
        <?php echo $row_collegebsce['count_picture']; ?>,
        <?php echo $row_collegebsce['count_moa']; ?>
      ],
    },{
        label: 'BSIE',
      data: [
        <?php echo $row_collegebsie['count_psa']; ?>,
        <?php echo $row_collegebsie['count_form137']; ?>,
        <?php echo $row_collegebsie['count_form138']; ?>,
        <?php echo $row_collegebsie['count_picture']; ?>,
        <?php echo $row_collegebsie['count_moa']; ?>
      ],
    },{
        label: 'BSCOMPE',
      data: [
        <?php echo $row_collegebscomp['count_psa']; ?>,
        <?php echo $row_collegebscomp['count_form137']; ?>,
        <?php echo $row_collegebscomp['count_form138']; ?>,
        <?php echo $row_collegebscomp['count_picture']; ?>,
        <?php echo $row_collegebscomp['count_moa']; ?>
      ],
    },{
        label: 'BSN',
      data: [
        <?php echo $row_collegebsn['count_psa']; ?>,
        <?php echo $row_collegebsn['count_form137']; ?>,
        <?php echo $row_collegebsn['count_form138']; ?>,
        <?php echo $row_collegebsn['count_picture']; ?>,
        <?php echo $row_collegebsn['count_moa']; ?>
      ],
    },{
        label: 'BSPT',
      data: [
        <?php echo $row_collegebspt['count_psa']; ?>,
        <?php echo $row_collegebspt['count_form137']; ?>,
        <?php echo $row_collegebspt['count_form138']; ?>,
        <?php echo $row_collegebspt['count_picture']; ?>,
        <?php echo $row_collegebspt['count_moa']; ?>
      ],
    },{
        label: 'BEED',
      data: [
        <?php echo $row_collegebee['count_psa']; ?>,
        <?php echo $row_collegebee['count_form137']; ?>,
        <?php echo $row_collegebee['count_form138']; ?>,
        <?php echo $row_collegebee['count_picture']; ?>,
        <?php echo $row_collegebee['count_moa']; ?>
      ],
    },{
        label: 'BSED-Major in English',
      data: [
        <?php echo $row_collegebsedme['count_psa']; ?>,
        <?php echo $row_collegebsedme['count_form137']; ?>,
        <?php echo $row_collegebsedme['count_form138']; ?>,
        <?php echo $row_collegebsedme['count_picture']; ?>,
        <?php echo $row_collegebsedme['count_moa']; ?>
      ],
    },{
        label: 'BSED-Major in Filipino',
      data: [
        <?php echo $row_collegebsedmf['count_psa']; ?>,
        <?php echo $row_collegebsedmf['count_form137']; ?>,
        <?php echo $row_collegebsedmf['count_form138']; ?>,
        <?php echo $row_collegebsedmf['count_picture']; ?>,
        <?php echo $row_collegebsedmf['count_moa']; ?>
      ],
    },{
        label: 'BSED-Major in Mathematics',
      data: [
        <?php echo $row_collegebsedmm['count_psa']; ?>,
        <?php echo $row_collegebsedmm['count_form137']; ?>,
        <?php echo $row_collegebsedmm['count_form138']; ?>,
        <?php echo $row_collegebsedmm['count_picture']; ?>,
        <?php echo $row_collegebsedmm['count_moa']; ?>
      ],
    },{
        label: 'BSED-Major in Biological Science',
      data: [
        <?php echo $row_collegebsedbs['count_psa']; ?>,
        <?php echo $row_collegebsedbs['count_form137']; ?>,
        <?php echo $row_collegebsedbs['count_form138']; ?>,
        <?php echo $row_collegebsedbs['count_picture']; ?>,
        <?php echo $row_collegebsedbs['count_moa']; ?>
      ],
    },{
        label: 'BSED-Major in Physical Education',
      data: [
        <?php echo $row_collegebsedpe['count_psa']; ?>,
        <?php echo $row_collegebsedpe['count_form137']; ?>,
        <?php echo $row_collegebsedpe['count_form138']; ?>,
        <?php echo $row_collegebsedpe['count_picture']; ?>,
        <?php echo $row_collegebsedpe['count_moa']; ?>
      ],
    },{
        label: 'BSCRIM',
      data: [
        <?php echo $row_collegebscrim['count_psa']; ?>,
        <?php echo $row_collegebscrim['count_form137']; ?>,
        <?php echo $row_collegebscrim['count_form138']; ?>,
        <?php echo $row_collegebscrim['count_picture']; ?>,
        <?php echo $row_collegebscrim['count_moa']; ?>
      ],
        },{
        label: 'BSPSYCH',
      data: [
        <?php echo $row_collegebspsy['count_psa']; ?>,
        <?php echo $row_collegebspsy['count_form137']; ?>,
        <?php echo $row_collegebspsy['count_form138']; ?>,
        <?php echo $row_collegebspsy['count_picture']; ?>,
        <?php echo $row_collegebspsy['count_moa']; ?>
      ],
    },{
        label: 'ABPSYCH',
      data: [
        <?php echo $row_collegeabpsy['count_psa']; ?>,
        <?php echo $row_collegeabpsy['count_form137']; ?>,
        <?php echo $row_collegeabpsy['count_form138']; ?>,
        <?php echo $row_collegeabpsy['count_picture']; ?>,
        <?php echo $row_collegeabpsy['count_moa']; ?>
      ],
    },{
        label: 'ABCOMM',
      data: [
        <?php echo $row_collegeabcom['count_psa']; ?>,
        <?php echo $row_collegeabcom['count_form137']; ?>,
        <?php echo $row_collegeabcom['count_form138']; ?>,
        <?php echo $row_collegeabcom['count_picture']; ?>,
        <?php echo $row_collegeabcom['count_moa']; ?>
      ],
    },{
        label: 'BSA',
      data: [
        <?php echo $row_collegebsacc['count_psa']; ?>,
        <?php echo $row_collegebsacc['count_form137']; ?>,
        <?php echo $row_collegebsacc['count_form138']; ?>,
        <?php echo $row_collegebsacc['count_picture']; ?>,
        <?php echo $row_collegebsacc['count_moa']; ?>
      ],
    },{
        label: 'BSBA-Marketing Management',
      data: [
        <?php echo $row_collegebsaccm['count_psa']; ?>,
        <?php echo $row_collegebsaccm['count_form137']; ?>,
        <?php echo $row_collegebsaccm['count_form138']; ?>,
        <?php echo $row_collegebsaccm['count_picture']; ?>,
        <?php echo $row_collegebsaccm['count_moa']; ?>
      ],
    }],
    options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    legend: {
      display: false
    }
  }
}
});
</script>

<?php
// Accountacy & Business Management (ABM)
$sql_shsabm = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM shsstud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Accountacy & Business Management (ABM)') AS count_form137, 
(SELECT COUNT(*) FROM shsstud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Accountacy & Business Management (ABM)') AS count_form138, 
(SELECT COUNT(*) FROM shsstud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Accountacy & Business Management (ABM)') AS count_picture, 
(SELECT COUNT(*) FROM shsstud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Accountacy & Business Management (ABM)') AS count_moa 
FROM shsstud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Strand = 'Accountacy & Business Management (ABM)'";

$result_shsabm = mysqli_query($conn, $sql_shsabm);
$row_shsabm = mysqli_fetch_assoc($result_shsabm);



// Science, Technology,Engineering & Mathematics (STEM)
$sql_shsstem = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM shsstud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Science, Technology, Engineering & Mathematics (STEM)') AS count_form137, 
(SELECT COUNT(*) FROM shsstud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Science, Technology, Engineering & Mathematics (STEM)') AS count_form138, 
(SELECT COUNT(*) FROM shsstud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Science, Technology, Engineering & Mathematics (STEM)') AS count_picture, 
(SELECT COUNT(*) FROM shsstud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Science, Technology, Engineering & Mathematics (STEM)') AS count_moa 
FROM shsstud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Strand = 'Science, Technology, Engineering & Mathematics (STEM)'";

$result_shsstem = mysqli_query($conn, $sql_shsstem);
$row_shsstem = mysqli_fetch_assoc($result_shsstem);


// Humanities and Social Science (HUMSS)
$sql_shshumss = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM shsstud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Humanities and Social Science (HUMSS)') AS count_form137, 
(SELECT COUNT(*) FROM shsstud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Humanities and Social Science (HUMSS)') AS count_form138, 
(SELECT COUNT(*) FROM shsstud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Humanities and Social Science (HUMSS)') AS count_picture, 
(SELECT COUNT(*) FROM shsstud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Humanities and Social Science (HUMSS)') AS count_moa 
FROM shsstud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Strand = 'Humanities and Social Science (HUMSS)'";

$result_shshumss = mysqli_query($conn, $sql_shshumss);
$row_shshumss = mysqli_fetch_assoc($result_shshumss);


// General Academics (GAS)
$sql_shsgas = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM shsstud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'General Academics (GAS)') AS count_form137, 
(SELECT COUNT(*) FROM shsstud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'General Academics (GAS)') AS count_form138, 
(SELECT COUNT(*) FROM shsstud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'General Academics (GAS)') AS count_picture, 
(SELECT COUNT(*) FROM shsstud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'General Academics (GAS)') AS count_moa 
FROM shsstud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Strand = 'General Academics (GAS)'";

$result_shsgas = mysqli_query($conn, $sql_shsgas);
$row_shsgas = mysqli_fetch_assoc($result_shsgas);


// Computer System Servicing (ICT)
$sql_shsict = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM shsstud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Computer System Servicing (ICT)') AS count_form137, 
(SELECT COUNT(*) FROM shsstud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Computer System Servicing (ICT)') AS count_form138, 
(SELECT COUNT(*) FROM shsstud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Computer System Servicing (ICT)') AS count_picture, 
(SELECT COUNT(*) FROM shsstud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Computer System Servicing (ICT)') AS count_moa 
FROM shsstud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Strand = 'Computer System Servicing (ICT)'";

$result_shsict = mysqli_query($conn, $sql_shsict);
$row_shsict = mysqli_fetch_assoc($result_shsict);


// Home Economics (HE)
$sql_shshe = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM shsstud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Home Economics (HE)') AS count_form137, 
(SELECT COUNT(*) FROM shsstud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Home Economics (HE)') AS count_form138, 
(SELECT COUNT(*) FROM shsstud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Home Economics (HE)') AS count_picture, 
(SELECT COUNT(*) FROM shsstud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Home Economics (HE)') AS count_moa 
FROM shsstud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Strand = 'Home Economics (HE)'";

$result_shshe = mysqli_query($conn, $sql_shshe);
$row_shshe = mysqli_fetch_assoc($result_shshe);


// Arts and Design (A&D)
$sql_shsad = "SELECT COUNT(*) AS count_psa, 
(SELECT COUNT(*) FROM shsstud WHERE Form137 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Arts and Design (A&D)') AS count_form137, 
(SELECT COUNT(*) FROM shsstud WHERE Form138 != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Arts and Design (A&D)') AS count_form138, 
(SELECT COUNT(*) FROM shsstud WHERE Picture != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Arts and Design (A&D)') AS count_picture, 
(SELECT COUNT(*) FROM shsstud WHERE MOA != '' AND Year BETWEEN $from_year AND $to_year AND Strand = 'Arts and Design (A&D)') AS count_moa 
FROM shsstud WHERE PSA != '' AND Status = 1 AND Year BETWEEN $from_year AND $to_year AND Strand = 'Arts and Design (A&D)'";

$result_shsad = mysqli_query($conn, $sql_shsad);
$row_shsad = mysqli_fetch_assoc($result_shsad);
?>


<!-- SHS -->
<script>
// Function to handle dropdown selection for Filter by Strand
function selectStrandValue(value) {
  const chart = Chart.getChart('Bar Chart SHS'); // Get the chart instance
  const errorMessage = document.getElementById('error-message'); // Get the error message element
  const chartContainer = document.getElementById('chart-container1'); // Get the chart container element

  if (!value) {
    // If no value is selected, hide the chart container and display error message
    chartContainer.style.display = 'none';
    errorMessage.textContent = 'Select a Strand to view';
    document.getElementById('class_filter_dropdownnn').textContent = 'Filter by Strand'; // Update the text of the dropdown button with default value
  } else {
    // If a value is selected, show the chart container and hide error message
    chartContainer.style.display = 'block';
    errorMessage.textContent = '';
    document.getElementById('class_filter_dropdownnn').textContent = value; // Update the text of the dropdown button with selected value
  }


  chart.data.datasets.forEach(dataset => {
    // Hide all datasets by default
    dataset.hidden = true;
    // Show respective datasets based on selected value
    if (value === 'ABM' && (dataset.label === 'ABM')) {
      dataset.hidden = false;
    } else if (value === 'STEM' && (dataset.label === 'STEM' )) {
      dataset.hidden = false;
    }
     else if (value === 'HUMSS' && (dataset.label === 'HUMSS' )) {
      dataset.hidden = false;
    }
    else if (value === 'GAS' && (dataset.label === 'GAS' )) {
      dataset.hidden = false;
    }
    else if (value === 'ICT' && (dataset.label === 'ICT' )) {
      dataset.hidden = false;
    } 
    else if (value === 'HE' && (dataset.label === 'HE')) {
      dataset.hidden = false;
    } 
    else if (value === 'A&D' && (dataset.label === 'A&D')) {
      dataset.hidden = false;
    } 

  });
  chart.update(); // Update the chart to reflect changes
}

const ctxa = document.getElementById('Bar Chart SHS').getContext('2d');

new Chart(ctxa, {
  type: 'bar',
  data: {
    labels: ['PSA', 'Form 137', 'Form 138', '2x2 Picture', 'MoA'],
    datasets: [{
      label: 'ABM',
      data: [
        <?php echo $row_shsabm['count_psa']; ?>,
        <?php echo $row_shsabm['count_form137']; ?>,
        <?php echo $row_shsabm['count_form138']; ?>,
        <?php echo $row_shsabm['count_picture']; ?>,
        <?php echo $row_shsabm['count_moa']; ?>
      ],
    },{
      label: 'STEM',
      data: [
        <?php echo $row_shsstem['count_psa']; ?>,
        <?php echo $row_shsstem['count_form137']; ?>,
        <?php echo $row_shsstem['count_form138']; ?>,
        <?php echo $row_shsstem['count_picture']; ?>,
        <?php echo $row_shsstem['count_moa']; ?>
      ],
    },{
        label: 'HUMSS',
      data: [
        <?php echo $row_shshumss['count_psa']; ?>,
        <?php echo $row_shshumss['count_form137']; ?>,
        <?php echo $row_shshumss['count_form138']; ?>,
        <?php echo $row_shshumss['count_picture']; ?>,
        <?php echo $row_shshumss['count_moa']; ?>
      ],
    },{
        label: 'GAS',
      data: [
        <?php echo $row_shsgas['count_psa']; ?>,
        <?php echo $row_shsgas['count_form137']; ?>,
        <?php echo $row_shsgas['count_form138']; ?>,
        <?php echo $row_shsgas['count_picture']; ?>,
        <?php echo $row_shsgas['count_moa']; ?>
      ],
    },{
      label: 'ICT',
      data: [
        <?php echo $row_shsict['count_psa']; ?>,
        <?php echo $row_shsict['count_form137']; ?>,
        <?php echo $row_shsict['count_form138']; ?>,
        <?php echo $row_shsict['count_picture']; ?>,
        <?php echo $row_shsict['count_moa']; ?>
      ],
    },{
        label: 'HE',
      data: [
        <?php echo $row_shshe['count_psa']; ?>,
        <?php echo $row_shshe['count_form137']; ?>,
        <?php echo $row_shshe['count_form138']; ?>,
        <?php echo $row_shshe['count_picture']; ?>,
        <?php echo $row_shshe['count_moa']; ?>
      ],
    },{
        label: 'A&D',
      data: [
        <?php echo $row_shsad['count_psa']; ?>,
        <?php echo $row_shsad['count_form137']; ?>,
        <?php echo $row_shsad['count_form138']; ?>,
        <?php echo $row_shsad['count_picture']; ?>,
        <?php echo $row_shsad['count_moa']; ?>
      ],
    }],
    options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    legend: {
      display: false
    }
  }
}
});
</script>



    <?php
    include("footer.php")
    ?>
    <br>
<script>
        $(document).ready(function () {
    $('#example').DataTable();
});
    </script>

<script>
        $(document).ready(function () {
    $('#example1').DataTable();
});
    </script>

    <style>
  #colls::-webkit-scrollbar {
  width: 8px;
  background-color: transparent;}

#colls::-webkit-scrollbar-track {
    background: transparent; /* make the scrollbar gradient as a combination of orange and dark blue */
}

#shss::-webkit-scrollbar {
  width: 8px;
  background: transparent; /* make the scrollbar gradient as a combination of orange and dark blue */
}

#shss::-webkit-scrollbar-track {
    background: transparent; /* make the scrollbar gradient as a combination of orange and dark blue */
}

.cs{
    min-height: 250px;
    min-width: 300px;
}
</style>

</body>
</html>
