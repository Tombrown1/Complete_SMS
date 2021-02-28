<?php 
 
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();

    session_start();

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
   
    $all_student = get_all_student($mysqli);
    
    //$update_student = update_student_by_id($std_id);

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
            <h1 align="center">Students Record</h1>         
            </div> 
     </main>
    <!-- Search function query form begins here! -->

<div class="container">
    <div class="col-md-4" style="float: right;">
        <form action="search.php" method="GET">
            <div class="input-group">
                <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="submit"  class="btn btn-outline-primary"> <a href="search.php"></a> search</button>
            </div>
        </form>
    </div>
     <br><br>
        <table class="table table-striped">
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
             <thead>
             <tbody>
             <?php 
            $cnt =1;
              if(mysqli_num_rows($all_student)>0){
                
                while($rows = mysqli_fetch_assoc($all_student))
                {
               
              ?>
             
                <tr>
                    <!-- <td><?php //echo $rows['std_id']  ?></td> -->
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $rows['std_name'] ?></td>
                    <td><?php echo $rows['std_email'] ?></td>
                    <td><?php echo $rows['std_phone'] ?></td>
                    <td> 
                    <?php  
                      //  $course_result = get_course_by_id($mysqli, $course_id);
                      $result = get_all_course($mysqli);
                      if(mysqli_num_rows($result)>0){
                          while($coz_row = mysqli_fetch_assoc($result)){
                              $course_id = $coz_row['course_id'];
                              $course_name = $coz_row['course_name'];

                              // Check if this is the courses checked by the student then echo them.
                           $sel_coz_result = get_student_courses_by_std_id($mysqli, $new_stud_id = $rows['std_id']);
                           $check_course = false;
                           if(mysqli_num_rows($sel_coz_result)>0){
                               while($chk_coz_row = mysqli_fetch_assoc($sel_coz_result)){
                                   $chk_course_id = $chk_coz_row['course_id'];

                                   if($chk_course_id == $course_id){
                                       $check_course = true;
                                       break;
                                   }
                               }
                           } 
                                if($course_id == $check_course){
                                    echo $course_name. ",";
                                }
                        ?>

                        <?php
                          }
                      }
                      
                    ?>
                    </td>
                    <td>
                    <?php 
                       $result = get_gender_by_id($mysqli, $gender_id = $rows['gender_id']);
                       while($row = mysqli_fetch_assoc($result)){
                           $gender_id = $row['gender_id'];
                           $gender_name = $row['gender_name'];
                       }
                       echo $gender_name;
                     ?>                    
                    </td>
                    <td><?php                     
                      $result = get_sponsor_by_id($mysqli, $sponsor_id = $rows['sponsor_id']);
                      if(mysqli_num_rows($result)){
                        while($row = mysqli_fetch_assoc($result)){
                            $sponsor_id = $row['sponsor_id'];
                            $sponsor_name = $row['sponsor_name'];
                        }
                        echo $sponsor_name;
                    }else{
                        echo "Nil";
                    }
                                             
                    ?></td>
                    <td>
                    <?php                     
                       $result=get_duration_by_id($mysqli, $duraion_id = $rows['duration_id']);
                        while($row = mysqli_fetch_assoc($result)){
                            $duration_id = $row['duration_id'];
                            $duration_name = $row['duration_name'];
                        }    
                        echo $duration_name;               
                    ?>                    
                    </td>
                    <td>
                        <?php                     
                         $result = get_payment_type_by_id($mysqli, $pay_type_id = $rows['pay_type_id']);
                         while($row = mysqli_fetch_assoc($result)){
                             $pay_type_id = $row['pay_type_id'];
                             $payment_type = $row['payment_type'];
                         }
                         echo $payment_type;
                     ?></td>
                     <td><a href="student_profile.php?view=1&std_id=<?php echo $rows['std_id'] ?>" class="btn btn-primary"  >View</a></td>
                    <!-- <td><a href="add_student.php?update=1&std_id=<?php echo $student_row['std_id'] ?>" class="btn btn-info" title="click to edit" onclick="return confirm('Sure to edit ?')"  >EDIT</a></td> -->
                    <!-- <td><a href="home.php?delete=1&std_id=<?php echo $rows['std_id'] ?>" class="btn btn-danger" title="click to delete" onclick="return confirm('Do you want to Delete')" >Delete</a></td> -->
                </tr>
             <?php
               $cnt ++;  
                }
              }
              ?>
            </tbody>
            </table>
        </div>
      
<?php
    include_once '../navbars/footer.php';
?>