<?php
include('../../secure/connect.php');

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// exit;

if (!empty($_POST)) {

    $prefix = mysqli_real_escape_string($con, $_POST['prefix']);
    $usr_firstname = mysqli_real_escape_string($con, $_POST['usr_firstname']);
    $usr_lastname = mysqli_real_escape_string($con, $_POST['usr_lastname']);
    $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

    $query_admin = "SELECT * FROM user WHERE usr_id='$usr_id' && fct_id='$fct_id'";

    $resutl_admin = mysqli_query($con, $query_admin) or die(mysqli_error($query_admin));
    $num_rows = mysqli_num_rows($resutl_admin);

    if ($num_rows == 1) {
        // echo '1';
        $update_adm = "UPDATE  user SET usr_prefix='$prefix',usr_firstname='$usr_firstname',usr_lastname='$usr_lastname'  WHERE usr_id='$usr_id' && fct_id='$fct_id'";
        $result_adm = mysqli_query($con, $update_adm) or die(mysqli_error($update_adm));

        if($result_adm){
            echo '<strong class="text-success">สำเร็จแล้ว</strong>';
        } else {
            echo '<strong class="text-danger">ผิดพลาด กรุณาลองใหม่อีกครั้ง</strong>';
        }

    } 
} else {
    echo "<script type='text/javascript'>
            alert('ผิดพลาด')
            location = 'frm_admin.php'
        </script>";
    exit();
}
