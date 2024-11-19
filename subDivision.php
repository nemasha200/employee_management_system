<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();
 

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
}else{
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
        <h2 class="text-center">Job Grades Registration Form</h2>
        <a href="subDivisionSearch.php">
            <button type="button" class="btn btn-primary btn-small">View Job Grade details</button>
        </a><br><br>
        <form id="registrationForm" method="POST" action="subDivisionSave.php">

        <div class="form-row"> 
           


             
            <div class="form-group col-md-12">
            <label for="divisionNumber">Reference Number</label>
            <input type="text" class="form-control" id="divisionNumber" name="divisionumber" placeholder="Enter refernce number">
             </div>

          

            
         
        </div>

        
        <div class="form-row"> 
           
        

        <div class="form-group col-md-12">
        <label for="departmentName">Job Title</label>
        <input type="text" class="form-control" id="jobname" name="jobname" placeholder="Enter job Title ">

        </div>

        </div>




        
        <button type="submit" class="btn btn-primary btn-small">Submit</button>                                                     
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>




</body>


</html>
<?php
}
?>