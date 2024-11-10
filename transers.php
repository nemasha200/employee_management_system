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
    <title>Transfers Registration Form</title>
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
            margin-left: 250px; /* Adjusted for sidebar width */
            padding: 30px;
            background-color: whitesmoke;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px); /* Adjust width for sidebar */
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

        /* Highlight the selected value with a yellow background */
        #selectedValue {
            background-color: yellow;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        
        #employNumber{
            color: black;
        }

              
        #designation{
            color: black;
        }

              
        #employment{
            color: black;
        }

              
        #department{
            color: black;
        }

        #transdepartment{
            color: black;

        }

        #company{
            color: black;
        }

        #employNumber{
            color: balck;
        }

        #transdepartment {
    color: white; /* Font color */
    background-color: #343a40; /* Background color */
}

#transcompany {


    
    color: white; /* Font color */
    background-color: #343a40; /* Background color */
}


       
    </style>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
<?php include 'submenubar.php';?>

<?php include 'logout.php';?> 

     
        <div class="container form-container">


            
            <h2 class="text-center">Transfers Registration Form</h2>
            <a href="transferSearch.php">
                <button type="button" class="btn btn-primary btn-small">View transfers</button>
            </a>
            <form id="registrationForm" method="POST" action="transferSave.php">


            
            <div class="form-row">


            

            <div class="form-group col-md-12">
            
            <label for="fullNameInitials">Full Name :</label>
                <select class="form-control" class="form-control" id="fullNameInitials" name="nameinitial"> 
               
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

            
 
            </div>
            

            <div class="form-row">

            <div class="form-group col-md-4">
                <label for="employNumber">Employ Number :</label>
                <input type="text" class="form-control" id="employNumber" name="empnumber" readonly>
                      
            </div>
          

                <div class="form-group col-md-7">
                    <label for="employment">Employment :</label>
                    <input type="employment" class="form-control" id="employment" name="employment" readonly>
                </div>
            </div>
            <br>
        
            

    <div class="form-group row">

    <label for="transfer1" class="col-sm-3 col-form-label"><strong>Existing Section :</strong></label>
    <div class="form-group col-md-3">
          <input type="department" class="form-control" id="department" name="exdepartment" readonly>

    </div>

         <div class="col-sm-3">
                    <input type="company" class="form-control" id="company" name="excompany" readonly>
            
        </div>

        <div class="col-sm-3">
        <input type="designation"  class="form-control" id="designation" name="designation" readonly>
            
        </div>
</div>

    
    

<div class="form-group row">
    <label for="transfer2" class="col-sm-3 col-form-label"><strong>Transfer Section :</strong></label>
    <div class="form-group col-md-3">
                            <select class="form-control" id="transdepartment" name="transdep">
                            <option value="" disabled selected> Department</option>



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
    
    <div class="col-sm-3">
                    <select class="form-control" id="transcompany" name="transcom">
                    <option value="" disabled selected>Company</option>
                    <?php 
                        $getEmp = mysqli_query($con,"SELECT * FROM  sub_company");
                        while ($resCom = mysqli_fetch_array($getEmp)) {
                            ?>
                        <option value="<?php echo $resCom['com_name'] ?>"><?php echo $resCom['com_name'] ?></option>

                            <?php
                        }
                    ?>
                            </select>
                    </select>
    </div>

    <div class="col-sm-3">
                <select class="form-control" id="designation1" name="designation1">
                    <option value="" disabled selected>Designation</option>
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
                            <label for="dob">Effective Date :</label>
                            <input type="date" class="form-control" id="dob1" name="dob1">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">Requested Date :</label>
                            <input type="date" class="form-control" id="dob2" name="dob2">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">Approved Date :</label>
                            <input type="date" class="form-control" id="dob3" name="dob3">
                        </div>


</div>
                
                
                <div class="form-group">
                    <label for="remark">Remark :</label>
                    <textarea class="form-control" id="remark" name="remark" rows="1" placeholder="Enter remark"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-small">Submit</button>
            </form>
        </div>
    </div>
    

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var transdepartment = document.getElementById('transdepartment').value.trim();
        var transcompany = document.getElementById('transcompany').value.trim();
        var designation1 = document.getElementById('designation1').value.trim();

        var dob1 = document.getElementById('dob1').value.trim();
        var dob2 = document.getElementById('dob2').value.trim();
        var dob3 = document.getElementById('dob3').value.trim();
        var remark = document.getElementById('remark').value.trim();

        if (!transdepartment) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Transfer department.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!transcompany) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Transfer company.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!designation1) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Transfer Designation.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!dob1) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the Effective Date.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!dob2) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the Requested Date.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!dob3) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the Approved Date.',
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
        $('#fullNameInitials').change(function () {
            var nameinitial = $(this).val();

            if (nameinitial) {
                $.ajax({
                    type: 'POST',
                    url: 'getTransferDetails.php',
                    data: { nameinitial: nameinitial  },
                    dataType: 'json',
                    success: function (response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            $('#employNumber').val(response.emp_num);
                            $('#designation').val(response.designation);
                            $('#employment').val(response.emp_status);
                            $('#department').val(response.department);
                            $('#company').val(response.comp_num);
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