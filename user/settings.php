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
      <nav class="navbar navbar-static-top">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="../jobs.php">Jobs</a>
            </li>
          </ul>
        </div>
      </nav>

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
                <li><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Jobs</a></li>
                <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                <li class="active"><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>

              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9 bg-white padding-2">
          <div class="box box-solid">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h2>Change Password</h2>
              </div>
              <p>Type in new password that you want to use</p>
              <div class="row">
                <div class="col-md-6">
                  <form id="changePassword" action="change-password.php" method="post">
                    <div class="form-group">
                      <input id="password" class="form-control input-lg" type="password" name="password"
                        autocomplete="off" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <input id="cpassword" class="form-control input-lg" type="password" autocomplete="off"
                        placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-flat btn-success">Change Password</button>
                    </div>
                    <div id="passwordError" class="color-red text-center hide-me">
                      Password Mismatch!!
                    </div>
                  </form>
                </div>
                <div class="col-md-6">
                  <form action="deactivate-account.php" method="post">
                    <label><input type="checkbox" required> I Want To Deactivate My Account</label><br />
                    <button type="submit" class="btn btn-danger btn-flat btn-lg">Deactivate My Account</button>
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

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../js/adminlte.min.js"></script>
  <script>
    $("#changePassword").on("submit", function (e) {
      e.preventDefault();
      if ($('#password').val() != $('#cpassword').val()) {
        $('#passwordError').show();
      } else {
        $(this).unbind('submit').submit();
      }
    });
  </script>
</body>

</html>