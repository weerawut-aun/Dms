<?php

if (isset($_POST['action'])) {

    include('../../../../secure/connect.php');

    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

    if ($_POST['action'] == 'fetch') {


        $output = '';

        $selcet_pty = "SELECT * FROM project_type WHERE fct_id='$fct_id'";
        $result = mysqli_query($con, $selcet_pty) or die(mysqli_error($selcet_pty));
        $num_rows = mysqli_num_rows($result);

        $output .= '
        <table id="tb_project_type" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>
                        <center>ประเภทโครงการ</center>
                    </th>
                    <th>
                        <center>สถานะ</center>
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        ';
        if ($num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {

                $status = '';

                $output .= '
                    <tr>
                        <td>
                            ' . $row['pty_type'] . '
                        </td>
                        <td>
                ';
                if ($row['pty_show'] == '1') {
                    $status = '<span class="badge bg-success">เปิดใช้งาน</span>';
                } else {
                    $status = '<span class="badge bg-danger">ปิดใช้งาน</span>';
                }
                $output .= '    
                            <center>
                                <span>' . $status . '<span>
                            </center>
                        </tb>
                        <td>
                            <center>
                            <button type="button" name="action" 
                                class="btn btn-success bnt-xs edit" 
                                data-pty_id="' . $row['pty_id'] . '" 
                                data-pty_show="' . $row['pty_show'] . '" title="เปิดใช้งาน">
                                    <i class="fas fa-eye"></i>
                            </button>

                            <button type="button" name="action" 
                                class="btn btn-danger bnt-xs delect" 
                            data-pty_id="' . $row['pty_id'] . '" 
                            data-pty_show="' . $row['pty_show'] . '" title="ปิดใช้งาน">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                            </center>
                        </td>
                    </tr>
                                
                ';
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
        </table>';
        echo $output;
    }

    if ($_POST['action'] == 'change_status_on') {

        $status = '';
        $status_on = '';

        $query_chk_status = "SELECT * FROM project_type WHERE pty_id='" . $_POST['pty_id'] . "'";
        $result_chk_Status = mysqli_query($con, $query_chk_status);
        $pty_show = mysqli_fetch_array($result_chk_Status);


        if ($pty_show['pty_show'] == '1') {
            $status_on = '<i class="text-danger">เปิดใช้งานอยู่แล้ว</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $status_on . '
            </div>
            ';
        } else {

            if ($_POST['pty_show'] == '0') {
                $status = '1';
            }
            $update = "UPDATE project_type SET pty_show='$status' WHERE pty_id='" . $_POST['pty_id'] . "'";
            $result_update = mysqli_query($con, $update);

            if ($result_update) {

                $status_on = '<span class="badge bg-success">เปิดใช้งาน</span>';
                echo '
            <div class="alert alert-light">
            รายการนี้ถูก' . $status_on . '
        </div>
            ';
            }
        }
    }
    if ($_POST['action'] == 'change_status_off') {
        $status = '';
        $status_off = '';

        $query_chk_status = "SELECT * FROM project_type WHERE pty_id='" . $_POST['pty_id'] . "'";

        $result_chk_Status = mysqli_query($con, $query_chk_status);
        $pty_show = mysqli_fetch_array($result_chk_Status);


        if ($pty_show['pty_show'] == '0') {
            $status_off = '<i class="text-danger">ปิดใช้งานอยู่แล้ว</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $status_off . '
            </div>
            ';
        } else {

            if ($_POST['pty_show'] == '1') {
                $status = '0';
            }
            $update = "UPDATE project_type SET pty_show='$status' WHERE pty_id='" . $_POST['pty_id'] . "'";
            $result_update = mysqli_query($con, $update);

            if ($result_update) {

                $status_off = '<span class="badge bg-danger">ปิดใช้งาน</span>';
                echo '
            <div class="alert alert-light">
            รายการนี้ถูก' . $status_off . '
        </div>
            ';
            }
        }
    }

    if ($_POST['action'] == 'insert_data') {


        $message = '';

        $pty_type = mysqli_real_escape_string($con, $_POST['pty_type']);

        $query_chk = "SELECT * FROM project_type WHERE pty_type = '$pty_type' && fct_id='$fct_id'";
        $result_chk = mysqli_query($con, $query_chk) or die(mysqli_error($query_chk));
        $num_rows = mysqli_num_rows($result_chk);

        if ($num_rows == 0) {
            $query_pty = "INSERT INTO project_type(pty_type,fct_id) VALUES('$pty_type','$fct_id')";

            if (mysqli_query($con, $query_pty) or die(mysqli_error($query_pty))) {
                $message = "เพิ่มข้อมูลเรียบร้อย";

                echo '<div class="alert alert-success">' . $message . '</div>';
            }
        } else {
            $message = "ข้อมูลซ้ำ กรุณาตรวจสอบใหม่อีกครั้ง";

            echo '<div class="alert alert-danger">' . $message . '</div>';
        }
    }
}
