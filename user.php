<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-image: url("black.jpg");
        }
        .registration-form {
            padding: 30px;
            background-color: #d6bbbb75;
            margin-top: 50px;
            margin-left: 200px;
        }
        .btn-red {
            background-color: red;
            border-color: red;
            color: white;
        }
        .btn-red:hover {
            background-color: darkred;
            border-color: darkred;
        }
        label {
            color: white;
        }
        .logout-button {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }
        .logout-button:hover {
            background-color: #c82333;
            color: white;
        }
    </style>
</head>
<body>
    <?php include 'submenubar.php'; ?>
    <?php include 'logout.php'; ?> 

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="registration-form" id="registrationForm" method="POST" action="userSave.php">
                    <h2 class="text-center">User Registration <img src="log.png" alt="Logo" width="60px" height="auto"></h2>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <select class="form-control" id="title" name="title">
                            <option value="" disabled selected>Select your title</option>
                            <option value="Mr">Mr</option>
                            <option value="Miss">Miss</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="firstName" name="firstname" placeholder="Enter firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Enter lastname">
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span style="color:red">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="" disabled selected>Select user type</option>
                            <option value="Admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password<span style="color:red">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="conpassword">Confirm Password<span style="color:red">*</span></label>
                        <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder="Enter confirm password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-red btn-small">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const firstName = document.getElementById('firstName').value.trim();
            const email = document.getElementById('email').value.trim();
            const contact = document.getElementById('contact').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const conpassword = document.getElementById('conpassword').value.trim();

            // Validation checks
            if (!firstName) {
                Swal.fire({
                    title: 'Validation Error',
                    text: 'First Name is required.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!email) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Email is required.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!email.includes('@')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Email must include "@" symbol.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!contact) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Contact number is required.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (contact.length !== 10 || isNaN(contact)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Contact',
                    text: 'Phone number must be exactly 10 digits long and contain only numbers.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!username) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Username is required.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Password validation: Minimum length and strong password
            const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Error',
                    text: 'Password must be at least 8 characters long.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (!passwordRegex.test(password)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Error',
                    text: 'Password must contain at least one uppercase letter, one number, and one special character.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (password !== conpassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Passwords do not match.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Final confirmation
            Swal.fire({
                title: 'Confirm Submission',
                text: 'Are you sure you want to submit?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Submit',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
