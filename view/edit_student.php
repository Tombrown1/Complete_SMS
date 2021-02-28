        <?php
            include_once '../connection/database_conn.php';
            $mysqli = connect_db();

            session_start();
            
            if(!isset($_SESSION['user_id'])){
                header("Location: login.php");
                exit();
            }

            include '../includes/students.php';
            include '../includes/courses.php';
            include '../includes/student_courses.php';
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
                $payment_id  = $_POST['payment_id'];
                $pay_type_id = $_POST['pay_type_id'];
                $fileNewname     = $_FILES['image'];
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
        
      $update_stud_id =   update_student_by_id($mysqli, $std_id, $std_name, $std_email, $std_phone, $gender_id,$sponsor_id, $duration_id, $payment_id, $pay_type_id, $fileNewname);
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

