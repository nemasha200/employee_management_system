<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: userlogin.php");
    exit();
} else {
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include 'db_connect.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
            width: 80%;
            max-width: 1000px;
            margin: 20px auto; 
            overflow-y: auto; 
            margin-left: 250px;
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
        /* Highlight the selected value with a yellow background */
        #selectedValue {
            background-color: aquamarine;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        hr {
            border: 1px solid #ccc;
            margin: 20px 0;
        }
        #ftc-details {
            display: none; /* Hide the FTC details by default */
        }

        .text {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: black;
            font-size: 0.9rem;
            left: 120px; /* Adjust this value as needed */

        }
        
    </style>
    
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body>

<?php include 'submenubar.php'; ?> 
<?php include 'logout.php'; ?> 

<div class="container position-relative">
    <div class="row justify-content-center">
        <div class="col-10 form-container">
            <h3 class="text-center">Employee Registration Form</h3>
            <a href="empSearch.php">
                <button type="button" class="btn btn-primary btn-small">View Users</button>
            </a>  
            <form id="empForm" method="POST" action="empSave.php" enctype="multipart/form-data">


            <h5><u>Employee Personal Details</u></h5><br>

<div class="form-group">
<label for="employeeType"><strong>Employee Category :<span style="color:red">*</span></strong></label>

<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="employeeType" id="staff" value="Staff" required>
<label class="form-check-label" for="staff">Staff</label>
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="employeeType" id="staff" value="ASE">
<label class="form-check-label" for="ase">Sales</label>
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="employeeType" id="staff" value="Factory">
<label class="form-check-label" for="factory">Worker</label><br>
</div>
</div> 


<div class="form-group col-md-">
<label for="dropdown">Company :<span style="color:red">*</span></label>
<select class="form-control" id="dropdown" name="company">
    <option value="" disabled selected>Select an option</option>
    <?php 
    $getEmp = mysqli_query($con,"SELECT * FROM  sub_company");
    while ($resCom = mysqli_fetch_array($getEmp)) {
        ?>
        <!-- want to go company code only for employer table -->
    <option value="<?php echo $resCom['com_number']."/".$resCom['com_name'] ?>"><?php echo $resCom['com_number']."/".$resCom['com_name']."/".$resCom['location'] ?></option>

        <?php
    }
?>
        </select>
</select>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="employNumber">Employee Number :<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="employNumber" name="empnumber" placeholder="Enter employ number">
    </div>


    <div class="form-group col-md-6">
        <label for="epfNumber">EPF Number :<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="epfNumber" name="epfnumber" placeholder="Enter EPF number">
    </div>
</div>

<div class="form-row">
<div class="form-group col-md-5">
<label for="headerGiven"><strong>Sex :</strong></label>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="sex" id="Male" value="Male">
<label class="form-check-label" for="male">Male</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="sex" id="female" value="Female">
<label class="form-check-label" for="female">Female</label>
</div>
</div>

<div class="form-group col-md-5">
<label for="headerGiven"><strong>Marital Status :</strong></label>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="marital" id="single" value="single">
<label class="form-check-label" for="single">Single</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="marital" id="Married" value="Married">
<label class="form-check-label" for="Married">Married</label>
</div>
</div>


        
</div>

<div class="form-group col-md-">
        <label for="fullName">Full Name :<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="fullName" name="fullname" placeholder="Enter full name">
    </div>
<div class="form-group col-md-">
        <label for="fullNameInitials">Name with Initials :<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" placeholder="Enter full name with initials">
</div>




    <div class="form-row">

    <div class="form-group col-md-4">
        <label for="dob">Date of Birth :</label>
        <input type="date" class="form-control" id="dob" name="dob">
    </div>
    
    <div class="form-group col-md-4">
        <label for="nicNumber">NIC Number :<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="nicNumber" name="nic" placeholder="Enter NIC number">
    </div>
 
    <div class="form-group col-md-4">
        <label for="nicNumber">Driving License Number :</label>
        <input type="text" class="form-control" id="drive" name="drive" placeholder="Enter Driving License number">
    </div>
    
   
</div>




<div class="form-group col-md-">
        <label for="address1">Permanent Address :<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter address 1">
</div>
    <div class="form-group col-md-">
        <label for="address2">Current Address :<span style="color:red">*</span></label>
        <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter address 2">
    </div>

    <div class="form-group">
<label for="employeeType"><strong>Educational Qualifications :</strong></label>

<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="qualifications" id="masters" value="Masters">
<label class="form-check-label" for="masters">Masters</label>
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="qualifications" id="degree" value="Degree">
<label class="form-check-label" for="degree">Degree</label>
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="qualifications" id="diploma" value="Diploma/HND">
<label class="form-check-label" for="diploma">Diploma/HND</label><br>
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="qualifications" id="nvq" value="NVQ/Naita">
<label class="form-check-label" for="nvq">NVQ/Naita</label><br>
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="checkbox" name="qualifications" id="other" value="Other Qualifications">
<label class="form-check-label" for="other">Other Qualifications</label><br>
</div>
</div>

