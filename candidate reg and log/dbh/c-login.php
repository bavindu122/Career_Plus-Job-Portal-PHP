<?php
    require_once 'dbconnection.php';

    $pwd=$_POST['Password'];
    $email=$_POST['Email'];
    $remme=$_POST['remme'];


        if (isset($_POST['login']))
        {
            $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pwd'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 1)
            {
                session_start();
                $userDetails = mysqli_fetch_assoc($result);

                ///session loged here
                $_SESSION['id_user'] = $userDetails['id_user'];
                $_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];

                if(isset($_POST['remember_me'])) {
                    // Set a cookie to remember the user's email
                    setcookie('remember_me', $email, time() + (86400 * 30), "/"); 
                }

            
                    //header redirrecting  here
                header("location: ../../user/index.php");
                exit;
            }
            else
            {
                echo "<script>alert('Oops Something Went Wrong!');
                        window.location.href = '../c_login.php';
                </script>";
            }
        }

    ?>