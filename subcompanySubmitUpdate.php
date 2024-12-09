<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    // Sanitize input to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $compnum = mysqli_real_escape_string($con, $_POST['compnum']);
    $compname = mysqli_real_escape_string($con, $_POST['compname']);
    $location = mysqli_real_escape_string($con, $_POST['location']);

    // Update query
    $update_query = "UPDATE `sub_company` 
                     SET `com_number` = '$compnum', 
                         `com_name` = '$compname', 
                         `location` = '$location' 
                     WHERE `id` = '$user_id'";

    if (mysqli_query($con, $update_query)) {
        header("Location: subCompanySearch.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
