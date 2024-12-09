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

$empnumber = $_POST['empnumber']; 
$nameinitial = $_POST['nameinitial'];
$department = $_POST['department'];
$grade = $_POST['grade'];
$mark = $_POST['mark'];                                             
$remark = $_POST['remark'];

$query = "INSERT INTO `evaluation`( `emp_num`, `name`, `department`, `evalu_grade`, `evalu_mark`, `remark`)
          VALUES ('$empnumber', '$nameinitial', '$department', '$grade', '$mark', '$remark')";

if (mysqli_query($con, $query)) {
    header("Location: evaluationSearch.php");
    exit();
} else {
    echo "Error: " . mysqli_error($con); 
}

?>

<?php
}
?>