<?php
session_start();
require ("../../../db.php");

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


$sql = "SELECT * FROM job_post WHERE id_jobpost=".$_GET['id'];

$result1 = $conn->query($sql);
$job_record = $result1->fetch_assoc();

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
        <a class="navbar-brand" href="../dashboard.php">CareerPlus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
            <li class="nav-item">
                <a class="btn btn-light border border-danger rounded-pill text-danger" href="?logout=TRUE">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="page my-3" id="welcome">
      <div class="row">
        <div class="col-md-6 d-flex align-items-center">
          <h1 class="text-center p-3 ps-5 fs-1">Job Post : <?php echo $job_record['jobtitle'] ?></h1>
        </div>
        <div class="col-md-6 fs-3 p-3 d-flex align-items-center justify-content-end">
        </div>
      </div>
      <hr>
    </div>

    <div class="row p-5">
      <!-- Form goes here -->
      <form class="row g-3 needs-validation" method="POST" action= "" >
        <div class="col-md-4 d-none">
            <label class="form-label fw-bold">Job Title</label>
            <input type="text" name="id" class="form-control" value="<?php echo $job_record['jobtitle'] ?>" required disabled>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Job Description</label>
            <div type="text" name="id" class="form-control hidden" style="height:300px;overflow-y:scroll">
                <?php echo $job_record['description'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Minimum Salary</label>
            <div type="text" name="id" class="form-control hidden">
                <?php echo $job_record['minimumsalary'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Maximum Salary</label>
            <div type="text" name="id" class="form-control hidden">
                <?php echo $job_record['maximumsalary'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Work Experience</label>
            <div type="text" name="id" class="form-control hidden">
                <?php echo $job_record['experience'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Required Qualification</label>
            <div type="text" name="id" class="form-control hidden">
                <?php echo $job_record['qualification'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-bold">Published on</label>
            <div type="text" name="id" class="form-control hidden">
                <?php echo $job_record['createdat'] ?>
            </div>
        </div>

        <div class="col-12">
            <a href="../user.php" class="btn btn-secondary" type="submit">Go Back</a>
            <button class="btn btn-primary" type="submit">Save Changes</button>
        </div>
        </div>
      </form>
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>