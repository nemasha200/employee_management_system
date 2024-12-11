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

$getuser = mysqli_query($con, "SELECT `id`,  `emp_num`, `name`, `designation`, `employment`, `ex_department`, `ex_company`, `trans_department`, `trans_company`, `trans_designation`,`effect_date`, `req_date`, `approve_date`, `remark` FROM `transfers` WHERE `id`='$user_id'");
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
        padding: 50px;
        background-color: whitesmoke;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: calc(100% - 250px); 
        max-width: 800px;
        margin: auto;
        margin-left: 35%;
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

        .form-control, select, textarea {
            color: black;
            background-color: white;
        }
        
        #fullNameInitials{
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

        #company{
            color: black;
        }

        #employNumber{
            color: balck;
        }

       
    </style>
</head>

<body>
<?php include 'submenubar.php';?>

<?php include 'logout.php';?> 

     
        <div class="container form-container">


            
            <h2 class="text-center">Transfers Registration Form</h2>
            <a href="transferSearch.php">
                <button type="button" class="btn btn-primary btn-small">View Updated transfers</button>
            </a>
            <form id="registrationForm" method="POST" action="transferSubmitUpdate.php">


            
            <div class="form-row">


            


            <div class="form-group col-md-12">
            <label for="fullNameInitials">Full Name :</label>
            <input type="text" value="<?php echo $res_user['name']; ?>" class="form-control" id="fullNameInitials" name="nameinitial" readonly>
                            
            </div>

            </div>
            

            <div class="form-row">

            <div class="form-group col-md-5">
                <label for="employNumber">Employ Number :</label>
                <input type="text" value="<?php echo $res_user['emp_num']; ?>" class="form-control" id="employNumber" name="empnumber" readonly>

                        
            </div>
            

                <div class="form-group col-md-7">
                    <label for="employment">Employment :</label>
                    <input type="employment" value="<?php echo $res_user['employment']; ?>" class="form-control" id="employment" name="employment" readonly>
                </div>
            </div>
           
        
            

    <div class="form-group row">

    <label for="transfer1" class="col-sm-3 col-form-label"><strong>Existing Section :</strong></label>
    <div class="form-group col-md-3">
          <input type="department" value="<?php echo $res_user['ex_department']; ?>" class="form-control" id="department" name="exdepartment" readonly>

    </div>

         <div class="col-sm-3">
                    <input type="company" value="<?php echo $res_user['ex_company']; ?>" class="form-control" id="company" name="excompany" readonly>
            
        </div>

        <div class="form-group col-md-3">
                            
                <input type="designation"  value="<?php echo $res_user['designation']; ?>" class="form-control" id="designation" name="designation" readonly>
            </div>   
</div>

    
    

<div class="form-group row">
    <label for="transfer2" class="col-sm-3 col-form-label"><strong>Transfer Section :</strong></label>
    <div class="form-group col-md-3">
                            <select class="form-control" id="department" name="transdep">



                    <?php
                    $getEmp = mysqli_query($con, "SELECT * FROM sub_department");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                        <option value="<?php echo $resCom['dep_name']; ?>"
                            <?php echo ($resCom['dep_name'] == $res_user['trans_department']) ? 'selected' : ''; ?>>
                            <?php echo $resCom['dep_name']; ?>
                        </option>
                    <?php
                    }
                    ?>

                            </select>


                        </div>
    
    <div class="col-sm-3">
                    <select class="form-control" id="dropdown" name="transcom">

                    <?php
                    $getEmp = mysqli_query($con, "SELECT * FROM sub_company");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                        <option value="<?php echo $resCom['com_number'] . '/' . $resCom['com_name']; ?>"
                            <?php echo ($resCom['com_name'] == $res_user['trans_company']) ? 'selected' : ''; ?>>
                            <?php echo $resCom['com_number'] . '/' . $resCom['com_name']; ?>
                        </option>
                    <?php
                    }
                    ?>
                    </select>
    </div>

    <div class="col-sm-3">
    <select class="form-control" id="designation1" name="designation1">
                    <?php 
                    $getEmp = mysqli_query($con, "SELECT * FROM sub_designation");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                        <option value="<?php echo $resCom['desi_name']; ?>"
                            <?php echo ($resCom['desi_name'] == $res_user['trans_designation']) ? 'selected' : ''; ?>>
                            <?php echo $resCom['desi_name']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>

                </div>


</div>

<div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="dob">Effective Date :</label>
                            <input type="date" value="<?php echo $res_user['effect_date']; ?>" class="form-control" id="dob" name="dob1">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">Requested Date :</label>
                            <input type="date" value="<?php echo $res_user['req_date']; ?>" class="form-control" id="dob" name="dob2">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">Approved Date :</label>
                            <input type="date" value="<?php echo $res_user['approve_date']; ?>" class="form-control" id="dob" name="dob3">
                        </div>


</div>
                
                
                <div class="form-group">
                    <label for="remark">Remark :</label>
                    <textarea class="form-control" id="remark" name="remark" rows="1"><?php echo $res_user['remark']; ?></textarea>
                    </div>

                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <button type="submit" class="btn btn-primary btn-small">Update</button>
    </form>
        </div>
    </div>
    

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
<script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Show SweetAlert2 notification
        Swal.fire({
            title: 'Success!',
            text: 'Transfer  has been updated successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // After clicking OK, submit the form
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