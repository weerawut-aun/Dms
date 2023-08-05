<?php
include("connect.php");

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

if (isset($_POST['usr_username'])) {

    $output = '';
    $usr_username = mysqli_real_escape_string($con, $_POST['usr_username']);
    // echo $usr_username;
    // exit;
    $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);


    $query_usr = "SELECT * FROM user WHERE usr_username='$usr_username '";
    $result_usr = mysqli_query($con, $query_usr) or die(mysqli_error($query_usr));

    // echo mysqli_num_rows($result_usr);
    // exit();


    if (mysqli_num_rows($result_usr) == 1) {

        while ($logged_in_user = mysqli_fetch_array($result_usr)) {

            if (password_verify($usr_password, $logged_in_user['usr_password'])) {

                $query_wcf = "SELECT * FROM web_config WHERE wcf_id=3";
                $result_wcf = mysqli_query($con, $query_wcf) or die(mysqli_error($query_wcf));
                $fetch_wcf = mysqli_fetch_array($result_wcf);

                $_SESSION['wcf_name'] = $fetch_wcf['wcf_name'];

                $status_id = $logged_in_user['usr_id'];


                $_SESSION['usr_username'] = $logged_in_user['usr_username'];


                $_SESSION['usr_id'] = $logged_in_user['usr_id'];

                $_SESSION['usr_prefix'] = $logged_in_user['usr_prefix'];
                $_SESSION['usr_firstname'] = $logged_in_user['usr_firstname'];
                $_SESSION['usr_lastname'] = $logged_in_user['usr_lastname'];

                $_SESSION['fct_id'] = $logged_in_user['fct_id'];


                $s_logged_usr_show = $logged_in_user['usr_show'];

                if ($s_logged_usr_show == 1) {

                    $dean_query = "SELECT * FROM dean WHERE usr_id='$status_id'";
                    $dean_result = mysqli_query($con, $dean_query) or die(mysqli_error($dean_query));
                    $dean_access = mysqli_fetch_array($dean_result);
                    $dean_status = $dean_access['dea_id'];
                    $dean_show = $dean_access['dea_show'];
                    if (isset($dean_status)) {
                        $dean_status = 1;
                    }


                    //check admin
                    $admin_result = mysqli_query($con, "SELECT * FROM admin 
                        WHERE usr_id='$status_id'") or die(mysqli_connect_error($admin_result));
                    $admin_access  = mysqli_fetch_assoc($admin_result);
                    $admin_status = $admin_access['adm_id'];
                    $admin_show = $admin_access['adm_show'];
                    // print_r($admin_status);
                    if (isset($admin_status)) {
                        $admin_status = 1;
                        // exit();
                    }

                    //Check endorser
                    $endorser_query = "SELECT * FROM endorser WHERE usr_id='$status_id'";
                    $endorser_result = mysqli_query($con, $endorser_query) or die(mysqli_connect_error());
                    $enodorser_access = mysqli_fetch_assoc(($endorser_result));
                    $endorser_status = $enodorser_access['eds_id'];
                    // print_r($admin_status);
                    if (isset($endorser_status)) {
                        $endorser_status = 1;
                        // exit();
                    }

                    // Check Staff
                    $stf_result = mysqli_query($con, "SELECT * FROM staff 
                 WHERE usr_id='$status_id'") or die(mysqli_connect_error());
                    $stf_access = mysqli_fetch_assoc($stf_result);
                    $stf_status = $stf_access['stf_id'];
                    if (isset($stf_status)) {
                        $stf_status = 1;
                        // exit();
                    }

                    //Check secretary
                    $secretary_query = "SELECT * FROM secretary WHERE usr_id='$status_id'";
                    $secretary_result = mysqli_query($con, $secretary_query) or die(mysqli_connect_error());
                    $secretary_access = mysqli_fetch_assoc(($secretary_result));
                    $secretary_status = $secretary_access['str_id'];
                    // print_r($admin_status);
                    if (isset($secretary_status)) {
                        $secretary_status = 1;
                        // exit();
                    }

                    //Check Student
                    $std_result = mysqli_query($con, "SELECT * FROM student
                 WHERE usr_id='$status_id'") or die(mysqli_connect_error());
                    $std_access = mysqli_fetch_assoc($std_result);
                    $std_status = $std_access['std_id'];
                    if (isset($std_status)) {
                        $std_status = 1;
                        // exit();
                    }

                    // //     //Check teacher
                    $tch_result = mysqli_query($con, "SELECT * FROM teacher
                 WHERE usr_id='$status_id'") or die(mysqli_connect_error());
                    $tch_access = mysqli_fetch_assoc($tch_result);
                    $tch_status = $tch_access['tec_id'];
                    if (isset($tch_status)) {
                        $tch_status = 1;
                        // exit();
                    }

                    // $fct_id =  $_SESSION['fct_id'];
                    if (isset($dean_status) == 1) {
                       
                        if ($dean_show == 0) {
                            $_SESSION['first_login'] = $dean_show;
                           
                        }
                        $_SESSION['dean'] = $dean_status;
                    }
                    if (isset($admin_status) == 1) {
                        // echo "คุณคือ admin";
                        if($admin_show == 0){
                            $_SESSION['first_login'] = $admin_show;
                        }
                        $_SESSION['admin'] = $admin_status;
                       
                    }
                    if (isset($endorser_status) == 1) {
                        
                        $_SESSION['endorser'] = $endorser_status;
                       
                    }

                    if (isset($stf_status) == 1) {
                        // echo "คุณคือ Staff";
                        $_SESSION['staff'] = $stf_status;
                       
                    }

                    if (isset($secretary_status) == 1) {
                        $_SESSION['secretary'] = $secretary_status;
                       
                    }

                    if (isset($std_status) == 1) {
                        // echo "คุณคือ Student";
                        $_SESSION['student'] = $std_status;
                       
                    }
                    if (isset($tch_status) == 1) {
                        // echo "คุณคือ Teacher";
                        $_SESSION['teacher'] = $tch_status;
                       
                    }
                    $output .= 'success';
                } else {
                    $output .= 'unsuccess';
                  
                }
            } else {
                // echo 'false';
                $output .= 'Password is incorrect';
            }
        }
    } else {
        $output .= 'Invalid username and password';
    }
    echo $output;
} else {
    echo "<script>
    window.alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง');
    window.location.href='process_login.php';
  </script>";

    exit;
}
mysqli_close($con);
