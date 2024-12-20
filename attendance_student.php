<?php
session_start();
include_once "includes/DB.inc.php";

if (!isset($_SESSION['ID']) || $_SESSION['Role'] !== 'Student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['ID'];

// Query to fetch courses with absences greater than 5
$query = "
    SELECT 
        c.course_code, 
        c.`course name`, 
        COUNT(a.status) AS absence_count
    FROM 
        attendance a
    INNER JOIN 
        courses c ON a.course_id = c.ID
    WHERE 
        a.student_id = ? AND a.status = 'Absent'
    GROUP BY 
        c.ID
    HAVING 
        absence_count > 5";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}

$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$courses_with_absences = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses_with_absences[] = $row;
    }
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Warning</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <style>
        .alert-warning-container {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 20px;
            border-radius: 5px;
            margin: 20px auto;
            text-align: center;
            font-weight: bold;
        }

        .alert-warning-container h2 {
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .table-danger {
            border: 2px solid #dc3545;
            background-color: #f8d7da;
        }

        .table-danger th {
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar_student.php'; ?>

            <!-- Main Content -->
            <main class="col-md-10 ml-sm-auto col-lg-10 px-4">
                <header class="dashboard-header my-4">
                    <h1>Attendance Warning</h1>
                    <p class="text-danger font-weight-bold">Courses with excessive absences. Immediate action required!</p>
                </header>

                <!-- Display Courses with Absences -->
                <?php if (!empty($courses_with_absences)) { ?>
                    <div class="alert-warning-container">
                        <h2 class="text-danger">Warning: Risk of Dropping Courses!</h2>
                        <p>If your absence count exceeds the limit, you may have to drop the course(s) below.</p>
                    </div>
                    <table class="table table-danger">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Number of Absences</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses_with_absences as $course) { ?>
                                <tr>
                                    <td><?= $course['course_code'] ?></td>
                                    <td><?= $course['course name'] ?></td>
                                    <td><?= $course['absence_count'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="alert alert-success">
                        You have no courses with more than 5 absences. Keep up the good work!
                    </div>
                <?php } ?>
            </main>
        </div>
    </div>
</body>
</html>
