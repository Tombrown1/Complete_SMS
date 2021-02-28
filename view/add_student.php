<?php 
    
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();

    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
    $student_row = 0;
    //$user_id = $_SESSION['user_id'];

    include_once '../includes/students.php';
    include_once '../includes/courses.php';
    include_once '../includes/courses.php';
    include_once '../includes/gender.php';
    include_once '../includes/sponsor.php';
    include_once '../includes/duration.php';
    include_once '../includes/payment.php';
    include_once '../includes/payment_type.php';
    include_once '../includes/student_courses.php';
    include_once '../users/includes/stud_user.php';

    //extract($_POST);
    if(isset($_POST['submit'])){

        $std_id       = time();
        $std_name     = $_POST['std_name'];
        $username     = $_POST['username'];
        $password     = $_POST['password'];
        $confirm_pass     = $_POST['confirm_pass'];
        if($password == $confirm_pass){
            $pass_confirm = true;
        }else{
            $pass_confirm = false;
            
        }
        $std_email    = $_POST['std_email'];
        $std_phone    = $_POST['std_phone'];
        //$course_id    = $_POST['course_id'];        
        $gender_id    = $_POST['gender_id'];
        $sponsor_id   = $_POST['sponsor_id'];
        $duration_id  = $_POST['duration_id'];
        $payment_id   = $_POST['payment_id'];
        $pay_type_id  = $_POST['pay_type_id'];
        $fileNewname  = $_FILES['image'];

       

           
        if(empty($_POST['std_name'])){
            die("Student name must not be empty");
        }
        // print_r($filename);
        // exit;
        if(isset($_FILES['image']))
        $filename  = $_FILES['image']['name'];
        $filetemp  = $_FILES['image']['tmp_name'];
        $filesize  = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $filetype  = $_FILES['image']['type'];

        $fileExt   = explode(".", $filename);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpeg', 'jpg', 'png', 'pdf');
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($filesize < 1000000){
                    $fileNewname = "Profile".$std_id. "_" .  rand(0, 9999999999). ".". $fileActualExt;
                    $filedestination = "../images/". $fileNewname;
                    move_uploaded_file($filetemp, $filedestination);
                }else{
                    echo "Your file is too large";
                }
            }else{
                echo "there was an error uploading your file";
            }
        }else{
            echo "You cannot upload this file type";
        }

        $check_email =  check_student_email($mysqli,$std_email);
        $check_phone =  check_student_phone($mysqli,$std_phone);
        if(mysqli_num_rows($check_email) > 0){
              echo ' <script>
                    alert("Email address is already used by another user!");
                </script>';
            }else if(mysqli_num_rows($check_phone) > 0){
            
                echo '<script>
                        alert("Phone Number is already used by another user!");
                    </script>';
            }else{
        $new_stud_id = insert_student($mysqli, $std_name, $std_email, $std_phone,$gender_id,$sponsor_id, $duration_id, $payment_id, $pay_type_id, $fileNewname);
            // Get student id from student table immediately after insertion
            //$std_id = mysqli_insert_id($mysqli);

            $selected_courses=$_POST['course'];
            //loop through selected courses 
            foreach ($selected_courses as $course_value) {
               // check if the course has earlier been added to the students course list
              $check_course_has_been_added= get_student_course_single_id($mysqli, $new_stud_id, $course_value);
              if(mysqli_num_rows($check_course_has_been_added)>0){
                //if it is greather than 0 the course exist 
                //do whatever you want here e.g. remove the course from list
              }else {
                  //else add the new selected course to the student course list
                 
                  insert_student_courses($mysqli, $new_stud_id, $course_value);
              }
                
            }
            // This line of code is used to add new student and insert their login details to Student_user table using mysqli insert id.
            insert_users($mysqli, $new_stud_id, $username, $password);

            echo '<script>
                       alert("You have registered successfully");
                       window.location ="home.php";
                   </script>';

        // $result = get_all_course($mysqli);
        // if(mysqli_num_rows($result)>0){
        //     while($row_course = mysqli_fetch_assoc($result)){
        //         $course_id = $row_course['course_id'];
        //         if($_POST['course'.$course_id] == $course_id)
        //         {
                    

        //             //header("Location: home.php");
        //             echo '<script> 
        //                     alert("New Student added successfully.");
        //                     window.location="home.php";
        //                 </script>';

        //         }
        //     }
        // }

       
        
  }
}

