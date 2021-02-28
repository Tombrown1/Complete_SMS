<?php

    function insert_student($mysqli, $std_name, $std_email, $std_phone,$gender_id,$sponsor_id, $duration_id, $payment_id, $pay_type_id, $fileNewname){
         //global $mysqli;
        $query = "INSERT INTO student(std_name, std_email, std_phone, gender_id, sponsor_id, duration_id, payment_id, pay_type_id, image)
                        VALUES('$std_name', '$std_email', '$std_phone','$gender_id', '$sponsor_id', '$duration_id', '$payment_id', '$pay_type_id', '$fileNewname')";
        //print_r($query);
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));        
        $insert_id = mysqli_insert_id($mysqli);
        return $insert_id;
    }

    function get_all_student($mysqli){
        //global $mysqli;  
       $query = "SELECT * FROM student ORDER BY std_id DESC";
       $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
       return $result;
    }

    function get_student_by_id($mysqli, $std_id){
        //global $mysqli;
        $query = "SELECT * FROM student WHERE std_id =". $std_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));        
        return $result;
    }

    function update_student_by_id($mysqli, $std_id, $std_name, $std_email, $std_phone, $gender_id, $sponsor_id, $duration_id, $fileNewname){
       // global $mysqli;
        $query = "UPDATE student SET std_name ='".$std_name."', std_email ='".$std_email."', std_phone ='". $std_phone."', gender_id ='".$gender_id."', sponsor_id ='". $sponsor_id."', duration_id ='".$duration_id."', image='".$fileNewname."' WHERE std_id=".$std_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        $insert_id = mysqli_insert_id($mysqli);
        return $result;
                             
    }

    function get_student_course($mysqli, $std_id){
        $query = "SELECT * FROM student WHERE std_id=".$std_id;
        $result = mysqli_query($mtsqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function check_student_email($mysqli, $std_email){
        $query = "SELECT * FROM student WHERE std_email = '$std_email'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result; 
    }
    
    function check_student_phone($mysqli,$std_phone){
            $query = "SELECT * FROM student WHERE std_phone = $std_phone";
            $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
            return $result; 
    }

    function delete_student_by_id($mysqli, $std_id){
        $query = "DELETE FROM student WHERE std_id =". $std_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return true;
    }

    function check_course_exist($mysqli, $course_id){
        $query = "SELECT * FROM student WHERE course_id =$course_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function check_email_update($mysqli, $std_id){
        $query = "SELECT std_email FROM student WHERE std_id =".$std_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }
?>