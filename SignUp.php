<?php
include_once "includes/DB.inc.php";
include "classes.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ROLE = htmlspecialchars($_POST["Role"]);
    $FROLE=htmlspecialchars($_POST["FRole"]);
    $Fname = htmlspecialchars($_POST["FName"]);
    $Lname = htmlspecialchars($_POST["LName"]);
    $Email = htmlspecialchars($_POST["Email"]);
    $Password = htmlspecialchars($_POST["Password"]);

    if ($ROLE === "Admin") {
        $role="Admin";
        $ROLEID=0;
        $sql = "INSERT INTO admins (FName, LName, Email, Password, Role, RoleID) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $Fname, $Lname, $Email, $Password, $role, $ROLEID);
    } else if ($ROLE === "Student") {
        $Major = htmlspecialchars($_POST["Major"]);
        $Minor = "";
        $Status = "Regular Student";
        $sem_gpa = 0;
        $cum_gpa = 0;
        $sem_crdth = 0;
        $total_crdth = 0;
        $role="Student";
        $ROLEID=1;

        $sql = "INSERT INTO students(FName, LName, Email, Password, Role, RoleID, Major, Minor, Status, `Sem gpa`, `Cum gpa`, `Sem crdth`, `Total crdth`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssiiii", $Fname, $Lname, $Email, $Password, $role, $ROLEID, $Major, $Minor, $Status, $sem_gpa, $cum_gpa, $sem_crdth, $total_crdth);
    }else if ($ROLE === "Faculty Member") {
        $faculty = htmlspecialchars($_POST['faculty']);
        $course_code = "";
        $role = "Faculty Member";
        $ROLEID = 2;
    
        $sql = "INSERT INTO faculty (FName, LName, Email, Password, Role, RoleID, faculty, `course code`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssssssss", $Fname, $Lname, $Email, $Password, $role, $ROLEID, $faculty, $course_code);
        } else {
            echo "Error: Failed to prepare statement.";
        }
    }
    if ($stmt->execute()) {
        header("Location:Login.php");
    }else{
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Welcome to OnCampus. Log in or sign up to access your account." />
    <meta name="keywords" content="welcome, login, signup, platform, student services" />
    <title>Welcome to OnCampus</title>
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <link rel="stylesheet" href="css/Signup.css"> <!-- Sidebar CSS -->
    <style>
    input::placeholder, select::placeholder {
        color: black;
        opacity: 1;
    }
</style>

</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <!-- Main Container -->
    <div class="flex w-full h-screen relative">
        <!-- Logo at Top-Left -->
        <div class="absolute top-8 left-8 z-50">
            <img src="img/logo.png" alt="Company Logo" class="w-32 md:w-48" />
        </div>

        <!-- Left Section -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-cover bg-center relative" style="background-image: url('img/hero.png');">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <!-- Welcome Text -->
            <div class="z-10 p-8 text-white text-left max-w-lg">
                <h1 class="text-4xl md:text-3xl font-bold leading-tight mb-4">Welcome to </h1>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">Your one-stop platform for academic success.</h1>
            </div>
        </div>


        <div class="w-full md:w-1/2 flex flex-col justify-center items-center" style="background: linear-gradient(to top, #005f73, #00c9f2); -webkit-clip-path: ellipse(80% 70% at 50% 50%); clip-path: ellipse(80% 70% at 50% 50%);">

        <div class="Signup-form-container">
    <div class="Signup-form">
        <h2>SignUp</h2>
        <form action="SignUp.php" method="post">
            <input type="FName" name="FName" placeholder="Enter your First Name" required>
            <input type="LName" name="LName" placeholder="Enter your Last Name" required>
            <input type="Email" name="Email" placeholder="Enter your Email" required>
            <input type="password" name="Password" placeholder="Enter your password" required>
            <select name="Role" id="role" onchange="toggleRoleOptions()">
                    <option value="">Select Your Role</option>
                    <option value="Student">Student</option>
                    <option value="Faculty Member">Faculty Member</option>
                    <option value="Admin">Admin</option>
            </select>
            <div id="majorDiv" style="display:none;">
                <select name="Major">
                  <option value="Select Major">Select Major</option>
                  <option value="Computer Science">Computer Science</option>
                  <option value="Law">Law</option>
                  <option value="Pharmacy">Pharmacy</option>
                  <option value="Dentistry">Dentistry</option>
                  <option value="Engineering">Engineering</option>
                </select><br>
              </div>
              <div id="facultymemberrole" style="display:none;">
              <select name="FRole" id="FMRole" onchange="toggleFMRoleOptions()">
                    <option value="Faculty Memeber Role">Select Faculty Role</option>
                    <option value="Doctor">Doctor</option>
                    <option value="TA">TA</option>
                </select><br>
                </div>
                <div id="facultyDiv" style="display:none;">
                <select name="faculty">
                  <option value="faculty">Select Faculty</option>
                  <option value="Computer Science">Computer Science</option>
                  <option value="Law">Law</option>
                  <option value="Pharmacy">Pharmacy</option>
                  <option value="Dentistry">Dentistry</option>
                  <option value="Engineering">Engineering</option>
                </select><br>
              </div>

            <input type="submit" value="SignUp">
        </form>
    </div>
</div>     


    </div>
    </div>


</body>
</html>

