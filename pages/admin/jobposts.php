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

// Handle delete operation if ID is provided
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $sql = "DELETE FROM job_post WHERE id_jobpost = $delete_id";
  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $mysqli->error;
  }
}

$sql = "SELECT job_post.*, company.companyname 
FROM job_post 
INNER JOIN company ON job_post.id_company=company.id_company";
$result = $conn->query($sql);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="./assets/imgs/logo.webp" type="image/icon type">
    <title>Career Plus</title>
  </head>
  <body>
  
  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid d-flex justify-content-between">
        <a class="navbar-brand" href="dashboard">CareerPlus</a>
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
      <div class="row align-items-center">
        <div class="col-md-6 d-flex justify-content-start">
            <h1 class="text-center p-3 ps-5 fs-1">Manage Job Posts</h1>
        </div>
        <div class="col-md-6">
            <div class="row justify-content-end">
                <div class="col-md-6 fs-3 p-3 d-flex align-items-center justify-content-end">
                    <a class="btn btn-primary me-4" href="dashboard.php">Back to homepage</a>
                    <a class="btn btn-success me-4" href="company/createCompany.php">Add New Job Post</a>
                </div>
            </div>
        </div>
      </div>
      <hr>
    </div>

    <div class="row p-3">
      <table class="table table-dark table-striped">
          <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Job Title</th>
                  <th scope="col">Company Name</th>
                  <th scope="col">Date Created</th>
                  <th scope="col">View</th>
                  <th scope="col">Delete</th>
              </tr>
          </thead>
          <tbody>
          <?php
            if ($result->num_rows > 0) {
              $index =0;
              while($row = $result->fetch_assoc()) {
                $index += 1;
                echo "<tr>
                        <td>".$index."</td>
                        <td>".$row["jobtitle"]."</td>
                        <td>".$row["companyname"]."</td>
                        <td>".$row["createdat"]."</td>
                        <td>".
                          "<a href='jobpost/viewpost.php?id=".$row['id_jobpost']."' class='btn btn-light'>View</a>"
                        ."</td>
                        <td>".
                          "<a href='?delete_id=".$row['id_jobpost']."' class='btn btn-danger' onclick='return confirmDelete();'>Delete</a>".
                        "</td>
                      </tr>";
              }
            } else {
            }
            ?>
          </tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
      }
    </script>
  </body>
</html>