<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {

    include 'db_connect.php';

    $empnumber = $_POST['empnumber'];
    $name = $_POST['nameinitial']; // Corrected from 'name' to 'nameinitial'
    $reason = $_POST['reason'];
    $reason1 = $_POST['reason1'];
    $remark = $_POST['remark'];
    $image_name = null;
    $response = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $targetDir = "dici/";
            $targetFile = $targetDir . basename($_FILES['photo']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif','pdf');

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
        $query = "INSERT INTO `discipline` (`emp_num`, `name`, `reason`, `action`, `img`, `remark`) VALUES ('$empnumber', '$name', '$reason','$reason1', '$image_name', '$remark')";
    } else {
        $query = "INSERT INTO `discipline` (`emp_num`, `name`, `reason`, `action`, `img`, `remark`) VALUES ('$empnumber', '$name', '$reason','$reason1', NULL, '$remark')";
    }

    if (mysqli_query($con, $query)) {
        header("Location: diciSearch.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
