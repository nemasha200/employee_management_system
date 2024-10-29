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
    $getuser = mysqli_query($con, "SELECT * FROM clearance WHERE id='$user_id'");
    $res_user = mysqli_fetch_array($getuser);

    
}
?>


<!DOCTYPE html>
<html lang="en">

<?php 
include 'db_connect.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearance Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: darkgrey;
            margin: 0;
            display: flex;
            background-image: url("black.jpg");
            overflow-x: hidden; 
        }
        .form-container {
            background-color: whitesmoke;
            padding: 30px;
            border-radius: 10px;
            border-color: black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            max-width: 1000px;
            margin: 20px auto; 
            overflow-y: auto; 
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
            background-color: red;
            border: none;
        }
        .btn-primary:hover {
            background-color: green;
        }
        .btn-small {
            padding: 5px 10px;
            font-size: 0.875rem;
            width: 150px;
            display: block;
            margin: 20px auto 0;
        }
        h4 {
            margin-bottom: 15px;
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
        hr {
            border: 1px solid #ccc;
            margin: 20px 0;
        }
        #dropdown
       {
            color:black;
        }

       #designation{
        color:black;
       }
       #fullName{
        color:black;
       }

       #Section{
        color:black;
       }

       #empNumber{
        color:black;

       }

       #refNumber{
        color:black;

       }

    
       
    </style>
</head>

<body>
<?php include 'submenubar.php';?>
<?php include 'logout.php';?> 

<div class="container form-container">
    <h2 class="text-center">Clearance Form</h2>
    <a href="clearSearch.php">
                <button type="button" class="btn btn-primary btn-small">View Updated Clearance </button>
    </a>

    

    <form id="registrationForm" method="POST" action="clearSubmitupdate.php" enctype="multipart/form-data">


    <div class="form-row">

    <div class="form-group col-md-4">
                <label for="employeeNumber">Employee Number</label>
                <input type="text"  value="<?php echo $res_user['emp_num']; ?>" class="form-control" id="empNumber" name="empnumber" readonly>
                         
            </div>

            <div class="form-group col-md-4">
                <label for="epfNumber">Reference Number</label>
                <input type="text" value="<?php echo $res_user['ref_num']; ?>" class="form-control" id="refNumber" name="refnumber" readonly>
            </div>

           

            <div class="form-group col-md-4">
                <label for="dob">Resignation w.e.f</label>
                <input type="date" value="<?php echo $res_user['wef']; ?>" class="form-control" id="dob" name="dob">
            </div>
        </div>  
       

        

        <!-- <div class="form-group">
            <label for="employeeType"><strong>Employee Type:</strong></label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="employeeType" id="staff" value="Staff" required>
                <label class="form-check-label" for="staff">Staff</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="employeeType" id="ase" value="ASE">
                <label class="form-check-label" for="ase">ASE</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="employeeType" id="factory" value="Factory">
                <label class="form-check-label" for="factory">Factory</label><br>
            </div>
        </div> -->

        <div class="form-group">
                        <label for="employeeType"><strong>Employee Category:</strong></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="employeeType" value="Staff" <?php echo ($res_user['emptype'] == 'Staff') ? 'checked' : ''; ?> required>
                            <label class="form-check-label">Staff</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="employeeType" value="Sales" <?php echo ($res_user['emptype'] == 'Sales') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Sales</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="employeeType" value="Factory" <?php echo ($res_user['emptype'] == 'Factory') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Factory</label>
                        </div>
        </div>

        <div class="form-group">
                <label for="dropdown">Company:</label>
                <input type="text" value="<?php echo $res_user['company_num']; ?>" class="form-control" id="dropdown" name="company" readonly>
                    
        </div>

       

        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" value="<?php echo $res_user['fullname']; ?>" class="form-control" id="fullName" name="fullName" readonly>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="Section">Section</label>
                <input type="text" value="<?php echo $res_user['section']; ?>" class="form-control" id="Section" name="section" readonly>
            </div>

            
            <div class="form-group col-md-5">
                <label for="department">Designation<span style="color:red">*</span></label>
                <input type="text" value="<?php echo $res_user['designation']; ?>"class="form-control" id="designation" name="designation" readonly>
                   
            </div>
        </div>

        

        <div class="form-group col-md-8">  
            <label for="headerGiven"><strong>Prior notice Given:</strong></label>
            <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="headerYes" name="headerGiven[]" value="yes" <?php echo ($res_user['prior_notice'] == 'yes' || strpos(strtolower($res_user['prior_notice']), 'yes') !== false) ? 'checked' : ''; ?>>
    <label class="form-check-label" for="headerYes">Yes</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="headerNo" name="headerGiven[]" value="no" <?php echo ($res_user['prior_notice'] == 'no' || strpos(strtolower($res_user['prior_notice']), 'no') !== false) ? 'checked' : ''; ?>>
    <label class="form-check-label" for="headerNo">No</label>
</div>


            
        </div>

        <div class="form-group col-md-">
            <label for="remark">Remark</label>
            <textarea class="form-control" id="remark" name="remark" rows="1"><?php echo $res_user['remark']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-small">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


   



</body>
</html>
<?php
}
?>