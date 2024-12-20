<?php
// fetch_attendance.php

session_start();

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    echo '<div class="alert alert-danger">You must be logged in to view attendance.</div>';
    exit();
}

$student_id = $_SESSION['student_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['course_id'])) {
    $course_id = intval($_POST['course_id']);

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $DB = "asp";

    // Set up DSN and create PDO instance
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        echo '<div class="alert alert-danger">Database connection failed.</div>';
        exit();
    }

    // Fetch attendance records
    $stmt = $pdo->prepare("
        SELECT a.date, a.status, f.course_name
        FROM attendance a
        INNER JOIN courses c ON a.course_id = c.ID
        WHERE a.course_id = ? AND a.student_id = ?
        ORDER BY a.date DESC
    ");
    $stmt->execute([$course_id, $student_id]);
    $attendance = $stmt->fetchAll();

    if ($attendance) {
        echo '
        <h3>Attendance Records</h3>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
        ';
        foreach ($attendance as $record) {
            $status_badge = ($record['status'] == 'Present') ? '<span class="badge badge-success">Present</span>' : '<span class="badge badge-danger">Absent</span>';
            echo "
                <tr>
                    <td>{$record['date']}</td>
                    <td>{$status_badge}</td>
                </tr>
            ";
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-info">No attendance records found for this course.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid request.</div>';
}
?>
