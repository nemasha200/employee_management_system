<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();
 

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}else{
    
?>

<?php 



include 'db_connect.php';


    $company = $_POST['company'];
    $employeeType = $_POST['employeeType'];
    $empnumber = $_POST['empnumber'];
    $epfnumber = $_POST['epfnumber'];
    $sex = $_POST['sex'];
    $marital = $_POST['marital'];
    $fullname = $_POST['fullname'];
    $nameinitial = $_POST['nameinitial'];
    $dob = $_POST['dob'];
    $nic = $_POST['nic'];
    $drive = $_POST['drive'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $qualifications = $_POST['qualifications'];
    $phonenumber = $_POST['phonenumber'];
    $landnumber = $_POST['landnumber'];
    $officenumber = $_POST['officenumber'];
    $doj = $_POST['doj'];
    $recruitmentType = $_POST['recruitmentType'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $grade = $_POST['grade'];
    $jobcategory = $_POST['jobcategory'];
    $vehiclenumber = $_POST['vehiclenumber'];
    $empstatus = $_POST['empstatus'];
    $ot = $_POST['ot'];
    $remark1 = $_POST['remark1'];
    $remark2 = $_POST['remark2'];
    $remark3 = $_POST['remark3'];
    $image_name = null;

    $response = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES['photo']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    
            // Check if file type is allowed
            if (in_array($imageFileType, $allowedTypes)) {
                // Move the uploaded file to the target directory
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
    
    // Insert data into the 'employer' table, including the image name if it was successfully uploaded
    if ($response['success']) {
        $query = "INSERT INTO `employer`(`comp_num`, `emp_type`, `emp_num`, `epf`, `sex`, `marital_status`,
 `full_name`, `initial_name`, `dob`, `nic`, `drive_lic_num`, `permanat_address`, `current_address`,
  `qulifications`, `mobile`, `landnumber`, `office_number`, `doj`, `recruitment_type`, `department`,
   `designation`, `grade`, `job_title`, `vehicle_num`, `img`, `emp_status`, `ot`, `remark1`, `remark2`, `remark3`) 
   
   VALUES ('$company','$employeeType','$empnumber','$epfnumber','$sex'
 ,'$marital','$fullname','$nameinitial','$dob','$nic','$drive','$address1','$address2','$qualifications' 
 ,'$phonenumber','$landnumber','$officenumber','$doj','$recruitmentType','$department','$designation','$grade',
 '$jobcategory', '$vehiclenumber','$image_name','$empstatus','$ot','$remark1','$remark2','$remark3')";

    } else {
        $query = "INSERT INTO `employer` (`comp_num`, `emp_type`, `emp_num`, `epf`,  `sex`, `marital_status`,
 `full_name`, `initial_name`, `dob`, `nic`, `drive_lic_num`, `permanat_address`, `current_address`,
  `qulifications`, `mobile`, `landnumber`, `office_number`, `doj`, `recruitment_type`, `department`,
   `designation`, `grade`, `job_title`, `vehicle_num`, `img`, `emp_status`, `ot`, `remark1`, `remark2`, `remark3`)
   
    VALUES ('$company','$employeeType','$empnumber','$epfnumber','$sex'
 ,'$marital','$fullname','$nameinitial','$dob','$nic','$drive','$address1','$address2','$qualifications' 
 ,'$phonenumber','$landnumber','$officenumber','$doj','$recruitmentType','$department','$designation','$grade',
 '$jobcategory', '$vehiclenumber', NULL,'$empstatus','$ot','$remark1','$remark2','$remark3')";
    }
    
    if (mysqli_query($con, $query)) {
        header("Location: employer.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
    
    ?>
    

<?php
}
?>








