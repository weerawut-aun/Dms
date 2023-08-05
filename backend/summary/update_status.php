<?php
require_once('../../secure/connect.php');


if (isset($_POST['usr_password'])) {

    $usr_username = mysqli_real_escape_string($con, $_SESSION['usr_username']);
    $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);
    $y_show = mysqli_real_escape_string($con, $_POST['y_show']);
    $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);


    $query = "SELECT * FROM user WHERE usr_username='$usr_username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($query));
    $num_rows = mysqli_num_rows($result);

    if ($num_rows == 1) {

        while ($rows = mysqli_fetch_array($result)) {
            if (password_verify($usr_password, $rows['usr_password'])) {
                // echo 'รหัสผ่านถูกต้อง';
                $update_years = "UPDATE years SET y_show='$y_show' WHERE y_id=$y_id && fct_id=$fct_id";
                $result_years = mysqli_query($con, $update_years) or die(mysqli_error($update_years));

                if ($result_years == true) {
                    echo "<script type=\"text/javascript\">
                            alert(\"สำเร็จแล้ว\")
                            window.location='" . BASE_URL . "/$y_id/summary'
                        </script>";
                    exit();
                } else {
                    echo "<script type=\"text/javascript\">
                    alert(\"ผิดพลาด โปรดลองอีกครั้ง\")
                    window.location='chk_premit_summary.php'
                </script>";
            exit();
                }
            } else {

                echo "<script type=\"text/javascript\">
                        alert(\"รหัสผ่านไม่ถูกต้อง\")
                        window.location='chk_premit_summary.php'
                    </script>";
                exit();
            }
        }
    }
}
