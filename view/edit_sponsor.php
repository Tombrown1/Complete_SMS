<?php
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();

    session_start();
            
            if(!isset($_SESSION['user_id'])){
                header("Location: login.php");
                exit();
            }

            include '../includes/sponsor.php';
?>
<?php
    if(isset($_POST['update'])){
        $sponsor_name    = $_POST['sponsor_name'];
        $std_id          = $_POST['std_id'];
        $relationship    = $_POST['relationship'];
        $sponsor_email   = $_POST['sponsor_email'];        
        $sponsor_phone   = $_POST['sponsor_phone'];
        $sponsor_address = $_POST['sponsor_address'];

        update_sponsor($mysqli, $sponsor_name, $std_id, $relationship, $sponsor_email, $sponsor_phone, $sponsor_address,$sponsor_id)

    }

?>