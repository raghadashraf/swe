<?php
// attendance_analytics.php
session_start();
include_once "includes/DB.inc.php";

// Fetch attendance data grouped by course and status
$query = "
    SELECT 
        course_id, 
        status, 
        COUNT(*) as count
    FROM attendance
    GROUP BY course_id, status
";
$result = $conn->query($query);

$attendanceData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendanceData[$row['course_id']][$row['status']] = $row['count'];
    }
}

// Convert data to JSON format for the chart
$attendanceDataJson = json_encode($attendanceData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            
        }
        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%; /* Adjust the width to make it smaller */
            max-width: 600px; /* Set a maximum width */
        }
        h1 {
            font-size: 1.5em; /* Smaller title font */
            margin-bottom: 20px;
        }
        canvas {
            max-width: 100%; /* Make the canvas responsive */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Attendance Analytics</h1>
        <canvas id="attendanceChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Parse attendance data passed from PHP
        const attendanceData = <?= $attendanceDataJson ?>;

        // Prepare data for Chart.js
        const labels = Object.keys(attendanceData); // Course IDs
        const presentCounts = labels.map(courseId => attendanceData[courseId]['Present'] || 0);
        const absentCounts = labels.map(courseId => attendanceData[courseId]['Absent'] || 0);

        const ctx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Course IDs
                datasets: [
                    {
                        label: 'Present',
                        data: presentCounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Absent',
                        data: absentCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12 // Smaller legend font
                            }
                        }
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 12 // Smaller font for Y-axis labels
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12 // Smaller font for X-axis labels
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
