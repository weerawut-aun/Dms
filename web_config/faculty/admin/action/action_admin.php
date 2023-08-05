<?php
if (isset($_POST['action'])) {

    include('../../../connect.php');

    

    if ($_POST['action'] == 'fetch') {
        $output = '';
        $status = '';
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);


        $query_usr = "SELECT * FROM user WHERE fct_id='$fct_id'";
        $result_usr = mysqli_query($con, $query_usr);

        $output .= '
        <table id="table_usr" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><center>ชื่อผู้ใช้งาน</center></th>
                <th><center>สถานะ</center></th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
        ';
        if (mysqli_num_rows($result_usr) > 0) {
            while ($usr = mysqli_fetch_array($result_usr)) {

                $query_admin = "SELECT * FROM admin WHERE usr_id='" . $usr['usr_id'] . "'";
                $result_admin = mysqli_query($con, $query_admin);

                if (mysqli_num_rows($result_admin) != 0) {

                    if ($usr['usr_show'] == 0) {
                        $status = '<span class="badge bg-danger text-white">ปิดใช้งาน</span>';
                    } else {
                        $status = '<span class="badge bg-success text-white">เปิดใช้งาน</span>';
                    }

                    $output .= '
                    <tr>
                        <td>' . $usr['usr_username'] . '</td>
                        <td><center>' . $status . '</center></td>
                        <td>
                          
                                <a href="frm_edit_admin.php?usr_id=' . $usr['usr_id'] . '" type="button" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" name="action" 
                                    class="btn btn-success bnt-xs on" 
                                    data-usr_id="' . $usr['usr_id'] . '" 
                                    data-usr_show="' . $usr['usr_show'] . '">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" name="action" 
                                    class="btn btn-danger bnt-xs off" 
                                    data-usr_id="' . $usr['usr_id'] . '" 
                                    data-usr_show="' . $usr['usr_show'] . '">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                           
                        </td>
                       
                    </tr>
                ';
                }
            }
        } else {
            $output .= '
            <tr class="blank_row">
            <td colspan="3">
                <center>
                    ไม่มีข้อมูล
                </center>
            </td>
            <td style="display: none"></td>
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
    if ($_POST['action'] == 'change_status_on') {
        $status_on = '';
        $status='';

        $query_status = "SELECT * FROM user WHERE usr_id='" . $_POST['usr_id'] . "'";
        $result_status = mysqli_query($con, $query_status);
        $usr_show = mysqli_fetch_array($result_status);

        if ($_POST['usr_show'] == '1') {
            $status_on = '<i class="text-danger">เปิดใช้งานอยู่แล้ว</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $status_on . '
            </div>
            ';
        } else {
           
            if($_POST['usr_show'] == '0'){
                $status = '1';
            }

            $update_status = "UPDATE user SET usr_show='$status' WHERE usr_id='" . $_POST['usr_id'] . "'";
            $result_update  = mysqli_query($con, $update_status);

            if ($result_update) {
                $status_on = '<span class="badge bg-success text-white">เปิดใช้งาน</span>';

                echo '
            <div class="alert alert-light text-while">
                รายการนี้ถูก' . $status_on . '
            </div>  
            ';
            }
        }
    }
    if ($_POST['action'] == 'change_status_off') {
        $status_off = '';

        $query_status = "SELECT * FROM user WHERE usr_id='" . $_POST['usr_id'] . "'";
        $result_status = mysqli_query($con, $query_status);
        $usr_show = mysqli_fetch_array($result_status);

        if ($_POST['usr_show'] == '0') {

            $status_off = '<i class="text-danger">ปิดใช้งานอยู่แล้ว</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $status_off . '
            </div>
            ';
        } else {
            if($_POST['usr_show'] == '1'){
                $status = '0';
            }

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
        }
    }
}
