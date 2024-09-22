<?php
session_start();
require ("../../db.php");

if(empty($_SESSION['access_level']) || $_SESSION['access_level'] != 'ADMIN'){
    header("location: /web-assignment/careerplus/chomepage");
    echo "Unauthorized Page";
    exit();
}

if(isset($_GET["logout"])){
    $_SESSION['access_level'] = null;
    $_SESSION['username'] = null;

    header("location: /web-assignment/careerplus/chomepage");
}

$sql_jobs = "SELECT COUNT(*) AS total_records FROM job_post";
$sql_comp = "SELECT COUNT(*) AS total_records FROM company";
$sql_app = "SELECT COUNT(*) AS total_records FROM `apply_job_post`";
$sql_user = "SELECT COUNT(*) AS total_records FROM users";
$result1 = $conn->query($sql_jobs);
$result2 = $conn->query($sql_comp);
$result3 = $conn->query($sql_app);
$result4 = $conn->query($sql_user);

$job_count = $result1->fetch_assoc()['total_records'];
$comp_count =  $result2->fetch_assoc()['total_records'];
$app_count =  $result3->fetch_assoc()['total_records'];
$user_count =  $result4->fetch_assoc()['total_records'];

// echo $_SESSION['access_level'];

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="icon" href="./assets/imgs/logo.webp" type="image/icon type">
        <title>Career Plus</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid d-flex justify-content-between">
                <a class="navbar-brand" href="#">CareerPlus</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                        <li class="nav-item">
                        <a class="btn btn-light border border-danger rounded-pill text-danger" href="../../index.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="page my-3" id="welcome">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <h1 class="p-3 ps-5 ">Welcome to CareerPlus!</h1>
                </div>
                <div class="col-md-6 fs-3 p-3 border-start border-2">
                    <h2>Overview</h2>
                    <div class="me-4">
                        <div class="d-flex justify-content-between">
                            <h3>No of Available Job Posts</h3>
                            <h3><?php echo $job_count?></h3>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h3>No of Registered Companies</h3>
                            <h3><?php echo $comp_count?></h3>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h3>No of Submitted Applications</h3>
                            <h3><?php echo $app_count?></h3>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h3>No of Registered Candidates</h3>
                            <h3><?php echo $user_count?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="row m-2">
            <div class="col p-0">
                <a class="card btn m-1 p-3 bg-primary" href="jobposts.php">
                    <p class="fw-bold text-center text-light m-0 fs-1">Job Posts</p>
                </a>
            </div>
            <div class="col p-0">
                <a class="card btn m-1 p-3 bg-danger" href="company.php">
                <p class="fw-bold text-center text-light m-0 fs-1">Companies</p>
                </a>
            </div>
            <!-- <div class="col p-0" type="hidden">
                <a class="card btn m-1 p-3 bg-success" href="application.php">
                <p class="fw-bold text-center text-light m-0 fs-1">Applications</p>
                </a>
            </div> -->
            <div class="col p-0">
                <a class="card btn m-1 p-3 bg-success" href="user.php">
                <p class="fw-bold text-center text-light m-0 fs-1">Users</p>
                </a>
            </div>                
        </div>




        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>