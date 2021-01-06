<?php 
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();
    include_once '../includes/users.php';

    extract($_POST);
    $check_user_email = check_email_ID($mysqli, $email);
        if(mysqli_num_rows($check_user_email) > 0){

            echo "Email ID Already Exist <br> . <a href='login.php'> Login</a> ";
           // header("Location: login.php");
            exit();
        }else{
            if(isset($_POST['submit'])){
                if(empty($_POST['name'])){
                    $error['error'] = true;
                }else{
                  $name = $_POST['name'];
                }
                if(empty($_POST['email'])){
                    $error['error'] = true;
                }else{
                    $email = $_POST['email'];
                }
                if(empty($_POST['password'])){
                    $error['error'] = true;
                }else{
                    $password = $_POST['password'];
                }
               
                //create safe values for input into the database
                $name     = mysqli_real_escape_string($mysqli, $name);
                $email    = mysqli_real_escape_string($mysqli, $email);
                $password = mysqli_real_escape_string($password, $password);
        
                insert_users($mysqli, $name, $email, $password);
             
            }
        }
    

    // if(isset($_POST['submit'])){
    //     if(empty($_POST['name'])){
    //         $error['error'] = true;
    //     }else{
    //       $name = $_POST['name'];
    //     }
    //     if(empty($_POST['email'])){
    //         $error['error'] = true;
    //     }else{
    //         $email = $_POST['email'];
    //     }
    //     if(empty($_POST['password'])){
    //         $error['error'] = true;
    //     }else{
    //         $password = $_POST['password'];
    //     }
    //     // $name      = $_POST['name'];
    //     // $email     = $_POST['email'];        
    //     // $password  = $_POST['password'];

    //     insert_users($mysqli, $name, $email, md5($password));
     
    // }



   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

    <!-- <script src="../assets/js/validate.js"></script> -->
    <!-- <script type="text/javascript" >
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const form = document.getElementById('form');
        const errorElement = document.getElementById('error');  

        form.addEventListener('submit', (e) => {
            let messages = []
            if(name.value === "" || name.value == null){
                messages.push("Name is Required");
            }

            if(email.value ==="" || email.value == null){
                messages.push("Email is required");
            }

            if(message.length > 0){
                e.preventDefault();
                errorElement.InnerText = messages.join(', ');
            }
        } );
    </script> -->

</head>
<body>
       <?php
        include_once '../navbars/menu.php';
    ?>
       
        <div class="jumbotron">
             <h1 align="center">Sign up</h1>
        </div>
   <div class="container">
       <div id="error"></div>
            <div class="col-md-6">                
            <form id="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            
            
            <button type="submit" name="submit" value="submit" id="submit-btn" class="btn btn-primary">Register</button> 
            </form>
            </div>
            <div class="col-md-6"></div>
        </div>
        <br><br>
        <?php
    include_once '../navbars/footer.php';
?>
</body>
</html>