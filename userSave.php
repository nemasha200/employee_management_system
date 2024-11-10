<?php 


include 'db_connect.php';


$title = $_POST['title'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['password'];
$conpassword = $_POST['conpassword'];







mysqli_query($con,"INSERT INTO `user`(`title`, `first_name`, `last_name`, `email`, `contact`, `type`, `username`, `password`, `con_password`)
 VALUES ('$title','$firstname','$lastname','$email','$contact','$type','$username','$password','$conpassword')");
 
 header("Location: user.php");
exit();


?>

