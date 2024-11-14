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

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $getuser = mysqli_query($con, "SELECT * FROM transfers WHERE id='$user_id'");
    $res_user = mysqli_fetch_array($getuser);

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotion/Demotion Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: #dadce3;
            background-image: url("black.jpg");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .sidebar {
            height: 100%;
            background-color: grey;
            color: black;
            padding-top: 20px;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar h4 {
            padding-bottom: 20px;
            font-size: 1.25rem;
            text-transform: uppercase;
            border-bottom: 1px solid #495057;
            margin-bottom: 20px;
            color: black;
        }

        .sidebar a {
            background-color: #7fe7f5;
            color: black;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        .sidebar a:hover {
            background-color: red;
        }

        .sidebar .submenu a {
            padding-left: 40px;
        }

        .logo {
            width: 30px;
            height: auto;
            display: inline-block;
            margin-right: 10px;
        }

        .form-container {
            margin-left: 250px; 
        padding: 50px;
        background-color: lightblue;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: calc(100% - 250px); 
        max-width: 800px;
        margin: auto;
        margin-left: 600px;
           
           
        }

        .form-control {
            color: black;
            background-color: #343a40;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        .form-group label {
            color: #343a40;
        }

        .btn-primary {
            background-color: #a62411;
            border: none;
            display: block;
            margin: 0 auto;
        }

        .btn-primary:hover {
            background-color: #c82333;
        }

        #selectionDisplay {
            display: none;
            margin-top: 20px;
        }

        /* Highlight the selected value with a yellow background */
        #selectedValue {
            background-color: yellow;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        
       
       
    </style>
</head>
<body>
<?php include 'submenubar.php';?>

    <div class="container form-container">
        <h2 class="text-center">Transfer details</h2>



       
<form>

<div class="form-row">


<div class="form-group col-md-12">
<label for="fullNameInitials">Full Name :</label>
<input type="text" class="form-control" id="fullNameInitials" name="nameinitial" value="<?php echo $res_user['name']; ?>" readonly>
                

</div>

</div>


<div class="form-row">


<div class="form-group col-md-5">
    <label for="employNumber">Employ Number :</label>
    <input type="text" class="form-control" id="employNumber" name="empnumber" value="<?php echo $res_user['emp_num']; ?>" readonly>
            
</div>

<div class="form-group col-md-7">
        <label for="employment">Employment :</label>
        <input type="employment" class="form-control" id="employment" name="employment" value="<?php echo $res_user['employment']; ?>" readonly>
    </div>



</div>






<div class="form-group row">

<label for="transfer1" class="col-sm-3 col-form-label"><strong>Existing Section :</strong></label>

<div class="form-group col-md-3">
<input type="text" class="form-control" id="department" name="exdepartment" value="<?php echo $res_user['ex_department']; ?>" readonly>

</div>

<div class="col-sm-3">
        <input type="text" class="form-control" id="company" name="excompany" value="<?php echo $res_user['ex_company']; ?>" readonly>

</div>

<div class="col-sm-3">
<input type="designation"  class="form-control" id="designation" name="designation" value="<?php echo $res_user['designation']; ?>" readonly>

</div>

</div>




<div class="form-group row">

<label for="transfer2" class="col-sm-3 col-form-label"><strong>Transfer Section :</strong></label>
<div class="form-group col-md-3">
                <input type="text" class="form-control" id="department" name="transdep" value="<?php echo $res_user['trans_department']; ?>" readonly>
                


</div>

<div class="col-sm-3">
        <input type="text" class="form-control" id="dropdown" name="transcom" value="<?php echo $res_user['trans_company']; ?>" readonly>
        
</div>

<div class="col-sm-3">
        <input type="text" class="form-control" id="designation1" name="designation1" value="<?php echo $res_user['trans_designation']; ?>" readonly>
        
</div>

</div>

<div class="form-row">

            <div class="form-group col-md-4">
                <label for="dob">Effective Date :</label>
                <input type="text" class="form-control" id="dob" name="dob1" value="<?php echo $res_user['effect_date']; ?>" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="dob">Requested Date :</label>
                <input type="text" class="form-control" id="dob" name="dob2" value="<?php echo $res_user['req_date']; ?>" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="dob">Approved Date :</label>
                <input type="text" class="form-control" id="dob" name="dob3" value="<?php echo $res_user['approve_date']; ?>" readonly>
            </div>


</div>
    
    
    <div class="form-group">
        <label for="remark">Remark :</label>
        <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $res_user['remark']; ?>" readonly>
    </div>
</body>
       
    
</html>
<?php
}
?>