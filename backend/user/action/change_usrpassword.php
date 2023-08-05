<?php
include('../../../secure/connect.php');
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if(isset($_POST)){

    $output = '';
    $message = '';
    $old_password = mysqli_real_escape_string($con,$_POST['old_password']);
    $new_password = mysqli_real_escape_string($con,$_POST['new_password']);
    $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
    $usr_id = mysqli_real_escape_string($con,$_SESSION['usr_id']);
    

    $query_usr = "SELECT * FROM  user WHERE usr_id='$usr_id'";
   
    $result_usr = mysqli_query($con,$query_usr) or die(mysqli_error($query_usr));
    
    if(mysqli_num_rows($result_usr) == 1){

        while($rows_user = mysqli_fetch_array($result_usr)){

            if(password_verify($old_password, $rows_user['usr_password'])){

                // echo 'current password';
                if($new_password !== $cpassword){
                    // echo 'not Maching';
                    $message = '<i class="text-danger">รหัสผ่านใหม่และยืนยันรหัสไม่ตรงกัน กรุณาลองใหม่อีกครั้ง</i>';
                } else {
                  
                    // echo 'Maching';
                    $hash = password_hash($new_password,PASSWORD_DEFAULT);

                    $update_password = "UPDATE  user SET usr_password='$hash' WHERE usr_id='$usr_id'";
                    $result_password = mysqli_query($con,$update_password) or die(mysqli_error($update_password));
                   
                    if($result_password == true){
                        $message = '<i class="text-success">เปลี่ยนรหัสผ่านเรียบร้อยแล้ว</i>';
                    } else {
                        $message = '<i class="text-danger">ผิดพลาด กรุณาลองใหม่อีกครั้ง</i>';
                    }

                }

            } else {
                // echo 'not password';
                $message = '<i class="text-danger">รหัสผ่านเก่าไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</i>';
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
mysqli_close($con);
