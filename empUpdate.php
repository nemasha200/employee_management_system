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

// Use a prepared statement to fetch employer details
$stmt = $con->prepare("SELECT empid, comp_num, emp_type, emp_num, epf, sex, marital_status, full_name, initial_name,
    dob, nic, drive_lic_num, permanat_address, current_address, qulifications, mobile, landnumber, office_number,
    doj, recruitment_type, department, designation, grade, job_title, last_promo, emp_status, vehicle_num, img,
    ot, remark1, remark2, remark3 FROM employer WHERE empid = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res_user = $stmt->get_result()->fetch_assoc();

// Parse the `comp_num` into parts
$comp_parts = explode('/', $res_user['comp_num']);
$comp_number = $comp_parts[0]; // Extract com_number
$comp_name = $comp_parts[1];   // Extract com_name


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
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
            background-color: whitesmoke;
            padding: 30px;
            border-radius: 10px;
            border-color: black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1000px;
            margin: 20px auto; 
            overflow-y: auto; 
            margin-left: 250px;
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
            background-color: aquamarine;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        hr {
            border: 1px solid #ccc;
            margin: 20px 0;
        }
       
    </style>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body>

<?php include 'submenubar.php';?> 
<?php include 'logout.php';?> 



<div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-10 form-container">
                <h2 class="text-center">Employee Registration Form</h2>
                <a href="empSearch.php">
                    <button type="button" class="btn btn-primary btn-small">View Updated Employers</button>
                </a>  
                <form id="registrationForm" method="POST" action="empSubmitUpdate.php" enctype="multipart/form-data">

            <h5><u>Employee Personal Details</u></h5><br>

            <div class="form-group">
    <label for="employeeType"><strong>Employee Category :<span style="color:red">*</span></strong></label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="employeeType" value="Staff" <?php echo ($res_user['emp_type'] == 'Staff') ? 'checked' : ''; ?> required>
        <label class="form-check-label">Staff</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="employeeType" value="Sales" <?php echo ($res_user['emp_type'] == 'Sales') ? 'checked' : ''; ?> required>
        <label class="form-check-label">Sales</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="employeeType" value="Factory" <?php echo ($res_user['emp_type'] == 'Factory') ? 'checked' : ''; ?> required>
        <label class="form-check-label">Factory</label>
    </div>
</div>


<div class="form-group">
                        <label for="company">Company:</label>
                        <select class="form-control" id="company" name="company" required>
                            <?php
                            $getEmp = mysqli_query($con, "SELECT com_number, com_name, location FROM sub_company");
                            while ($resCom = mysqli_fetch_array($getEmp)) {
                                $value = $resCom['com_number'] . '/' . $resCom['com_name'];
                          
                                $selected = ($resCom['com_number'] == $comp_number 
                                    && $resCom['com_name'] == $comp_name ) ? 'selected' : '';
                                echo "<option value='$value' $selected>{$resCom['com_number']}/{$resCom['com_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

           


                    

                
              

               
                <div class="form-row">

                
                
                        <div class="form-group col-md-6">
                            <label for="employNumber">Employ Number :<span style="color:red">*</span></label>
                            <input type="text" value="<?php echo $res_user['emp_num']; ?>" class="form-control" id="employNumber" name="empnumber" placeholder="Enter employ number">
                </div>

                       

                <div class="form-group col-md-6">
                            <label for="epfNumber">EPF Number :<span style="color:red">*</span></label>
                            <input type="text" value="<?php echo $res_user['epf']; ?>" class="form-control" id="epfNumber" name="epfnumber" placeholder="Enter EPF number">
                </div>
              
                
                 <!-- Gender -->
                 <div class="form-group col-md-5">
                        <label for="sex"><strong>Gender :</strong></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" value="Male" <?php echo ($res_user['sex'] == 'Male') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" value="Female" <?php echo ($res_user['sex'] == 'Female') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>


                      

                     <!-- Marital Status -->
                    <div class="form-group col-md-5">
                        <label for="marital"><strong>Marital Status :</strong></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marital" value="single" <?php echo ($res_user['marital_status'] == 'single') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Single</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marital" value="Married" <?php echo ($res_user['marital_status'] == 'Married') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Married</label>
                        </div>
                    </div>


            

            
                            
            </div>

            <div class="form-group col-md-">
                            <label for="fullName">Full Name :<span style="color:red">*</span></label>
                            <input type="text" value="<?php echo $res_user['full_name']; ?>" class="form-control" id="fullName" name="fullname" placeholder="Enter full name">
            </div>

            
            <div class="form-group col-md-">
                            <label for="fullNameInitials">Name with Initials :<span style="color:red">*</span></label>
                            <input type="text" value="<?php echo $res_user['initial_name']; ?>" class="form-control" id="fullNameInitials" name="nameinitial" placeholder="Enter full name with initials">
            </div>






            <div class="form-row">

            <div class="form-group col-md-4">
                            <label for="dob">Date of Birth :</label>
                            <input type="date" value="<?php echo $res_user['dob']; ?>" class="form-control" id="dob" name="dob">
            </div>

                        
            <div class="form-group col-md-4">
                            <label for="nicNumber">NIC Number :<span style="color:red">*</span></label>
                            <input type="text" value="<?php echo $res_user['nic']; ?>" class="form-control" id="nicNumber" name="nic" placeholder="Enter NIC number">
            </div>

                     
            <div class="form-group col-md-4">
                            <label for="nicNumber">Driving License Number :</label>
                            <input type="text" value="<?php echo $res_user['drive_lic_num']; ?>" class="form-control" id="nicNumber" name="drive" placeholder="Enter Driving License number">
            </div>
                        

                       
            </div>

            <div class="form-group col-md-">
                            <label for="address1">Permanent Address :<span style="color:red">*</span></label>
                            <input type="text" value="<?php echo $res_user['permanat_address']; ?>" class="form-control" id="address1" name="address1" placeholder="Enter address 1">
            </div>


                    
            <div class="form-group col-md-">
                            <label for="address2">Current Address :<span style="color:red">*</span></label>
                            <input type="text" value="<?php echo $res_user['current_address']; ?>" class="form-control" id="address2" name="address2" placeholder="Enter address 2">
            </div>
       


                    <!-- Qualifications -->
                    <div class="form-group">
                        <label for="qualifications"><strong>Educational Qualifications :</strong></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="qualifications[]" value="Masters" <?php echo (strpos($res_user['qulifications'], 'Masters') !== false) ? 'checked' : ''; ?>>
                            <label class="form-check-label">Masters</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="qualifications[]" value="Degree" <?php echo (strpos($res_user['qulifications'], 'Degree') !== false) ? 'checked' : ''; ?>>
                            <label class="form-check-label">Degree</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="qualifications[]" value="Diploma/HND" <?php echo (strpos($res_user['qulifications'], 'Diploma/HND') !== false) ? 'checked' : ''; ?>>
                            <label class="form-check-label">Diploma/HND</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="qualifications[]" value="NVQ/Naita" <?php echo (strpos($res_user['qulifications'], 'NVQ/Naita') !== false) ? 'checked' : ''; ?>>
                            <label class="form-check-label">NVQ/Naita</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="qualifications[]" value="Other Qulifications" <?php echo (strpos($res_user['qulifications'], 'Other Qualifications') !== false) ? 'checked' : ''; ?>>
                            <label class="form-check-label">Other Qualifications</label>
                        </div>
                    </div>

      <div class="form-row">

                     
<div class="form-group col-md-4">
    <label for="phoneNumber">Mobile Number :<span style="color:red">*</span></label>
    <input type="text" value="<?php echo $res_user['mobile']; ?>" class="form-control" id="phoneNumber" name="phonenumber" placeholder="Enter mobile number">
</div>


<div class="form-group col-md-4">
    <label for="phoneNumber1">Landphone Number :</label>
    <input type="text" value="<?php echo $res_user['landnumber']; ?>" class="form-control" id="phoneNumber1" name="landnumber" placeholder="Enter landphone number">
</div>


<div class="form-group col-md-4">
    <label for="phoneNumber1">Office Number :</label>
    <input type="text" value="<?php echo $res_user['office_number']; ?>" class="form-control" id="phoneNumber1" name="officenumber" placeholder="Enter Office number">
</div>


</div>





                     
  <hr>


<h5><u>Employee Company related Details</u></h5><br>

<div class="form-row">

<div class="form-group col-md-4">
<label for="dob">Date of Join :<span style="color:red">*</span></label>
<input type="date" value="<?php echo $res_user['doj']; ?>" class="form-control" id="doj" name="doj">
</div>

<div class="form-group col-md-4">
                        <label for="recruitmentType">Recruitment Type :</label>
                        <select class="form-control" name="recruitmentType">
                            <option value="new" <?php echo ($res_user['recruitment_type'] == 'new') ? 'selected' : ''; ?>>New</option>
                            <option value="rejoin" <?php echo ($res_user['recruitment_type'] == 'rejoin') ? 'selected' : ''; ?>>Rejoin</option>
                        </select>
                    </div>



            <div class="form-group col-md-4">
                            <label for="department">Department :<span style="color:red">*</span></label>
                            <select class="form-control" id="department" name="department">


                            <?php 
                        $getEmp = mysqli_query($con,"SELECT * FROM  sub_department");
                        while ($resCom = mysqli_fetch_array($getEmp)) {
                            ?>
                        <option value="<?php echo $resCom['dep_name']; ?>"
                            <?php echo ($resCom['dep_name'] == $res_user['department']) ? 'selected' : ''; ?>>
                            <?php echo $resCom['dep_name']; ?>
                        </option>

                            <?php
                        }
                    ?>
                            </select>


                        </div>


            </div>

                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="designation">Designation :<span style="color:red">*</span></label>
                            <select class="form-control" id="designation" name="designation">
                            <option value="" disabled selected>Select an option</option>

                            <?php 
                        $getEmp = mysqli_query($con,"SELECT * FROM  sub_designation ");
                        while ($resCom = mysqli_fetch_array($getEmp)) {
                            ?>
                           <option value="<?php echo $resCom['desi_name']; ?>"
                            <?php echo ($resCom['desi_name'] == $res_user['designation']) ? 'selected' : ''; ?>>
                            <?php echo $resCom['desi_name']; ?>
                        </option>
                            <?php
                        }
                    ?>
                            </select>
                        </div>   


                        <div class="form-group col-md-4">
                            <label for="company">Grade :<span style="color:red">*</span></label>
                            <select class="form-control" id="grade" name="grade">


                            <?php 
                        $getEmp = mysqli_query($con,"SELECT * FROM  sub_division ");
                        while ($resCom = mysqli_fetch_array($getEmp)) {
                            ?>
                            <option value="<?php echo $resCom['grade']; ?>"
                            <?php echo ($resCom['grade'] == $res_user['grade']) ? 'selected' : ''; ?>>
                            <?php echo $resCom['grade']; ?>
                        </option>
                            <?php
                        }
                    ?>
                            </select>
                        </div>

            
                           
                    
                   
                        <div class="form-group col-md-4">
                            <label for="jobCategory">Job Title :<span style="color:red">*</span></label>
                            <select class="form-control" id="jobCategory" name="jobcategory">
                            <option value="" disabled selected>Select an option</option>


                            <?php 
                        $getEmp = mysqli_query($con,"SELECT * FROM  sub_jobcat ");
                        while ($resCom = mysqli_fetch_array($getEmp)) {
                            ?>
                            <option value="<?php echo $resCom['jobcat_name']; ?>"
                            <?php echo ($resCom['jobcat_name'] == $res_user['job_title']) ? 'selected' : ''; ?>>
                            <?php echo $resCom['jobcat_name']; ?>
                        </option>
                            <?php
                        }
                    ?>
                            </select>
                        </div> 
                </div>  

                <div class="form-row">   


                <div class="form-group col-md-5">
    <label for="dob">Last promoted Dates :</label>
        <input type="text"  value="<?php echo $res_user['last_promo']; ?>" class="form-control" id="lpd" name="lpd">
</div>



                              
           <!-- Employee Status -->
           <div class="form-group col-md-7">
                        <label for="empstatus">Employee Status :<span style="color:red">*</span></label>
                        <select class="form-control"  id="empstatus" name="empstatus">
                            <option value="permanent" <?php echo ($res_user['emp_status'] == 'permanent') ? 'selected' : ''; ?>>Permanent</option>
                            <option value="ftc" <?php echo ($res_user['emp_status'] == 'ftc') ? 'selected' : ''; ?>>FTC</option>
                            <option value="casual" <?php echo ($res_user['emp_status'] == 'casual') ? 'selected' : ''; ?>>Casual</option>
                            <option value="consultant" <?php echo ($res_user['emp_status'] == 'consultant') ? 'selected' : ''; ?>>Consultant</option>
                        </select>
            </div>


                    
                </div>
                

                <div class="form-row">           
                

           

            <div class="form-group col-md-3">
                            <label for="vehicleNumber">Vehicle Number :</label>
                            <input type="text" value="<?php echo $res_user['vehicle_num']; ?>" class="form-control" id="vehicleNumber" name="vehiclenumber" placeholder="Enter vehicle number">
            </div>
        

<div class="form-group col-md-3">
                <label for="uploadPhoto">Upload NIC or Driving License:</label>
                <?php if ($res_user['img']): ?>
                    <img src="uploads/<?php echo $res_user['img']; ?>" alt="NIC/Driving License" width="150" height="150"><br>
                <?php endif; ?>
                <input type="file" class="form-control-file" name="photo">
            </div>


            <!-- OT -->
            <div class="form-group col-md-5">
                        <label for="ot">OT :</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ot" value="Yes" <?php echo ($res_user['ot'] == 'Yes') ? 'checked' : ''; ?>>
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ot" value="No" <?php echo ($res_user['ot'] == 'No') ? 'checked' : ''; ?>>
                            <label class="form-check-label">No</label>
                        </div>
            </div>    
                        
                        
                       

            <div class="row">
    <div class="col-md-12">
        <div class="form-group row align-items-start">
            <label for="remark" class="col-form-label col-md-2 text-left">Remark :</label>

            <div class="col-md-10">
                <div class="row">
                    <label for="remark1" class="col-md-1 col-form-label text-left">1</label>
                    <div class="col-md-11">
                        <textarea class="form-control mb-2" id="remark1" name="remark1" rows="1"><?php echo $res_user['remark1']; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-10 offset-md-2">
                <div class="row">
                    <label for="remark2" class="col-md-1 col-form-label text-left">2</label>
                    <div class="col-md-11">
                        <textarea class="form-control mb-2" id="remark2" name="remark2" rows="1"><?php echo $res_user['remark2']; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-10 offset-md-2">
                <div class="row">
                    <label for="remark3" class="col-md-1 col-form-label text-left">3</label>
                    <div class="col-md-11">
                        <textarea class="form-control" id="remark3" name="remark3" rows="1"><?php echo $res_user['remark3']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

          
            <div class="form-group col-md-12 text-center">

    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

    <button type="submit" class="btn btn-primary btn-small">Submit</button>

</div>
</form>
               
 </div>
</div>





   

 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>



<script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Capture values
            var company = document.getElementById('company').value.trim();
            var employNumber = document.getElementById('employNumber').value.trim();
            var epfNumber = document.getElementById('epfNumber').value.trim();
            var fullName = document.getElementById('fullName').value.trim();
            var fullNameInitials = document.getElementById('fullNameInitials').value.trim();
            var nicNumber = document.getElementById('nicNumber').value.trim();
        var address1 = document.getElementById('address1').value.trim();
        var address2 = document.getElementById('address2').value.trim();
        var phoneNumber = document.getElementById('phoneNumber').value.trim();
        var doj = document.getElementById('doj').value.trim();
        var department = document.getElementById('department').value.trim();
        var designation = document.getElementById('designation').value.trim();
        var grade = document.getElementById('grade').value.trim();
        var jobCategory = document.getElementById('jobCategory').value.trim();
        var empstatus = document.getElementById('empstatus').value.trim();
        var remark1 = document.getElementById('remark1').value.trim();

            // Validation
            if (!company) {
                Swal.fire({
                    title: 'Validation Error!',
                    text: 'Please select a Company Number.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!employNumber) {
                Swal.fire({
                    title: 'Validation Error!',
                    text: 'Please enter an Employee Number.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!epfNumber) {
                Swal.fire({
                    title: 'Validation Error!',
                    text: 'Please enter an EPF Number.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!fullName) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select an FullName.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }


        if (!fullName || !/^[A-Z][a-z]*( [A-Z][a-z]*)*$/.test(fullName)) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Full Name must have the first letter of each name capitalized (e.g., "John Doe").',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!fullNameInitials) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select  Name with Initials.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!fullNameInitials || !/^[A-Z](\.[A-Z])*\.? [a-zA-Z\s]+$/.test(fullNameInitials)) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a valid Name with Initials (e.g., "A.B. Smith").',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!nicNumber) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select  NIC.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        



        if (!nicNumber || (!/^\d{9}[Vv]$/.test(nicNumber) && !/^\d{12}$/.test(nicNumber))) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'NIC Number must be either 9 digits followed by "V" or 12 digits.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!address1) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Permanent Address.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!address2) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Current Address.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!phoneNumber) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a phone Number.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!phoneNumber || phoneNumber.length !== 10 || !/^\d{10}$/.test(phoneNumber)) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Phone Number must be exactly 10 digits long.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!doj) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Date of Joining.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!department) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Department.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!designation) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Designation.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!designation) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Designation.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!grade) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Grade.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!jobCategory) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select a Job Category.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!empstatus) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please select an Employee Status.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }

        if (!remark1) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please enter a Remark.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false;
        }


            // If all validations pass, show success alert and submit form
            Swal.fire({
                title: 'Updated!',
                text: 'Form updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
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

