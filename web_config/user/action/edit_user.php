<?php
require_once('../../connect.php');

if (!empty($_POST)) {
    $output = '';
    $message = '';

    $old_wcf_password = mysqli_real_escape_string($con, $_POST['old_wcf_password']);
    
    $wcf_password = mysqli_real_escape_string($con, $_POST['wcf_password']);
    $cn_password = mysqli_real_escape_string($con, $_POST['cn_password']);

    $query = "SELECT * FROM web_config WHERE wcf_id=2";
    $result = mysqli_query($con, $query) or die(mysqli_error($query));
    $row = mysqli_fetch_array($result);


    if (!password_verify($old_wcf_password, $row['wcf_name'])) {
        $message = '<strong class="text-danger">รหัสผ่านไม่ถูกต้อง</strong>';
    } else {

        if ($wcf_password !==  $cn_password) {
            $message = '<strong class="text-danger">รหัสผ่านไม่ตรงยืนยันรหัสผ่าน</strong>';
        } else {
            
            $password = password_hash($wcf_password,PASSWORD_DEFAULT);

            $update = "UPDATE  web_config SET wcf_name='$password' WHERE wcf_id=2";
            $resutl2 = mysqli_query($con,$update) or die(mysqli_error($update));
            
            if($resutl2){
                $message = '<strong class="text-succes">เรียบร้อยแล้ว</strong>';
            } else {
                $message = '<strong class="text-danger">ผิดพลาด กรุณาลองใหม่อีกครั้ง</strong>';
            }
        }
    }
    $output .= '
    <div class="alert alert-light">
    ' . $message . '
</div> 
    ';
    echo $output;
}
