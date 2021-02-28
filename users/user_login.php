<?php
    session_start();
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();
   include_once 'includes/stud_user.php';

    if(isset($_POST['login'])){

        $username   = $_POST['username'];
        $password   = $_POST['password'];

        //create safe values for input into the database
        $email    = mysqli_real_escape_string($mysqli, $username);
        $password = mysqli_real_escape_string($mysqli, $password);

     $result = login($mysqli, $username, $password);    
                if(mysqli_num_rows($result) > 0){
                    while($rows = mysqli_fetch_assoc($result)){
                        $_SESSION['student_id'] = $rows['new_stud_id'];
                        $_SESSION['username']   = $rows['username'];
                    }
               header("Location: index.php?login=success");
                exit();     
            }else{
               header("Location: user_login.php?login=error");
            }
            
        //echo $_SESSION['user_id'];
    // }else{
    //     header("Location: signup.php?login=error");
    //    exit();
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
<?php
        include_once 'stud_menu/menu.php';
    ?>
        <div class="jumbotron">
             <h1 align="center">Login to your account</h1>
             <!-- <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="add_course.php">Add Course</a></li>
                <li><a href="add_duration.php">Add Duration</a></li>
                <li><a href="add_student.php">Add Student</a></li>
             </ul> -->
        </div>

        <div class="container">
            <div class="col-md-6">
                
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>
            </div>
            <div class="col-md-6"></div>
        </div>
        <br><br><br><br><br><br><br>
       
        <?php
    include_once 'stud_menu/footer.php';
?>
</body>
</html>