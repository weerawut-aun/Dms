<?php
include('../connect.php');


if (!empty($_POST)) {

    $output = '';
    $message = '';

    $username = mysqli_real_escape_string($con, $_POST['username']);

    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM web_config WHERE wcf_id=1";

    $result = mysqli_query($con, $query) or die(mysqli_error($query));

    $row_username = mysqli_fetch_array($result);

    if (password_verify($username, $row_username['wcf_name']) == 0) {
        $message = '<strong class="text-danger">ชื่อผู้ใช้งานไม่ถูกต้อง</strong>';
    } else {

        $query2 = "SELECT * FROM web_config WHERE wcf_id=2";
        $result2 = mysqli_query($con, $query2) or die(mysqli_error($query2));
        $row_password = mysqli_fetch_array($result2);

        if(password_verify($password,$row_password['wcf_name']) == 0){
            $message = '<strong class="text-danger">รหัสผ่านไม่ถูกต้อง</strong>';
        } else {
            $_SESSION['wcf_name'] = $row_username['wcf_name'];

           $output .= '<script>

                            window.location.href="./faculty/index.php"
                    </script>';
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
