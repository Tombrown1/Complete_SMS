<?php
    session_start();
    if(isset($_SESSION['student_id'])){
        session_destroy();
        unset($_SESSION['student_id']);

       header("Location: index1.php");
    }else{
        header("Location: index1.php");
    }


// public function logout(){
//            session_destroy();
//            unset($_SESSION['user']);
//            return true;
//         }
?>

