<?php
include_once "includes/DB.inc.php";
include "classes.php";

$studentsObject = new Student($conn);
$students = $studentsObject->getAllstudents();

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['ID'])) {
    $studentId = $_POST['ID'];
    $studentData = $studentsObject->getStudentByID($studentId);

    if ($studentData!=null) {
      echo json_encode($studentData ? $studentData : ["error" => "Student not found"]);
      exit;
      }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/Students_dashboard.css"/>

</head>
<body>

<div class="container mt-5">
    <h1>Students Management</h1>
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Search by ID">
                <button class="search-btn input-group-text" onclick="searchById()">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-primary ms-2" type="button" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    Add Student
                </button>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover" id="studentTable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($student = $students->fetch_assoc()): ?>
            <tr>
                <th scope="row"><?= htmlspecialchars($student['ID']); ?></th>
                <td><?= htmlspecialchars($student['FName']); ?></td>
                <td><?= htmlspecialchars($student['LName']); ?></td>
                <td><?= htmlspecialchars($student['Email']); ?></td>
                <td><?= htmlspecialchars($student['Status']); ?></td>
                <td class="operation-icons">
                    <i class="fas fa-eye" onclick="showStudentInfo(<?= $student['ID']; ?>)"></i>
                    <i class="fas fa-edit" onclick="editStudent(this)"></i>
                    <i class="fas fa-trash" onclick="openConfirmDeleteModal(this)"></i>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal for Add Student -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="major" class="form-label">Major</label>
                        <input type="text" class="form-control" id="major" required>
                    </div>
                    <div class="mb-3">
                        <label for="minor" class="form-label">Minor</label>
                        <input type="text" class="form-control" id="minor" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status">
                            <option value="regular">regular</option>
                            <option value="probation">probation</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="semesterGPA" class="form-label">Semester GPA</label>
                        <input type="number" step="0.01" class="form-control" id="semesterGPA" required>
                    </div>
                    <div class="mb-3">
                        <label for="cumulativeGPA" class="form-label">Cumulative GPA</label>
                        <input type="number" step="0.01" class="form-control" id="cumulativeGPA" required>
                    </div>
                    <div class="mb-3">
                        <label for="semesterCreditHours" class="form-label">Semester Credit Hours</label>
                        <input type="number" class="form-control" id="semesterCreditHours" required>
                    </div>
                    <div class="mb-3">
                        <label for="totalCreditHours" class="form-label">Total Credit Hours</label>
                        <input type="number" class="form-control" id="totalCreditHours" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addStudentForm">Add Student</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="studentInfoModal" tabindex="-1" aria-labelledby="studentInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentInfoModalLabel">Student Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="studentId"></span></p>
                <p><strong>First Name:</strong> <span id="studentFirstName"></span></p>
                <p><strong>Last Name:</strong> <span id="studentLastName"></span></p>
                <p><strong>Email:</strong> <span id="studentEmail"></span></p>
                <p><strong>Role:</strong> <span id="Role"></span></p>
                <p><strong>RoleID:</strong> <span id="RoleID"></span></p>
                <p><strong>Major:</strong> <span id="Major"></span></p>
                <p><strong>Minor:</strong> <span id="Minor"></span></p>
                <p><strong>Status:</strong> <span id="studentStatus"></span></p>
                <p><strong>Sem GPA:</strong> <span id="Sem GPA"></span></p>
                <p><strong>Cum GPA:</strong> <span id="Cum GPA"></span></p>
                <p><strong>Sem CRDTH:</strong> <span id="Sem CRDTH"></span></p>
                <p><strong>Total CRDTH:</strong> <span id="Total CRDTH"></span></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    function showStudentInfo(studentid) {
        fetch('',{
          method:'POST',
          headers:{'Content-type':'application/x-www-form-urlencoded'},
          body:'ID='+ studentid
        })
        .then(response=>response.json())
        .then(data=>{
          if (data.error) {
                alert(data.error);
            } else {
                // Populate the modal with student data
                document.getElementById('studentId').innerText = data.ID;
                document.getElementById('studentFirstName').innerText = data.FName;
                document.getElementById('studentLastName').innerText = data.LName;
                document.getElementById('studentEmail').innerText = data.Email;
                document.getElementById('Role').innerText = data.Role;
                document.getElementById('RoleID').innerText = data.ROLEID;
                document.getElementById('Major').innerText = data.Major;
                document.getElementById('Minor').innerText = data.Minor;
                document.getElementById('studentStatus').innerText = data.Status;
                document.getElementById('Sem GPA').innerText = data['Sem gpa'];
                document.getElementById('Cum GPA').innerText = data['Cum gpa'];
                document.getElementById('Sem CRDTH').innerText = data['Sem crdth'];
                document.getElementById('Total CRDTH').innerText = data['Total crdth'];

                const modal = new bootstrap.Modal(document.getElementById('studentInfoModal'));
                modal.show();
              }
      })
      .catch(error => console.error('Error:', error));

        // document.getElementById('studentid').innerText = `ID: ${id}`;
        // document.getElementById('studentFullName').innerText = `Name: ${firstName} ${lastName}`;
        // document.getElementById('studentEmail').innerText = `Email: ${email}`;
        // document.getElementById('studentStatus').innerText = `Status: ${status}`;

        // const modal = new bootstrap.Modal(document.getElementById('studentInfoModal'));
        // modal.show();
    }

    function searchById() {
        const input = document.getElementById('searchInput').value;
        const table = document.getElementById('studentTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const id = rows[i].getElementsByTagName('th')[0].innerText;
            rows[i].style.display = id.includes(input) ? '' : 'none';
        }
    }
</script>

</body>
</html>