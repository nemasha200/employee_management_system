<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();
 

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}else{
?>

<?php
include 'db_connect.php'; // Ensure this file connects to your database

// Check if user_id is provided in the query parameters
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']); // Sanitize user_id to ensure it's an integer

    // Get the current status of the user
    $result = mysqli_query($con, "SELECT active FROM employer WHERE id = $user_id");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $current_status = $row['active'];

        // Toggle the active status
        $new_status = ($current_status == 1) ? 0 : 1;
        $update_query = "UPDATE employer SET active = $new_status WHERE id = $user_id";

        if (mysqli_query($con, $update_query)) {
            // Redirect to empSearch page after successful update
            header("Location: empSearch.php");
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        echo "Error retrieving record: " . mysqli_error($con);
    }
} else {
    echo "No user ID specified.";
}

mysqli_close($con); // Close the database connection
?>
<?php
}
?>