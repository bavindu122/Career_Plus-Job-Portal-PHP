<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Career Plus</title>
  <link rel="icon" href="img/career-plus-logo-v.png" type="image/icon-type" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="css/Cabout.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/customnew.css">
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">
    <header style="position: fixed;">
      <nav>
        <div class="logo">
          <img src="img/career plus.png">
        </div>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <?php if (empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>

            <li>
            <div class="dropdown">
              <a>Login</a>
              <div class="dropdown-content">
                <a href="candidate reg and log/c_login.php"> Candidate Login</a>
                <a href="company reg and log/company_login.php"> Company Login</a>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown">
              <a>Sign Up</a>
              <div class="dropdown-content">
                <a href="candidate reg and log/c_register.html"> Candidate Sign Up</a>
                <a href="company reg and log/company_register.php"> Company Sign Up</a>
              </div>
            </div>
          </li>

          <?php } else {
            if (isset($_SESSION['id_user'])) {
              ?>
              <li>
                <a href="user/index.php">Dashboard</a>
              </li>
              <?php
            } else if (isset($_SESSION['id_company'])) {
              ?>
                <li>
                  <a href="company/index.php">Dashboard</a>
                </li>
            <?php } ?>
            <li>
              <a href="logout.php">Logout</a>
            </li>
          <?php } ?>
        </ul>

      </nav>
    </header>



    <div class="content-wrapper" style="margin-left: 0px;">

      <?php

      $sql = "SELECT * FROM job_post INNER JOIN company ON job_post.id_company=company.id_company WHERE id_jobpost='$_GET[id]'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          ?>

          <section id="candidates" class="content-header">
            <div class="container">
              <div class="row">
                <div class="col-md-9 bg-white padding-2">
                  <div class="pull-left">
                    <h2><b>
                        <?php echo $row['jobtitle']; ?>
                      </b></h2>
                  </div>
                  <div class="pull-right">
                    <a href="jobs.php" class="btn btn-default btn-lg btn-flat margin-top-20"><i
                        class="fa fa-arrow-circle-left"></i> Back</a>
                  </div>
                  <div class="clearfix"></div>
                  <hr>
                  <div>
                    <p><span class="margin-right-10"><i class="fa fa-location-arrow text-green"></i>
                        <?php echo $row['city']; ?>
                      </span> <i class="fa fa-calendar text-green"></i>
                      <?php echo date("d-M-Y", strtotime($row['createdat'])); ?>
                    </p>
                  </div>
                  <div>
                    <?php echo stripcslashes($row['description']); ?>
                  </div>
                  <?php
                  if (isset($_SESSION["id_user"]) && empty($_SESSION['companyLogged'])) { ?>
                    <div>
                      <a href="apply.php?id=<?php echo $row['id_jobpost']; ?>"
                        class="btn btn-success btn-flat margin-top-50">Apply</a>
                    </div>
                  <?php } ?>


                </div>
                <div class="col-md-3">
                  <div class="thumbnail">
                    <img src="uploads/logo/<?php echo $row['logo']; ?>" alt="companylogo">
                    <div class="caption text-center">
                      <h3>
                        <?php echo $row['companyname']; ?>
                      </h3>
                      <p><a href="#" class="btn btn-primary btn-flat" role="button">More Info</a>
                        <hr>
                      <div class="row">
                        <ul class="thumb-ul">
                          <li>
                            <div class="col-md-4"><a href=""><i class="fa fa-warning"></i> Report</a></div>
                          </li>

                          <li>
                            <div class="col-md-4"><a href="user/create-mail.php"><i class="fa fa-envelope"></i> Email</a>
                            </div>
                          </li>

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <?php
        }
      }
      ?>


      <footer>
        <p>© 2024 CareerPlus. All Rights Reserved.</p>
      </footer>
    </div>
    <!-- /.content-wrapper -->



  </div>
  <!-- ./wrapper -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>



</body>

</html>