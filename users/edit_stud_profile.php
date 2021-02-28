<?php
            include_once '../connection/database_conn.php';
            $mysqli = connect_db();

            session_start();
            if(!isset($_SESSION['student_id'])){
                header("Location: user_login.php");
                exit();
            }
            $user_id = $_SESSION['student_id'];

            include_once 'includes/students.php';
            include_once '../includes/courses.php';
            include_once '../includes/courses.php';
            include_once '../includes/gender.php';
            include_once '../includes/sponsor.php';
            include_once '../includes/duration.php';
            include_once '../includes/payment.php';
            include_once '../includes/payment_type.php';
            include_once '../includes/student_courses.php';
            include_once '../users/includes/stud_user.php';
 ?>

        <?php
            if(isset($_POST['update'])){
               // $std_id      = time();
                $std_id      = $_POST['std_id'];
                $std_name    = $_POST['std_name'];
                $std_email   = $_POST['std_email']; 
                $std_email_old = $_POST['std_email_old'];
                if($std_email==$std_email_old){
                    $skip_email_check=true;
                }else{
                    $skip_email_check=false;
                }
                if(!$skip_email_check){
                    $check_email =  check_student_email($mysqli,$std_email);
                    if(mysqli_num_rows($check_email) >0){
                        $email_exist=true;
                    }else{
                         $email_exist=false;
                    }
                }else{
                    $email_exist=false;
                }
                $std_phone   = $_POST['std_phone'];
               // $course_id   = $_POST['course_id'];
                $gender_id   = $_POST['gender_id'];
                $sponsor_id  = $_POST['sponsor_id'];
                $duration_id = $_POST['duration_id'];
                // $payment_id  = $_POST['payment_id'];
                // $pay_type_id = $_POST['pay_type_id'];
                $fileNewname = $_FILES['image'];
                // print_r($filename);
                // exit;
                if(isset($_FILES['image']))
                $filename = $_FILES['image']['name'];
                $filetemp = $_FILES['image']['tmp_name'];
                $filesize = $_FILES['image']['size'];
                $fileError = $_FILES['image']['error'];
                $filetype = $_FILES['image']['type'];

                $fileExt   = explode(".", $filename);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpeg', 'jpg', 'png', 'pdf');
                if(in_array($fileActualExt, $allowed)){
                    if($fileError === 0){
                        if($filesize < 1000000){
                            $fileNewname = "Profile".$std_id. "_" . rand(0, 9999999999). ".". $fileActualExt;
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
        
        if(!$email_exist){
        
      $update_stud_id =   update_student_by_id($mysqli, $std_id, $std_name, $std_email, $std_phone, $gender_id, $sponsor_id, $duration_id, $fileNewname);
      //Get the updated student id immediately and insert the id into student_course table
     
      $selected_courses=$_POST['update_course'];
      //before inserting new course, first remove the ones unchecked then proceed to insert new record
      delete_student_courses_by_student_id($mysqli, $std_id);
      //loop through selected courses 
      foreach ($selected_courses as $course_value){
         
        //then add the selected course to the student course list
        insert_student_courses($mysqli, $std_id, $course_value);
        
          
      }
      echo '<script>
      alert("Student record updated successfully");
      window.location="student_profile.php?view=1&std_id='.$std_id.'";
      </script>';
    }
    else{
        echo '<script> alert("Failed to update record, Email is used by another user kindly change email address"); 
        window.location="student_profile.php?view=1&std_id='.$std_id.'";
        </script>';
    }
     
    }
        ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Profile</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
<?php
        include_once 'stud_menu/menu.php'; 
    ?>
    <main class="container">
            <div class="welcome text-center py-5 px-3"> <br>
            <h4 align="center">Edit Student Profile</h4> <br>           
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
                        <form action="edit_stud_profile.php" method="post" enctype="multipart/form-data">
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
                
                <!-- This input field on students edit ends is commented so that student wil to have
                 access to edit the payment and  payment type they made except admin do so. -->

            <!-- <div class="form-group">
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
            </div>    -->
            <!-- <div class="form-group">
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
                    }
                    ?>
                </select>
            </div> -->
                
            <div class="form-group">
                <label for="image">Upload Passport</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" name="update" class="btn btn-primary">Submit</button>
            </form>
        </div>
    
    </div>
</body>
</html>

