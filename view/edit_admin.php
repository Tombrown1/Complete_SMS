<?php
include_once '../connection/database_conn.php';
$mysqli = connect_db();
include_once '../includes/admin.php';

    if(isset($_POST['update'])){
            $admin_id      = $_POST['admin_id'];
            $admin_name    = $_POST['admin_name'];
            $admin_email   = $_POST['admin_email'];      
            $admin_phone   = $_POST['admin_phone'];
            $gender_id     = $_POST['gender_id'];
            $created_at    = date('Y-m-d H:i:s');
    
            update_admin($mysqli, $admin_id, $admin_name, $admin_email, $admin_phone, $gender_id, $created_at);
         
      
    }
?>