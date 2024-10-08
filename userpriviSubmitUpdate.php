<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
    include 'db_connect.php';

    // Fetch data from the form
    $selectuser = $_POST['selectuser'];
    $registrationDate = $_POST['registrationDate'];
    $registrationTime = $_POST['registrationTime'];
    $count = $_POST['rowCount'];

    // Delete existing privileges for the user before updating
    $deleteQuery = "DELETE FROM user_priviledge WHERE username = '$selectuser'";
    mysqli_query($con, $deleteQuery);

    // Insert updated privileges
    for ($i = 1; $i <= ($count - 1); $i++) {
        if (isset($_POST['submenu' . $i])) {
            $menu_id = $_POST['main' . $i];
            $submenu_id = $_POST['submenu' . $i];

            $insertQuery = "INSERT INTO user_priviledge(username, menu_id, submenu_id, date, time) 
                            VALUES ('$selectuser', '$menu_id', '$submenu_id', '$registrationDate', '$registrationTime')";
            mysqli_query($con, $insertQuery);
        }
    }

    // Redirect back to the user privileges page after updating
    header("Location: priviSearch.php");
    exit();
}
?>
