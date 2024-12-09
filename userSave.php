<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Autoload Composer dependencies

include 'db_connect.php';

// Collect form data
$title = $_POST['title'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['password'];
$conpassword = $_POST['conpassword'];

// Insert data into the database
mysqli_query($con, "INSERT INTO user(title, first_name, last_name, email, contact, type, username, password, con_password)
 VALUES ('$title','$firstname','$lastname','$email','$contact','$type','$username','$password','$conpassword')");

// Send email
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                           
    $mail->Host = 'smtppro.zoho.com';                         
    $mail->SMTPAuth = true;                                    
    $mail->Username = 'it@raigam.lk';                  
    $mail->Password = 'It#78195$';                  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
    $mail->Port = 587;                                         

    // Recipients
    $mail->setFrom('it@raigam.lk', 'Raigam Employee Management System');   
    $mail->addAddress($email, $firstname . ' ' . $lastname);   // Recipient's email and name

    // Content
    $mail->isHTML(true);                                       // Set email format to HTML
    $mail->Subject = 'Registration Successful!';
    $mail->Body = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                line-height: 1.6;
                margin: 0;
                padding: 0;
            }
            .email-container {
                width: 100%;
                max-width: 600px;
                margin: 20px auto;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 20px;
                background-color: #f9f9f9;
            }
            h1 {
                color: #444;
                font-size: 24px;
            }
            p {
                margin: 0 0 10px;
            }
            ul li {
                margin: 5px 0;
            }
            ul li b {
                color: #555;
            }
            .footer {
                margin-top: 20px;
                font-size: 12px;
                color: #777;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <h1>Welcome to Our Platform, $firstname!</h1>
            <p>Dear $firstname $lastname,</p>
            <p>We are excited to have you on board as a $type on our platform. Below are your registration details:</p>
            <ul>
                <li><b>Title:</b> $title</li>
                <li><b>Contact:</b> $contact</li>
                <li><b>Type:</b> $type</li>
                <li><b>Username:</b> $username</li>
                <li><b>Password:</b> $password</li>
            </ul>
            <p>If you have any questions, feel free to contact us at any time.</p>
            <p>Best Regards,</p>
            <p><strong>Raigam HR</strong></p>
            <div class='footer'>
                <p>This is an automated message. Please do not reply to this email.</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $mail->AltBody = "Dear $firstname, Thank you for registering! Your username is $username and your password is $password.";
    

    $mail->send();

    // Redirect to user.php after successful email
    header("Location: user.php");
    exit();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>