<?php
session_start();
include_once "includes/DB.inc.php";
include "classes.php";
//var_dump($_POST);
// if (!$conn) {
//     die("Database connection failed: " . mysqli_connect_error());
// } else {
//     echo "Database connected successfully.";
// }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Email"]) && isset($_POST["Password"])) {
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];

        if ($stmt = $conn->prepare("SELECT * FROM students WHERE Email = ?")) {
            $stmt->bind_param("s", $Email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                // Verify the password
                if ($Password === $row['Password']) {
                    $_SESSION["ID"]=$row["ID"];
                    $_SESSION["FName"]=$row["FName"];
                    $_SESSION["LName"]=$row["LName"];
                    $_SESSION["Email"]=$row["Email"];
                    $_SESSION["Password"]=$row["Password"];
                    $_SESSION["Role"]=$row["Role"];
                    $_SESSION["ROLEID"] = $row["ROLEID"];
                    $_SESSION["Major"]=$row["Major"];
                    $_SESSION["Minor"]=$row["Minor"];
                    $_SESSION["Status"]=$row["Status"];
                    $_SESSION["Sem GPA"]=$row["Sem gpa"];
                    $_SESSION["Cum GPA"]=$row["Cum gpa"];
                    $_SESSION["Sem crdth"]=$row["Sem crdth"];
                    $_SESSION["Total crdth"]=$row["Total crdth"];
                    header("Location: dashboard_student.php?login=success");
                    exit();
                }
            }
            $stmt->close();
        }

        // Check for doctor
        if ($stmt = $conn->prepare("SELECT * FROM faculty WHERE Email = ?")) {
            $stmt->bind_param("s", $Email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                echo "<pre>";
                print_r($row); // Debugging: Print the retrieved row
                echo "</pre>";
                if ($Password === $row['Password']) { // Assuming plain-text comparison (use hashing in production)
                    $_SESSION["ID"] = $row["ID"]; // Ensure case matches database
                    $_SESSION["FName"] = $row["FName"];
                    $_SESSION["LName"] = $row["LName"];
                    $_SESSION["Email"] = $row["Email"];
                    $_SESSION["Password"]=$row["Password"];
                    $_SESSION["Role"] = $row["Role"]; 
                    $_SESSION["ROLEID"] = $row["ROLEID"];
                    $_SESSION["faculty"]=$row["faculty"];
                    header("Location: dashboard_student.php?login=success");
                    exit();
                }
            }
            $stmt->close();
        }

        // Check for admin
        if ($stmt = $conn->prepare("SELECT * FROM admins WHERE Email = ?")) {
            $stmt->bind_param("s", $Email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                // Verify the password
                if ($Password === $row['Password']) {
                    $_SESSION["ID"]=$row["ID"];
                    $_SESSION["FName"]=$row["FName"];
                    $_SESSION["LName"]=$row["LName"];
                    $_SESSION["Email"]=$row["Email"];
                    $_SESSION["Password"]=$row["Password"];
                    $_SESSION["Role"]=$row["Role"];
                    $_SESSION["ROLEID"] = $row["ROLEID"];
                    header("Location: dashboard_admin.php?login=success");
                    exit();
                }
            }
            $stmt->close();
        }

         else {
            die("Failed to prepare statement.");
        }
    } else {
        $loginError = "Email or Password not provided!";
    }
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
    <link rel="stylesheet" href="css/Login.css"> <!-- Sidebar CSS -->
    
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

        <!-- Right Section with Gradient and Clip Path -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center" style="background: linear-gradient(to top, #005f73, #00c9f2); -webkit-clip-path: ellipse(80% 70% at 50% 50%); clip-path: ellipse(80% 70% at 50% 50%);">
            <!-- Blurred Login Form Overlay -->
            <div class="login-form-container">
                <div class="login-form">
                    <h2 class="text-white text-2xl font-bold mb-6">Login</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <input type="email" name="Email" placeholder="Enter your email" required class="mb-4 p-2 w-full rounded-md border border-gray-300">
                        <input type="password" name="Password" placeholder="Enter your password" required class="mb-4 p-2 w-full rounded-md border border-gray-300">
                        <input type="submit" value="Login" class="w-full p-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>























<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Welcome to OnCampus. Log in to access your account." />
    <meta name="keywords" content="welcome, login, platform, student services" />
    <title>Welcome to OnCampus</title>
    
    <link rel="stylesheet" href="css/login-signup.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
</head>

<body class="bg-gradient-to-r from-blue-400 to-blue-600 min-h-[80vh] flex flex-col justify-center py-8">
<br><br>
    <div class="flex flex-col items-center mb-6 text-center">
        <br><br>
        <img src="img/logo.png" alt="Company Logo" class="w-24 mb-2" />
        <h1 class="text-3xl md:text-4xl text-white font-bold">Welcome to OnCampus</h1>
        <p class="text-md md:text-lg text-white mt-1">Your one-stop platform for academic success.</p>
    </div>

    <div class="container mx-auto flex flex-wrap flex-col md:flex-row items-center justify-center mb-6">
       
        <div class="w-full md:w-3/5 py-4 text-center">
            <img class="w-full md:w-4/5 z-50" src="img/hero.png" alt="Hero Image" />
        </div>
    </div>
    
      <div class="wave-section mt-6">
        <svg viewBox="0 0 1428 174" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.1"></path>
            <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.1"></path>
            <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.2"></path>
            <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"></path>
            </g>
        </svg>
    </div>
    
</body>
</html> -->
    <!-- <script>
        function toggleRoleOptions() {
            var role = document.getElementById('role').value;
            document.getElementById('majorDiv').style.display = (role === 'Student') ? 'block' : 'none';
            document.getElementById('facultyRoleDiv').style.display = (role === 'Faculty Member') ? 'block' : 'none';
        }

        function validateForm(form) {
            let emptyFields = [];
            if (!form.Email.value) emptyFields.push("Email");
            if (!form.Password.value) emptyFields.push("Password");

            if (form.id === "signupForm") {
                if (!form.Name.value) emptyFields.push("Name");
                if (form.Email.value && !form.Email.value.includes('@')) {
                    alert("Please enter a valid email address with an @ symbol.");
                    return false;
                }
            }

            if (emptyFields.length > 0) {
                alert("Please fill in the following fields: " + emptyFields.join(", "));
                return false;
            }
            return true;
        }
    </script> -->
<!-- </head>
<body>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="img/login.jpeg" alt="">
            </div>
            <div class="back">
                <img src="img/login.jpeg" alt="">
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Login Form</div>
                    <form action="" id="loginForm" method="post" onsubmit="return validateForm(this)">
                        <input type="hidden" name="action" value="login">
                        <div class="social-container">
                            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://accounts.google.com/" class="social"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="Email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="Password" placeholder="Enter your password" required>
                        </div>
                        <div class="text"><a href="forget-password.php">Forgot password?</a></div>
                        <div class="button input-box">
                            <input type="submit" value="Submit">
                        </div>
                        <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
                        <?php if (isset($loginError)) echo "<div style='color:red;'>$loginError</div>"; ?>
                    </form>
                </div>
                
                <div class="signup-form">
                    <div class="title">Sign up Form</div>
                    <form action="" id="signupForm" method="post" onsubmit="return validateForm(this)">
                        <input type="hidden" name="action" value="signup">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" name="Name" placeholder="Enter your name" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="Email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="Password" placeholder="Enter your password" required>
                        </div>
                        <div class="input-box">
                            <label>Role: </label>
                            <select name="Role" id="role" onchange="toggleRoleOptions()" required>
                                <option value="">Select Your Role</option>
                                <option value="Student">Student</option>
                                <option value="Faculty Member">Faculty Member</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div id="majorDiv" style="display:none;">
                            <label>Major: </label>
                            <select name="Major">
                                <option value="Computer Science">Computer Science</option>
                                <option value="Alsun">Alsun</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="Dentistry">Dentistry</option>
                                <option value="Engineering">Engineering</option>
                            </select>
                        </div>
                        <div id="facultyRoleDiv" style="display:none;">
                            <label>Faculty Role: </label>
                            <select name="FRole">
                                <option value="Doctor">Doctor</option>
                                <option value="TA">TA</option>
                            </select>
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Submit">
                        </div>
                        <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html> -->
