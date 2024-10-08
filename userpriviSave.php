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

$selectuser = $_POST['selectuser'];
$registrationDate = $_POST['registrationDate'];
$registrationTime = $_POST['registrationTime'];
$count = $_POST['rowCount'];

$username = $selectuser; 

for ($i = 1; $i <= ($count - 1); $i++) {
    if (isset($_POST['submenu' . $i])) {
        $menu_id = $_POST['main' . $i];
        $submenu_id = $_POST['submenu' . $i];

        $query = "INSERT INTO `user_priviledge`(`username`, `menu_id`, `submenu_id`, `date`, `time`) VALUES ('$username','$menu_id','$submenu_id','$registrationDate','$registrationTime')";

        mysqli_query($con, $query);
    }
}

header("Location: userPrivi.php");

?>
<?php
}
?>
