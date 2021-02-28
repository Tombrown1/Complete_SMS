<?php
   
    function insert_duration($mysqli, $duration){
        $query = "INSERT INTO duration(duration_name) VALUES('$duration')";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }

    function get_duration($mysqli){
        $query = "SELECT * FROM duration";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function get_duration_by_id($mysqli, $duration_id){
        $query = "SELECT * FROM duration WHERE duration_id = '".$duration_id."'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function check_duration($mysqli,$duration_name){
        $query = "SELECT * FROM duration WHERE duration_name = '".$duration_name."'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }
?>