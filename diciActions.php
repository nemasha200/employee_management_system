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
    <title>Disciplinary Actions Registration Form</title>
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

        
        .form-container {
            margin-left: 250px; /* Adjusted for sidebar width */
            padding: 30px;
            background-color: #dadce3;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px); /* Adjust width for sidebar */
            max-width: 800px;
            margin: auto;
            margin-left: 600px;
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

        .btn-small {
            padding: 5px 10px;
            font-size: 0.875rem;
            width: 150px;
            display: block;
            margin: 20px auto 0;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #343a40;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #495057;
        }

        #emp{
            color: black;
        }
    </style>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
<?php include 'submenubar.php';?>

<?php include 'logout.php';?> 

    
      
        <div class="container form-container">
            <h2 class="text-center">Disciplinary Actions Form</h2>
            <a href="diciSearch.php">
                <button type="button" class="btn btn-primary btn-small">View Disciplinary Actions</button>
            </a>
            <form id="registrationForm" method="POST" action="diciSave.php" enctype="multipart/form-data">

            
            <div class="form-row">
            
            


            <div class="form-group col-md-8">
                            <label for="fullNameInitials">Full Name :</label>
                            <select class="form-control" id="fullNameInitials" name="nameinitial">

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

            <div class="form-group col-md-4">
                            <label for="emp">Employee Number :</label>
                            <input type="text" class="form-control" id="emp" name="empnumber" readonly>

                         
            </div>

            


            </div>

            <div class="form-row">
            
            <div class="form-group col-md-12">
                            <label for="fullNameInitials">Disciplinary issue :</label>
                            <input type="text" class="form-control" id="reason" name="reason" placeholder="Enter Issue">
            </div>
        </div>

<div class="form-row">
            
            <div class="form-group col-md-12">
                            <label for="fullNameInitials">Disciplinary Action :</label>
                            <input type="text" class="form-control" id="reason1" name="reason1" placeholder="Enter Action">
            </div>
</div>

            <div class="form-group">
                    <label for="imageUpload">Upload File : (Only Allowed pdf, jpg, jpeg, png formates)</label>
                            <input type="file" class="form-control-file" id="group" name="photo">
                            
                            <div class="message" id="message"></div>

                </div>
                
                <div class="form-group">
                    <label for="remark">Remark :</label>
                    <textarea class="form-control" id="remark" name="remark" rows="2" placeholder="Enter remark"></textarea>
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

        var reason = document.getElementById('reason').value.trim();
        var group = document.getElementById('group').value.trim();
        var remark = document.getElementById('remark').value.trim();
       
        if (!reason) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a reason.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!group) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a photo.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!remark) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the remark.',
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
                    url: 'getDicidetails.php',
                    data: { nameinitial: nameinitial  },
                    dataType: 'json',
                    success: function (response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            $('#emp').val(response.emp_num);
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
