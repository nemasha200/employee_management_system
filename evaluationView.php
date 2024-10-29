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
    $getuser = mysqli_query($con, "SELECT * FROM evaluation WHERE id='$user_id'");
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
        #department{
            color: black;
        }
        #fullNameInitials{
            color: black;
        }
        #employNumber{
            color: black;
        }
        #fullNameInitials{
            color: black;
        }
        #grade{
            color: black;
        }
        #mark{
            color: black;
        }
        #remark{
            color: black;
        }



</style>

</head>


<body>
<?php include 'submenubar.php';?>

<?php include 'logout.php';?> 

     
        <div class="container form-container col-md-6">


            
            <h2 class="text-center">Promotion Evaluation Marks</h2>
            

            <div class="form-row">
                        

                        <div class="form-group col-md-12">
                        <label for="fullNameInitials">Full Name :</label>
                        <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" value="<?php echo $res_user['name']; ?>" readonly>
                
                         </div>
        
                     </div>

           
            <div class="form-row">

            <div class="form-group col-md-5">
                <label for="employNumber">Employ Number :</label>
                <input type="text" class="form-control" id="employNumber" name="empnumber" value="<?php echo $res_user['emp_num']; ?>" readonly>
                         
            </div>

            <div class="form-group col-md-7">
                            <label for="department">Department :</label>
                            <input type="text" class="form-control" id="department" name="department" value="<?php echo $res_user['department']; ?>" readonly>
            

             </div>
</div>

            
                


             

         

                    <div class="form-row">

                    <div class="form-group col-md-6">
                            <label for="company">Evaluation Grading :</label>
                            <input type="text" class="form-control" id="grade" name="grade" value="<?php echo $res_user['evalu_grade']; ?>" readonly>
                            
                    </div>


                   
                <div class="form-group col-md-6">
                            <label for="mark">Evaluation Mark :</label>
                            <input type="text" class="form-control" id="mark" name="mark" value="<?php echo $res_user['evalu_mark']; ?>" readonly>
                </div>
   


                       



                    </div>

                   
        

                <div class="form-group">
                    <label for="remark">Remark :</label>
                    <input type="text" class="form-control" id="remark" name="remark" rows="2" value="<?php echo $res_user['remark']; ?>" readonly>

                </div>
               
            </form>

    
    

   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    



  

</body>

</html>
<?php
}
?>