<?php 
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();

    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
    
    include_once '../includes/students.php';
    include_once '../includes/sponsor.php';

    if(isset($_POST['submit'])){
        $sponsor_name    = $_POST['sponsor_name'];
        $std_id          = $_POST['std_id'];
        $relationship    = $_POST['relationship'];
        $sponsor_email   = $_POST['sponsor_email'];        
        $sponsor_phone   = $_POST['sponsor_phone'];
        $sponsor_address = $_POST['sponsor_address'];

        insert_sponsor($mysqli, $sponsor_name, $std_id, $relationship, $sponsor_email, $sponsor_phone, $sponsor_address);
     
    }

    if(isset($_GET['delete'])){
        $sponsor_id = $_GET['sponsor_id'];
        $delete_sponsor = delete_sponsor_by_id($mysqli, $sponsor_id);

        if($delete_sponsor){
            header("Location: add_sponsor.php");
        }
    }

   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sponsor</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>    
<?php
        include_once '../navbars/menu.php';
        if(isset($_GET['update'])){
            $operation_msg = "EDIT SPONSOR";
        }else {
            $operation_msg = "ADD SPONSOR";
        }
    ?>
          
          <main class="container">
            <div class="welcome text-center py-5 px-3"> <br>
            <h4 align="center"><?php echo $operation_msg; ?></h4> <br>           
            </div>             
        </main> 
        <div class="container">
            <div class="col-md-6">
            <?php
                if(isset($_GET['update'])){
                $sponsor_id = $_GET['sponsor_id'];
                $result = get_sponsor_by_id($mysqli, $sponsor_id);
                $sponsor_row = mysqli_fetch_assoc($result);
            ?>
            <!-- //Edit Sponsor Section -->
            <form action="edit_sponsor.php" method="post">
            <div class="form-group">
                <label for="sponsor_name">Sponsor Name</label>
                <input type="text" name="sponsor_name" value="<?php echo $sponsor_row['sponsor_name'] ?>" class="form-control">
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
                        <option value="<?php echo $std_id; ?>" <?php if($std_id == $rows['std_id']){ echo "selected"; } ?> ><?php echo $std_name; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="relationship">Relationship</label>
                <input type="text" name="relationship" value="<?php echo $sponsor_row['relationship'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="sponsor_email">Email</label>
                <input type="email" name="sponsor_email" value="<?php echo $sponsor_row['sponsor_email'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="sponsor_phone">Phone No</label>
                <input type="text" name="sponsor_phone" value="<?php echo $sponsor_row['sponsor_phone'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="sponsor_address">Address</label>
                <input type="text" name="sponsor_address" value="<?php echo $sponsor_row['sponsor_address'] ?>" class="form-control">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Submit</button>
            </form>
            <?php
        }else{
            ?>
            
            
                    <!-- //Add Sponsor Section -->
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="sponsor_name">Sponsor Name</label>
                <input type="text" name="sponsor_name" class="form-control">
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
                        <option value="<?php echo $std_id; ?>"><?php echo $std_name; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="relationship">Relationship</label>
                <input type="text" name="relationship" class="form-control">
            </div>
            <div class="form-group">
                <label for="sponsor_email">Email</label>
                <input type="email" name="sponsor_email" class="form-control">
            </div>
            <div class="form-group">
                <label for="sponsor_phone">Phone No</label>
                <input type="text" name="sponsor_phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="sponsor_address">Address</label>
                <input type="text" name="sponsor_address" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
           <?php 
        }
        ?>
        
                
            
            </div>
            <div class="col-md-6"></div>
        </div>
        <br><br>
        <div class="container">
            <h2>All Sponsors</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Student</th>
                        <th>Relationship</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Address</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                 $cnt = 1;
                    $sponsor = get_all_sponsor($mysqli);
                    if(mysqli_num_rows($sponsor) > 0){
                       
                        while($rows = mysqli_fetch_assoc($sponsor)){                   
                    
                    ?>
                    
                    <tr>
                        <td><?php echo $cnt ?></td>
                        <td><?php echo $rows['sponsor_name'] ?></td>
                        <td>
                            <?php                            
                           $result = get_student_by_id($mysqli, $std_id = $rows['std_id']);
                                while($row = mysqli_fetch_assoc($result)){
                                    $std_name = $row['std_name'];
                                } 
                                echo $std_name;                           
                            ?>                        
                        </td>
                        <td><?php echo $rows['relationship'] ?></td>
                        <td><?php echo $rows['sponsor_email'] ?></td>
                        <td><?php echo $rows['sponsor_phone'] ?></td>
                        <td><?php echo $rows['sponsor_address'] ?></td>
                        <td><a href="add_sponsor.php?update=1&sponsor_id=<?php echo $rows['sponsor_id'] ?>" class="btn btn-info">Edit</a></td>
                        <td><a href="add_sponsor.php?delete=1&sponsor_id=<?php echo $rows['sponsor_id'];?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <?php
                    $cnt ++;
                        }               
 
                    }else{
                        echo "Nil";
                    }
                   
                ?>
                    
                </tbody>
            </table>
        </div>

        <?php
    include_once '../navbars/footer.php';
    ?>