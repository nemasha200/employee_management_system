<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();
 

if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit();
}else{

?>


<?php 
include 'db_connect.php';
$customer_id =$_GET['user_id'];

mysqli_query($con,"DELETE FROM `employer` WHERE empid= $customer_id");
header('Location:empSearch.php')


?>
<?php
}
?>