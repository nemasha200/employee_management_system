<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}

include 'db_connect.php';

$empnumber = isset($_POST['empnumber']) ? $_POST['empnumber'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$reason = isset($_POST['reason']) ? $_POST['reason'] : '';
$remark = isset($_POST['remark']) ? $_POST['remark'] : '';
$image_name = null;

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $targetDir = "dici/";
        $targetFile = $targetDir . basename($_FILES['photo']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                $image_name = basename($_FILES['photo']['name']);
                $response['success'] = true;
                $response['message'] = "The file " . htmlspecialchars($image_name) . " has been uploaded.";
            } else {
                $response['success'] = false;
                $response['message'] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "No file was uploaded or there was an error uploading the file.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method.";
}

if ($response['success']) {
    $query = "INSERT INTO `discipline` (`emp_num`, `name`, `reason`, `img`, `remark`) VALUES ('$empnumber', '$name', '$reason', '$image_name', '$remark')";
} else {
    $query = "INSERT INTO `discipline` (`emp_num`, `name`, `reason`, `img`, `remark`) VALUES ('$empnumber', '$name', '$reason', NULL, '$remark')";
}

if (mysqli_query($con, $query)) {
    header("Location: diciActions.php");
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}

?>
