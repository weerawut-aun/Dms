<?php

require_once('../../secure/connect.php');
chk_eds();

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if (isset($_POST['usr_password'])) {

    $usr_id = $_SESSION['usr_id'];
    $usr_password = $_POST['usr_password'];
    $y_id = $_SESSION['y_id'];
    $fct_id = $_SESSION['fct_id'];
    $status = '1';


    $query = "SELECT * FROM user WHERE usr_id='" . $_SESSION['usr_id'] . "'";
    $result = mysqli_query($con, $query) or die(mysqli_error($query));
    // $num_row = mysqli_num_rows($result);
    // echo $num_row;
    // exit;

    if (mysqli_num_rows($result) == 1) {
        // echo 'รหัสผ่านถูกต้อง';
        // exit;
        $rows_eds = mysqli_fetch_array($result);

        if (password_verify($usr_password, $rows_eds['usr_password'])) {
            // echo 'รหัสผ่านถูกต้อง';
            //  exit;

            $check_agenda = "SELECT * FROM agenda WHERE  y_id= $y_id && fct_id= $fct_id";
            $result_chk = mysqli_query($con, $check_agenda);
            $num_row = mysqli_num_rows($result_chk);

            if ($num_row > 0) {
                // echo 'เช็คข้อมูล';
                $query_status = "UPDATE agenda SET agd_show='$status' WHERE y_id=$y_id && fct_id= $fct_id";
               
                $result_status = mysqli_query($con,$query_status) or die(mysqli_error($query_status));

                if ($result_status) {

                    // echo "<font color='red'> รอชำระเงิน </font>";
                    echo "<script>
                        alert(\"จบวาระการประชุม \")
                        window.location='" . BASE_URL . "/$y_id/agenda'
                    </script>";
                    exit();
                }
            } else {
               
                echo "<script>
                alert('ไม่มีข้อมูลวาระการประชุม')
                window.location='frm_check_permit.php'
            </script>";
        exit();
            }

            // $query_status = "UPDATE meet_detail SET mtd_status='$mtd_status' WHERE y_id=$y_id";
            // $result_status = mysqli_query($con, $query_status) or die(mysqli_error($query_status));

            // if ($result_status) {

            //     // echo "<font color='red'> รอชำระเงิน </font>";
            //     echo "<script>
            //             alert(\"จบวาระการประชุม \")
            //             window.location='" . BASE_URL . "/$y_id/agenda'
            //         </script>";
            //     exit();
            // }
        } else {
            echo "<script>
                    alert('รหัสผ่านไม่ถูกต้อง')
                    window.location='frm_check_permit.php'
                </script>";
            exit();
        }
    } else {
        // echo 'รหัสผ่านไม่ถูกต้อง';
        // exit;
        echo "<script>
                alert('รหัสผ่านไม่ถูกต้อง')
                window.location='frm_check_permit.php'            
        </script>";
        exit();
    }
}

mysqli_close($con);
