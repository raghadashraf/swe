<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/dashboard_admin.css"> <!-- Link to the CSS file -->
</head>
<body class="gradient-clipped-background">
    <!-- Top-left image -->
    <div class="absolute top-8 left-8 z-50">
            <img src="img/logo.png" alt="Company Logo" class="top-left-image" />
        </div>

    <!-- Centered Buttons -->
    <div class="button-container">
        <button class="menu-button" onclick="location.href='dashboard.php';">Admin Dashboard</button>
        <button class="menu-button" onclick="location.href='students.php';">Students</button>
        <button class="menu-button" onclick="location.href='doctors.php';">Doctors</button>
        <button class="menu-button logout-button" onclick="location.href='welcome.php';">Logout</button>
    </div>
</body>
</html>
