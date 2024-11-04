<?php
// Start the session and connect to the database
session_start();
include 'db_connect.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $refnumber = $_POST['refnumber'];
    $dob = $_POST['dob'];
    $prior_notice = isset($_POST['headerGiven']) ? implode(',', $_POST['headerGiven']) : '';
    $remark = $_POST['remark'];

    // Handle file upload if a new file is uploaded
    $upload_dir = 'clear/';
    $img_name = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $img_name = basename($_FILES['photo']['name']);
        $img_tmp = $_FILES['photo']['tmp_name'];
        $img_dest = $upload_dir . $img_name;

        // Move the uploaded file to the specified directory
        if (!move_uploaded_file($img_tmp, $img_dest)) {
            die("Error uploading file");
        }
    } else {
        // Keep the old image if no new image is uploaded
        $existing_query = mysqli_query($con, "SELECT img FROM clearance WHERE id='$user_id'");
        if ($existing_row = mysqli_fetch_assoc($existing_query)) {
            $img_name = $existing_row['img'];
        }
    }

    // Update the database
    $update_query = "UPDATE clearance SET 
                        ref_num = '$refnumber',
                        wef = '$dob',
                        prior_notice = '$prior_notice',
                        img = '$img_name',
                        remark = '$remark'
                    WHERE id = '$user_id'";

    if (mysqli_query($con, $update_query)) {
        // Redirect with a success message
        echo "<script>
                alert('Clearance details updated successfully!');
                window.location.href = 'clearSearch.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating clearance details.');
                window.history.back();
              </script>";
    }
} else {
    echo "Invalid request.";
}
?>
