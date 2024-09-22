<?php
session_start();

//If user Not logged in then redirect them back to homepage. 
if (empty($_SESSION['id_user'])) {
  header("Location: ../index.php");

  exit();

}

require_once("../db.php");

?>
<!DOCTYPE html>
<html>

<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CareerPlus</title>
  <link rel="icon" href="../img/career-plus-logo-v.png" type="image/icon-type" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/style.css">

</head>

<body>

  <div class="wrapper">

    <header class="main-header">
      <a href="index.php" class="logo">
        <img class="header-logo" src="../img/career plus.png" alt="career plus logo">
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar ">
        <ul class="nav navbar-nav">
          <li>
            <a href="../jobs.php" class="d1">Jobs</a>
          </li>
        </ul>
      </div>

    </header>

    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-3">
          <div class="box-nav ">
            <div class="box-header with-border">
              <h3 class="box-title">Welcome <b>
                  <?php echo $_SESSION['name']; ?>
                </b></h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
                <li class="active"><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Jobs</a></li>
                <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>

              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9 bg-white padding-2">
          <div class="box box-solid">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h2>Recent Applications</h2>
                <button id="showDescriptionBtn"><i class="icon fa fa-info"></i></button>
                <div id="description" style="display: none;">
                  Below you will find job roles you have applied for.
                </div>
              </div>

              <?php
              $sql = "SELECT * FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost WHERE apply_job_post.id_user='$_SESSION[id_user]'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  ?>
                  <div class="card mb-3">
                    <div class="card-body">
                      <h5 class="card-title"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>">
                          <?php echo $row['jobtitle']; ?>
                        </a></h5>
                      <p class="card-text"><i class="fa fa-calendar"></i>
                        <?php echo $row['createdat']; ?>
                      </p>
                      <div class="status">
                        <?php
                        if ($row['status'] == 0) {
                          echo '<span class="badge badge-warning">Pending</span>';
                        } else if ($row['status'] == 1) {
                          echo '<span class="badge badge-danger">Rejected</span>';
                        } else if ($row['status'] == 2) {
                          echo '<span class="badge badge-success">Under Review</span>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer" style="margin-left: 0px;">
      <div class="text-center">
        <strong>Copyright &copy; 2024 <a href="#">Career Plus</a>.</strong>
      </div>
    </footer>
    
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
    // Get the button element
    var showDescriptionBtn = document.getElementById('showDescriptionBtn');

    // Get the description element
    var description = document.getElementById('description');

    // Add event listener to the button
    showDescriptionBtn.addEventListener('click', function () {
      // Toggle the display property of the description
      if (description.style.display === 'none' || description.style.display === '') {
        description.style.display = 'block';
      } else {
        description.style.display = 'none';
      }
    });
  </script>
</body>

</html>