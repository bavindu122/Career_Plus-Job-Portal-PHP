<?php
   require_once 'dbconnection.php';

    $email=$_POST['Email'];
    $password=$_POST['Password'];
    
    if (isset($_POST['login']))
    {
        $query = "SELECT * 
        FROM `company` 
        WHERE `email` = '$_POST[Email]' 
        AND `password` = '$_POST[Password]'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1)
        {
            session_start();
            $companyDetails = mysqli_fetch_assoc($result);

            //session loged here
            $_SESSION['id_company'] = $companyDetails['id_company'];
            $_SESSION['name'] = $row['companyname'];

            if(isset($_POST['remember_me'])) {
                // Set a cookie to remember the user's email
                setcookie('remember_me', $email, time() + (86400 * 30), "/"); // Cookie expires in 30 days
            }
        
             //header redirrecting here 
            header('location: ../../company/index.php');
            exit;
        }
        else
        {
            echo "<script>alert('Oops Something Went Wrong!');
            window.location.href = '../company_login.html';
            </script>";
            exit;
        }
    }

    ?>
