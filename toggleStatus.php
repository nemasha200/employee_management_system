<?php
include 'db_connect.php';

if (isset($_GET['empid']) && isset($_GET['status'])) {
    $empid = mysqli_real_escape_string($con, $_GET['empid']);
    $newStatus = mysqli_real_escape_string($con, $_GET['status']);

    $updateStatusQuery = "UPDATE employer SET isAct = $newStatus WHERE empid = '$empid'";

    if (mysqli_query($con, $updateStatusQuery)) {
        header("Location: empSearch.php"); 
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}
?>
