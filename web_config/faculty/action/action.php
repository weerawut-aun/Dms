<?php
// print_r($_POST);
include('../../connect.php');

if (isset($_POST)) {

    $output = '';
    $message = '';
    $fct_name = mysqli_real_escape_string($con, $_POST['fct_name']);
    $fct_uploadsize = mysqli_real_escape_string($con, $_POST['fct_uploadsize']);
    $usr_username = mysqli_real_escape_string($con, $_POST['usr_username']);
    $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);


    $query_fct = "SELECT * FROM faculty WHERE fct_name='$fct_name'";
    $result_fct = mysqli_query($con, $query_fct) or die(mysqli_error($query_fct));


    if (mysqli_num_rows($result_fct) == 0) {

        $query_user = "SELECT * FROM user WHERE usr_username='$usr_username'";
        $result_user = mysqli_query($con, $query_user) or die(mysqli_error($query_user));

        if (mysqli_num_rows($result_user) == 0) {

            $insert_fct = "INSERT INTO faculty(fct_name,fct_uploadsize) VALUES('$fct_name','$fct_uploadsize')";

            if (mysqli_query($con, $insert_fct) or die(mysqli_error($insert_fct))) {

                $fct_id = mysqli_insert_id($con);
                $usr_password  = password_hash($usr_password, PASSWORD_DEFAULT);
                $insert_user = "INSERT INTO user(usr_username,usr_password,fct_id) values('$usr_username','$usr_password','$fct_id')";

                if (mysqli_query($con, $insert_user) or die(mysqli_error($insert_user))) {
                    $usr_id = mysqli_insert_id($con);
                    $insert_admin = "INSERT INTO admin(usr_id) VALUES('$usr_id')";

                    if (mysqli_query($con, $insert_admin) or die(mysqli_error($insert_admin))) {
                        $output .= 'สำเร็จแล้ว';
                    }
                }
            }
        } else {
            $output .= 'ชื่อผู้ใช้งานซ้ำ';
        }
    } else {
        $output .= 'ชื่อคณะนี้ซ้ำ';
    }

    echo $output;
}
mysqli_close($con);
