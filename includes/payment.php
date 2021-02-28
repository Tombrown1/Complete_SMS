<?php    

    function insert_payment($mysqli, $std_id, $course_id, $duration_id, $pay_type_id, $payment_date, $amount){
        //global $mysqli;
        $query = "INSERT INTO payment(std_id, course_id, duration_id, pay_type_id, payment_date, amount)
                VALUES('$std_id', '$course_id', '$duration_id', '$pay_type_id', '$payment_date', '$amount')";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

        if($result){
            header("Location: add_payment.php");
        }
    }

    function get_all_payment($mysqli){
        //global $mysqli;
        $query = "SELECT * FROM payment";
        $result = mysqli_query($mysqli, $query) or die(mysqlli_error($mysqli));
        return $result;
    }

    function get_payment_by_id($mysqli, $payment_id){
        $query = "SELECT * FROM payment WHERE payment_id = $payment_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function update_payment_by_id($mysqli, $payment_id, $std_id, $course_id, $duration_id, $pay_type_id, $payment_date, $amount){
        $query = "UPDATE payment SET std_id ='".$std_id."', course_id ='".$course_id."', duration_id ='".$duration_id."', pay_type_id ='".$pay_type_id."', payment_date ='".$payment_date."', amount='".$amount."' WHERE payment_id =".$payment_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        header("Location: add_payment.php");

    }

    function delete_payment_by_id($mysqli, $payment_id){
        $query = "DELETE FROM payment WHERE payment_id = $payment_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return true;
    }

    function check_delete_payment($mysqli, $payment_id){
        $query = "SELECT * payment WHERE payment_id = $payment_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }
?>