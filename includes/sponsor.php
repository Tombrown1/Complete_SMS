<?php

    function insert_sponsor($mysqli, $sponsor_name, $std_id, $relationship, $sponsor_email, $sponsor_phone, $sponsor_address){
        $query = "INSERT INTO sponsor(sponsor_name, std_id, relationship, sponsor_email, sponsor_phone, sponsor_address)
                VALUES('$sponsor_name', '$std_id', '$relationship', '$sponsor_email', '$sponsor_phone', '$sponsor_address')";
        $result = mysqli_query($mysqli, $query) or die($mysqli_error($mysqli));
        return $result;
        if($result){
            header("Location: add_sponsor.php");
        }
    }

    function get_all_sponsor($mysqli){
        $query = "SELECT * FROM sponsor";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function get_sponsor_by_id($mysqli, $sponsor_id){
        $query = "SELECT * FROM sponsor WHERE sponsor_id = $sponsor_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function update_sponsor($mysqli, $sponsor_name, $std_id, $relationship, $sponsor_email, $sponsor_phone, $sponsor_address,$sponsor_id){
        $query = "UPDATE sponsor SET sponsor_name ='$sponsor_name', std_id='$std_id', relationship= '$relationship', sponsor_email = '$sponsor_email', sponsor_phone = '$sponsor_phone', sponsor_address = '$sponsor_address' WHERE sponsor_id = $sponsor_id ";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }

    function delete_sponsor_by_id($mysqli, $sponsor_id){
        $query = "DELETE FROM sponsor WHERE sponsor_id = $sponsor_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }

?>