<?php

    function insert_users($mysqli, $new_stud_id, $username, $password){
        $query = "INSERT INTO student_user(new_stud_id, username, password) VALUES('".$new_stud_id."', '".$username."', '".md5($password)."')";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }

    function get_users($mysqli){
        $query = "SELECT * FROM student_user";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function get_users_by_id($mysqli, $new_stud_id){
        $query = "SELECT * FROM student_user WHERE new_stud_id=".$new_stud_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function login($mysqli, $username, $password){
        $query = "SELECT * FROM student_user WHERE username='".$username."' and password='".md5($password)."'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function check_username($mysqli, $email){
        $query = "SELECT * FROM student_user WHERE username = '".$username."'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }
?>