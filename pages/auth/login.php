<?php

require ("../../db.php");

// Handle Login operation when form submit
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) == 1){
        $adminDetails = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['access_level'] = 'ADMIN';
        
        header("location: ../admin/dashboard.php");
        echo "Login Successful";
        exit;
    }else{
        echo "Login Failed";
    }
    
}

?>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="icon" href="./assets/imgs/logo.webp" type="image/icon type">
        <title>Career Plus</title>
    </head>

    <body>
        <div class="container">
            <h1 class="my-3 text-center">Login</h1>
            <div class="container my-5">
                <div class="d-flex justify-content-center">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="row px-3">
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <!-- <p><?php echo $adminDetails->nu ?></p> -->
            </div>
        </div>

    </body>
</html>