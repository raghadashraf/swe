<?php
session_start();
include_once "includes/DB.inc.php";

if (!isset($_SESSION['ID']) || $_SESSION['Role'] !== 'Faculty Member') {
    header("Location: login.php");
    exit();
}

$faculty_id = $_SESSION['ID'];

// Fetch upcoming lectures and meetings for the timeline
$query = "
    SELECT 
        fc.day, 
        fc.time, 
        fc.location, 
        c.course_code, 
        c.`course name`, 
        fc.location
    FROM faculty_courses fc
    INNER JOIN courses c ON fc.course_id = c.ID
    WHERE fc.faculty_id = ?
    ORDER BY FIELD(fc.day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), 
             TIME_FORMAT(fc.time, '%H:%i') ASC
";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}
$stmt->bind_param("i", $faculty_id);
$stmt->execute();
$result = $stmt->get_result();

$timeline_items = [];
while ($row = $result->fetch_assoc()) {
    $timeline_items[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Dashboard</title>
    <link rel="stylesheet" href="css/dashboard_dr.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .dashboard-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-left:10%;
        }

        .timeline, .calendar {
            flex: 1;
            max-width: 48%;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .calendar-container iframe {
            border-radius: 10px;
            width: 100%;
        }

        .timeline-list {
            list-style: none;
            padding: 0;
        }

        .timeline-list li {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 15px;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="dashboard">
        <header class="dashboard-header">
            <h1>Doctor's Dashboard</h1>
            <p>Welcome, Dr. <?= htmlspecialchars($_SESSION['FName'] . ' ' . $_SESSION['LName']) ?></p>
        </header>
        
        <div class="dashboard-content">
            <!-- Timeline Section -->
            <section class="timeline">
                <h2>Timeline</h2>
                <ul class="timeline-list">
                    <?php if (!empty($timeline_items)) {
                        foreach ($timeline_items as $item) { ?>
                            <li>
                                <h3>Lecture: <?= htmlspecialchars($item['course_code'] . ' - ' . $item['course name']) ?></h3>
                                <p><strong>Day:</strong> <?= htmlspecialchars($item['day']) ?></p>
                                <p><strong>Time:</strong> <?= htmlspecialchars($item['time']) ?></p>
                                <p><strong>Location:</strong> <?= htmlspecialchars($item['location']) ?></p>
                            </li>
                        <?php }
                    } else { ?>
                        <li>
                            <p>No upcoming lectures or meetings.</p>
                        </li>
                    <?php } ?>
                </ul>
            </section>

            <!-- Calendar Section -->
            <section class="calendar">
                <h2>Calendar</h2>
                <div class="calendar-container">
                    <iframe src="https://calendar.google.com/calendar/embed?src=[YOUR_CALENDAR_LINK]&ctz=America%2FNew_York"
                        style="border: 0" height="500" frameborder="0" scrolling="no">
                    </iframe>
                </div>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
