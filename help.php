<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help and Support</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard_dr.css"> <!-- Existing dashboard CSS -->
    <link rel="stylesheet" href="css/sidebar.css"> <!-- Sidebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        /* Additional styles for professionalism */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        header {
            margin-bottom: 20px;
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
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

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
                    <p>If you are unable to find the information you need, please don't hesitate to reach out:</p>
                    <p><strong>For immediate assistance:</strong> Contact our support team at <a href="mailto:support@example.com">support@example.com</a>.</p>
                </section>

                <a href='dashboard_dr.php' class="btn btn-primary">🔙 Return to Dashboard</a>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
