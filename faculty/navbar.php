 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="enroll_exam_list.php">Enroll Request List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="enroll_student_results.php">Enrolled Student Results</a>
                </li>
   </ul>
      <div class="d-flex">
      <a class="nav-link" style="color:#C7C8C9" href="faculty_profile.php">Profile(<?php echo Session::get('name') ?>)</a>
      <a class="nav-link "  style="color:#C7C8C9" href="?action=logout">Logout</a>  
      </div>
    </div>
  
</nav>