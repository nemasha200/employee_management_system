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
       
    </style>
</head>

<body>
<?php include 'submenubar.php';?>
<?php include 'logout.php';?> 

<div class="container form-container">
    <h2 class="text-center">Clearance Form</h2>
    <!-- <a href="clearSearch.php"> -->
    <a href="clearSearch.php.php">
                <button type="button" class="btn btn-primary btn-small">View Clearance </button>
    </a>

    

    <form id="registrationForm" method="POST" action="clearSave.php" enctype="multipart/form-data">
        <div id="dropdownDiv">
            <div class="form-group">
                <label for="dropdown">Company:</label>
                <select class="form-control" id="dropdown" name="company">
                    <option value="" disabled selected>Select an option</option>
                    <?php 
                    $getEmp = mysqli_query($con, "SELECT * FROM sub_company");
                    while ($resCom = mysqli_fetch_array($getEmp)) { ?>
                        <option value="<?php echo $resCom['com_number'] . '/' . $resCom['com_name'] ?>">
                            <?php echo $resCom['com_number'] . '/' . $resCom['com_name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div id="selectionDisplay">
            <h4 id="selectedValue"></h4>
        </div>

        <div class="form-group">
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
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="epfNumber">Reference Number</label>
                <input type="text" class="form-control" id="epfNumber" name="refnumber" placeholder="Enter Reference number">
            </div>

            <div class="form-group col-md-4">
                <label for="employeeNumber">Employee Number</label>
                <input type="text" class="form-control" id="empNumber" name="empnumber" placeholder="Enter employee number">
            </div>

            <div class="form-group col-md-4">
                <label for="dob">Resignation w.e.f</label>
                <input type="date" class="form-control" id="dob" name="dob">
            </div>
        </div>

        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter full name">
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="Section">Section</label>
                <input type="text" class="form-control" id="Section" name="section" placeholder="Enter Section">
            </div>

            
            <div class="form-group col-md-5">
                <label for="department">Designation<span style="color:red">*</span></label>
                <select class="form-control" id="department" name="designation">
                    <?php 
                    $getEmp = mysqli_query($con, "SELECT * FROM sub_designation");
                    while ($resDep = mysqli_fetch_array($getEmp)) { ?>
                        <option value="<?php echo $resDep['desi_name'] ?>"><?php echo $resDep['desi_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        

        <div class="form-group col-md-8">  
            <label for="headerGiven"><strong>Prior notice Given:</strong></label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="headerYes" name="headerGiven" value="yes">
                <label class="form-check-label" for="headerYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="headerNo" name="headerGiven" value="no">
                <label class="form-check-label" for="headerNo">No</label>
            </div>
        </div>

        <div class="form-group col-md-10">
            <label for="remark">Remark</label>
            <textarea class="form-control" id="remark" name="remark"></textarea>
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
