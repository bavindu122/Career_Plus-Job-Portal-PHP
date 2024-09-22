<?php
session_start();

//If user Not logged in then redirect them back to homepage. 
if (empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

$sql = "SELECT * FROM mailbox WHERE id_mailbox='$_GET[id_mail]' AND (id_fromuser='$_SESSION[id_user]' OR id_touser='$_SESSION[id_user]')";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['fromuser'] == "company") {
    $sql1 = "SELECT * FROM company WHERE id_company='$row[id_fromuser]'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
      $rowCompany = $result1->fetch_assoc();
    }
    $sql2 = "SELECT * FROM users WHERE id_user='$row[id_touser]'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
      $rowUser = $result2->fetch_assoc();
    }
  } else {
    $sql1 = "SELECT * FROM company WHERE id_company='$row[id_touser]'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
      $rowCompany = $result1->fetch_assoc();
    }
    $sql2 = "SELECT * FROM users WHERE id_user='$row[id_fromuser]'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
      $rowUser = $result2->fetch_assoc();
    }
  }

}

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
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  <!-- tinycloud-apikey -->
  <script src="https://cdn.tiny.cloud/1/itwkbk974b6ptant0h1lcpqdza9ku52oye7vjfn7rxp9dqpt/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
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
                <li class="active"><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9 bg-white padding-2">
          <div class="box box-solid">
            <div class="box box-primary">
              <div class="row">
                <div class="col-md-12">
                  <a href="mailbox.php" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
                  <div class="card">
                    <div class="mailbox-read-info">
                      <h3>
                        <?php echo $row['subject']; ?>
                      </h3>
                      <h5>From:
                        <?php if ($row['fromuser'] == "company") {
                          echo $rowCompany['companyname'];
                        } else {
                          echo $rowUser['firstname'];
                        } ?>
                        <span class="mailbox-read-time pull-right">
                          <?php echo date("d-M-Y h:i a", strtotime($row['createdAt'])); ?>
                        </span>
                      </h5>
                    </div>
                    <div class="mailbox-read-message">
                      <?php echo stripcslashes($row['message']); ?>
                    </div>
                    <!-- /.mailbox-read-message -->
                    <!-- /.box-body -->
                  </div>

                  <?php

                  $sqlReply = "SELECT * FROM reply_mailbox WHERE id_mailbox='$_GET[id_mail]'";
                  $resultReply = $conn->query($sqlReply);
                  if ($resultReply->num_rows > 0) {
                    while ($rowReply = $resultReply->fetch_assoc()) {
                      ?>
                      <div class="card">
                        <div class="mailbox-read-info">
                          <h3>Reply Message</h3>
                          <h5>From:
                            <?php if ($rowReply['usertype'] == "company") {
                              echo $rowCompany['companyname'];
                            } else {
                              echo $rowUser['firstname'];
                            } ?>
                            <span class="mailbox-read-time pull-right">
                              <?php echo date("d-M-Y h:i a", strtotime($rowReply['createdAt'])); ?>
                            </span>
                          </h5>
                        </div>
                        <div class="mailbox-read-message">
                          <?php echo stripcslashes($rowReply['message']); ?>
                        </div>
                      </div>

                      <?php
                    }
                  }
                  ?>


                  <div class="card">
                    <!-- /.box-header -->

                    <div class="mailbox-read-info">
                      <h3>Send Reply</h3>
                    </div>
                    <div class="mailbox-read-message">
                      <form action="reply-mailbox.php" method="post">
                        <div class="form-group">
                          <textarea class="form-control input-lg" id="description" name="description"
                            placeholder="Reply"></textarea>
                          <input type="hidden" name="id_mail" value="<?php echo $_GET['id_mail']; ?>">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-flat btn-success">Reply</button>
                        </div>
                      </form>
                    </div>
                    <!-- /.mailbox-read-message -->
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
        </div>



      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer" style="margin-left: 0px;">
        <div class="text-center">
          <strong>Copyright &copy; 2016-2017 <a href="jonsnow.netai.net">Career Plus</a>.</strong> All rights
          reserved.
        </div>
      </footer>



    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script>
      tinymce.init({
        selector: 'textarea',
        apiKey: 'itwkbk974b6ptant0h1lcpqdza9ku52oye7vjfn7rxp9dqpt',
      });
    </script>
    <script>
      $(function () {
        $('#example1').DataTable();
      })
    </script>

</body>

</html>