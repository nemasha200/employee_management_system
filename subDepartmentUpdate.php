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
$user_id = $_GET['user_id'];

$getuser = mysqli_query($con, "SELECT `sub_dep_id`, `dep_num`, `dep_name` FROM `sub_department` WHERE `sub_dep_id`='$user_id'");
$res_user = mysqli_fetch_array($getuser);
?>




<!DOCTYPE html>
<html lang="en">
<?php include 'db_connect.php';?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Division Registration Form</title>
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
        background-color: #daf4f5;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: auto;
        margin-left: 620px;
        width: 700px;
    }

    .form-control {
        color: white;
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

    #selectedValue {
        background-color: yellow;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }

    #employNumber,
    #company,
    #department,
    #doj,
    #designation,
    #grade,
    #dob2{
        background-color: white;
        color: black;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">
 </head>


 <body>
<?php include 'submenubar.php';?>
<?php include 'logout.php';?> 
    
<div class="container form-container">
    <h2 class="text-center">Department Registration Form</h2><br><br>
    <a href="subDepartmentSearch.php">
            <button type="button" class="btn btn-primary btn-small">View updated Departments</button>
        </a>
        <form id="registrationForm" method="POST" action="subDepartmentSubmitUpdate.php">


   

        <div class="form-row"> 
           


             
            <div class="form-group col-md-12">

            <label for="companyNumber">Department Number :</label>
            <input type="number" value="<?php echo $res_user['dep_num']; ?>" class="form-control" id="DepartmentNumber" name="Departmentnum" placeholder="Enter Department number">
           
            </div>

          

            
         
        </div>

        
        <div class="form-row"> 
           
        

        <div class="form-group col-md-12">
        <label for="companyName">Department Name :</label>
                <input type="text" value="<?php echo $res_user['dep_name']; ?>" class="form-control" id="DepartmentName" name="Departmentname" placeholder="Enter Department name">
        </div>

        </div>


        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">


        
        <button type="submit" class="btn btn-primary btn-small">Update</button>                                                     
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Show SweetAlert2 notification
        Swal.fire({
            title: 'Success!',
            text: 'Department has been updated successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // After clicking OK, submit the form
                this.submit();
            }
        });
    });
</script>



</body>


</html>
<?php
}
?>