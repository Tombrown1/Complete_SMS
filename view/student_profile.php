<?php 
    
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();
    $student_rows = 0;
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
    $user_id = $_SESSION['user_id'];

     include_once '../includes/students.php';
     include_once '../includes/courses.php';
     include_once '../includes/gender.php';
    // include_once '../includes/sponsor.php';
    include_once '../includes/duration.php';
    // include_once '../includes/payment_type.php';
     include_once '../includes/payment.php';
     include_once '../includes/student_courses.php';
    
    if(isset($_GET['view'])){
        $std_id = $_GET['std_id'];
        $result = get_student_by_id($mysqli, $std_id);
        $student_rows = mysqli_fetch_assoc($result);
    }

    if(isset($_GET['delete'])){
        $std_id = $_GET['std_id'];
        $delete_student = delete_student_by_id($mysqli, $std_id);

        if($delete_student){
            header("Location: home.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <style>
        body{
    padding-top: 68px;
    padding-bottom: 50px;
}
        .image-container {
            position: relative;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .image-container:hover .image {
            opacity: 0.3;
        }

        .image-container:hover .middle {
            opacity: 1;
        }
    </style>
</head>
<body>
    <?php
        include_once '../navbars/menu.php'; 
    ?>      
          <main class="container">
            <div class="welcome text-center py-5 px-3"> <br>
            <h4 align="center">Student Profile</h4> <br> 
            <p class="float-left"><a href="students.php" class="btn btn-primary" role="button">Back</a></p>          
            </div> 
                        
        </main>   
    
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title mb-4">
                                    <div class="d-flex justify-content-start">
                                
                                    <?php

                                    // $profile = $student_rows['image'];
                                    // if($profile){
                                        
                                    //     echo "<img src='images/profile".$profile."'/>";
                                    // }

                                      $profile_image = $student_rows['image'];
                                      if($profile_image){
                                          echo "<img src='../images/".$profile_image."'/>";
                                      }
                                    
                                    ?>
                                        <!-- <img src="#" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" /> -->
                                        <div class="middle">
                                            <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                            <input type="file" style="display: none;" id="profilePicture" name="file" />
                                        </div>
                                    </div>

                                    <div class="userData ml-3">
                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">
                                        <?php
                                           echo $student_rows['std_name'];
                                        ?>
                                        
                                        </a></h2>
                                    </div>
                                    <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                     </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-primary" id="edit-tab" data-toggle="tab" href="add_student.php?update=1&std_id=<?php echo $student_rows['std_id'] ?>"  role="tab" aria-controls="edit" aria-selected="false">Edit</a>
                                            <!-- <a href="#" class="nav-link btn btn-danger" role="tab">Delete</a> -->
                                        </li> 
                                        <li class="nav-item ">
                                            <a class="nav-link btn btn-danger" id="delete-tab" data-toggle="tab" href="home.php?delete=1&std_id=<?php echo $student_rows['std_id'] ?>" role="tab" aria-controls="delete" title="click to edit" onclick="return confirm('Are you sure, you want to delete ?')" aria-selected="false">Delete</a>
                                            <!-- <a href="#" class="nav-link btn btn-info" role="tab"> Edit</a> -->
                                        </li>
                                    </ul>

                                    <div class="tab-content m1-1" id="myTabcontent">
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Full Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $student_rows['std_name'] ?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Email</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $student_rows['std_email'] ?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Phone Number</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $student_rows['std_phone'] ?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Course</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                        <?php 
                                            $result = get_all_course($mysqli);
                                            if(mysqli_num_rows($result)>0){
                                                while($coz_row = mysqli_fetch_array($result)){
                                                    $course_id = $coz_row['course_id'];
                                                    $course_name = $coz_row['course_name'];

                                                    //Check for courses selected by student and fetch them from the course loop.
                                                    $sel_coz_result = get_student_courses_by_std_id($mysqli, $new_stud_id = $student_rows['std_id']);
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
                                            ?>
                                            <?php
                                                }
                                            }
                                        ?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Gender</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php 
                                                // echo $student_rows['gender_id'];
                                                // exit;
                                                $result = get_gender_by_id($mysqli, $gender_id = $student_rows['gender_id']);
                                                if(mysqli_num_rows($result)){
                                                    while($rows = mysqli_fetch_assoc($result)){
                                                        $gender_id = $rows['gender_id'];
                                                        $gender_name = $rows['gender_name'];
                                                    }
                                                }
                                                echo $gender_name;
                                                ?>
                                            </div>
                                        </div>
                                        <hr />
                                   
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Course Duration</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php 
                                                $result = get_duration_by_id($mysqli, $duration_id = $student_rows['duration_id']);                                                
                                                    while($rows = mysqli_fetch_assoc($result)){
                                                        $duration_id = $rows['duration_id'];
                                                        $duration_name = $rows['duration_name'];
                                                        
                                                    }                                               
                                              echo $duration_name;
                                                ?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Training Fee</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php 
                                                    $result = get_payment_by_id($mysqli, $payment_id = $student_rows['payment_id']);  
                                                    if(mysqli_num_rows($result) > 0){
                                                        while($pay_rows = mysqli_fetch_array($result)){
                                                            $amount = $pay_rows['amount'];
                                                          
                                                        }
                                                    }
                                                      echo $amount;                                      
                                                    
                                                ?>
                                            </div>
                                        </div>
                                        <hr />

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
       </div>

    <?php
    include_once '../navbars/footer.php';
    ?>
