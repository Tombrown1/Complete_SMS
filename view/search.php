<?php 
 
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();

    session_start();
    $search_value = 0;
    if(!isset($_SESSION['user_id'])){       
        header("Location: signup.php");
        exit();
    }else{
        //echo "<p> Welcome " .$_SESSION['name']. "</p>";
    }
    
     include_once '../includes/students.php';
     include_once '../includes/courses.php';
     include_once '../includes/gender.php';
     include_once '../includes/duration.php';
     include_once '../includes/payment_type.php';
     include_once '../includes/sponsor.php';
     include_once '../includes/student_courses.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record System</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <!-- <link href="navbar-top-fixed.css" rel="stylesheet"> -->
</head>
<body>  
    <?php
        include_once '../navbars/menu.php';
    ?>
        <main class="container">
            <div class="welcome text-center py-5 px-3"><br>
            <h3 align="center">Student search result</h3>         
            </div> 
     </main>
        <div class="container">
        <a href="students.php" class="btn btn-primary" role="button">Back</a> <br>
            <table class="table table-striped">
            <br>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th >Course</th>
                        <th>Gender</th>
                        <th>Sponsor</th>
                        <th>Duration</th>
                        <th>Payment</th>
                        <th colspan="2">Action</th>
                    
                    </tr>
                </thead>
                <tbody>
                <?php
    // student search results begins here!
    if(isset($_GET['search'])){
        $search_value = $_GET['search'];
        $search_result = search_student_by_name($mysqli, $search_value);
        if(mysqli_num_rows($search_result)>0){
            while ($search_row = mysqli_fetch_assoc($search_result)) {
        ?> 
            <tr>
                <td><?php  echo $search_row['std_id']; ?></td>
                <td><?php  echo $search_row['std_name']; ?></td>
                <td><?php  echo $search_row['std_email']; ?></td>
                <td><?php  echo $search_row['std_phone']; ?></td>
                <td>
                <?php 
                
                // select course by student id in course table                            
                $result = get_all_course($mysqli);
                if(mysqli_num_rows($result)>0){
                    while($coz_row = mysqli_fetch_array($result)){
                        $course_id = $coz_row['course_id'];
                        $course_name = $coz_row['course_name'];

                        //Check for courses selected by student and fetch them from the course loop.
                        $sel_coz_result = get_student_courses_by_std_id($mysqli, $new_stud_id = $search_row['std_id']);
                        $check_course = false;
                        if(mysqli_num_rows($sel_coz_result)>0){
                            while($chk_coz_row = mysqli_fetch_array($sel_coz_result)){
                                $chk_course_id = $chk_coz_row['course_id'];

                                if($chk_course_id == $course_id){
                                    $check_course = true;
                                    break;
                                }
                            }
                        }

                        if($course_id == $check_course){
                            echo $course_name.",";
                        }
                    }}
                ?>
                </td>
                <td>
                <?php
                    // Fetch student gender from student table using their gender id
                    //$std_gender_id = $search_row['gender_id'];                           
                    $gender = get_gender_by_id($mysqli, $gender_id =  $search_row['gender_id']);
                               if(mysqli_num_rows($gender)>0){
                                   while($gen_row = mysqli_fetch_assoc($gender)){
                                       $gender_id = $gen_row['gender_id'];
                                       $gender_name = $gen_row['gender_name'];
                                   }
                                   echo $gender_name;
                               }
                ?></td>
                <td>
                    <?php
                        // Fetch student sponsor from student table using their sponsor id
                        $sponsor_id = $search_row['sponsor_id'];
                        $sponsor = get_sponsor_by_id($mysqli, $sponsor_id = $sponsor_id);
                                    if(mysqli_num_rows($sponsor)>0){
                                        while($spon_row = mysqli_fetch_array($sponsor)){
                                            $sponsor_id = $spon_row['sponsor_id'];
                                            $sponsor_name = $spon_row['sponsor_name'];
                                        }
                                        echo $sponsor_name;
                                    }
                    ?>
                </td>
                <td>
                    <?php
                         $duration_id = $search_row['duration_id'];
                         $duration = get_duration_by_id($mysqli, $duration_id = $duration_id);
                             if(mysqli_num_rows($duration)>0){
                                 while($dura_row = mysqli_fetch_array($duration)){
                                     $duration_id = $dura_row['duration_id'];
                                     $duration_name = $dura_row['duration_name'];
                                 }
                                 echo $duration_name;
                             }
                    ?>
                </td>
                    <td>
                        <?php
                            $pay_type_id = $search_row['pay_type_id'];
                            $payment = get_payment_type_by_id($mysqli, $pay_type_id = $pay_type_id);
                                if(mysqli_num_rows($payment)>0){
                                    while($pay_row = mysqli_fetch_array($payment)){
                                        $pay_type_id = $pay_row['pay_type_id'];
                                        $pay_type_name = $pay_row['payment_type'];
                                    }
                                    echo $pay_type_name;
                                }
    
                        ?>
                    </td>
                    <td>
                    <td><a href="student_profile.php?view=1&std_id=<?php echo $search_row['std_id']; ?>" class="btn btn-primary"  >View</a></td>
                    </td>
            </tr>

     

<?php 
 }   } }
?>
                </tbody>
            </table>
        </div>







<?php
    include_once '../navbars/footer.php';
?>