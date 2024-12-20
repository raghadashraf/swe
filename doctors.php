<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctors Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .search-btn {
            border: none;
            background: transparent;
            cursor: pointer;
        }
        .search-btn:hover {
            color: #fff;
            background-color: #343a40;
            border-radius: 0.25rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef; /* Light gray on hover */
        }
        .input-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 0.25rem;
        }
        h1 {
            margin-bottom: 20px;
        }
        .operation-icons i {
            cursor: pointer;
            margin-right: 8px;
        }
        .operation-icons i:hover {
            color: #007bff;
        }
        .add-student-icon {
            color: #28a745;
            font-size: 1.2rem;
        }
        .add-student-icon:hover {
            color: #218838;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="bg-dark text-light text-center py-2">Doctors Management</h1>
    
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Search by ID">
                <button class="search-btn input-group-text bg-dark text-light" onclick="searchById()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover" id="studentTable">
      <thead class="table-dark">
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
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>mark.otto@example.com</td>
          <td>Active</td>
          <td class="operation-icons">
            <i class="fas fa-eye text-success" onclick="showStudentInfo(this)"></i>
            <i class="fas fa-edit text-primary" onclick="editStudent(this)"></i>
            <i class="fas fa-trash text-danger" onclick="openConfirmDeleteModal(this)"></i>
            <i class="fas fa-user-plus add-student-icon" title="Add Student" data-bs-toggle="modal" data-bs-target="#addStudentModal"></i>
          </td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>jacob.thornton@example.com</td>
          <td>Inactive</td>
          <td class="operation-icons">
            <i class="fas fa-eye text-success" onclick="showStudentInfo(this)"></i>
            <i class="fas fa-edit text-primary" onclick="editStudent(this)"></i>
            <i class="fas fa-trash text-danger" onclick="openConfirmDeleteModal(this)"></i>
            <i class="fas fa-user-plus add-student-icon" title="Add Student" data-bs-toggle="modal" data-bs-target="#addStudentModal"></i>
          </td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>Bird</td>
          <td>larry.bird@example.com</td>
          <td>Active</td>
          <td class="operation-icons">
            <i class="fas fa-eye text-success" onclick="showStudentInfo(this)"></i>
            <i class="fas fa-edit text-primary" onclick="editStudent(this)"></i>
            <i class="fas fa-trash text-danger" onclick="openConfirmDeleteModal(this)"></i>
            <i class="fas fa-user-plus add-student-icon" title="Add Student" data-bs-toggle="modal" data-bs-target="#addStudentModal"></i>
          </td>
        </tr>
      </tbody>
    </table>
</div>

<!-- Modal for Add Student -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Add Doctor</h5>
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
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="addStudentForm">Add Doctor</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirmation Modal for Deletion -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this record?</p>
        <p id="deleteStudentInfo"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Student Info Modal -->
<div class="modal fade" id="studentInfoModal" tabindex="-1" aria-labelledby="studentInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentInfoModalLabel">Doctor Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="studentFullName"></p>
        <p id="studentEmail"></p>
        <p id="studentStatus"></p>
      </div>
    </div>
  </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentModalLabel">Edit Doctor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editStudentForm">
          <div class="mb-3">
            <label for="editFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="editFirstName" required>
          </div>
          <div class="mb-3">
            <label for="editLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="editLastName" required>
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" required>
          </div>
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select class="form-select" id="editStatus">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="saveEditButton">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    let rowToEdit;
    let rowToDelete;

    function showStudentInfo(element) {
        const row = element.closest('tr');
        const firstName = row.cells[1].innerText;
        const lastName = row.cells[2].innerText;
        const email = row.cells[3].innerText;
        const status = row.cells[4].innerText;

        document.getElementById('studentFullName').innerText = `Name: ${firstName} ${lastName}`;
        document.getElementById('studentEmail').innerText = `Email: ${email}`;
        document.getElementById('studentStatus').innerText = `Status: ${status}`;

        const modal = new bootstrap.Modal(document.getElementById('studentInfoModal'));
        modal.show();
    }

    function editStudent(element) {
        rowToEdit = element.closest('tr');
        const firstName = rowToEdit.cells[1].innerText;
        const lastName = rowToEdit.cells[2].innerText;
        const email = rowToEdit.cells[3].innerText;
        const status = rowToEdit.cells[4].innerText;

        document.getElementById('editFirstName').value = firstName;
        document.getElementById('editLastName').value = lastName;
        document.getElementById('editEmail').value = email;
        document.getElementById('editStatus').value = status;

        const modal = new bootstrap.Modal(document.getElementById('editStudentModal'));
        modal.show();
    }

    document.getElementById('saveEditButton').onclick = function() {
        if (rowToEdit) {
            const firstName = document.getElementById('editFirstName').value;
            const lastName = document.getElementById('editLastName').value;
            const email = document.getElementById('editEmail').value;
            const status = document.getElementById('editStatus').value;

            rowToEdit.cells[1].innerText = firstName;
            rowToEdit.cells[2].innerText = lastName;
            rowToEdit.cells[3].innerText = email;
            rowToEdit.cells[4].innerText = status;

            const modal = bootstrap.Modal.getInstance(document.getElementById('editStudentModal'));
            modal.hide(); // Hide the modal
            rowToEdit = null; // Clear the reference
        }
    };

    function openConfirmDeleteModal(element) {
        rowToDelete = element.closest('tr'); // Store the row to delete
        const firstName = rowToDelete.cells[1].innerText; // Get first name
        const lastName = rowToDelete.cells[2].innerText; // Get last name
        document.getElementById('deleteStudentInfo').innerText = `${firstName} ${lastName}`;
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    }

    document.getElementById('confirmDeleteButton').onclick = function() {
        if (rowToDelete) {
            rowToDelete.remove(); // Remove the row from the table
            rowToDelete = null; // Clear the reference
            const modal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
            modal.hide(); // Hide the modal
        }
    };

    function searchById() {
        const input = document.getElementById('searchInput').value;
        const table = document.getElementById('studentTable');
        const rows = table.getElementsByTagName('tr');
        
        // Loop through all table rows, except the header
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('th');
            const id = cells[0].innerText; // Get the ID from the first cell
            if (id.includes(input)) {
                rows[i].style.display = ''; // Show the row
            } else {
                rows[i].style.display = 'none'; // Hide the row
            }
        }
    }
</script>

</body>
</html>