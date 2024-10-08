<?php
session_start();

?>
<?php 
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['pwd']; 
$type = $_POST['type'];

$stmt = mysqli_query($con,"SELECT * FROM user WHERE username = '$username' AND password = '$password' AND type = '$type'");
$res = mysqli_fetch_array($stmt);
$row = mysqli_num_rows($stmt);


if($row>0){
    
    $_SESSION["username"] = $res['username'];
    $_SESSION["admin_id"] = $res['admin_id'];
    $_SESSION["first_name"] = $res['first_name'];
    $_SESSION["last_name"] = $res['last_name'];
    header("Location: userlogin.php?status=success");


} else {
    header("Location: userlogin.php?status=error");
}
exit();

?>
