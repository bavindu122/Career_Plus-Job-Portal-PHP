<?php

session_start();


require_once("db.php");
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Jobs</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="icon" href="img/career-plus-logo-v.png" type="image/icon-type" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/customnew.css">
  <link rel="stylesheet" href="css/Cabout.css">
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body>


  <!-- Header Part -->
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
      </div>
    </nav>
  </header>
  <!-- Header End -->


  <div class="content-wrapper" style="margin-left: 0px;">
    <section class="content-header" style="padding-top: 10%;">
      <div class="container">
        <div class="row">
          <div class="search-container">
            <input type="text" id="searchBar" class="form-control" placeholder="Search job">
            <button id="searchBtn" type="button" class="btn btn-info btn-flat">Go!</button>
          </div>
          <div id="target-content">
            <!-- Display search results here -->
          </div>
          <div class="col-md-12 latest-job margin-bottom-20">
            <h1>Available Jobs</h1><br />
            <?php


            $sql = "SELECT * FROM job_post INNER JOIN company ON job_post.id_company=company.id_company";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $sql1 = "SELECT * 
                      FROM company
                      WHERE id_company='$row[id_company]'";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                  while ($row1 = $result1->fetch_assoc()) {
                    ?>
                    <div class="card">
                      <div class="card-left blue-bg">
                        <img src="uploads/logo/<?php echo $row['logo']; ?>" alt="companylogo">
                      </div>
                      <div class="card-center">
                        <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>">
                            <?php echo $row['jobtitle']; ?>
                          </a>
                          <span class="attachment-heading pull-right">
                            <?php echo $row['maximumsalary']  ?> USD/Month
                          </span>
                        </h4>
                        <div class="attachment-text">
                          <div><strong>
                              <?php echo $row1['companyname']; ?> |
                              <?php echo $row1['city']; ?> | Experience
                              <?php echo $row['experience']; ?> Years
                            </strong></div>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
              }
            }
            ?>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer>
    <p>© 2024 CareerPlus. All Rights Reserved.</p>
  </footer>

  <script>
    $(document).ready(function () {
      // Perform search when Go! button is clicked
      $("#searchBtn").click(function () {
        var query = $("#searchBar").val().trim();
        if (query !== '') {
          $.ajax({
            url: 'search.php',
            type: 'get',
            data: { query: query },
            success: function (response) {
              $("#target-content").html(response);
            }
          });
        }
      });
    });
  </script>

</body>

</html>