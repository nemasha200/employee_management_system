<?php
session_start();
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['pwd'];
$type = $_POST['type'];

// Initialize error messages
$error = '';

// Check if the username exists
$stmt = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
if (mysqli_num_rows($stmt) == 0) {
    $error = 'username';
} else {
    $user = mysqli_fetch_assoc($stmt);

    // Validate password
    if ($user['password'] !== $password) {
        $error = 'password';
    }

    // Validate type
    if ($user['type'] !== $type) {
        $error = 'type';
    }
}

// Handle errors or login success
if ($error) {
    header("Location: userlogin.php?status=error&error=$error");
} else {
    $_SESSION["username"] = $user['username'];
    $_SESSION["admin_id"] = $user['admin_id'];
    $_SESSION["first_name"] = $user['first_name'];
    $_SESSION["last_name"] = $user['last_name'];
    header("Location: userlogin.php?status=success");
}
exit();
