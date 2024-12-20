<?php
session_start();
include_once "includes/DB.inc.php";

// Ensure user is logged in
if (!isset($_SESSION['ID'])) {
    echo "You are not logged in. Redirecting to login page...";
    header("Location: login.php");
    exit();
}
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
                <label for="faculty_id">Faculty ID:</label>
                <input type="text" id="faculty_id" name="faculty_id" value="<?php echo htmlspecialchars($_SESSION['ID']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($_SESSION['FName']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($_SESSION['LName']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['Email']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" value="<?php echo htmlspecialchars($_SESSION['Password']); ?>" readonly>
                <i class="bi bi-eye-slash" id="togglePassword" onclick="togglePasswordVisibility()"></i>
            </div>

            <div class="form-group">
                <label for="faculty">Faculty</label>
                <input type="text" id="faculty" name="faculty" value="<?php echo htmlspecialchars($_SESSION['faculty']); ?>" readonly>
            </div>
        </form>
    </section>
</div>

<script>
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('pass');
    const toggleIcon = document.getElementById('togglePassword');

    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    toggleIcon.classList.toggle('bi-eye');
    toggleIcon.classList.toggle('bi-eye-slash');
}
</script>

</body>
</html>
