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



    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-10 form-container">
                <h2 class="text-center">Employee Remunaration</h2>
                <a href="salarySearch.php">
                    <button type="button" class="btn btn-primary btn-small">View Benifits</button>
                </a>  
                <form id="registrationForm" method="POST" action="salarySave.php" enctype="multipart/form-data">

               
                    
        <form id="myForm">
            <div id="dropdownDiv">
                <div class="form-group">
                    <label for="dropdown">Company:</label>
                    <select class="form-control" id="dropdown" name="company">
                        <option value="" disabled selected>Select an option</option>
                        <?php 
                        $getEmp = mysqli_query($con,"SELECT * FROM  sub_company");
                        while ($resCom = mysqli_fetch_array($getEmp)) {
                            ?>
                        <option value="<?php echo $resCom['com_number']."/".$resCom['com_name'] ?>"><?php echo $resCom['com_number']."/".$resCom['com_name'] ?></option>

                            <?php
                        }
                    ?>
                            </select>
                    </select>
                </div>
            </div>
            <div id="selectionDisplay">
                <h4 id="selectedValue"></h4>
            </div>


     <div class="form-row">
    <div class="form-group col-md-3">
        <label for="empNumber">Employee Number</label>
        <input type="text" class="form-control" id="empNumber" name="empnumber" placeholder="Enter Employee number">
    </div>
    
    <div class="form-group col-md-6">
            <label for="fullNameInitials">Name with Initials</label>
            <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" placeholder="Enter full name with initials">
    </div>

    <div class="form-group col-md-3">
        <label for="empNumber">EPF Number</label>
        <input type="text" class="form-control" id="empNumber" name="epfnumber" placeholder="Enter epf number">
    </div>
</div>

<div class="form-group col-md-5">
        <label for="basic">Basic</label>
        <input type="text" class="form-control" id="Basic" name="basic" placeholder="Enter basic">
</div>

<div class="form-group col-md-5">
        <label for="bra">BRA</label>
        <input type="text" class="form-control" id="bra" name="bra" placeholder="Enter bra">
</div>

<hr>

<div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label"><strong>Fixed Allowance</strong></label>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><strong>Amounts</strong></label>
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
                    <label class="form-check-label" for="allowance2">Budgetory Allowance</label>
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
                    <label class="form-label"><strong>Fixed deduction</strong></label>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><strong>Amounts</strong></label>
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
                    <label class="form-check-label" for="allowance2">Medical insurance</label>
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

            
           
<div class="form-group col-md-6">
        <label for="Payment">Payment</label>
        <input type="text" class="form-control" id="Payment" name="payment" placeholder="Enter Payment">
</div>

<div class="form-group col-md-6">
        <label for="Account">Account Number</label>
        <input type="text" class="form-control" id="Account" name="account" placeholder="Enter Account Number">
</div>

<div class="form-group col-md-6">
        <label for="Bank">Bank Name</label>
        <input type="text" class="form-control" id="Bank" name="bank" placeholder="Enter Bank name">
</div>

<div class="form-group col-md-6">
        <label for="Branch">Branch Name</label>
        <input type="text" class="form-control" id="Branch" name="branch" placeholder="Enter Branch name ">
</div>



<button type="submit" class="btn btn-primary btn-small">Submit</button>

           



           

<script>
        document.getElementById('dropdown').addEventListener('change', function() {
            var selected = this.options[this.selectedIndex].text;
            document.getElementById('selectedValue').innerText = selected;
            
            // Show the h4 and hide the dropdown and label
            document.getElementById('selectionDisplay').style.display = 'block';
            document.getElementById('dropdownDiv').style.display = 'none';
        });
    </script>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
?>