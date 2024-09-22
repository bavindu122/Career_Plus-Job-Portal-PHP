<?php
session_start();

if (empty($_SESSION['id_company'])) {
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
  <!-- js -->
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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
                  <?php echo htmlspecialchars($_SESSION['name']); ?>
                </b></h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">

                <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="edit-company.php"><i class="fa fa-tv"></i> My Company</a></li>
                <li><a href="create-job-post.php"><i class="fa fa-file-o"></i> Create Job Post</a></li>
                <li><a href="my-job-post.php"><i class="fa fa-file-o"></i> My Job Post</a></li>
                <li><a href="job-applications.php"><i class="fa fa-file-o"></i> Job Application</a></li>
                <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>

              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9 bg-white padding-2">
          <div class="box box-solid">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h2>Overview</h2>
                <button id="showDescriptionBtn"><i class="icon fa fa-info"></i></button>
                <div id="description" style="display: none;">
                  <i> In this dashboard you are able to change your account settings, post and manage your jobs.</i>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="info-box ">
                    <span class="info-box-icon "><i class="ion ion-ios-people-outline"></i></span>
                    <div >
                      <ul class="info-box-content">
                        <li class="info-box-text">Job Posted</li>

                        <?php
                        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM job_post WHERE id_company = ?");
                        $stmt->bind_param("i", $_SESSION['id_company']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $total = $row['total'];
                        ?>

                        <li class="info-box-number">
                          <?php echo htmlspecialchars($total); ?>
                        </li>

                      </ul>

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box ">
                    <span class="info-box-icon "><i class="ion ion-ios-browsers"></i></span>
                    <div>
                    <ul class="info-box-content">
                        <li class="info-box-text">Application For Jobs</li>

                        <?php
                        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM apply_job_post WHERE id_company = ?");
                        $stmt->bind_param("i", $_SESSION['id_company']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $total = $row['total'];
                        ?>

                        <li class="info-box-number">
                          <?php echo htmlspecialchars($total); ?>
                        </li>

                      </ul>
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
  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2024 <a href="#">Career Plus</a>.</strong>
    </div>
  </footer>
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