<div class="form-row">

 
<div class="form-group col-md-4">
<label for="phoneNumber">Mobile Number :<span style="color:red">*</span></label>
<input type="text" class="form-control" id="phoneNumber" name="phonenumber" placeholder="Enter mobile number">
</div>

<div class="form-group col-md-4">
<label for="phoneNumber1">Landphone Number :</label>
<input type="text" class="form-control" id="phoneNumber1" name="landnumber" placeholder="Enter landphone number">
</div>

<div class="form-group col-md-4">
<label for="phoneNumber1">Office Number :</label>
<input type="text" class="form-control" id="phoneNumber2" name="officenumber" placeholder="Enter Office number">
</div>

</div>




<h5><u>Employee Company related Details</u></h5><br>

     <div class="form-row">

        <div class="form-group col-md-4">
        <label for="dob">Date of Join :<span style="color:red">*</span></label>
        <input type="date" class="form-control" id="doj" name="doj">
    </div>
    
    <div class="form-group col-md-4">
<label for="recruitmentType">Recruitment Type :</label>
<select class="form-control" id="recruitmentType" name="recruitmentType">
<option value="" disabled selected>Select an option</option>

<option value="new">New</option>
<option value="rejoin">Rejoin</option>
</select>
</div>



<div class="form-group col-md-4">
        <label for="department">Department :<span style="color:red">*</span></label>
        <select class="form-control" id="department" name="department">
        <option value="" disabled selected>Select an option</option>


        <?php 
    $getEmp = mysqli_query($con,"SELECT * FROM  sub_department");
    while ($resDep = mysqli_fetch_array($getEmp)) {
        ?>
    <option value="<?php echo $resDep['dep_name'] ?>"><?php echo $resDep['dep_name'] ?></option>

        <?php
    }
?>
        </select>


    </div>

</div>

<div class="form-row">
    
    <div class="form-group col-md-4">
        <label for="designation">Designation :<span style="color:red">*</span></label>
        <select class="form-control" id="designation" name="designation">
        <option value="" disabled selected>Select an option</option>

        <?php 
    $getEmp = mysqli_query($con,"SELECT * FROM  sub_designation ");
    while ($resCom = mysqli_fetch_array($getEmp)) {
        ?>
    <option value="<?php echo $resCom['desi_name']?>"><?php echo $resCom['desi_name']?></option>

        <?php
    }
?>
        </select>
    </div>   


    <div class="form-group col-md-4">
        <label for="company">Grade :<span style="color:red">*</span></label>
        <select class="form-control" id="grade" name="grade">
        <option value="" disabled selected>Select an option</option>


        <?php 
    $getEmp = mysqli_query($con,"SELECT * FROM  sub_division ");
    while ($resCom = mysqli_fetch_array($getEmp)) {
        ?>
    <option value="<?php echo $resCom['grade'] ?>"><?php echo $resCom['grade'] ?></option>

        <?php
    }
?>
        </select>
    </div>


       


    <div class="form-group col-md-4">
        <label for="jobCategory">Job Title :<span style="color:red">*</span></label>
        <select class="form-control" id="jobCategory" name="jobcategory">
        <option value="" disabled selected>Select an option</option>


        <?php 
    $getEmp = mysqli_query($con,"SELECT * FROM  sub_jobcat ");
    while ($resCom = mysqli_fetch_array($getEmp)) {
        ?>
    <option value="<?php echo $resCom['jobcat_name']?>"><?php echo $resCom['jobcat_name']?></option>

        <?php
    }
?>
        </select>
    </div> 

   
</div>  



<div class="form-row">   
    
<div class="form-group col-md-4">
    <label for="dob">Last promoted Dates :</label>
    <div id="date-fields">
        <input type="date" class="form-control" id="lpd" name="lpd[]">
    </div>
    <button type="button" class="btn btn-primary mt-2" id="add-date">Add More Dates</button>
</div>

<script>
    document.getElementById('add-date').addEventListener('click', function() {
        // Create a new date input element
        var newDateField = document.createElement('input');
        newDateField.type = 'date';
        newDateField.className = 'form-control mt-2';
        newDateField.name = 'lpd[]'; // Make it an array

        // Append the new date input to the 'date-fields' div
        document.getElementById('date-fields').appendChild(newDateField);
    });
</script>

<div class="form-group col-md-7">
                    <label for="recruitmentType">Employee Status :<span style="color:red">*</span></label>
                    <select class="form-control" id="empstatus" name="empstatus">
                        <option value="" disabled selected>Select an option</option>
                        <option value="permanent">Permanent</option>
                        <option value="ftc">FTC</option>
                        <option value="casual">Casual</option>
                        <option value="consultant">Consultant</option>
                    </select>
