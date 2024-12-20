<?php
// Include the database connection file
include_once "includes/DB.inc.php";

// Ensure $conn is defined and the database connection is established
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM availability";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Initialize arrays for student preferences and staff availability
$studentPreferences = [];
$staffAvailability = [];

// Fetch and categorize availability data
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['role'] === 'Student') {
        $studentPreferences[] = $row;
    } else {
        $staffAvailability[] = $row;
    }
}

// Optionally print the arrays after fetching data (for debugging purposes)
// echo "<pre>Student Preferences:\n";
// print_r($studentPreferences);
// echo "\nStaff Availability:\n";
// print_r($staffAvailability);
// echo "</pre>";

/**
 * Match schedules between students and staff.
 *
 * @param array $studentPreferences
 * @param array
 * @param array $staffAvailability
 * @return array Matched schedules
 */
function matchSchedule($studentPreferences, $staffAvailability) {
    $schedule = [];
    foreach ($studentPreferences as $preference) {
        foreach ($staffAvailability as $availability) {
            if (
                $preference['time_slot'] === $availability['time_slot'] &&
                $preference['available_date'] === $availability['available_date']
            ) {
                // Add matched schedule
                $schedule[] = [
                    'student_id' => $preference['user_id'],
                    'doctor_id' => $availability['user_id'],  // Assuming doctor_id is staff user_id
                    'time_slot' => $preference['time_slot'],
                    'date' => $preference['available_date']
                ];
                break; // Stop checking once a match is found
            }
        }
    }
    return $schedule;
}

// Call the matching function
$matchedSchedules = matchSchedule($studentPreferences, $staffAvailability);

// Prepare the statement for inserting matched schedules
$stmt = $conn->prepare("INSERT INTO appointments (student_id, doctor_id, date, time_slot, status) VALUES (?, ?, ?, ?, 'scheduled')");

if (!$stmt) {
    die("Preparation failed: " . $conn->error);
}

// Process each matched schedule
foreach ($matchedSchedules as $schedule) {
    $studentId = $schedule['student_id'];
    $doctorId = $schedule['doctor_id'];
    $date = $schedule['date'];
    $timeSlot = $schedule['time_slot'];

    // Ensure the date is in the correct format (YYYY-MM-DD)
    $date = date('Y-m-d', strtotime($date));

    // Bind parameters and execute the statement
    $stmt->bind_param("iiss", $studentId, $doctorId, $date, $timeSlot);

    // Check if binding worked before executing
    if (!$stmt->bind_param("iiss", $studentId, $doctorId, $date, $timeSlot)) {
        echo "Binding parameters failed: " . $stmt->error . "<br>";
    }

    // Execute and check for errors
    if ($stmt->execute()) {
        echo "Appointment scheduled: Student ID $studentId with Doctor ID $doctorId on $date at $timeSlot<br>";
    } else {
        echo "Error inserting appointment: " . $stmt->error . "<br>";  // Print error if execute fails
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>