<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        session_destroy();
        unset($_SESSION['user_id']);

       header("Location: home1.php");
    }else{
        header("Location: home1.php");
    }


// public function logout(){
//            session_destroy();
//            unset($_SESSION['user']);
//            return true;
//         }
?>

