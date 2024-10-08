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

$user_id = $_POST['user_id'];

$selectemp = $_POST['selectemp'];
$image = $_POST['image'];
$remark = $_POST['remark'];

// echo $selectemp."<br>";
// echo $user_id;
// die();

mysqli_query($con, "UPDATE `discipline` SET `select_emp`='$selectemp', `img`='$image',  `remark`='$remark' WHERE `id`='$user_id'");

header("Location: diciSearch.php");
exit();
?>
<?php
}
?>