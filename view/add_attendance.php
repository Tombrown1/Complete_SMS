<?php 
    
    include_once '../includes/students.php';
    // include_once '../includes/courses.php';

    if(isset($_POST['submit'])){
        $admin_name    = $_POST['admin_name'];
        $admin_email   = $_POST['admin_email'];        
        $admin_phone   = $_POST['admin_phone'];
        $gender_id     = $_POST['gender_id'];
        $created_at    = date('Y-m-d H:i:s');

        insert_admin($admin_name, $admin_email, $admin_phone, $gender_id, $created_at);
     
    }



   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
        <div class="jumbotron">
             <h1 align="center">Add Attendance</h1>
             <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="add_course.php">Add Course</a></li>
                <li><a href="add_duration.php">Add Duration</a></li>
                <li><a href="add_student.php">Add Student</a></li>
             </ul>
        </div>

        <div class="container">
            <div class="col-md-6">
                
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="admin_name"> Name</label>
                <input type="text" name="admin_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="admin_email">Email</label>
                <input type="email" name="admin_email" class="form-control">
            </div>
            <div class="form-group">
                <label for="admin_phone">Phone No</label>
                <input type="text" name="admin_phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="gender_id">Gender</label>
                <!-- <input type="text" name="gender_id" class="form-control" placeholder="Enter Gender"> -->
                <select name="gender_id">
                    <option value="">Select Gender</option>
                    <?php
                        $gender = get_gender();
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
            
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
            <div class="col-md-6"></div>
        </div>
        <br><br>
        <div class="container">
            <h2>All Admin</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Gender</th>
                        <th>Date Signup</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $admin = get_all_admin();
                    if(mysqli_num_rows($admin) > 0){
                        while($rows = mysqli_fetch_assoc($admin)){
                    
                    ?>
                    
                    <tr>
                        <td><?php echo $rows['admin_id'] ?></td>
                        <td><?php echo $rows['admin_name'] ?></td>                   
                        <td><?php echo $rows['admin_email'] ?></td>
                        <td><?php echo $rows['admin_phone'] ?></td>                        
                        <td>
                            <?php                            
                           $gender = get_gender_by_id($std_id = $rows['gender_id']);
                                while($row = mysqli_fetch_assoc($gender)){
                                    $std_name = $row['gender_name'];
                                } 
                                echo $std_name;                           
                            ?>                        
                        </td>     
                        <td><?php echo $rows['created_at'] ?></td>
                        <td><a href="add_admin.php?update=1&admin_id=<?php echo $rows['admin_id'] ?>" class="btn btn-info">Edit</a></td>
                        <td><a href="#" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <?php
                        }
                    }else{
                        echo "Nil";
                    }
                ?>
                    
                </tbody>
            </table>
        </div>

        <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>