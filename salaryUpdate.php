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

$getuser = mysqli_query($con, "SELECT `id`, `company_num`, `department`, `name`, `epf`, `basic`, `bra`, `fa_travelling_amount`, `fa_budget_amount`, `fa_retravel_amount`, `fa_vehicle_amount`, `fa_fual_amount`, 
`fa_logging_amount`, `fa_attendance_amount`, `fa_travel_exp_amount`, `fa_pettah_amount`, `fa_bakery_amount`, `fa_insentive_amount`, `fd_welfare_amount`, `fd_medical_amount`, `fd_other1`, `fd_other2`, `fd_other3`, `payemnt`, `account_num`, `bank_name`, `branch_name`  FROM `salary` WHERE `id`='$user_id'");
$res_user = mysqli_fetch_array($getuser);
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

        
        #department{
            color: black;
        }

        #fullNameInitials{
            color: black;
        }
       
        #company{
            color:black;
        }

        #epf{
            color: black;
        }

    </style>
</head>
<body>

<?php include 'submenubar.php';?> 
<?php include 'logout.php';?> 



    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-10 form-container">
                <h2 class="text-center">Employee Remunaration</h2>
                <a href="salarySearch.php">
                    <button type="button" class="btn btn-primary btn-small">View Updated Benifits</button>
                </a>  
                <form id="registrationForm" method="POST" action="salarySubmitupdate.php" enctype="multipart/form-data">

               
                
           

                <div class="form-row">


        
    <div class="form-group col-md-9">
            <label for="fullNameInitials">Name with Initials :</label>
            <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" value="<?php echo $res_user['name']; ?>" readonly>
    </div>

    <div class="form-group col-md-3">
        <label for="empNumber">Department :</label>
        <input type="text" class="form-control" id="department" name="department" value="<?php echo $res_user['department']; ?>" readonly>
                        
            
            </div>
    
                    
    </div> 

    <div class="form-group">
                    <label for="dropdown">Company:</label>
                    <input type="text"  class="form-control" id="company"  value="<?php echo $res_user['company_num']; ?>" readonly>
                    
    </div>


               
            

     <div class="form-row">
   

    <div class="form-group col-md-3">
        <label for="empNumber">EPF Number :</label>
        <input type="text" class="form-control" id="epf" name="epfnumber" value="<?php echo $res_user['epf']; ?>" readonly>
    </div>


<div class="form-group col-md-5">
        <label for="basic">Basic :</label>
        <input type="text" class="form-control" id="Basic" name="basic" value="<?php echo $res_user['basic']; ?>" >
</div>

<div class="form-group col-md-4">
        <label for="bra">BRA :</label>
        <input type="text" class="form-control" id="bra" name="bra" value="<?php echo $res_user['bra']; ?>" >
</div>

</div>

<hr>

<div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label"><strong>Fixed Allowance :</strong></label>
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
                    <input type="text" class="form-control" placeholder="Amount" id="Amount1" name="amount1" value="<?php echo $res_user['fa_travelling_amount']; ?>" >
                </div>
            </div>

            <!-- Second Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance2"> -->
                    <label class="form-check-label" for="allowance2">Budgetory Allowance</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount2" value="<?php echo $res_user['fa_budget_amount']; ?>" >
                </div>
            </div>

            <!-- Third Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance3"> -->
                    <label class="form-check-label" for="allowance3">Travelling Re imburcement</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount3" value="<?php echo $res_user['fa_retravel_amount']; ?>" >
                </div>
            </div>

            <!-- Fourth Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance4"> -->
                    <label class="form-check-label" for="allowance4">Vehicle Exp.Reimburcement</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount4" value="<?php echo $res_user['fa_vehicle_amount']; ?>" >
                </div>
            </div>

            <!-- Fifth Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance5"> -->
                    <label class="form-check-label" for="allowance5">Fual Allowance</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount5" value="<?php echo $res_user['fa_fual_amount']; ?>" >
                </div>
            </div>
           
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance6"> -->
                    <label class="form-check-label" for="allowance5">Logging Re imburcement</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount6" value="<?php echo $res_user['fa_logging_amount']; ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance7"> -->
                    <label class="form-check-label" for="allowance5">Attendance Bonus</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount7" value="<?php echo $res_user['fa_attendance_amount']; ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance7"> -->
                    <label class="form-check-label" for="allowance5">Travelling Exp. Reimbursment</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount8" value="<?php echo $res_user['fa_travel_exp_amount']; ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance8"> -->
                    <label class="form-check-label" for="allowance5">Allowance for  Pettah</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount9" value="<?php echo $res_user['fa_pettah_amount']; ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance9"> -->
                    <label class="form-check-label" for="allowance5">Allowance for Bakery</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount10" value="<?php echo $res_user['fa_bakery_amount']; ?>" >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance10"> -->
                    <label class="form-check-label" for="allowance5">Performance Incentive</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount11" value="<?php echo $res_user['fa_insentive_amount']; ?>" >

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
                    <input type="text" class="form-control" placeholder="Amount" name="amount12" value="<?php echo $res_user['fd_welfare_amount']; ?>" >
                </div>
            </div>

            <!-- Second Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance2"> -->
                    <label class="form-check-label" for="allowance2">Medical insurance</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount13" value="<?php echo $res_user['fd_medical_amount']; ?>" >
                </div>
            </div>

            <!-- Third Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance3"> -->
                    <label class="form-check-label" for="allowance3">other1</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount14" value="<?php echo $res_user['fd_other1']; ?>" >
                </div>
            </div>

            <!-- Fourth Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance4"> -->
                    <label class="form-check-label" for="allowance4">other2</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount15" value="<?php echo $res_user['fd_other2']; ?>" >
                </div>
            </div>

            <!-- Fifth Allowance -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <!-- <input class="form-check-input" type="checkbox" id="allowance5"> -->
                    <label class="form-check-label" for="allowance5">other3</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Amount" name="amount16" value="<?php echo $res_user['fd_other3']; ?>" >
                </div>
            </div>


            <hr>

            <div class="form-row">
          
           
<div class="form-group col-md-6">
        <label for="Payment">Payment Method :</label>
        <select class="form-control" name="payment">
                            <option value="cash" <?php echo ($res_user['payemnt'] == 'cash') ? 'selected' : ''; ?>>Cash</option>
                            <option value="cheque" <?php echo ($res_user['payemnt'] == 'cheque') ? 'selected' : ''; ?>>Cheque</option>
                            <option value="transfer" <?php echo ($res_user['payemnt'] == 'transfer') ? 'selected' : ''; ?>>Bank Transfer</option>

                        </select>
</div>

<div class="form-group col-md-6">
        <label for="Account">Account Number :</label>
        <input type="text" class="form-control" id="Account" name="account" value="<?php echo $res_user['account_num']; ?>" >
</div>

</div>

<div class="form-row">

<div class="form-group col-md-6">
        <label for="Bank">Bank Name :</label>
        <input type="text" class="form-control" id="Bank" name="bank" value="<?php echo $res_user['bank_name']; ?>" >
</div>

<div class="form-group col-md-6">
        <label for="Branch">Branch Name :</label>
        <input type="text" class="form-control" id="Branch" name="branch" value="<?php echo $res_user['branch_name']; ?>" >
</div>

</div>

<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<button type="submit" class="btn btn-primary btn-small">Update</button>
           


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
</body>
</html>
<?php
}
?>