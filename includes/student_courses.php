<?php
    function insert_student_courses($mysqli,$new_stud_id,$course_id){
        $query = "INSERT INTO student_courses (new_stud_id, course_id) VALUES('$new_stud_id', '$course_id')";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }

    function get_all_student_courses($mysqli){
        $query = "SELECT * FROM student_courses";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function update_courses_checked_by_student($mysqli, $course_id, $update_stud_id){
        $query ="UPDATE student_courses SET course_id = '".$course_id."' WHERE new_stud_id=".$update_stud_id;
    }

    function get_student_courses_by_std_id($mysqli, $new_stud_id){
        $query = "SELECT course_id FROM student_courses WHERE new_stud_id =".$new_stud_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function get_all_student_courses_by_course_id($mysqli, $course_id){
        $query = "SELECT * FROM student_courses WHERE course_id =". $course_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }

    function get_student_course_single_id($mysqli, $new_stud_id, $course_id){
        //global $mysqli;
        $query = "SELECT * FROM student_courses WHERE course_id =". $course_id." AND new_stud_id = $new_stud_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }
    function delete_student_courses_by_student_id($mysqli, $new_stud_id){
        $query = "DELETE FROM student_courses WHERE new_stud_id =".$new_stud_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }
function delete_student_courses($mysqli, $std_courses_id){
        $query = "DELETE FROM student_courses WHERE std_course_id =".$std_courses_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }
?>