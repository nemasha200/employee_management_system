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
    $getuser = mysqli_query($con, "SELECT * FROM discipline WHERE id='$user_id'");
    $res_user = mysqli_fetch_array($getuser);

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinary Registration Form</title>
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
            background-color: #22b3b0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        }

        .btn-primary:hover {
            background-color: #495057;
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
        <h2 class="text-center">Disciplinary details</h2>
       
        <form>
            <div class="form-group">
                <label for="selectEmployee">Select Employee</label>
                <input type="text" class="form-control" id="selectEmployee" name="selectemp" value="<?php echo $res_user['select_emp']; ?>" readonly>
                    
            </div>
            <div class="form-group">
                <label for="remark">Remark</label>
                <input type="text" class="form-control" id="remark" name="remark" rows="2" value="<?php echo $res_user['remark']; ?>" readonly>            
            </div>
            

            <div class="form-group col-md-12">
                            <label for="photo">Photo</label>
                            <?php
                            if(!empty($res_user['img'])) {
                                echo '<div><img src="dici/' . $res_user['img'] . '" alt="Employee Photo" class="img-fluid" /></div>';
                            } else {
                                echo '<div>No photo uploaded.</div>';
                            }
                            ?>
            </div>
   
       </form>
</body>
       
    
</html>

<?php
  }
?>