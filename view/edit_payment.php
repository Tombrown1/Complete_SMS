<?php
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();
    session_start();
            
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
    include '../includes/payment.php';

    if(isset($_POST['update'])){
        $payment_id   = $_POST['payment_id'];
        $std_id       = $_POST['std_id'];            
        $course_id    = $_POST['course_id'];
        $duration_id  = $_POST['duration_id'];
        $pay_type_id  = $_POST['pay_type_id'];
        $payment_date = date('Y-m-d H:i:s');
        $amount       = $_POST['amount'];

        // print_r($_POST);
      update_payment_by_id($mysqli, $payment_id, $std_id, $course_id, $duration_id, $pay_type_id, $payment_date, $amount);
    }
    
?>




            