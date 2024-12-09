
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    $fullName = $_POST['fullName'];
    $empnumber = $_POST['empnumber'];
    $refnumber = $_POST['refnumber'];
    $dob = $_POST['dob'];
    $company = $_POST['company'];
    $section = $_POST['section'];
    $nic = $_POST['nic'];
    $headerGiven = $_POST['headerGiven'];
    $remark = $_POST['remark'];

    $image_name = null;
    $response = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $targetDir = "clear/";
            $targetFile = $targetDir . basename($_FILES['photo']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

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
                $response['message'] = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed.";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "No file was uploaded or there was an error uploading the file.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Invalid request method.";
    }

    // Modify the SQL query to match the correct columns
    if ($response['success']) {
        $query = "INSERT INTO `clearance` (`full_name`, `emp_num`, `ref_num`, `wef`, `company`, `section`, `nic`, `prior_notice`, `img`, `remark`) 
                  VALUES ('$fullName', '$empnumber', '$refnumber', '$dob', '$company', '$section', '$nic', '$headerGiven', '$image_name', '$remark')";
    } else {
        $query = "INSERT INTO `clearance` (`full_name`, `emp_num`, `ref_num`, `wef`, `company`, `section`, `nic`, `prior_notice`, `img`, `remark`) 
                  VALUES ('$fullName', '$empnumber', '$refnumber', '$dob', '$company', '$section', '$nic', '$headerGiven', NULL, '$remark')";
    }

    if (mysqli_query($con, $query)) {
        header("Location: clearSearch.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
