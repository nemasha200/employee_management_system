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

$getuser = mysqli_query($con, "SELECT `id`, `select_emp`, `img`, `remark` FROM `discipline` WHERE `id`='$user_id'");
$res_user = mysqli_fetch_array($getuser);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinary Actions Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #dadce3;
            background-image: url("img1.jpg");
        }
        .form-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            background-color: #c5eaed;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
<?php include 'submenubar.php';?>

    <div class="container form-container">
        <button class="back-button" onclick="window.history.back();">&larr;</button>
        <h2 class="text-center">Disciplinary Actions Form</h2>
        <a href="diciSearch.php">
            <button type="button" class="btn btn-primary btn-small">View Updated Disciplinary Actions</button>
        </a>
        <form id="registrationForm" method="POST" action="diciSubmitUpdate.php">
        <div class="form-group">
                    <label for="selectEmployee">Select Employee</label>
                    <select class="form-control" id="selectEmployee" name="selectemp" >
                    <?php 
                        $getEmp = mysqli_query($con,"SELECT * FROM employer WHERE isact='1' ");
                        while ($resAct = mysqli_fetch_array($getEmp)) {
                            ?>
                        <option value="<?php echo $resAct['fullname']."/".$resAct['nic_num'] ?>"><?php echo $resAct['fullname']."/".$resAct['nic_num'] ?></option>

                            <?php
                        }
                    ?>
                    </select> 
                </div>

                
            <div class="form-group">
                <label for="imageUpload">Upload Image</label>
                <input type="file" class="form-control-file" id="imageUpload" name="image" value="<?php echo $res_user['img']; ?>">
            </div>
            <div class="form-group">
                <label for="remark">Remark</label>
                <input type="text" class="form-control" id="remark" name="remark" rows="3" placeholder="Enter remark"value="<?php echo $res_user['remark']; ?>">
            </div>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <button type="submit" class="btn btn-primary btn-small">Submit</button>

        </form>
    </div>
</body>
</html>
<?php
    }
?>