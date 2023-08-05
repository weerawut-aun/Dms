<?php

if (isset($_POST['action'])) {
    include('../../../secure/connect.php');

    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

    if ($_POST['action'] == 'fetch') {
        $output = '';
        $status = '';

        $query_admin = "SELECT u.*,a.usr_id FROM user as u
            JOIN admin as a ON a.usr_id = u.usr_id
            WHERE u.fct_id=$fct_id ";
        $result_admin = mysqli_query($con, $query_admin) or die(mysqli_error($query_admin));

        $output .= '
        <table id="tabel_admin" class="table table-bordered table-striped">
        <thead>
            <tr>
               
                <th><center>ชื่อผู้ใช้งาน</center></th>
                <th><center>สถานะ</center></th>
                <th></th>
            </tr>
           
        </thead>
        <tbody>
        ';
        if (mysqli_num_rows($result_admin) != 0) {
            while ($user = mysqli_fetch_array($result_admin)) {

                if ($user['usr_show'] == 0) {
                    $status = '<span class="badge bg-danger text-white">ปิดใช้งาน</span>';
                } else {
                    $status = '<span class="badge bg-success text-white">เปิดใช้งาน</span>';
                }
                $output .= '
                <tr>
                    <td>' . $user['usr_username'] . '</td>
                    <td>
                       <center>
                            <span>' . $status . '</span>
                       </center>
                    </td>
                    <td> 
                        <center>
                            <button type="button" class="btn btn-warning edit_pasword" data-usr_id="' . $user['usr_id'] . '" 
                                data-toggle="modal" data-target="#modal-edit_password">
                            <i class="fas fa-edit"></i>
                        </button>
                            <button type="button" name="action" 
                                class="btn btn-success bnt-xs  on" 
                                data-usr_id="' . $user['usr_id'] . '" 
                                data-usr_show="' . $user['usr_show'] . '">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" name="action" 
                                class="btn btn-danger bnt-xs off" 
                                data-usr_id="' . $user['usr_id'] . '" 
                                data-usr_show="' . $user['usr_show'] . '">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </center>
                    </td>
                ';
            }
        } else {
            $output .= '
            <tr class="blank_row">
            <td colspan="2">
                <center>
                    ไม่มีข้อมูล
                </center>
            </td>
            <td style="display: none"></td>
         
        </tr>
            ';
        }
        $output .= '
        </tbody>
    </table>
    ';


        echo $output;
    }
    if ($_POST['action'] == 'reset_password') {
        // echo $_POST['usr_id'];
       $message = '';

        if($_POST['usr_password'] == $_POST['c_password']){
            $usr_id = mysqli_real_escape_string($con,$_POST['usr_id']);
            $usr_password = mysqli_real_escape_string($con,$_POST['usr_password']);
            $hash_password = password_hash($usr_password,PASSWORD_DEFAULT);

            $update = "UPDATE user SET usr_password='$hash_password' WHERE usr_id='$usr_id'";
            
            if(mysqli_query($con,$update) or die(mysqli_error($update))){
                $message = '<i class="text-success">เปลี่ยนรหัสผ่านเรียบร้อยแล้ว</i>';

                echo '
                <div class="alert alert-light">
                    รายการนี้ถูก' .  $message . '
                </div>
                ';
            }

        } else {
            $message = '<i class="text-danger">รหัสผ่านไม่ตรงกัน กรุณาเช็คใหม่อีกครั้ง</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' .  $message . '
            </div>
            ';
        }
    }
    if ($_POST['action'] == 'status_on') {
        $status_on = '';
        $status = '';

        $query_status = "SELECT * FROM user WHERE usr_id='" . $_POST['usr_id'] . "'";
        $result_status = mysqli_query($con, $query_status) or die(mysqli_error($query_status));
        $user = mysqli_fetch_array($result_status);
        if ($_POST['usr_show'] == '0') {

            $status = '1';
            $update_status = "UPDATE user SET usr_show='$status' WHERE usr_id='" . $_POST['usr_id'] . "'";
            if (mysqli_query($con, $update_status)) {
                $status_on = '<span class="badge bg-success text-white">เปิดใช้งาน</span>';

                echo '
        <div class="alert alert-light text-while">
            รายการนี้ถูก' . $status_on . '
        </div>  
        ';
            }
        } else {
            $status_on = '<i class="text-danger">เปิดใช้งานอยู่แล้ว</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $status_on . '
            </div>
            ';
        }
    }
    if ($_POST['action'] == 'status_off') {
        $status_off = '';
        $status = '';

        $query_status = "SELECT * FROM user WHERE usr_id='" . $_POST['usr_id'] . "'";
        $result_status = mysqli_query($con, $query_status) or die(mysqli_error($query_status));
        $user = mysqli_fetch_array($result_status);
        if ($_POST['usr_show'] == '1') {
            $status = '0';

            $update_status = "UPDATE user SET usr_show='$status' WHERE usr_id='" . $_POST['usr_id'] . "'";
            // echo $update_status;
            $result_update  = mysqli_query($con, $update_status);

            if ($result_update) {
                $status_off = '<span class="badge bg-danger text-white">ปิดใช้งาน</span>';

                echo '
            <div class="alert alert-light text-while">
                รายการนี้ถูก' . $status_off . '
            </div>  
            ';
            }
        } else {
            $status_off = '<i class="text-danger">ปิดใช้งานอยู่แล้ว</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $status_off . '
            </div>
            ';
        }
    }
}
