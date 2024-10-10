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
    <title>Promotion Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">        
</head>
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
        padding: 30px;
        background-color: whitesmoke;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: calc(100% - 250px); 
        max-width: 800px;
        margin: auto;
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

    #fullNameInitials,
    #company,
    #department,
    #doj,
    #designation,
    #grade {
        background-color: white;
        color: black;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">


<body>
<?php include 'submenubar.php';?>
<?php include 'logout.php';?> 
    
<div class="container form-container">
    <h2 class="text-center">Promotion Registration Form</h2>
    <a href="promosearch.php">
        <button type="button" class="btn btn-primary btn-small">View promotions</button>
    </a>
    <form id="promoForm" method="POST" action="promoSave.php">

        <div class="form-row"> 
            <div class="form-group col-md-3">
                <label for="employNumber">Employ Number:</label>
                <select class="form-control" id="employNumber" name="empnumber">
                    <option value="" disabled selected>Select an option</option>
                    <?php 
                    $getEmp = mysqli_query($con,"SELECT emp_num FROM  employer ");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                    <option value="<?php echo $resCom['emp_num'] ?>"><?php echo $resCom['emp_num'] ?></option>
                    <?php
                    }
                    ?>
                </select>      
            </div>
            
            <div class="form-group col-md-9">
                <label for="fullNameInitials">Name with Initials:</label>
                <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" readonly>
            </div>
        </div>
        <div class="form-group col-md-13">
            <label for="company">Company:</label>
            <input type="text" class="form-control" id="company" name="company" readonly>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department">Department<span style="color:red">*</span></label>
                <input type="text" class="form-control" id="department" name="department" readonly>
            </div>

            <div class="form-group col-md-5">
                <label for="dob">Date of Join</label>
                <input type="text" class="form-control" id="doj" name="doj" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="grade">Existing Grade<span style="color:red">*</span></label>
                <input type="grade" class="form-control" id="grade" name="grade" readonly>
        </div>


        <div class="form-group col-md-3">
                <label for="designation">Existing Designation<span style="color:red">*</span></label>
                <input type="designation"  class="form-control" id="designation" name="designation" readonly>
                    
               
            </div>

            <div class="form-group col-md-3">
                <label for="grade1">Promoted Grade<span style="color:red">*</span></label>
                <select class="form-control" id="grade1" name="grade1">
                    <option value="" disabled selected>Select an option</option>
                    <?php 
                    $getEmp = mysqli_query($con,"SELECT job_title, grade FROM sub_division");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                    <option value="<?php echo $resCom['grade'] ?>"><?php echo $resCom['grade'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="designation1">Promoted Designation<span style="color:red">*</span></label>
                <select class="form-control" id="designation1" name="designation1">
                    <option value="" disabled selected>Select an option</option>
                    <?php 
                    $getEmp = mysqli_query($con,"SELECT desi_name FROM sub_designation");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                    <option value="<?php echo $resCom['desi_name'] ?>"><?php echo $resCom['desi_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="action">Promo Action</label>
                <select class="form-control" id="action" name="action">
                    <option value="" disabled selected>Select an option</option>
                    <option value="promotion">Promotion</option>
                    <option value="demotion">Demotion</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="dob1">With Effect Date</label>
                <input type="date" class="form-control" id="dob1" name="dob1">
            </div>
            <div class="form-group col-md-4">
                <label for="dob2">Last Promoted Date</label>
                <input type="date" class="form-control" id="dob2" name="dob2">
            </div>
        </div>

        <div class="form-group">
            <label for="remark">Remark</label>
            <textarea class="form-control" id="remark" name="remark" rows="1" placeholder="Enter remark"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-small">Submit</button>                                                     
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

<script>
    document.getElementById('promoForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var promotedGrade = document.getElementById('grade1').value.trim();
        var promotedDesignation = document.getElementById('designation1').value.trim();
        var action = document.getElementById('action').value.trim();
        var dob1 = document.getElementById('dob1').value.trim();
        var dob2 = document.getElementById('dob2').value.trim();
        var remark = document.getElementById('remark').value.trim();

        if (!promotedGrade) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a promoted grade.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!promotedDesignation) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a promoted designation.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!action) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the action (Promotion or Demotion).',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!dob1) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the With Effect Date.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!dob2) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the Promoted Date.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!remark) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a remark.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

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



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#employNumber').change(function () {
            var empNumber = $(this).val();

            if (empNumber) {
                $.ajax({
                    type: 'POST',
                    url: 'getEmployeeDetails.php',
                    data: { empnumber: empNumber },
                    dataType: 'json',
                    success: function (response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            $('#fullNameInitials').val(response.initial_name);
                            $('#company').val(response.comp_num);
                            $('#department').val(response.department);
                            $('#doj').val(response.doj);
                            $('#grade').val(response.grade);
                            $('#designation').val(response.designation);



                        }
                    },
                    error: function () {
                        alert('Error retrieving employee details');
                    }
                });
            }
        });
    });
</script>


</body>

</html>
<?php
}
?>