  <?php
    if(isset($_SESSION['user_id'])){
    ?>
      <nav class="navbar navbar-expand-md navbar-dark bg-info fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Student Record System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
      <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="home.php">Home</a>
        </li> 
        <li class="nav-item ">
          <a class="nav-link" aria-current="page" href="students.php">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_student.php">Add New Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_course.php">Add Course</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_sponsor.php">Add Sponsor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_payment.php">Add Payment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_admin.php">Admin</a>
        </li>            
      </ul>
      <ul class="navbar-nav ml-auto mb-2 mb-md-0">
      <li class="nav-item ">
          <a class="nav-link " href="#"><?php echo "Hello ". $_SESSION['name'] ?></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
   <?php }else{
     ?>
    <nav class="navbar navbar-expand-md navbar-dark bg-info fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Student Record System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">          
      <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="home1.php">Home</a>
        </li>       
      </ul>
      <ul class="navbar-nav ml-auto mb-2 mb-md-0">
      <li class="nav-item ">
          <a class="nav-link " href="signup.php">Signup</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="login.php">Login</a>
        </li>     
      </ul>
    </div>
  </div>
</nav>
  <?php } ?>
