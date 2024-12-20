<?php
session_start();
error_reporting(E_ALL);
include('includes/DB.inc.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT); // Secure password hashing

    // Check if the user exists
    $sql = "SELECT StudentEmail FROM tblstudent WHERE StudentEmail=:email AND ContactNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        // Generate verification code
        $VCode = bin2hex(random_bytes(3)); // 6 characters verification code
        setcookie("VCode", $VCode, time() + 1500, "/"); // Set cookie for 25 minutes
        setcookie("Emailforv", $email, time() + 1500, "/");

        // Send verification email
        $mail = new PHPMailer(true);
        try {
            // SMTP settings (move these to a config file or environment variables in production)
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@example.com';
            $mail->Password = 'your-email-password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('your-email@example.com', 'Your Website');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Verification Code';
            $mail->Body = 'Your verification code is: ' . $VCode;

            $mail->send();
            echo "<script>alert('Verification code has been sent to your email');</script>";
            header('Location: verify_mail.php');
            exit();
        } catch (Exception $e) {
            echo "<script>alert('Verification email could not be sent.');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or mobile number');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Forgot Password</title>
    <link rel="stylesheet" href="css/forget.css">
    <script>
        function validateForm() {
            const newPassword = document.getElementById('newpassword').value;
            const confirmPassword = document.getElementById('confirmpassword').value;
            if (newPassword !== confirmPassword) {
                alert("New Password and Confirm Password do not match!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container">
    <div class="brand-logo">
        <img src="img/logo_Dark.jpeg">
    </div>
    <h4>RECOVER PASSWORD</h4>
    <h6 class="font-weight-light">Enter your email address to reset your password</h6>
    <form class="pt-3" id="login" method="post" name="chngpwd" onsubmit="return validateForm()">
        <div class="form-group">
            <input type="email" class="form-control form-control-lg" placeholder="Email Address" required="true" name="email">
        </div>
        <div class="form-group">
            <input class="form-control form-control-lg" type="password" name="newpassword" id="newpassword" placeholder="New Password" required="true"/>
        </div>
        <div class="form-group">
            <input class="form-control form-control-lg" type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required="true"/>
        </div>
        <div class="mt-3">
            <button class="btn btn-success btn-block loginbtn" type="submit" name="submit">Reset</button>
        </div>
        <div class="mb-2">
            <a href="welcome.php" class="btn btn-block btn-facebook auth-form-btn">
                <i class="icon-social-home mr-2"></i>Back Home
            </a>
        </div>
    </form>
</div>
</body>
</html>
