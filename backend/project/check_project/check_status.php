<?php
require_once('../../../secure/connect.php');
chk_eds();

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();


if (isset($_POST['usr_password'])) {

    $usr_username = mysqli_real_escape_string($con, $_SESSION['usr_username']);
    $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);
    $pro_show = mysqli_real_escape_string($con, $_POST['pro_show']);
    $pro_details = mysqli_real_escape_string($con, $_POST['pro_details']);
    $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
    $pro_id = mysqli_real_escape_string($con, $_SESSION['pro_id']);


    $query = "SELECT * FROM user WHERE usr_username='$usr_username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($query));
    $num_rows = mysqli_num_rows($result);

    if ($num_rows == 1) {

        while ($rows = mysqli_fetch_array($result)) {
            if (password_verify($usr_password, $rows['usr_password'])) {
                // echo 'รหัสผ่านถูกต้อง';

                if ($pro_show == 1) {
                    $chk_pdt = "SELECT * FROM  project_details WHERE y_id=$y_id && pro_id=$pro_id && fct_id=$fct_id";
                    // echo $chk_pdt;
                    // exit;
                    $result_pdt = mysqli_query($con, $chk_pdt) or die(mysqli_error($chk_pdt));
                    $rows = mysqli_fetch_array($result_pdt);

                    // check info project 1
                    if ($rows['iof_id'] == 0 && $rows['ipt_id'] == 0 && $rows['ise_id'] == 0 && $rows['ipe_id'] == 0 && $rows['irn_id'] == 0 && $rows['wpt_id'] == 0 && $rows['alt_id'] == 0 && $rows['apt_id'] == 0) {
                        echo "<script type=\"text/javascript\">";
                        echo "alert(\"กรุณาเช็คข้อมูลโครงการ\");";
                        echo "window.location='" . BASE_URL . "/project/$pro_id'";
                        echo "</script>";
                        exit();
                    }
                    // check step 2
                    elseif ($rows['img_id'] == 0 && $rows['lat_id'] == 0) {
                        echo "<script type=\"text/javascript\">";
                        echo "alert(\"กรุณาเช็คขั้นตอนการดำเนินการ\");";
                        echo "window.location='" . BASE_URL . "/project/$pro_id'";
                        echo "</script>";
                        exit();
                    }
                    // check step 3
                    elseif ($rows['pbk_id'] == 0 && $rows['clt_id'] == 0) {
                        echo "<script type=\"text/javascript\">";
                        echo "alert(\"กรุณาเช็คขั้นตอนสรุป\");";
                        echo "window.location='" . BASE_URL . "/project/$pro_id'";
                        echo "</script>";
                        exit();
                    } else {

                        $chk_pro = "SELECT * FROM project WHERE y_id=$y_id && pro_id=$pro_id && fct_id=$fct_id";
                        // echo $chk_pro;
                        // exit;
                        $result_pro = mysqli_query($con, $chk_pro) or die(mysqli_error($chk_pro));
                        $num_rows1 = mysqli_num_rows($result_pro);
                        if ($num_rows1 == 1) {
                            // echo 'ปิดโครงการ';
                            $update_pro = "UPDATE project SET pro_show='$pro_show' WHERE y_id=$y_id && pro_id=$pro_id && fct_id=$fct_id";
                            // echo $update_pro;
                            // exit;
                            $result_pro1 = mysqli_query($con, $update_pro) or die(mysqli_error($update_pro));

                            if ($result_pro1 == true) {
                                echo "<script type=\"text/javascript\">";
                                echo "alert(\"จบโครงการ\");";
                                echo "window.location='" . BASE_URL . "/$y_id/project'";
                                echo "</script>";
                                exit();
                            }
                        }
                    }
                }elseif ($pro_show == 2) {
               
                    $chk_pro = "SELECT * FROM project WHERE y_id=$y_id && pro_id=$pro_id && fct_id=$fct_id";
                    // echo $chk_pro;
                    // exit;
                    $result_pro = mysqli_query($con, $chk_pro) or die(mysqli_error($chk_pro));
                    $num_rows1 = mysqli_num_rows($result_pro);
                    if ($num_rows1 == 1) {
                        // echo 'ปิดโครงการ';
                        $update_pro = "UPDATE project SET pro_show='$pro_show',pro_details='$pro_details' WHERE y_id=$y_id && pro_id=$pro_id && fct_id=$fct_id";
                        // echo $update_pro;
                        // exit;
                        $result_pro1 = mysqli_query($con, $update_pro) or die(mysqli_error($update_pro));
    
                        if ($result_pro1 == true) {
                            echo "<script type=\"text/javascript\">
                                        alert(\"ยกเลิกโครงการ\")
                                        window.location='" . BASE_URL . "/$y_id/project'
                                    </script>";
                            exit();
                        }
                    }
                }
            } else {
                $chk = password_hash($pro_show, PASSWORD_DEFAULT);
                 // "window.location='" . BASE_URL . "/project/check_project'";
                echo "<script type=\"text/javascript\">
                    alert(\"รหัสผ่านไม่ถูกต้อง\")
                            window.location='" . BASE_URL . "/backend/project/check_project/chk_password.php?chk=$chk'
                        </script>";
                exit();
            }
        }
    }
}
mysqli_close($con);
