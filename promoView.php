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

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $getuser = mysqli_query($con, "SELECT * FROM promotion WHERE id='$user_id'");
    $res_user = mysqli_fetch_array($getuser);

    
}
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
            background-color: lightblue;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px); /* Adjust width for sidebar */
            max-width: 800px;
            margin: auto;
        }

        .form-control {
            color: black;
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


            
            <h2 class="text-center">Promotion Registration Form</h2>
           
            <form id="registrationForm" method="POST" action="promoSave.php">
                

            <form id="myForm">
            <div id="dropdownDiv">
                <div class="form-group">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" name="company" value="<?php echo $res_user['company']; ?>" readonly>
                    
                </div>
            </div>
            <div id="selectionDisplay">
                <h4 id="selectedValue"></h4>
            </div>


            
                <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="employNumber">Employ Number </label>
                            <input type="text" class="form-control" id="employNumber" value="<?php echo $res_user['emp_num']; ?>" readonly>
                </div>

                <div class="form-group col-md-6">
                            <label for="fullNameInitials">Name with Initials</label>
                            <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" value="<?php echo $res_user['name']; ?>" readonly>
                 </div>

                 <div class="form-group col-md-3">
                            <label for="department">Department<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="department" name="department" value="<?php echo $res_user['department']; ?>" readonly>


                </div>

                </div>

                    <div class="form-row">

                    <div class="form-group col-md-3">
                            <label for="company">Existing Grade<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="grade" name="garde" value="<?php echo $res_user['ex_grade']; ?>" readonly>

                        </div>


                    <div class="form-group col-md-3">
                            <label for="designation">Existing Designation<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $res_user['ex_grade']; ?>" readonly>

                        </div>   

                        <div class="form-group col-md-3">
                            <label for="grade1">Promoted Grade<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="grade1" name="grade1" value="<?php echo $res_user['promo_grade']; ?>" readonly>

                        </div>


                        <div class="form-group col-md-3">
                            <label for="designation">Promoted Designation<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="designation1" name="designation1" value="<?php echo $res_user['promo_designation']; ?>" readonly>

                        </div> 




                    </div>

                    <div class="form-row">

                    <div class="form-group col-md-4">
                            <label for="dob">With effect Date</label>
                            <input type="text" class="form-control" id="dob1" name="dob1" value="<?php echo $res_user['promo_effect_date']; ?>" readonly>

                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">Last promoted Date</label>
                            <input type="text" class="form-control" id="dob2" name="dob2" value="<?php echo $res_user['last_promo_date']; ?>" readonly>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">Date of join</label>
                            <input type="text" class="form-control" id="dob3" name="dob3" value="<?php echo $res_user['doj']; ?>" readonly>
                        </div>
                           
        </div>

        <div class="form-group">
                    <label for="remark">Remark</label>
                    <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $res_user['remark']; ?>" readonly>
        </div>
        </form>

    
    

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