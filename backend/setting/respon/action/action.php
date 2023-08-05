<?php

if (isset($_POST['action'])) {
    include('../../../../secure/connect.php');

    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

    if ($_POST['action'] == 'fetch') {

        $output = '';

        $query = "SELECT * FROM responsible_project WHERE fct_id='$fct_id'";
        $result = mysqli_query($con, $query) or die(mysqli_error($query));
        $num_rows = mysqli_num_rows($result);

        $output .= '
            <table id="tb_repon" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th> 
                            <center>รายชื่อ </center>
                        </th>
                        <th>
                            <center>สถานะ </center>
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
                            ' . $row['rpt_person'] . '
                        </td>
                        <td>
                    ';
                if ($row['rpt_show'] == 1) {
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
                                data-rpt_id="' . $row['rpt_id'] . '" 
                                data-rpt_show="' . $row['rpt_show'] . '"
                                title="เปิดใช้งาน">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button type="button" name="action" 
                                class="btn btn-danger bnt-xs delect" 
                                data-rpt_id="' . $row['rpt_id'] . '" 
                                data-rpt_show="' . $row['rpt_show'] . '"
                                title="ปิดใช้งาน">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                            </center>
                        </td>
                    </tr>
                    ';
            }
        } else {
            $output .= '
                <tr>
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

        $query_chk_status = "SELECT * FROM responsible_project WHERE rpt_id='" . $_POST['rpt_id'] . "'";
        $result_chk_status = mysqli_query($con, $query_chk_status);
        $rpt_show = mysqli_fetch_array($result_chk_status);

        if ($_POST['rpt_show'] == '1') {
            $status_on = '<i class="text-danger">เปิดใช้งานอยู่แล้ว</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $status_on . '
            </div>
            ';
        } else {
            if ($_POST['rpt_show'] == '0') {
                $status = '1';
            }
            $update = "UPDATE responsible_project SET rpt_show='$status' WHERE rpt_id='" . $_POST['rpt_id'] . "' && fct_id='$fct_id'";
            $resutlt_update = mysqli_query($con, $update);

            if ($resutlt_update) {
               
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

        $query_chk_status = "SELECT * FROM responsible_project WHERE rpt_id='" . $_POST['rpt_id'] . "'";
        $result_chk_status = mysqli_query($con, $query_chk_status);
        $rpt_show = mysqli_fetch_array($result_chk_status);

        if ($_POST['rpt_show'] == '0') {
            $status_off = '<i class="text-danger">ปิดใช้งานอยู่แล้ว</i>';

            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $status_off . '
            </div>
            ';
        } else {
            if ($_POST['rpt_show'] == '1') {
                $status = '0';
            }
            $update = "UPDATE responsible_project SET rpt_show='$status' WHERE rpt_id='" . $_POST['rpt_id'] . "' && fct_id='$fct_id'";
            $resutlt_update = mysqli_query($con, $update);

            if ($resutlt_update) {
               
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

        $rpt_person = $_POST['prefix_repon'].''.$_POST['rpt_firstname'].' '.$_POST['rpt_lastname'];

     
        $query_chk = "SELECT * FROM responsible_project WHERE rpt_person='$rpt_person' && fct_id='$fct_id'";
        $resutl_chk = mysqli_query($con, $query_chk);
        $num_rows = mysqli_num_rows($resutl_chk);

        if ($num_rows == 0) {
            $query_rpt = "INSERT INTO responsible_project(rpt_person,fct_id) VALUES('$rpt_person','$fct_id')";

            if (mysqli_query($con, $query_rpt) or die(mysqli_error($query_rpt))) {
                $message = 'เพิ่มข้อมูลเรียบร้อย';

                echo '<div class="alert alert-light">' . $message . '</div>';
            } else {
                $message = 'ไม่สามารถเพิ่มข้อมูลนี้ได้';

                echo '<div class="alert alert-danger">' . $message . '</div>';
            }
        } else {
            $message = "ข้อมูลซ้ำ กรุณาตรวจสอบใหม่อีกครั้ง";

            echo '<div class="alert alert-danger">' . $message . '</div>';
        }
    }
}
