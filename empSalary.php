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
    <title>Employee Benifits Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            margin-left: 300px; 
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

       
        hr {
            border: 1px solid #ccc;
            margin: 20px 0;
        }

        #emp{
            color: black;
        }
       
        #company{
            color:black;
        }
        #department{
            color:black;
        }

        #epf{
            color: black;
        }

    </style>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body>

<?php include 'submenubar.php';?> 
<?php include 'logout.php';?> 



    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-10 form-container">
                <h2 class="text-center">Employee Remuneration</h2>
                <a href="salarySearch.php">
                    <button type="button" class="btn btn-primary btn-small">View Benifits</button>
                </a>  
                <form id="registrationForm" method="POST" action="salarySave.php" enctype="multipart/form-data">

                <div class="form-row">


              
    
    <div class="form-group col-md-9">
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

    <div class="form-group col-md-3">
        <label for="empNumber">Department :</label>
        <input type="text" class="form-control" id="department" name="department" readonly>
                      
            
            </div>
                    
    </div> 


                <div class="form-group">
                    <label for="dropdown">Company:</label>
                    <input type="text" class="form-control" id="company" name="company" readonly>
                    
                </div>
           
            

     <div class="form-row">
   

    <div class="form-group col-md-3">
        <label for="empNumber">EPF Number :</label>
        <input type="text" class="form-control" id="epf" name="epfnumber" readonly>
    </div>


<div class="form-group col-md-5">
        <label for="basic">Basic :</label>
        <input type="text" class="form-control" id="Basic" name="basic" placeholder="Enter basic">
</div>

<div class="form-group col-md-4">
        <label for="bra">BRA(Budgetory Relief Allowance) :</label>
        <input type="text" class="form-control" id="bra" name="bra" placeholder="Enter bra">
</div>

</div>

<hr>

<div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label"><strong>Other Benifits :</strong></label>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><strong>Amounts :</strong></label>
                </div>
            </div>

            <!-- First Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance1"> -->
                    <label class="form-check-label" for="allowance1">Travelling Washing Reimburse</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" id="Amount1" name="amount1">
                </div>
            </div>

            <!-- Second Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance2"> -->
                    <label class="form-check-label" for="allowance2">Other amount</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount2">
                </div>
            </div>

            <!-- Third Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance3"> -->
                    <label class="form-check-label" for="allowance3">Travelling Re imburcement</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount3">
                </div>
            </div>

            <!-- Fourth Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance4"> -->
                    <label class="form-check-label" for="allowance4">Vehicle Exp.Reimburcement</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount4">
                </div>
            </div>

            <!-- Fifth Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance5"> -->
                    <label class="form-check-label" for="allowance5">Fual Allowance</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount5">
                </div>
            </div>
           
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance6"> -->
                    <label class="form-check-label" for="allowance5">Logging Re imburcement</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount6">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance7"> -->
                    <label class="form-check-label" for="allowance5">Attendance Bonus</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount7">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance7"> -->
                    <label class="form-check-label" for="allowance5">Travelling Exp. Reimbursment</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount8">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance8"> -->
                    <label class="form-check-label" for="allowance5">Allowance for  Pettah</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount9">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance9"> -->
                    <label class="form-check-label" for="allowance5">Allowance for Bakery</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount10">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance10"> -->
                    <label class="form-check-label" for="allowance5">Performance Incentive</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount11">
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label"><strong>Fixed deduction :</strong></label>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><strong>Amounts :</strong></label>
                </div>
            </div>

            <!-- First Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance1"> -->
                    <label class="form-check-label" for="allowance1">Welfare</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount12">
                </div>
            </div>

            <!-- Second Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance2"> -->
                    <label class="form-check-label" for="allowance2">Medical Insurance</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount13">
                </div>
            </div>

            <!-- Third Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance3"> -->
                    <label class="form-check-label" for="allowance3">other1</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount14">
                </div>
            </div>

            <!-- Fourth Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance4"> -->
                    <label class="form-check-label" for="allowance4">other2</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount15">
                </div>
            </div>

            <!-- Fifth Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance5"> -->
                    <label class="form-check-label" for="allowance5">other3</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount16">
                </div>
            </div>


            <hr>

            <h5><u>Bank Information</u></h5><br>

            <div class="form-row">
          
           
<div class="form-group col-md-6">
        <label for="Payment">Payment Method :</label>
        <select class="form-control" id="Payment" name="payment">
                        <option value="" disabled selected>Select an option</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="tansfer">Bank transfer</option>
                    </select>
</div>

<div class="form-group col-md-6">
        <label for="Account">Account Number :</label>
        <input type="text" class="form-control" id="Account" name="account" placeholder="Enter Account Number">
</div>

</div>

<div class="form-row">

<div class="form-group col-md-6">
        <label for="Bank">Bank Name :</label>
        <input type="text" class="form-control" id="Bank" name="bank" placeholder="Enter Bank name">
</div>

<div class="form-group col-md-6">
        <label for="Branch">Branch Name :</label>
        <input type="text" class="form-control" id="Branch" name="branch" placeholder="Enter Branch name ">
</div>

</div>

<button type="submit" class="btn btn-primary btn-small">Submit</button>

           


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var Basic = document.getElementById('Basic').value.trim();
        var bra = document.getElementById('bra').value.trim();
        var Payment = document.getElementById('Payment').value.trim();
        var Account = document.getElementById('Account').value.trim();
        var Bank = document.getElementById('Bank').value.trim();
        var Branch = document.getElementById('Branch').value.trim();

        if (!Basic) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Basic.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!bra) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Budgetory Relief Allowance.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!Payment) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the payment.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!Account) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the Account.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!Bank) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select the Bank.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!Branch) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Branch.',
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
                    url: 'getSalarydetails.php', 
                    data: { nameinitial: nameinitial },
                    dataType: 'json',
                    success: function (response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            $('#company').val(response.comp_num);
                            $('#department').val(response.department);
                            $('#epf').val(response.epf);
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