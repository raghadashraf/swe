
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help and Support</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard_student.css"> <!-- Existing dashboard CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- Font Awesome for icons -->

    <style>
        /* Additional styles for professionalism */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;

        }
        header {
            margin-bottom: 20px;
            margin-top: 5%
        }

        a {
            color: #007bff;
            text-decoration: none;

        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }

        h1 {
            font-size: 2.5rem;
            color: #343a40;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 1.5rem;
            color: #495057;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;

        }
        ul li {
            margin-bottom: 10px;
            margin-right: 80%;
        }
        .s{
            margin-right: 20%;   
            
        }
    </style>
</head>
<body>
<aside>
    <img src="img/logo.png" alt="Logo" width="90%">
    <br>
    <nav>
        <a href="dashboard_student.php">
            <img src="img/dashboard.png" alt="Dashboard" class="dashboard"> Dashboard
        </a>
        <a href="Schedule.php">
            <img src="img/clock.png" alt="My Schedule" class="myschedule"> Schedule
        </a>
        <a href="myProfile_student.php">
            <img src="img/myprofile.png" alt="My Profile" class="myprofile"> My Profile
        </a>
        <a href="help_student.php">
            <img src="img/help.png" alt="Help" class="help"> Help
        </a>
        <a href="SignOut.php">
            <img src="img/logout.png" alt="Log Out" class="logout"> Log Out
        </a>
    </nav>
</aside>

<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <main class="col-md-10 ml-sm-auto col-lg-10 px-4">
            <header class="dashboard-header">
                <h1>Help and Support</h1>
                <p>Welcome to the Help and Support section. How can we assist you today?</p>
            </header>
            
            <section>
                <h2>Available Resources</h2>
                <p>We offer a variety of resources to help you navigate your queries:</p>
                <ul>
                    <li><a href="faq.php">🔍 Frequently Asked Questions</a></li>
                    <li><a href="mailto:support@example.com">📩 Contact Support via Email</a></li>
                    <li><a href="guides.php">📚 User Guides and Tutorials</a></li>
                </ul>
            </section>

            <section>
                <h2>Need Further Assistance?</h2>
                <p>If you are unable to find the information you need, please don't hesitate to reach out</p>
                           
            </section>

            <a href='dashboard_student.php' class="btn">🔙 Return to Dashboard</a>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
