 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item active">
                    <a class="nav-link" href="student_dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="enrolledexam.php">Enroll Exam</a>
                </li>
                
   </ul>
      <div class="d-flex">
      <a class="nav-link" style="color:#C7C8C9" href="student_profile.php">Profile(<?php echo Session::get('name') ?>)</a>
      <a class="nav-link "  style="color:#C7C8C9" href="?action=logout">Logout</a>  
      </div>
    </div>
  
</nav>
