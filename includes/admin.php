<?php    

    function insert_admin($mysqli, $admin_name, $admin_email, $admin_pass, $admin_phone, $gender_id, $created_at){
        //global $mysqli;
        $query = "INSERT INTO admin(admin_name, admin_email, admin_pass, admin_phone, gender_id, created_at )
                VALUES('$admin_name', '$admin_email', '".md5($admin_pass)."', '$admin_phone', '$gender_id', '$created_at')";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
        if($result){
            header("location: add_admin.php");
        }
    }

    function get_all_admin($mysqli){
       // global $mysqli;
        $query = "SELECT * FROM admin";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }

    function get_admin_by_id($mysqli, $admin_id){
       // global $mysqli;
        $query = "SELECT * FROM admin WHERE admin_id =".$admin_id;
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        return $result;
    }
    //$query = "SELECT * FROM course WHERE course_id =". $course_id;

    function update_admin($mysqli, $admin_id, $admin_name, $admin_email, $admin_phone, $gender_id, $created_at){
        //global $mysqli;
        $query = "UPDATE admin set admin_name = '$admin_name', admin_email = '$admin_email', admin_phone = '$admin_phone', gender_id = '$gender_id', created_at = '$created_at'  WHERE admin_id = $admin_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        
        if($result){
            header("Location: add_admin.php");
        }
    }

    function delete_admin($mysqli,$admin_id){
        //global $mysqli;
        $query = "DELETE FROM admin WHERE admin_id = $admin_id";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }

    function login_admin($mysqli, $admin_email, $admin_pass){
        $query = "SELECT * FROM admin WHERE admin_email='".$admin_email."' AND admin_pass='".md5($admin_pass)."'";
        $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
    }
?>


