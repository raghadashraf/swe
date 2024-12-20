function toggleRoleOptions() {
    var role = document.getElementById('role').value;
    var majorDiv = document.getElementById('majorDiv');
    var facultyRoleDiv = document.getElementById('facultymemberrole');
    // Show Major dropdown if the role is "Student"
    majorDiv.style.display = role === 'Student' ? 'block' : 'none';
    // Show Faculty Member Role dropdown if the role is "Faculty Member"
    facultyRoleDiv.style.display = role === 'Faculty Member' ? 'block' : 'none';
  }
  function toggleFMRoleOptions(){
      var fMR=document.getElementById('FMRole').value;
      var FMMD=document.getElementById('facultyDiv');
      FMMD.style.display = (fMR === 'Doctor' || fMR === 'TA') ? 'block' : 'none';
  }