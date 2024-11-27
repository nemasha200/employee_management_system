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
    $getuser = mysqli_query($con, "SELECT * FROM employer WHERE empid='$user_id'");
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
    <title>Employee Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">=
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    

    <style>
        body {
            background-color: darkgrey;
            margin: 0;
            display: flex;
            background-image: url("black.jpg");
            overflow-x: hidden; 
        }
        .form-container {
            background-color: lightblue;
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

        .highlight-green {
            background-color: darkcyan;
            color: white;
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
                <h2 class="text-center">Employee Registration Form</h2>
               
                <form id="registrationForm" method="POST" action="empSave.php" enctype="multipart/form-data">

               
                    
               
                <div class="form-group">
                <label for="company">Company</label>
                <!-- Display company name inside an h4 with green highlight -->
                <h4 class="highlight-green" id="company" readonly><?php echo $res_user['comp_num']; ?></h4>    
                </div>
           
            
            <h5><u>Employee Personal Details</u></h5><br>

                    <div class="form-group">
                    <label for="employeeType"><strong>Employee Category:</strong></label>
                    <input type="text" class="form-control" id="employeeType" name="employeeType" value="<?php echo $res_user['emp_type']; ?>" readonly>

                     

                    
                </div> 
                 
                <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="employNumber">Employ Number </label>
                            <input type="text" class="form-control" id="employNumber" name="empnumber" value="<?php echo $res_user['emp_num']; ?>" readonly>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="epfNumber">EPF Number</label>
                            <input type="text" class="form-control" id="epfNumber" name="epfnumber" value="<?php echo $res_user['epf']; ?>" readonly>
                        </div>

                      

            <div class="form-group col-md-5">
                <label for="headerGiven"><strong>Sex :</strong></label>
                <input type="text" class="form-control" id="headerGiven" name="headerGiven" value="<?php echo $res_user['sex']; ?>" readonly>

                
               
            </div>

            <div class="form-group col-md-5">
                <label for="headerGiven"><strong>Marital Status :</strong></label>
                <input type="text" class="form-control" id="headerGiven" name="headerGiven" value="<?php echo $res_user['marital_status']; ?>" readonly>

               
            </div>

            
                            
            </div>

            <div class="form-group col-md-">
                            <label for="fullName">Full Name<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="fullName" name="fullname" value="<?php echo $res_user['full_name']; ?>" readonly>
                        </div>
            <div class="form-group col-md-">
                            <label for="fullNameInitials">Name with Initials</label>
                            <input type="text" class="form-control" id="fullNameInitials" name="nameinitial" value="<?php echo $res_user['initial_name']; ?>" readonly>
            </div>




                        <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="dob">Date of Birth</label>
                            <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $res_user['dob']; ?>" readonly>

                        </div>
                        
                        <div class="form-group col-md-4">
                            <label for="nicNumber">NIC Number</label>
                            <input type="text" class="form-control" id="nicNumber" name="nic" value="<?php echo $res_user['nic']; ?>" readonly>
                        </div>
                     
                        <div class="form-group col-md-4">
                            <label for="nicNumber">Driving License Number</label>
                            <input type="text" class="form-control" id="nicNumber" name="drive" value="<?php echo $res_user['drive_lic_num']; ?>" readonly>
                        </div>
                        
                       
                    </div>



                    
                    <div class="form-group col-md-">
                            <label for="address1">Permanent Address</label>
                            <input type="text" class="form-control" id="address1" name="address1" value="<?php echo $res_user['permanat_address']; ?>" readonly>
                    </div>
                        <div class="form-group col-md-">
                            <label for="address2">Current Address</label>
                            <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $res_user['current_address']; ?>" readonly>
                        </div>

                        <div class="form-group">
    <label for="employeeType"><strong>Educational Qualifications:</strong></label>
    <input type="text" class="form-control" id="qualifications" name="qualifications" value="<?php echo $res_user['qulifications']; ?>" readonly>


   
</div>

      <div class="form-row">

                     
<div class="form-group col-md-4">
    <label for="phoneNumber">Mobile Number</label>
    <input type="text" class="form-control" id="phoneNumber" name="phonenumber" value="<?php echo $res_user['mobile']; ?>" readonly>
</div>

<div class="form-group col-md-4">
    <label for="phoneNumber1">Landphone Number</label>
    <input type="text" class="form-control" id="phoneNumber1" name="landnumber" value="<?php echo $res_user['landnumber']; ?>" readonly>
</div>

<div class="form-group col-md-4">
    <label for="phoneNumber1">Office Number</label>
    <input type="text" class="form-control" id="phoneNumber1" name="officenumber" value="<?php echo $res_user['office_number']; ?>" readonly>
</div>

</div>




<h5><u>Employee Company related Details</u></h5><br>

                         <div class="form-row">

                            <div class="form-group col-md-4">
                            <label for="dob">Date of Join</label>
                            <input type="text" class="form-control" id="doj" name="doj" value="<?php echo $res_user['doj']; ?>" readonly>

                        </div>
                        
                        <div class="form-group col-md-4">
                <label for="recruitmentType">Recruitment Type:</label>
                <input type="text" class="form-control" id="recruitmentType" name="recruitmentType" value="<?php echo $res_user['recruitment_type']; ?>" readonly>

                
            </div>



            <div class="form-group col-md-4">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" name="department" value="<?php echo $res_user['department']; ?>" readonly>

                           


                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $res_user['designation']; ?>" readonly>

                           
                        </div>   


                        <div class="form-group col-md-4">
                            <label for="company">Grade</label>
                            <input type="text" class="form-control" id="grade" name="grade" value="<?php echo $res_user['grade']; ?>" readonly>

                        </div>

            
                           
                    
                   
                        <div class="form-group col-md-4">
                            <label for="jobCategory">Job Title</label>
                            <input type="text" class="form-control" id="" name="" value="<?php echo $res_user['job_title']; ?>" readonly>

                        </div> 
                </div>  

                <div class="form-row">    


                <div class="form-group col-md-4">
        <label for="recruitmentType">Last promoted Dates :</label>
        <input type="text" class="form-control" id="lpd" name="lpd[]" value="<?php echo $res_user['last_promo']; ?>" readonly>

    </div>


                
            <div class="form-group col-md-6">
        <label for="recruitmentType">Employee Status:</label>
        <input type="text" class="form-control" id="empstatus" name="empstatus" value="<?php echo $res_user['emp_status']; ?>" readonly>

    </div>


    </div>

    <div class="form-row">           
                   <div class="form-group col-md-3">
                            <label for="vehicleNumber">Vehicle Number</label>
                            <input type="text" class="form-control" id="vehiclenumber" name="vehiclenumber" value="<?php echo $res_user['vehicle_num']; ?>" readonly>
            </div>

         


    <div class="form-group col-md-3">
                <label for="headerGiven"><strong>OT :</strong></label>
                <input type="text" class="form-control" id="ot" name="ot" value="<?php echo $res_user['ot']; ?>" readonly>

               
            </div>         
                        


            <div class="form-group col-md-4">
            <label for="uploadPhoto">Upload NIC or Driving License</label>
            <?php
                            if(!empty($res_user['img'])) {
                                echo '<div><img src="uploads/' . $res_user['img'] . '" alt="NIC/Driving License" width="300" height="250" class="img-fluid" /></div>';
                            } else {
                                echo '<div>No photo uploaded.</div>';
                            }
                            ?>
            </div>

                        

           
                        
                       

            <div class="row">
    <div class="col-md-12">
        <div class="form-group row align-items-start">
            <!-- Remark label outside the input section -->
            <label for="remark" class="col-form-label col-md-2 text-left">Remark</label>

            <div class="col-md-10">
                <div class="row">
                    <label for="remark1" class="col-md-1 col-form-label text-left">1</label>
                    <div class="col-md-11">
                    <input type="text" class="form-control" id="" name="" value="<?php echo $res_user['remark1']; ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="col-md-10 offset-md-2">
                <div class="row">
                    <label for="remark2" class="col-md-1 col-form-label text-left">2</label>
                    <div class="col-md-11">
                    <input type="text" class="form-control" id="" name="" value="<?php echo $res_user['remark2']; ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="col-md-10 offset-md-2">
                <div class="row">
                    <label for="remark3" class="col-md-1 col-form-label text-left">3</label>
                    <div class="col-md-11">
                    <input type="text" class="form-control" id="" name="" value="<?php echo $res_user['remark3']; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

          
           
</form>
               
 </div>
</div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
?>