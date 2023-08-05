<?php
include('../../../connect.php');


if (!empty($_POST)) {

    $output = '';
    $message = '';
    $usr_username = mysqli_real_escape_string($con, $_POST['usr_username']);
    $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);
    $c_password = mysqli_real_escape_string($con, $_POST['c_password']);
    $fct_id = mysqli_real_escape_string($con, $_POST['fct_id']);


    $chk_username = "SELECT usr_username FROM user WHERE usr_username='$usr_username'";
    $result_chk_username = mysqli_query($con, $chk_username) or die(mysqli_error($chk_username));
    $num_rwos_username = mysqli_num_rows($result_chk_username);


    if ($num_rwos_username == 0) {

        if ($usr_password == $c_password) {

            $hash_password = password_hash($usr_password,PASSWORD_DEFAULT);

            $insert_usr = "INSERT INTO user(usr_username,usr_password,fct_id) VALUES('$usr_username','$hash_password','$fct_id')";
            $result_usr = mysqli_query($con, $insert_usr) or die(mysqli_error($insert_usr));

            if ($result_usr == true) {

                $usr_id = mysqli_insert_id($con);

                $insert_adm = "INSERT INTO admin(usr_id) VALUES('$usr_id')";
                $result_adm = mysqli_query($con, $insert_adm) or die(mysqli_error($insert_adm));

                if ($result_adm == true) {
                    $message = 'สมัครสมาชิกสำเร็จแล้ว!!';
                    $output = '<strong class="text-success">' . $message . '</strong>';
                } else {
                    $message = 'ผิดพลาด กรุณาลองใหม่ครั้ง';
                    $output .= '<strong class="text-danger">' . $message . '</strong>';
                }
            } else {
                $message = 'ผิดพลาด กรุณาลองใหม่ครั้ง';
                $output .= '<strong class="text-danger">' . $message . '</strong>';
            }
        } else {
            $message = 'รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน กรุณาลองใหม่อีกครั้ง';
            $output .= '<strong class="text-danger">' . $message . '</strong>';
        }
    } else {
        $message = 'ชื่อผู้ใช้งานนี้ถูกใช้งานแล้ว กรุณาตั้งชื่อผู้ใช้งานใหม่';
        $output .= '<strong class="text-danger">' . $message . '</strong>';
    }
    echo $output;
}

mysqli_close($con);