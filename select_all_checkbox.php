   <?php
    if(isset($_POST['submit'])){
        if(isset($_POST['course'])){
            foreach ($_POST['course'] as $course) {
                echo $course .'<br/>';
            }
        }
    }
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple select Checkbox</title>
    <script src="assets/jquery/jquery.js"></script>

</head>
<body>
      
      <script>
        $(document).ready(function(){
            $("#form1 #select-all").click(function(){
                $("#form1 input[type='checkbox']").prop('checked', this.checked);
            });
        });
      </script>

<h1>Select all Course</h1>
    <form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="checkbox" id="select-all"> Select All
    </p>
        <input type="checkbox" name='course[]' value="Value 1"> Value 1 <br>
        <input type="checkbox" name='course[]' value="Value 2"> Value 2 <br>
        <input type="checkbox" name='course[]' value="Value 3"> Value 3 <br>
        <input type="checkbox" name='course[]' value="Value 4"> Value 4 <br>
        <input type="checkbox" name='course[]' value="Value 5"> Value 5 <br>
     </p>
     <input type="submit" name="submit">    
    </form>
    <br>
        <?php
            for($x=1; $x <=10; $x++){
                // echo $x . "<br>";
                    for($y = 1; $y<=10; echo $y++){
                        echo $y  . "<br>";
                    }
            }
        ?>
</body>
</html>

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
                                    //echo "Checked CourseID: ".$checked_course_id;
                                    if($checked_course_id == $course_id)
                                    {
                                        $checked = true;
                                        break;
                                    }
                                }
                            }
                            //echo "Course: ".$course_id;  
                ?>
                <input type="checkbox" name='<?php echo "course".$course_id;?>' value="<?php echo $course_id; ?>" <?php if($checked==true){echo "checked";}?>> &nbsp;&nbsp;&nbsp; <?php echo $course_name; ?><br/>
               <?php
                            
                 }
                }
                
               ?>
            </div>  