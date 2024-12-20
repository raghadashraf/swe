<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
        <link rel="stylesheet" href="css/dashboard_admin.css">

</head>
<body>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
<img src="img/logo.png" alt="Logo" width="90%">
<br>
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Admin</span>
                <i class="icon-layers menu-icon"></i>
              </a>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Courses</span>
                <i class="icon-layers menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-class.php">Add Class</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-class.php">Manage Class</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="students.php" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title">Students</span>
                <i class="icon-people menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-students.php">Add Students</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-students.php">Manage Students</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="doctors.php" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title">Doctors</span>
                <i class="icon-people menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-students.php">Add doctors</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-students.php">Manage doctors</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="Ta.php" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title">TAs</span>
                <i class="icon-people menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-students.php">Add TAs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-students.php">Manage TAs</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">schedules</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-notice.php"> Add schedules </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-notice.php"> Manage schedules </a></li>
                </ul>
              </div>
            </li>
     

              <li class="nav-item">
              <a class="nav-link" href="between-dates-reports.php">
                <span class="menu-title">Reports</span>
                <i class="icon-notebook menu-icon"></i>
              </a>
               </li>
               
               <a class="nav-link" data-toggle="collapse" href="SignOut.php" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title">Log Out</span>
                <i class="icon-people menu-icon"></i>
              </a>
               </li>

            </li>
          </ul>
        </nav>
</body>
</html>