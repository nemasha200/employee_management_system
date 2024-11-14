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

$getuser = mysqli_query($con, "SELECT id, company, emp_num, name, department, ex_grade, ex_grade, promo_grade, promo_designation,promo_action, promo_effect_date, last_promo_date, doj, remark FROM promotion WHERE id='$user_id'");
$res_user = mysqli_fetch_array($getuser);
?>

<!DOCTYPE html>
<html lang="en">

<html>
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
            padding: 20px;
            background-color: whitesmoke;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px); /* Adjust width for sidebar */
            max-width: 800px;
            margin: auto;
            margin-left: 570px;
        }

        .form-control, select, textarea {
            color: black;
            background-color: white;
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

       
    </style>
</head>

<body>
<?php include 'submenubar.php';?>

<?php include 'logout.php';?> 

<div class="container form-container">
    <h2 class="text-center">Promotion Registration Form</h2>
    <a href="promosearch.php">
        <button type="button" class="btn btn-primary btn-small">View updated promotions</button>
    </a>
    <form id="registrationForm" method="POST" action="promoSubmitUpdate.php">
        <div class="form-row"> 

        <div class="form-group col-md-9">
                <label for="fullNameInitials">Name with Initials</label>
                <input type="text" value="<?php echo $res_user['name']; ?>" class="form-control" id="fullNameInitials" name="nameinitial" readonly>
            </div> 
            
            <div class="form-group col-md-3">
                <label for="employNumber">Employ Number </label>
                <input type="text" value="<?php echo $res_user['emp_num']; ?>" class="form-control" id="employNumber" name="empnumber" readonly>
            </div>

           
        </div>

        <div class="form-group col-md-13">
            <label for="company">Company:</label>
            <input type="company" value="<?php echo $res_user['company']; ?>" class="form-control" id="company" name="company" readonly>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department">Department</label>
                <input type="text" value="<?php echo $res_user['department']; ?>" class="form-control" id="department" name="department" readonly>
            </div>

            <div class="form-group col-md-5">
                <label for="dob">Date of join</label>
                <input type="text" value="<?php echo $res_user['doj']; ?>" class="form-control" id="doj" name="doj" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="grade">Existing Grade</label>
                <input type="text" value="<?php echo $res_user['ex_grade']; ?>" class="form-control" id="grade" name="grade" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="designation">Existing Designation<span style="color:red">*</span></label>
                <input type="text" value="<?php echo $res_user['promo_designation']; ?>" class="form-control" id="designation" name="designation" readonly>
            </div>   

            <div class="form-group col-md-3">
                <label for="company">Promoted Grade<span style="color:red">*</span></label>
                <select class="form-control" id="grade" name="grade1">
                    <?php
                    $getEmp = mysqli_query($con, "SELECT * FROM sub_division");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                        <option value="<?php echo $resCom['grade']; ?>"
                            <?php echo ($resCom['grade'] == $res_user['promo_grade']) ? 'selected' : ''; ?>>
                            <?php echo $resCom['grade']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="designation">Promoted Designation</label>
                <select class="form-control" id="designation" name="designation1">
                    <?php 
                    $getEmp = mysqli_query($con, "SELECT * FROM sub_designation");
                    while ($resCom = mysqli_fetch_array($getEmp)) {
                    ?>
                        <option value="<?php echo $resCom['desi_name']; ?>"
                            <?php echo ($resCom['desi_name'] == $res_user['promo_designation']) ? 'selected' : ''; ?>>
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
                <label for="recruitmentType">Promo Action</label>
                <select class="form-control" id="action" name="action">
                    <option value="" disabled selected>Select an option</option>
                    <option value="promotion"<?php echo ($res_user['promo_action'] == 'promotion') ? 'selected' : ''; ?>>Promotion</option>
                    <option value="demotion" <?php echo ($res_user['promo_action'] == 'demotion') ? 'selected' : ''; ?>>Demotion</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="dob">With effect Date</label>
                <input type="date" value="<?php echo $res_user['promo_effect_date']; ?>" class="form-control" id="dob" name="dob1">
            </div>

            <div class="form-group col-md-4">
                <label for="dob">Last promoted Date</label>
                <input type="date" value="<?php echo $res_user['last_promo_date']; ?>" class="form-control" id="dob" name="dob2" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="remark">Remark</label>
            <textarea class="form-control" id="remark" name="remark" rows="1"><?php echo $res_user['remark']; ?></textarea>
        </div>

        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <button type="submit" class="btn btn-primary btn-small">Update</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>

</body>
</html>
<?php
}
?>  
