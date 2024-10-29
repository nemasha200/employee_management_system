<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}

include 'db_connect.php';


$user_id = $_POST['user_id'];

$reason = $_POST['reason'];
$reason1 = $_POST['reason1'];
$remark = $_POST['remark'];


$image = '';
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $target_dir = "dici/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    $image = $_FILES["photo"]["name"];
}


$sql = "UPDATE `discipline` SET `reason`='$reason',`action`='$reason1', `remark`='$remark'";
if ($image) {
    $sql .= ", `img`='$image'";
}
$sql .= " WHERE `id`='$user_id'";


if (!mysqli_query($con, $sql)) {
    die("Error updating record: " . mysqli_error($con));
}

header("Location: diciSearch.php");
exit();
