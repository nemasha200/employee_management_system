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
            padding: 60px;
            border-radius: 10px;
            border-color: black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            max-width: 1000px;
            margin: 20px auto; 
            overflow-y: auto; 
            margin-left: 35%;
            bottom: 100px;
b        }
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

       #nic{
        color:black;
       }
       #empNumber{
        color:black;
       }

       #Section{
        color:black;
       }

    
       
    </style>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">

    
</head>

<body>
<?php include 'submenubar.php';?>
<?php include 'logout.php';?> 

<div class="container form-container">
    <h2 class="text-center">Clearance Form</h2>
    <a href="clearSearch.php">
                <button type="button" class="btn btn-primary btn-small">View Clearance </button>
    </a>

    

    <form id="registrationForm" method="POST" action="clearSave.php" enctype="multipart/form-data">



    <div class="form-group">
            <label for="fullName">Full Name :</label>
            <select class="form-control" id="FullName" name="fullName">
                    <option value="" disabled selected>Select an option</option>
                    <?php 
                    $getEmp = mysqli_query($con,"SELECT full_name FROM  employer WHERE isAct ='1'");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                    <option value="<?php echo $resCom['full_name'] ?>"><?php echo $resCom['full_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>    
        </div>

    <div class="form-row">

    <div class="form-group col-md-4">
                <label for="employeeNumber">Employee Number :</label>
                <input type="text" class="form-control" id="empNumber" name="empnumber" readonly>
                         
            </div>

            <div class="form-group col-md-4">
                <label for="epfNumber">Reference Number :</label>
                <input type="text" class="form-control" id="refNumber" name="refnumber" placeholder="Enter Reference number">
            </div>

           

            <div class="form-group col-md-4">
                <label for="dob">Resignation w.e.f :</label>
                <input type="date" class="form-control" id="dob" name="dob">
            </div>
        </div>  
       

        

        
        <div class="form-group">
                <label for="dropdown">Company :</label>
                <input type="text" class="form-control" id="dropdown" name="company" readonly>
                    
        </div>

       

       

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="Section">Section :</label>
                <input type="text" class="form-control" id="Section" name="section" readonly>
            </div>

            
            <div class="form-group col-md-6">
                <label for="nic">NIC Number :</label>
                <input type="text" class="form-control" id="nic" name="nic" readonly>
                   
            </div>
        </div>

        
        <div class="form-row">
        <div class="form-group col-md-5">  
    <label for="headerGiven"><strong>Prior notice Given :</strong></label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="headerYes" name="headerGiven" value="yes" required>
        <label class="form-check-label" for="headerYes">Yes</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="headerNo" name="headerGiven" value="no" required>
        <label class="form-check-label" for="headerNo">No</label>
    </div>
</div>

<div class="form-group col-md-7">
                    <label for="imageUpload">Upload File : (Only Allowed pdf, jpg, jpeg, png formates)</label>
                            <input type="file" class="form-control-file" id="group" name="photo">
                            
                            <div class="message" id="message"></div>

</div>
</div>




        <div class="form-group col-md-">
            <label for="remark">Remark :</label>
            <textarea class="form-control" id="remark" name="remark" rows="1" placeholder="Enter remark"></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-small">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var refNumber = document.getElementById('refNumber').value.trim();
        var dob = document.getElementById('dob').value.trim();
        // var head = document.getElementById('head').value.trim();
        var head = document.querySelector('input[name="headerGiven"]:checked');


        var remark = document.getElementById('remark').value.trim();

        if (!refNumber) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Reference Number.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!dob) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Resignation date.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

       

if (!head) {
    Swal.fire({
        title: 'Validation Error!',
        text: 'Please select the Prior notice Given.',
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
        $('#FullName').change(function () {
            var fullName = $(this).val();

            if (fullName) {
                $.ajax({
                    type: 'POST',
                    url: 'getClearancedetails.php',
                    data: { fullName: fullName },
                    dataType: 'json',
                    success: function (response) {
                        if (response.error) {
                            alert(response.error);
                        } else if (response.emp_num && response.comp_num && response.department && response.nic) {
                            $('#dropdown').val(response.comp_num);
                            $('#empNumber').val(response.emp_num);
                            $('#Section').val(response.department);
                            $('#nic').val(response.nic);
                        } else {
                            Swal.fire({
                                title: 'Data Missing!',
                                text: 'Some details could not be retrieved automatically. Please contact support.',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error retrieving employee details.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
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
