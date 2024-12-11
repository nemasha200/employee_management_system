<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
       
    /* Existing styles here */
    .toggle-password i {
        color: white; /* Set the icon color to black */
    }
    .toggle-password:hover i {
        color: black; /* Optional: Add hover effect */
    }

  
    /* Existing styles here */
    .toggle-password {
        background-color: white; /* Set the background color to gray */
        border: none; /* Remove border */
    }
    .toggle-password:hover {
        background-color: darkgray; /* Optional: Add hover effect */
    }
    .toggle-password i {
        color: black; /* Set the icon color to black */
    }
</style>

</style>

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
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="conpassword">Confirm Password<span style="color:red">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder="Enter confirm password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
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
        // Show/Hide Password Toggle
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentNode.previousElementSibling;
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>
