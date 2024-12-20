<?php
session_start();
include_once "includes/DB.inc.php";

if (!isset($_SESSION['ID']) || $_SESSION['Role'] !== 'Faculty Member') {
    header("Location: login.php");
    exit();
}

// Get the faculty member's ID
$faculty_id = $_SESSION['ID'];

// Fetch the faculty member's schedule
$query = "
    SELECT 
        fc.day, 
        fc.time, 
        fc.location, 
        c.course_code, 
        c.`course name`
    FROM faculty_courses fc
    INNER JOIN courses c ON fc.course_id = c.ID
    WHERE fc.faculty_id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}
$stmt->bind_param("i", $faculty_id);
$stmt->execute();
$result = $stmt->get_result();

// Organize courses by day
$schedule = [];
while ($row = $result->fetch_assoc()) {
    $schedule[$row['day']][] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard_dr.css">
    <link rel="stylesheet" href="css/schedule.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .schedule-content {
            margin-left: auto;
            margin-right: auto;
            max-width: 90%;
        }

        .schedule-table {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .schedule-content {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="container mt-5">
    <header class="dashboard-header text-center">
        <h1>Weekly Course Schedule</h1>
        <p>Manage your lectures and office hours efficiently.</p>
    </header>

    <div class="schedule-content">
        <table class="schedule-table table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Initialize an array for unique time slots
                $unique_timeslots = [];

                // Extract unique time slots from the schedule
                foreach ($schedule as $day => $courses) {
                    foreach ($courses as $course) {
                        if (!in_array($course['time'], $unique_timeslots)) {
                            $unique_timeslots[] = $course['time'];
                        }
                    }
                }

                // Sort the time slots
                usort($unique_timeslots, function ($a, $b) {
                    return strtotime($a) - strtotime($b);
                });

                // Generate table rows dynamically
                foreach ($unique_timeslots as $timeslot) {
                    echo "<tr>";
                    echo "<td>$timeslot</td>";

                    foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day) {
                        echo "<td>";
                        if (isset($schedule[$day])) {
                            foreach ($schedule[$day] as $course) {
                                if ($course['time'] === $timeslot) {
                                    echo "<div>
                                        <strong>{$course['course_code']}</strong>: {$course['course name']}<br>
                                        Location: {$course['location']}
                                    </div>";
                                }
                            }
                        }
                        echo "</td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
