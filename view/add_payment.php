    <?php
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();

    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }

    include_once '../includes/students.php';
    include_once '../includes/courses.php';
    include_once '../includes/payment_type.php';
    include_once '../includes/duration.php';
    include_once '../includes/gender.php';
    include_once '../includes/payment.php';

        if(isset($_POST['submit'])){
            $std_id = $_POST['std_id'];            
            $course_id = $_POST['course_id'];
            $duration_id = $_POST['duration_id'];
            $pay_type_id = $_POST['pay_type_id'];
            $payment_date = date('Y-m-d H:i:s');
            $amount       = $_POST['amount'];
            
            insert_payment($mysqli, $std_id, $course_id, $duration_id, $pay_type_id, $payment_date, $amount);
        }

        // Delete Payment Logic begins here!
        if(isset($_GET['delete'])){
            $payment_id = $_GET['payment_id'];
            $delete_payment = delete_payment_by_id($mysqli, $payment_id);

            if($delete_payment){
                header("Location: add_payment.php");
          }   
        }


        if(isset($_GET['update'])){
            $operation_msg = "Edit Student Payment Record";
        }else{
            $operation_msg = "Add Student Payment";
        }
    ?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Payment</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>

    <?php
        include_once '../navbars/menu.php'; 
    ?>      
          <main class="container">
            <div class="welcome text-center py-5 px-3"> <br>
            <h4 align="center"><?php echo $operation_msg; ?></h4> <br>           
            </div>             
        </main> 
        <div class="container">
            <div class="col-md-6">
            <!-- Payment Edit/Update logic begins here -->
                <?php
                    if(isset($_GET['update'])){
                        $payment_id = $_GET['payment_id'];
                        $result = get_payment_by_id($mysqli, $payment_id);
                        $payment_row = mysqli_fetch_assoc($result);
                    ?>
                    <!-- Form for editing of Payment. -->
                         <form action="edit_payment.php" method="post">
                         <div class="form-group">
                            <input type="hidden" name="payment_id" class="form-control" value="<?php echo $payment_row['payment_id'];?>">
                         </div>
            <div class="form-group">                   
                <label for="std_id">Student</label>
                <select class="form-control" name="std_id" id="">
                    <option value="">select student</option>
                    <?php
                        $student = get_all_student($mysqli);
                        if(mysqli_num_rows($student)){
                            while($rows = mysqli_fetch_assoc($student)){
                                $std_id = $rows['std_id'];
                                $std_name = $rows['std_name'];
                    ?>
                        <option value="<?php echo $std_id; ?>" <?php if($std_id == $payment_row['std_id']){echo "selected";} ?> ><?php echo $std_name; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="course_id">Course</label>
                <select class="form-control" name="course_id">
                    <option value="">choose course</option>
                    <?php
                           $result  = get_all_course($mysqli);
                            if(mysqli_num_rows($result)){
                                while($rows = mysqli_fetch_assoc($result)){
                                    $course_id = $rows['course_id'];
                                    $course_name = $rows['course_name'];                              
                    ?>
                           <option value="<?php echo $course_id ?>" <?php if($course_id == $payment_row['course_id']){echo "selected";} ?> ><?php echo $course_name ?></option>
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
                            <option value="<?php echo $duration_id ?>" <?php if($duration_id == $payment_row['duration_id']){echo "selected";} ?> ><?php echo $duration_name ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="pay_type_id">Payment</label>
                <select class="form-control" name="pay_type_id">
                            <option value="">Payment Type</option>
                    <?php
                        $payment = get_payment_type($mysqli);
                        if(mysqli_num_rows($payment)){
                            while($rows = mysqli_fetch_assoc($payment)){
                                $pay_type_id = $rows['pay_type_id'];
                                $payment_type= $rows['payment_type'];
                        ?>
                            <option value="<?php echo $pay_type_id ?>" <?php if($pay_type_id == $payment_row['pay_type_id']){echo "selected";} ?> ><?php echo $payment_type ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            <div class="form-group">
                <label for="amount">Amount Paid</label> 
              <input type="text" name="amount" class="form-control" value="<?php echo $payment_row['amount']; ?>">
            </div>            

            <button type="submit" name="update" class="btn btn-primary">Add Payment</button>
            </form>
                  <?php  }else{
                      ?>
                      <!-- Form for adding a sponsor to a student -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="std_id">Student</label>
                <select class="form-control" name="std_id" id="">
                    <option value="">select student</option>
                    <?php
                        $student = get_all_student($mysqli);
                        if(mysqli_num_rows($student)){
                            while($rows = mysqli_fetch_assoc($student)){
                                $std_id = $rows['std_id'];
                                $std_name = $rows['std_name'];
                    ?>
                        <option value="<?php echo $std_id; ?>"><?php echo $std_name; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="course_id">Course</label>
                <select class="form-control" name="course_id">
                    <option value="">choose course</option>
                    <?php
                           $result  = get_all_course($mysqli);
                            if(mysqli_num_rows($result)){
                                while($rows = mysqli_fetch_assoc($result)){
                                    $course_id = $rows['course_id'];
                                    $course_name = $rows['course_name'];                              
                    ?>
                           <option value="<?php echo $course_id ?>"><?php echo $course_name ?></option>
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
                <label for="pay_type_id">Payment</label>
                <select class="form-control" name="pay_type_id">
                            <option value="">Payment Type</option>
                    <?php
                        $payment = get_payment_type($mysqli);
                        if(mysqli_num_rows($payment)){
                            while($rows = mysqli_fetch_assoc($payment)){
                                $pay_type_id = $rows['pay_type_id'];
                                $payment_type= $rows['payment_type'];
                        ?>
                            <option value="<?php echo $pay_type_id ?>"><?php echo $payment_type ?></option>
                        <?php
                            }
                        }
                    ?>
                </select>
            <div class="form-group">
                <label for="amount">Amount Paid</label> 
              <input type="text" name="amount" class="form-control">
            </div>            

            <button type="submit" name="submit" class="btn btn-primary">Add Payment</button>
            </form>
                 <?php }
                ?>
            
            </div>
            <div class="col-md-6"></div>
        </div>
        <br><br>

            <div class="container">
                <div class="col-lg-12">
                <h2>Student Payment</h2>
                <table class="table table-striped">
                <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Duration</th>
                            <th>Payment Method</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $payment = get_all_payment($mysqli);
                            if(mysqli_num_rows($payment) > 0){
                                while($rows = mysqli_fetch_assoc($payment)){
                            ?>
                                <tr>
                                    <td><?php echo $rows['payment_id'];?></td>
                                    <td><?php
                                    $student = get_student_by_id($mysqli, $std_id = $rows['std_id']);
                                        while($row = mysqli_fetch_assoc($student)){
                                            $std_id = $row['std_id'];
                                            $std_name = $row['std_name'];
                                        }
                                        echo $std_name;
                                    
                                    ?></td>
                                    <td><?php 
                                    $course = get_course_by_id($mysqli, $course_id = $rows['course_id']);
                                        while($row = mysqli_fetch_assoc($course)){
                                            $course_id = $row['course_id'];
                                            $course_name = $row['course_name'];
                                        }
                                        echo $course_name;
                                    ?></td>
                                    <td><?php
                                     $duration = get_duration_by_id($mysqli, $duration_id = $rows['duration_id']);
                                        while($row = mysqli_fetch_assoc($duration)){
                                            $duration_id = $row['duration_id'];
                                            $duration_name = $row['duration_name'];
                                        }
                                        echo $duration_name;
                                    ?></td>
                                    <td><?php 
                                    $result = get_payment_type_by_id($mysqli, $pay_type_id = $rows['pay_type_id']);
                                        while($row = mysqli_fetch_assoc($result)){
                                            $pay_type_id = $row['pay_type_id'];
                                            $payment_type = $row['payment_type'];
                                        }
                                        echo $payment_type;
                                    ?></td>
                                    
                                    <td><?php echo $rows['payment_date'];?></td>
                                    <td><?php echo $rows['amount'];?></td>
                                    <td><a href="add_payment.php?update=1&payment_id=<?php echo $rows['payment_id'] ?>" class="btn btn-info">EDIT</a></td>
                                    <td><a href="add_payment.php?delete=1&payment_id=<?php echo $rows['payment_id'];
                                        // Check payment id if it is used before deleting
                                        // $payment_check = check_delete_payment($mysqli, $payment_id);
                                        //     if(mysqli_num_rows($payment_check)>0){
                                        //         echo "Please this payment record cannot be deleted";
                                        //     }else{
                                        //         echo $rows['payment_id'];
                                        //     }
                                    ?>" class="btn btn-danger" title="click to edit" onclick="return confirm('Are you sure, you want to delete ?')">Delete</a></td>
                                </tr>
                           <?php 
                        }
                        }
                        ?>
                            
                        
                    </tbody>
                </table>

                </div>
            </div>

        <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>