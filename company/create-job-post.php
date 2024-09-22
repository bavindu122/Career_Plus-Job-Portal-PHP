<?php
session_start();

if(empty($_SESSION['id_company'])) {
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
   <!-- tinycloud-apikey -->
   <script src="https://cdn.tiny.cloud/1/itwkbk974b6ptant0h1lcpqdza9ku52oye7vjfn7rxp9dqpt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>

  <div class="wrapper">
  <header class="main-header">
      <a href="index.php" class="logo">
        <img class="header-logo" src="../img/career plus.png" alt="career plus logo" >
      </a>
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
                <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="edit-company.php"><i class="fa fa-tv"></i> My Company</a></li>
                  <li class="active"><a href="create-job-post.php"><i class="fa fa-file-o"></i> Create Job Post</a></li>
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
            <div class="box box-content">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h2>Create Job Post</h2>
                </div>
                <div class="row">
                  <form method="post" action="addpost.php">
                    <div class="col-md-12 latest-job ">
                      <div class="form-group">
                        <input class="form-control input-lg" type="text" id="jobtitle" name="jobtitle" placeholder="Job Title">
                      </div>
                      <div class="form-group">
                        <textarea class="form-control input-lg" id="description" name="description" placeholder="Job Description"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="number" class="form-control  input-lg" id="minimumsalary" min="1000" max="1000000" autocomplete="off" name="minimumsalary" placeholder="Minimum Salary" required="">
                      </div>
                      <div class="form-group">
                        <input type="number" class="form-control  input-lg" id="maximumsalary" name="maximumsalary" min="1000" max="1000000" placeholder="Maximum Salary" required="">
                      </div>
                      <div class="form-group">
                    <input type="number" class="form-control  input-lg" id="experience" autocomplete="off" name="experience" placeholder="Experience (in Years) Required" required="">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control  input-lg" id="qualification" name="qualification" placeholder="Qualification Required" required="">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-flat btn-success">Create</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
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

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        apiKey: 'itwkbk974b6ptant0h1lcpqdza9ku52oye7vjfn7rxp9dqpt', 
    });
</script>
</body>
</html>