</div>

</div>

<div class="form-row">   

<div class="form-group col-md-5">
        <label for="vehicleNumber">Vehicle Number :</label>
        <input type="text" class="form-control" id="vehicleNumber" name="vehiclenumber" placeholder="Enter vehicle number">
</div>



<div class="form-group col-md-5">
        <label for="uploadPhoto">Upload NIC or Driving License: (Only Allowed pdf, jpg, jpeg, png formates)</label>
        <input type="file" class="form-control-file" id="form-group" name="photo">
        <div class="message" id="message"></div>
</div>

 </div>   
  
                
  


<div class="form-group col-md-3">
<label for="headerGiven"><strong>OT :</strong></label>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="ot" id="yes" value="Yes">
<label class="form-check-label" for="male">Yes</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="ot" id="no" value="No">
<label class="form-check-label" for="female">No</label>
</div>
</div>         
    
    
   

<div class="row">
<div class="col-md-12">
<div class="form-group row align-items-start">
<label for="remark" class="col-form-label col-md-2 text-left">Remark :</label>

<div class="col-md-10">
<div class="row">
<label for="remark1" class="col-md-1 col-form-label text-left">1 :<span style="color:red">*</span></label>
<div class="col-md-11">
    <textarea class="form-control mb-2" id="remark1" name="remark1" rows="1" placeholder="Enter remark"></textarea>
</div>
</div>
</div>

<div class="col-md-10 offset-md-2">
<div class="row">
<label for="remark2" class="col-md-1 col-form-label text-left">2 :</label>
<div class="col-md-11">
    <textarea class="form-control mb-2" id="remark2" name="remark2" rows="1" placeholder="Enter remark"></textarea>
</div>
</div>
</div>

<div class="col-md-10 offset-md-2">
<div class="row">
<label for="remark3" class="col-md-1 col-form-label text-left">3 :</label>
<div class="col-md-11">
    <textarea class="form-control" id="remark3" name="remark3" rows="1" placeholder="Enter remark"></textarea>
</div>
</div>
</div>
</div>
</div>
</div>


                
              
                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-small">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- <div class="text">
        <span> Copyright © 2024 Designed by <a href="#"> RAIGAM IT Department </a> All rights reserved.</span>
    </div> -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

<script>
    document.getElementById('empForm').addEventListener('submit', function (event) {
        event.preventDefault();

        // Fetch values from the form
        var dropdown = document.getElementById('dropdown').value.trim();
        var employNumber = document.getElementById('employNumber').value.trim();
        var epfNumber = document.getElementById('epfNumber').value.trim();
        var fullName = document.getElementById('fullName').value.trim();
        var fullNameInitials = document.getElementById('fullNameInitials').value.trim();
        var nicNumber = document.getElementById('nicNumber').value.trim();
        var address1 = document.getElementById('address1').value.trim();
        var address2 = document.getElementById('address2').value.trim();
        var phoneNumber = document.getElementById('phoneNumber').value.trim();
        var doj = document.getElementById('doj').value.trim();
        var department = document.getElementById('department').value.trim();
        var designation = document.getElementById('designation').value.trim();
        var grade = document.getElementById('grade').value.trim();
        var jobCategory = document.getElementById('jobCategory').value.trim();
        var empstatus = document.getElementById('empstatus').value.trim();
        var remark1 = document.getElementById('remark1').value.trim();

        // Validation checks
        if (!dropdown) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Company Number.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!employNumber) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select an Employee Number.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!epfNumber) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select an EPF Number.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }
        if (!fullName) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select an FullName.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }


        if (!fullName || !/^[A-Z][a-z]*( [A-Z][a-z]*)*$/.test(fullName)) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Full Name must have the first letter of each name capitalized (e.g., "John Doe").',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!fullNameInitials) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select  Name with Initials.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!fullNameInitials || !/^[A-Z](\.[A-Z])*\.? [a-zA-Z\s]+$/.test(fullNameInitials)) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a valid Name with Initials (e.g., "A.B. Smith").',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!nicNumber) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select  NIC.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        



        if (!nicNumber || (!/^\d{9}[Vv]$/.test(nicNumber) && !/^\d{12}$/.test(nicNumber))) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'NIC Number must be either 9 digits followed by "V" or 12 digits.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!address1) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Permanent Address.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!address2) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Current Address.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!phoneNumber) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a phone Number.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!phoneNumber || phoneNumber.length !== 10 || !/^\d{10}$/.test(phoneNumber)) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Phone Number must be exactly 10 digits long.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!doj) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Date of Joining.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!department) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Department.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!designation) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Designation.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!designation) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Designation.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!grade) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Grade.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!jobCategory) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Job Category.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!empstatus) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select an Employee Status.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!remark1) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Remark.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        // Success message and form submission
        Swal.fire({
            title: 'Success!',
            text: 'Form submitted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
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
