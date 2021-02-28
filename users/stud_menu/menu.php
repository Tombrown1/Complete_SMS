  <?php
    if(isset($_SESSION['student_id'])){  
      $std_id = $_SESSION['student_id'];
    ?>
      <nav class="navbar navbar-expand-md navbar-dark bg-info fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Student Record System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse"> 

    <?php
                $select_student_record = get_student_by_id($mysqli, $std_id);
                if(mysqli_num_rows($select_student_record)>0){
                    while($stud_row = mysqli_fetch_assoc($select_student_record)){
                        $stud_id = $stud_row['std_id'];
                    }
                  }
                   
            ?>

      <ul class="navbar-nav me-auto mb-2 mb-md-0">    
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="student_profile.php?view=1&std_id=<?php echo $stud_id; ?>" class="btn-button">Profile</a>
        </li>
       
        
      </ul>
      <ul class="navbar-nav ml-auto mb-2 mb-md-0">
      <li class="nav-item ">
          <a class="nav-link " href="#"><?php echo "Hello ". $_SESSION['username'] ?></a>
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
          <a class="nav-link" aria-current="page" href="index1.php">Home</a>
        </li>          
      </ul>
      <ul class="navbar-nav ml-auto mb-2 mb-md-0">    
        <li class="nav-item ">
          <a class="nav-link " href="user_register.php">Signup</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="user_login.php">Login</a>
        </li>    
      </ul>
    </div>
  </div>
</nav>
  <?php } ?>
