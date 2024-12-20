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

        <!-- Right Section -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center" style="background: linear-gradient(to top, #005f73, #00c9f2); -webkit-clip-path: ellipse(80% 70% at 50% 50%); clip-path: ellipse(80% 70% at 50% 50%);">
    <!-- Buttons -->
    <div class="flex flex-col items-center space-y-6">
        <a href="Login.php" class="w-48 text-center bg-white text-blue-600 font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-blue-500 hover:text-white transition duration-300">
            Log In
        </a>
        <a href="SignUp.php" class="w-48 text-center bg-white text-blue-600 font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-blue-500 hover:text-white transition duration-300">
            Sign Up
        </a>
    </div>
</div>

    </div>
</body>
</html>
