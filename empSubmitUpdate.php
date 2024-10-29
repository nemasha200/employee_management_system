<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST['user_id'];

        // Combine the selected qualifications into a comma-separated string
        $qualifications = !empty($_POST['qualifications']) ? implode(',', $_POST['qualifications']) : '';

        // Retrieve other form data
        $employeeType = $_POST['employeeType'];
        $company = $_POST['company'];
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
        $phonenumber = $_POST['phonenumber'];
        $landnumber = $_POST['landnumber'];
        $officenumber = $_POST['officenumber'];
        $doj = $_POST['doj'];
        $recruitmentType = $_POST['recruitmentType'];
        $department = $_POST['department'];
        $designation = $_POST['designation'];
        $grade = $_POST['grade'];
        $jobcategory = $_POST['jobcategory'];
        $lpd = $_POST['lpd'];
        $empstatus = $_POST['empstatus'];
        $vehiclenumber = $_POST['vehiclenumber'];
       
        $ot = $_POST['ot'];
        $remark1 = $_POST['remark1'];
        $remark2 = $_POST['remark2'];
        $remark3 = $_POST['remark3'];

        // Handle photo upload
        $img = ''; // Default empty image path

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "pdf") {
                echo "Sorry, only JPG, JPEG, PDF & PNG files are allowed.";
                exit();
            }

            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $img = basename($_FILES["photo"]["name"]); // Save image file name
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        }

        $query = "UPDATE employer 
                  SET comp_num='$company', emp_type='$employeeType', emp_num='$empnumber', epf='$epfnumber', sex='$sex', marital_status='$marital', full_name='$fullname', 
                  initial_name='$nameinitial', dob='$dob', nic='$nic', drive_lic_num='$drive', permanat_address='$address1', current_address='$address2', qulifications='$qualifications', 
                  mobile='$phonenumber', landnumber='$landnumber', office_number='$officenumber', doj='$doj', recruitment_type='$recruitmentType', department='$department', designation='$designation', 
                  grade='$grade', job_title='$jobcategory', last_promo='$lpd', emp_status='$empstatus', vehicle_num='$vehiclenumber',ot='$ot', remark1='$remark1', remark2='$remark2', remark3='$remark3'";

        // Only update the img field if a new image was uploaded
        if ($img != '') {
            $query .= ", img='$img'";
        }

        // Add the WHERE clause to specify which record to update
        $query .= " WHERE empid='$user_id'";

        // Execute the query
        if (mysqli_query($con, $query)) {
            header("Location: empSearch.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
}
?>
