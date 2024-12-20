<?php
session_start();
include_once "includes/DB.inc.php";

if (!isset($_SESSION['ID']) || $_SESSION['Role'] !== 'Faculty Member') {
    header("Location: login.php");
    exit();
}

// Get the faculty member's ID
$faculty_id = $_SESSION['ID'];

// Fetch courses assigned to the faculty member
$stmt = $conn->prepare("SELECT c.ID AS course_id, c.course_code, c.`course name` FROM courses c WHERE c.faculty_id = ?");
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}

$stmt->bind_param("i", $faculty_id);
$stmt->execute();
$result = $stmt->get_result();

$courses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}
$stmt->close();

// Fetch students assigned to a selected course if submitted
$students = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_course'])) {
    $selected_course_id = $_POST['selected_course'];

    $query = "
        SELECT 
            s.ID AS student_id, 
            s.FName, 
            s.LName
        FROM 
            student_courses sc
        INNER JOIN 
            students s ON sc.student_id = s.ID
        WHERE 
            sc.course_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $selected_course_id);
    $stmt->execute();
    $students = $stmt->get_result();
    $stmt->close();
}

// Handle attendance submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attendance'])) {
    $course_id = $_POST['course_id'];
    $attendance = $_POST['attendance'];

    $marked_students = array_keys($attendance);
    foreach ($attendance as $student_id => $status) {
        $status = $status === 'present' ? 'Present' : 'Absent';

        $stmt = $conn->prepare("INSERT INTO attendance (course_id, student_id, status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE status = ?");
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }

        $stmt->bind_param("iiss", $course_id, $student_id, $status, $status);
        $stmt->execute();
        $stmt->close();
    }

    // Mark absent for unmarked students
    $query = "SELECT s.ID AS student_id FROM student_courses sc INNER JOIN students s ON sc.student_id = s.ID WHERE sc.course_id = ? AND s.ID NOT IN (" . implode(",", $marked_students) . ")";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $absent_students = $stmt->get_result();
    $stmt->close();

    while ($row = $absent_students->fetch_assoc()) {
        $student_id = $row['student_id'];
        $status = 'Absent';
        $stmt = $conn->prepare("INSERT INTO attendance (course_id, student_id, status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE status = ?");
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }
        $stmt->bind_param("iiss", $course_id, $student_id, $status, $status);
        $stmt->execute();
        $stmt->close();
    }

    echo "<div class='alert alert-success mx-auto' style='max-width: 600px; padding: 15px; background-color: #e7f3e4; color: #276738; border-left: 6px solid #47a447; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);'>
        <h4 class='alert-heading' style='margin-bottom: 10px;'>Success!</h4>
        <p style='margin: 0;'>Attendance for course <strong>$course_id</strong> has been recorded successfully.</p>
      </div>";

        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <style>
        .alert {
            animation: fadeOut 5s forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; display: none; }
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
                <header class="dashboard-header my-4">
                    <h1>Attendance Management</h1>
                    <p>Select a course to view and mark attendance for students.</p>
                </header>

                <!-- Course Selection -->
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="selected_course">Select Course:</label>
                        <select name="selected_course" id="selected_course" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Select a Course --</option>
                            <?php
                            if (!empty($courses)) {
                                foreach ($courses as $course) {
                                    echo '<option value="' . $course['course_id'] . '" ' . 
                                         (isset($selected_course_id) && $selected_course_id == $course['course_id'] ? 'selected' : '') . '>' . 
                                         $course['course_code'] . ' - ' . $course['course name'] . 
                                         '</option>';
                                }
                            } else {
                                echo '<option value="">No courses available</option>';
                            }
                            ?>
                        </select>
                    </div>
                </form>

                <!-- Student List -->
                <?php if ($students && $students->num_rows > 0) { ?>
                    <form method="POST" action="">
                        <input type="hidden" name="course_id" value="<?= $selected_course_id ?>">
                        <h2>Students Enrolled in the Course</h2>
                        <?php while ($student = $students->fetch_assoc()) { ?>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="attendance[<?= $student['student_id'] ?>]" value="present">
                                <label class="form-check-label">
                                    <?= $student['FName'] ?> <?= $student['LName'] ?>
                                </label>
                            </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary mt-3">Submit Attendance</button>
                    </form>
                <?php } elseif (isset($selected_course_id)) { ?>
                    <p>No students found for the selected course.</p>
                <?php } ?>
            </main>
        </div>
    </div>
</body>
</html>
