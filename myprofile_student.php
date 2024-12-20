<?php
session_start();
include_once "includes/DB.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="css/dashboard_student.css">
    <link rel="stylesheet" href="css/myProfile_student.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<?php include 'sidebar_student.php'; ?>

<body class="gradient-clipped-background">

<div class="container">
    <section class="profile-section">
        <h1>My Profile</h1>
        <form method="POST" class="profile-form">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" value="<?php echo $_SESSION['ID']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" value="<?php echo $_SESSION['FName']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" value="<?php echo $_SESSION['LName']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['Email']; ?>" readonly>
            </div>

                            <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="password" id="pass" name="pass" value="<?php echo $_SESSION['Password']; ?>">
                    <i class="bi bi-eye-slash" id="togglePassword" onclick="togglePasswordVisibility()"></i>
            </div>


            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status" value="<?php echo $_SESSION['Status']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="major">Major:</label>
                <input type="text" id="major" name="major" value="<?php echo $_SESSION['Major']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="cum_gpa">Cumulative GPA:</label>
                <input type="number" id="cum_gpa" name="cum_gpa" value="<?php echo $_SESSION['Cum GPA']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="total_crdth">Total Credits:</label>
                <input type="number" id="total_crdth" name="total_crdth" value="<?php echo $_SESSION['Total crdth']; ?>" readonly>
            </div>
        </form>
    </section>
</div>

<script>
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('pass'); // Corrected ID reference
    const toggleIcon = document.getElementById('togglePassword');

    // Toggle the type attribute
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Toggle the eye icon
    toggleIcon.classList.toggle('bi-eye');
    toggleIcon.classList.toggle('bi-eye-slash');
}
</script>

</body>
</html>