<?php
include('../../../secure/connect.php');

if (!empty($_POST)) {


    $message = '';
    $usr_username = mysqli_real_escape_string($con, $_POST['usr_username']);
    $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);
    $c_password = mysqli_real_escape_string($con, $_POST['c_password']);
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);



    $query_chk_username = "SELECT * FROM user WHERE usr_username='$usr_username'";
    $result_username = mysqli_query($con, $query_chk_username) or die(mysqli_error($query_chk_username));

    if (mysqli_num_rows($result_username) == 0) {

        if ($usr_password == $c_password) {

            $usr_password = password_hash($usr_password, PASSWORD_DEFAULT);

            $insert_user = "INSERT INTO user(usr_username,usr_password,fct_id) 
                VALUES('$usr_username','$usr_password','$fct_id')";
            $result_user = mysqli_query($con, $insert_user) or die(mysqli_error($insert_user));

            if ($result_user == true) {
                $usr_id = mysqli_insert_id($con);

                $insert_admin = "INSERT INTO admin(usr_id) VALUE('$usr_id')";
                $result_admin = mysqli_query($con, $insert_admin) or die(mysqli_error($insert_admin));

                if ($result_admin == true) {
                    $message = '<i class="text-success">สมัครผู้ดูแลระบบเรียบร้อยแล้ว</i>';

                    echo '
                    <div class="alert alert-light">
                        ' .  $message . '
                    </div>
                    ';
                }
            } else {
                $message = '<i class="text-danger">ผิดพลาด กรุณาลองใหม่อีกครั้ง</i>';

                echo '
                <div class="alert alert-light">
                    ' .  $message . '
                </div>
                ';
            }
        } else {

            $message = '<i class="text-danger">รหัสผ่านกับยืนยันรหัสผ่านไม่ตรงกัน กรุณาลองใหม่อีกครั้ง</i>';

            echo '
            <div class="alert alert-light">
                ' .  $message . '
            </div>
            ';
        }
    } else {
        $message = '<i class="text-danger">ชื่อผู้ใช้งานซ้ำ กรุณาเปลี่ยนใหม่แล้วลองอีกครั้ง</i>';

        echo '
        <div class="alert alert-light">
            ' .  $message . '
        </div>
        ';
    }
} else {
    echo '
        <script>
            alert("ผิดพลาด")
            window.history.back();
        </script>
    ';
}
