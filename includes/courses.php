<?php
    // include_once 'database_conn.php';
    // $mysqli = connect_db();
    //include_once '../connection/connect_files.php';
  

    function insert_course($mysqli, $course_name, $std_id, $duration_id){
        //global $mysqli;       
        $query = "INSERT INTO course(course_name, std_id, duration_id)
                VALUES('$course_name', '$std_id', '$duration_id')";
        $result = mysqli_query($mysqli, $query) or die(myqli_error($mysqli));
        
    }

    function get_all_course($mysqli){
        //global $mysqli;
        $query = "SELECT * FROM course";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function get_course_by_id($mysqli, $course_id){
        //global $mysqli;
        $query = "SELECT * FROM course WHERE course_id =". $course_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function get_all_course_by_std_id($mysqli, $std_id){
        $query = "SELECT * FROM course WHERE std_id =".$std_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    // function get_stud_courses_by_std_id($mysqli, $std_id)

    function update_course($mysqli, $course_name, $std_id, $duration_id, $course_id){
        //global $mysqli;
        $query = "UPDATE course SET course_name = '$course_name', std_id = '$std_id', duration='$duration' 
        WHERE course_id = '$course_id'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }

    function delete_course($mysqli, $course_id){
        //global $mysqli;
        $query = "DELETE FROM course WHERE course_id =" . $course_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return true;
    }

    function check_course($mysqli,$course_name){
        $query = "SELECT * FROM course WHERE course_name = '".$course_name."'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

?>