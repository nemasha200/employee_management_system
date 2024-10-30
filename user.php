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
            background-color: grey;
            margin-top: 50px;
        }
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            width: 100px;
            height: auto;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="registration-form" id="registrationForm" method="POST" action="userSave.php">
                    <h2 class="text-center">Login Registration</h2>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <select class="form-control" id="title" name="title" required>
                            <option value="" disabled selected>Select your title</option>
                            <option value="Mr">Mr</option>
                            <option value="Miss">Miss</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="firstName" name="firstname" placeholder="Enter firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Enter lastname">
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span style="color:red">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="" disabled selected>Select user type</option>
                            <option value="Admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password<span style="color:red">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="conpassword">Confirm Password<span style="color:red">*</span></label>
                        <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder="Enter confirm password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-red btn-small" id="submitBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let form = e.target;
            if (!form.checkValidity()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill out all required fields!',
                });
                return;
            }
            let password = document.getElementById('password').value;
            let conpassword = document.getElementById('conpassword').value;
            if (password !== conpassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Please make sure the passwords match!',
                });
                return;
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to submit the form?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Submitted!',
                        'Your form has been submitted.',
                        'success'
                    ).then(() => {
                        form.reset();
                    });
                }
            });
        });
    </script>
</body>
</html>
