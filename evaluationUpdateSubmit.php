<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    $user_id = $_POST['user_id'];
    $empnumber = $_POST['empnumber'];
    $nameinitial = $_POST['nameinitial'];
    $department = $_POST['department'];
    $grade = $_POST['grade'];
    $mark = $_POST['mark'];
    $remark = $_POST['remark'];

    $update_query = "
        UPDATE `evaluation` 
        SET `name` = '$nameinitial', 
            `emp_num` = '$empnumber', 
            `department` = '$department', 
            `evalu_grade` = '$grade', 
            `evalu_mark` = '$mark', 
            `remark` = '$remark' 
        WHERE `id` = '$user_id'";

    if (mysqli_query($con, $update_query)) {
        header("Location: evaluationSearch.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