if(isset($_GET['update'])){
    $operation_msg='Edit Record';
}else{
     $operation_msg='Add New Student';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <?php
        include_once '../navbars/menu.php'; 
    ?>      
          <main class="container">
            <div class="welcome text-center py-5 px-3"> <br>
            <h4 align="center"> <?php echo  $operation_msg ?> </h4> <br>           
            </div>             
        </main>   
    
        <div class="container">
            <div class="col-md-6">
                <?php
                    if(isset($_GET['update'])){
                        $std_id = $_GET['std_id'];
                        $result = get_student_by_id($mysqli, $std_id);
                        $student_row = mysqli_fetch_assoc($result);
                    ?>
                        <!-- update Form -->
                        <form action="edit_student.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="std_id" class="form-control" value="<?php echo $student_row['std_id'] ?>">
            </div>
            <div class="form-group">
                <label for="std_name">Student Name</label>
                <input type="text" name="std_name" class="form-control" value="<?php echo $student_row['std_name'] ?>">
            </div>
            <div class="form-group">
                <label for="std_email">Student Email</label>
                <input type="email" name="std_email" class="form-control" value="<?php echo $student_row['std_email'] ?>">
                <input type="hidden" name="std_email_old" class="form-control" value="<?php echo $student_row['std_email'] ?>">
            </div>
            <div class="form-group">
                <label for="std_phone">Student phone</label>
                <input type="text" name="std_phone" class="form-control" value="<?php echo $student_row['std_phone'] ?>">
            </div>
            <!-- Edit selected course using checked box -->
            <div class="form-group">
                <span>Choose Courses offered</span> <br>
                <?php                   
                    $result = get_all_course($mysqli);
                    if(mysqli_num_rows($result)>0){
                        while($row_course = mysqli_fetch_assoc($result)){
                            $course_id = $row_course['course_id'];
                            $course_name = $row_course['course_name'];                              

                            //Check if the student selected the course
                            $chk_result = get_student_courses_by_std_id($mysqli, $new_stud_id = $student_row['std_id']);
                            $checked = false;
                            if(mysqli_num_rows($chk_result)>0){    
                                while($row_checked_course = mysqli_fetch_assoc($chk_result)){
                                    $checked_course_id = $row_checked_course['course_id'];
                                   // echo "Checked CourseID: ".$checked_course_id;
                                    if($checked_course_id == $course_id)
                                    {
                                       $checked = true;
                                        //echo "true";                                      
                                        break;
                                    }
                                }
                            }
                           // echo "Course: ".$course_id;
                        //    if("Course: ".$course_id == $checked){
                        //        echo $course_id;
                        //    }                           
                ?>
                <input type="checkbox" name='<?php echo "update_course[]" ?>' value="<?php echo $course_id; ?>" <?php if($checked==true){echo "checked";}?>> &nbsp;&nbsp;&nbsp; <?php echo $course_name; ?><br/>
               <?php
                            
                 }
                }
                
               ?>
            </div>               
            <div class="form-group">                
                <label for="course_id">Course</label>
                <select class="form-control" name="course_id" id="course_id">
                    <?php
                           $result  = get_all_course($mysqli);
                            if(mysqli_num_rows($result)){
                                while($rows = mysqli_fetch_assoc($result)){
                                    $course_id = $rows['course_id'];
                                    $course_name = $rows['course_name'];  
                                                             
                    ?>
                           <option value="<?php echo $course_id ?>" <?php if($course_id==$student_row['course_id']){echo "selected";} ?>><?php echo $course_name ?></option>

                    <?php 
                    }
                }  
                ?>
                </select>
            
            <div class="form-group">
                <label for="gender_id">Gender</label>
                <select class="form-control" name="gender_id">
                    <?php                    
                    $gender = get_gender($mysqli);                        
                    if(mysqli_num_rows($gender)){                            
                        while($rows = mysqli_fetch_assoc($gender)){
                            $gender_id = $rows['gender_id'];
                            $gender_name = $rows['gender_name'];                            
                    ?>
                   <option value="<?php echo $gender_id ?>" <?php if($gender_id == $student_row['gender_id']){echo "selected";} ?> ><?php echo $gender_name ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sponsor_id">Sponsor</label>
                <!-- <input type="text" name="sponsor_id" class="form-control"> -->
                <select class="form-control" name="sponsor_id">
                        <?php
                        $sponsor = get_all_sponsor($mysqli);
                        if(mysqli_num_rows($sponsor)){
                            while($rows = mysqli_fetch_assoc($sponsor)){
                                $sponsor_id = $rows['sponsor_id'];
                                $sponsor_name = $rows['sponsor_name'];
                        ?>
                        <option value="<?php echo $sponsor_id ?>" <?php if($sponsor_id == $student_row['sponsor_id']){echo "selected";} ?>><?php echo $sponsor_name ?></option>
                        <?php
                            }
                        }
                        ?>
                </select> 
            </div>
            <div class="form-group">
                <label for="duration_id">Course Duration</label>                   
                <select class="form-control" name="duration_id">
                    <?php
                        $duration = get_duration($mysqli);
                        if(mysqli_num_rows($duration)){
                            while($rows = mysqli_fetch_assoc($duration)){
                                $duration_id = $rows['duration_id'];
                                $duration_name= $rows['duration_name'];
                        ?>
                            <option value="<?php echo $duration_id ?>"<?php if($duration_id == $student_row['duration_id']){echo "selected";} ?>><?php echo $duration_name ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="payment_id">Amount Paid</label>
                <select class="form-control" name="payment_id">
                    <?php
                        $amount_payed = get_all_payment($mysqli);
                        if(mysqli_num_rows($amount_payed)){
                            while($rows = mysqli_fetch_assoc($amount_payed)){
                                $payment_id = $rows['payment_id'];
                                $amount= $rows['amount'];
                        ?>
                            <option value="<?php echo $payment_id ?>"<?php if($payment_id == $student_row['payment_id']){echo "selected";} ?>><?php echo $amount ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            </div>   
            <div class="form-group">
                <label for="pay_type_id">Payment Method</label>
                <select class="form-control" name="pay_type_id">
                    <?php
                        $pay_type = get_payment_type($mysqli);
                        if(mysqli_num_rows($pay_type)){
                            while($rows = mysqli_fetch_assoc($pay_type)){
                                $pay_type_id = $rows['pay_type_id'];
                                $payment_type= $rows['payment_type'];
                        ?>
                            <option value="<?php echo $pay_type_id ?>" <?php if($pay_type_id == $student_row['pay_type_id']){echo "selected";} ?>><?php echo $payment_type ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            </div>
                
            <div class="form-group">
                <label for="image">Upload Passport</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" name="update" class="btn btn-primary">Submit</button>
            </form>

                    <!-- Add New Student Form begins here ! -->
               <?php
                 }else{
                ?>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" id="student_record" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="std_name">Student Name</label>
                <input id="name" type="text" name="std_name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group" <?php if(isset($email_error)): ?> class="form_error" <?php endif ?>>
                <label for="std_email">Student Email</label>
                <input type="email" name="std_email" class="form-control" value="<?php //echo $std_email; ?>" placeholder="Enter Email">
                <?php if(isset($email_error)): ?>
                <span><?php echo $email_error; ?></span>
                <?php endif ?>
            </div>
            <div class="form-group" <?php if(isset($phone_error)): ?> class="form_error" <?php endif ?>>
                <label for="std_phone">Student phone</label>
                <input type="text" name="std_phone" class="form-control" placeholder="Enter Phone No">
                <?php if(isset($phone_error)): ?>
                <span><?php echo $phone_error; ?></span>
                <?php endif ?>
            </div>
                    <!-- select course using checked box -->
             <div class="form-group">
                <span>Choose Courses offered</span> <br>
                <?php
                    $result = get_all_course($mysqli);
                    if(mysqli_num_rows($result)>0){
                        while($row_course = mysqli_fetch_assoc($result)){
                            $course_id = $row_course['course_id'];
                            $course_name = $row_course['course_name'];
                            
                ?>
                <!-- <input type="checkbox" name='<?php echo "course".$course_id; ?>' value="<?php echo $course_id; ?>"> &nbsp;&nbsp;&nbsp; <?php echo $course_name; ?><br/> -->
                
                <input type="checkbox" name='course[]' value="<?php echo $course_id; ?>"> &nbsp;&nbsp;&nbsp; <?php echo $course_name; ?><br/>
               <?php
                 }
                }
               ?>
            </div>            
            <div class="form-group">
                <label for="gender_id">Gender</label>
                <!-- <input type="text" name="gender_id" class="form-control" placeholder="Enter Gender"> -->
                <select class="form-control" name="gender_id">
                    <option value="">Select Gender</option>
                    <?php
                        $gender = get_gender($mysqli);
                        if(mysqli_num_rows($gender)){
                            while($rows = mysqli_fetch_assoc($gender)){
                                $gender_id = $rows['gender_id'];
                                $gender_name = $rows['gender_name'];
                        ?>
                        <option value="<?php echo $gender_id; ?>"><?php echo $gender_name; ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <!-- <div class="form-group">
                    <label for="gender_id"> Gender</label><br>
                    <?php
                        $gender = get_gender($mysqli);
                        if(mysqli_num_rows($gender)){
                            while($rows = mysqli_fetch_assoc($gender)){
                                $gender_id = $rows['gender_id'];
                                $gender_name = $rows['gender_name'];
                            }
                        ?>
                    <input type="radio" name="gender_id" <?php if(isset($gender_name) && $gender_name=="female") echo $gender_name; ?> value="female"> Female
                    <input type="radio" name="gender_id" <?php if(isset($gender_name) && $gender_name=="male") echo $gender_name; ?> value="male"> Male
                    <input type="radio" name="gender_id" <?php if(isset($gender_name) && $gender_name=="other") echo $gender_name; ?> value="others"> Others
                    <?php
                            
                        }
                    ?>
            </div> -->
            <div class="form-group">
                <label for="sponsor_id">Sponsor</label>
                 <!-- <input type="text" name="sponsor_id" class="form-control"> -->
                <select class="form-control" name="sponsor_id">
                    <option value="">Sponsor</option>
                        <?php
                        $sponsor = get_all_sponsor($mysqli);
                        if(mysqli_num_rows($sponsor)){
                            while($rows = mysqli_fetch_assoc($sponsor)){
                                $sponsor_id = $rows['sponsor_id'];
                                $sponsor_name = $rows['sponsor_name'];
                        ?>
                        <option value="<?php echo $sponsor_id ?>"><?php echo $sponsor_name ?></option>
                        <?php
                            }
                        }
                        ?>
                </select> 
            </div>  
            <div class="form-group">
                <label for="duration_id">Course Duration</label>                   
                <select class="form-control" name="duration_id">
                    <option value="">duration</option>
                <?php
                    $duration = get_duration($mysqli);
                    if(mysqli_num_rows($duration)){
                        while($rows = mysqli_fetch_assoc($duration)){
                            $duration_id = $rows['duration_id'];
                            $duration_name= $rows['duration_name'];
                    ?>
                        <option value="<?php echo $duration_id ?>"><?php echo $duration_name ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>  
            <div class="form-group">
                <label for="payment_id">Amount Paid</label>
                <select class="form-control" name="payment_id">
                            <option value="">Amount</option>
                    <?php
                        $amount_payed = get_all_payment($mysqli);
                        if(mysqli_num_rows($amount_payed)>0){
                            while($rows = mysqli_fetch_assoc($amount_payed)){
                                $payment_id = $rows['payment_id'];
                                $amount= $rows['amount'];                                
                        ?>
                            <option value="<?php echo $payment_id ?>"><?php echo $amount ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            </div>              
            <div class="form-group">
                <label for="pay_type_id">Payment Method</label>
                <select class="form-control" name="pay_type_id">
                            <option value="">Method</option>
                    <?php
                        $pay_type = get_payment_type($mysqli);
                        if(mysqli_num_rows($pay_type)){
                            while($rows = mysqli_fetch_assoc($pay_type)){
                                $pay_type_id = $rows['pay_type_id'];
                                $payment_type= $rows['payment_type'];

                                
                        ?>
                            <option value="<?php echo $pay_type_id ?>"><?php echo $payment_type ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Upload Passport</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label for="confirm_pass">Confirm Password</label>
                <input type="password" name="confirm_pass" value="<?php //if(!$pass_confirm){echo "Password does not match";} ?>" class="form-control" placeholder="Enter Password">
            </div>
            

            <button type="submit" name="submit" class="btn btn-primary">Submit</button> &nbsp;&nbsp;
            <button class="btn btn-primary"><a href="add_sponsor.php"></a>Add Sponsor</button>
            </form>
              <?php
              }
                ?>
            
            </div>
            <div class="col-md-6"></div>
        </div></div>
        <br>

    <?php
    include_once '../navbars/footer.php';
    ?>


    <script>
    var form = document.getElementById("student_record");
    
    form.addEventListener("submit", function(){
        var name = document.getElementById("name").value;
if(!name){
 alert("Name is Required");
 return false;
    }
    });
    
    </script>