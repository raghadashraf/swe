<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Include your existing CSS -->
    <link rel="stylesheet" href="css/dashboard_student.css">
    <!-- Include FontAwesome for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include the chatbot CSS -->
    <link rel="stylesheet" href="css/chatbot.css">
    <style>
        /* Chatbot Modal Styles */
        .chatbot-modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1000; /* On top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
        }

        .chatbot-modal-content {
            background-color: #fefefe;
            margin: 50px auto; /* 15% from the top and centered */
            border: 1px solid #888;
            width: 80%;
            max-width: 400px; /* Could be more or less, depending on screen size */
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .chatbot-header {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            position: relative;
        }

        .chatbot-header h2 {
            margin: 0;
        }

        .chatbot-close {
            color: white;
            position: absolute;
            right: 15px;
            top: 5px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .chatbot-close:hover,
        .chatbot-close:focus {
            color: #ddd;
            text-decoration: none;
            cursor: pointer;
        }

        .chatbot-body {
            padding: 10px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body class="gradient-clipped-background">
    <?php include 'sidebar_student.php'; ?>

    <!-- Dashboard Content -->
    <div class="dashboard">
        <header>
            <!-- Welcome Box with Grey Background -->
            <div class="welcome-box">
                <h1>Welcome</h1>
            </div>

            <!-- AI Companion Box -->
            <div class="ai-companion-box">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <div class="image-container">

                        <img class="sera-icon" src="img/XSERA-ICON.png" alt="X.SERA" />
                    </div>
                    <div class="future-content flex flex-col">
                        <h2>X.SERA</h2>
                        <p>Your AI Companion is here now. Give it a try and enjoy the future of learning ✨✨</p>
                    </div>
                    <div class="future-arrow-btn flex items-center inline-flex">
                    <button class="future-button" onclick="toggleChatbot()">
                        <i class="fas fa-comments"></i> Chat Now
                    </button>
                    </div>
                </div>
            </div>
        </header>
<!--
        <div class="dashboard-content">
            Main Categories Section 
            <div class="main-categories">
                <div class="category-box">
                    <h3>Courses</h3>
                </div>
                <div class="category-box">
                    <h3>Attendance</h3>
                </div>
                <div class="category-box">
                    <h3>Grades</h3>
                </div>
                <div class="category-box">
                    <h3>Schedule</h3>
                </div>
            </div>
    -->
    </div>

    <!-- Chatbot Modal -->
    <div id="chatbot-modal" class="chatbot-modal">
        <div class="chatbot-modal-content">
            <div class="chatbot-header">
                <span class="chatbot-close" onclick="toggleChatbot()">&times;</span>
                <h2>X.SERA - Your AI Companion</h2>
            </div>
            <div class="chatbot-body">
                <?php include 'chatbot.php'; ?>
            </div>
        </div>
    </div>

    <!-- JavaScript for Chatbot Modal -->
    <script>
        // Function to toggle the chatbot modal
        function toggleChatbot() {
            var modal = document.getElementById("chatbot-modal");
            modal.style.display = (modal.style.display === "block") ? "none" : "block";
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("chatbot-modal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
