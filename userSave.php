<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}

include 'db_connect.php';

$title = mysqli_real_escape_string($con, $_POST['title']);
$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$contact = mysqli_real_escape_string($con, $_POST['contact']);
$type = mysqli_real_escape_string($con, $_POST['type']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$conpassword = mysqli_real_escape_string($con, $_POST['conpassword']);

if ($password !== $conpassword) {
    echo "Passwords do not match.";
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO `user` (`title`, `first_name`, `last_name`, `email`, `contact`, `type`, `username`, `password`) 
          VALUES ('$title', '$firstname', '$lastname', '$email', '$contact', '$type', '$username', '$hashedPassword')";

if (mysqli_query($con, $query)) {
    header("Location: user.php");
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>
