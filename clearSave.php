<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    $company = $_POST['company'];     
    $refnumber = $_POST['refnumber'];
    $empnumber = $_POST['empnumber'];
    $dob = $_POST['dob'];
    $fullName = $_POST['fullName'];
    $section = $_POST['section'];
    $designation = $_POST['designation'];                                             
    $headerGiven = $_POST['headerGiven'];
    $remark = $_POST['remark'];

    $photoPath = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            $uploadDir = 'uploads/';
            $photoPath = $uploadDir . basename($_FILES['photo']['name']);
            move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
        } else {
            echo "Error: Only PDF, JPG, JPEG, and PNG formats are allowed.";
            exit();
        }
    }

    $query = "INSERT INTO `clearance` 
                (`company_num`,  `ref_num`, `emp_num`, `wef`, `fullname`, `section`, `designation`, `prior_notice`, `remark`, `photo_path`) 
              VALUES 
                ('$company',  '$refnumber', '$empnumber', '$dob', '$fullName', '$section', '$designation', '$headerGiven', '$remark', '$photoPath')";

    if (mysqli_query($con, $query)) {
        header("Location: clearance.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con); 
    }
}
?>
