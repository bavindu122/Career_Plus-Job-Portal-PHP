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
                <a href="#"> Candidate Login</a>
                <a href="#"> Company Login</a>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown">
              <a>Sign Up</a>
              <div class="dropdown-content">
                <a href="#"> Candidate Sign Up</a>
                <a href="#"> Company Sign Up</a>
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
  <!-- Header End -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section class="content-header" style=" padding-top: 10%;">
      <div class="container">
        <div class="row">

          <div class="col-md-12 latest-job margin-bottom-20">
            <h1>Latest Jobs</h1><br />
            <?php
            $sql = "SELECT * FROM job_post";
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
                        <img src="img/icon2.jpg" alt="New Job">
                      </div>
                      <div class="card-center">
                        <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>">
                            <?php echo $row['jobtitle']; ?>
                          </a>
                          <span class="attachment-heading pull-right">Rs
                            <?php echo $row['maximumsalary']; ?>/Month
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

    <div class="col-md-9">

      <?php

      $limit = 4;

      $sql = "SELECT COUNT(id_jobpost) AS id FROM job_post";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_records = $row['id'];
        $total_pages = ceil($total_records);
      } else {
        $total_pages = 1;
      }

      ?>

      <div id="target-content">

      </div>
      <div class="text-center">
        <ul class="pagination text-center" id="pagination"></ul>
      </div>

    </div>
  </div>
  </div>
  </section>



  </div>
  <!-- /.content-wrapper -->

  </div>
  <footer>
    <p>© 2024 CareerPlus. All Rights Reserved.</p>
  </footer>

  <script>
    function Pagination() {
      $("#pagination").twbsPagination({
        totalPages: <?php echo $total_pages; ?>,
        visible: 5,
        onPageClick: function (e, page) {
          e.preventDefault();
          $("#target-content").html("loading....");
          $("#target-content").load("jobpagination.php?page=" + page);
        }
      });
    }
  </script>

  <script>
    $(function () {
      Pagination();
    });
  </script>

  <script>
    $("#searchBtn").on("click", function (e) {
      e.preventDefault();
      var searchResult = $("#searchBar").val();
      var filter = "searchBar";
      if (searchResult != "") {
        $("#pagination").twbsPagination('destroy');
        Search(searchResult, filter);
      } else {
        $("#pagination").twbsPagination('destroy');
        Pagination();
      }
    });
  </script>

  <script>
    $(".experienceSearch").on("click", function (e) {
      e.preventDefault();
      var searchResult = $(this).data("target");
      var filter = "experience";
      if (searchResult != "") {
        $("#pagination").twbsPagination('destroy');
        Search(searchResult, filter);
      } else {
        $("#pagination").twbsPagination('destroy');
        Pagination();
      }
    });
  </script>

  <script>
    $(".citySearch").on("click", function (e) {
      e.preventDefault();
      var searchResult = $(this).data("target");
      var filter = "city";
      if (searchResult != "") {
        $("#pagination").twbsPagination('destroy');
        Search(searchResult, filter);
      } else {
        $("#pagination").twbsPagination('destroy');
        Pagination();
      }
    });
  </script>

  <script>
    function Search(val, filter) {
      $("#pagination").twbsPagination({
        totalPages: <?php echo $total_pages; ?>,
        visible: 5,
        onPageClick: function (e, page) {
          e.preventDefault();
          val = encodeURIComponent(val);
          $("#target-content").html("loading....");
          $("#target-content").load("search.php?page=" + page + "&search=" + val + "&filter=" + filter);
        }
      });
    }
  </script>

</body>

</html>