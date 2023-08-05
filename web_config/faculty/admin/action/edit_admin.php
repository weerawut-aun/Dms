<?php

include('../../../connect.php');

// echo $_POST['fct_id'];
// exit;

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';


if (!empty($_POST)) {

    $output = '';
    $message = '';
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
    $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
    $usr_username = mysqli_real_escape_string($con, $_POST['usr_username']);
    $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);
    $c_password = mysqli_real_escape_string($con, $_POST['c_password']);
    $code = mysqli_real_escape_string($con, $_POST['code']);

    if ($usr_password == $c_password) {

        $usr_password = password_hash($usr_password, PASSWORD_DEFAULT);

        $edit_admin = "UPDATE user SET usr_password = '$usr_password'
                    WHERE usr_id='$usr_id'" or die(mysqli_error($con));

        if (mysqli_query($con, $edit_admin)) {
            $message = 'แก้ไขข้อมูลเรียบร้อย';
           
            $output .= '<sapn lass="text-success">'.$message.'</sapn>';
        } else {
            $message = 'ผิดพลาด กรุณาลองใหม่อีกครั้ง';
           
            $output .= '<sapn lass="text-danger">'.$message.'</sapn>';
        }
    } else {
        $message = 'รหัสผ่านไม่ตรงกัน';

        $output .= '<sapne class="text-danger">' . $message . '</span>';
    }

    echo $output;
} else {
    echo '
        <script>
            alert("ผิดพลาด")
            windown:location="../frm_edit_admin.php?usr_id=' . $_SESSION['usr_id'] . '"
        </script>
    ';
}
mysqli_close($con);
