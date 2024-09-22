<?php
$server="localhost";
$username="root";
$password="";
$dhname="CareerPlus";

$conn =mysqli_connect("$server","$username","$password","$dhname");

if(!$conn){
    echo "Error";
}

?>