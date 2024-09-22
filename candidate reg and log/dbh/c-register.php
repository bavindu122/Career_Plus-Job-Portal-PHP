<?php
require_once 'dbconnection.php';


$fname=$_POST['firstName'];
$lname=$_POST['lastName'];
$email=$_POST['Email'];
$password=$_POST['Password'];
$confirmpassword=$_POST['confirmPassword'];
$address=$_POST['address'];
$city=$_POST['city'];
$state=$_POST['state'];
$phonenumber=$_POST['phoneNumber'];
$qualification = $_POST['Quali'];
$stream=$_POST['stream'];
$passingyear=$_POST['passYear'];
$dob=$_POST['dBay'];
$age=$_POST['Age'];
$designation=$_POST['designation'];
$introduction=$_POST['intoduction'];
$skills=$_POST['skills'];


if($password == $confirmpassword)
{

$sql="INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`, `address`, `city`, `state`, `contactno`,`qualification`, `stream`, `passingyear`, `dob`, `age`, `designation`,  `aboutme`, `skills`) 
VALUES ('$fname','$lname','$email','$password','$address','$city','$state','$phonenumber','$qualification','$stream','$passingyear','$dob','$age','$designation','$introduction','$skills')";

$runn=mysqli_query($conn,$sql);
if ($runn){
    echo "<script>alert('Your Account Was Created Successfully')
    
        window.location.href = '../c_login.php';
    </script>";
    header('location:../c_login.php');
    exit;

}else{
    echo "Error: " . mysqli_error($conn);
}

}else{
    echo "<script>alert('Password dosen't match');
            window.location.href = '../c_register.html';
    </script>";   
}
header('location: c_register.html');
exit;

?>
