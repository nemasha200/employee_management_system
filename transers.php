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

        
    </style>
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

            <div class="form-group col-md-4">
                            <label for="emp">Employee Number</label>
                            <input type="text" class="form-control" id="emp" name="emp" placeholder="Enter employee number">
            </div>


            <div class="form-group col-md-8">
                            <label for="fullNameInitials">Name with Initials</label>
                            <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" placeholder="Enter full name with initials">
            </div>

            
            </div>
            

            <div class="form-row">
            <div class="form-group col-md-5">
                            <label for="designation">Designation<span style="color:red">*</span></label>
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

                <div class="form-group col-md-6">
                    <label for="employment">Employment</label>
                    <select class="form-control" id="employment" name="employment">
                    <option value="" disabled selected>Select an option</option>
                    <option>Permanent</option>
                    <option>Contract</option>
                    <option>Casual</option>
                    </select>
                </div>
            </div>
            <br>
        
            

    <div class="form-group row">
    <label for="transfer1" class="col-sm-3 col-form-label"><strong>Existing Section</strong></label>
    <div class="form-group col-md-4">
                            <select class="form-control" id="department" name="exdepartment">
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

         <div class="col-sm-4">
                    <select class="form-control" id="dropdown" name="excompany">
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
</div>

    
    

<div class="form-group row">
    <label for="transfer2" class="col-sm-3 col-form-label"><strong>Transfer Request</strong></label>
    <div class="form-group col-md-4">
                            <select class="form-control" id="department" name="transdep">
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
    
    <div class="col-sm-4">
                    <select class="form-control" id="dropdown" name="transcom">
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
</div>

<div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="dob">Effective Date</label>
                            <input type="date" class="form-control" id="dob" name="dob1">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">Requested Date</label>
                            <input type="date" class="form-control" id="dob" name="dob2">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">Approved Date</label>
                            <input type="date" class="form-control" id="dob" name="dob3">
                        </div>


</div>
                
                
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <textarea class="form-control" id="remark" name="remark" rows="1" placeholder="Enter remark"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-small">Submit</button>
            </form>
        </div>
    </div>
    

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