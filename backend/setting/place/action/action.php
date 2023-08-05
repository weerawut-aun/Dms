<?php
if (isset($_POST['action'])) {

    include('../../../../secure/connect.php');

    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

    if ($_POST['action'] == 'fetch') {

        $output = '';

        $selcet_pla = "SELECT * FROM place  WHERE fct_id='$fct_id'";
        $result_pla = mysqli_query($con, $selcet_pla) or die(mysqli_error($selcet_pla));
        $num_rows = mysqli_num_rows($result_pla);

        $output .= '
            <table id="tb_place" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            <center>
                                สถานที่
                            </center>
                        </th>
                        <th>
                            <center>
                                สถานะ
                            </center>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            ';
        if ($num_rows > 0) {
            while ($rows = mysqli_fetch_array($result_pla)) {
                $status = '';

                $output .= '
                <tr>
                    <td>' . $rows['pla_name'] . '</td>
                    <td>
                ';
                if ($rows['pla_show'] == '1') {
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
                        data-pla_id="' . $rows['pla_id'] . '" 
                        data-pla_show="' . $rows['pla_show'] . '"
                        title="เปิดใช้งาน">
                            <i class="fas fa-eye"></i>
                    </button>

                    <button type="button" name="action" 
                        class="btn btn-danger bnt-xs delect" 
                        data-pla_id="' . $rows['pla_id'] . '" 
                        data-pla_show="' . $rows['pla_show'] . '"
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
        $message = '';

        $query_chk_status = "SELECT * FROM place WHERE pla_id='" . $_POST['pla_id'] . "'";
        $resutl_chk_status = mysqli_query($con, $query_chk_status);
        $pla_show = mysqli_fetch_array($resutl_chk_status);

        if ($pla_show['pla_show'] == '1') {
            $message = '<i class="text-danger">เปิดใช้งานอยู่แล้ว</i>';


            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $message . '
            </div>
            ';
        } else {
            if ($_POST['pla_show'] == '0') {
                $status = '1';
            }
            $update = "UPDATE place SET pla_show='$status' WHERE pla_id='" . $_POST['pla_id'] . "'";
            $result_update = mysqli_query($con, $update);

            if ($result_update) {


                $message = '<span class="badge bg-success">เปิดใช้งาน</span>';

                echo '
                <div class="alert alert-light">
                    รายการนี้ถูก' . $message . '
                </div>  
                ';
            }
        }
    }

    if ($_POST['action'] == 'change_status_off') {
        $status = '';
        $message = '';

        $query_chk_status = "SELECT * FROM place WHERE pla_id='" . $_POST['pla_id'] . "'";
        $resutl_chk_status = mysqli_query($con, $query_chk_status);
        $pla_show = mysqli_fetch_array($resutl_chk_status);

        if ($pla_show['pla_show'] == '0') {

            $message = '<i class="text-danger">ปิดใช้งานอยู่แล้ว</i>';


            echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $message . '
            </div>
            ';
        } else {

            if ($_POST['pla_show'] == '1') {
                $status = '0';
            }
            $update = "UPDATE place SET pla_show='$status' WHERE pla_id='" . $_POST['pla_id'] . "'";
            $result_update = mysqli_query($con, $update);

            if ($result_update) {

                $message = '<span class="badge bg-danger">ปิดใช้งาน</span>';

                echo '
            <div class="alert alert-light">
                รายการนี้ถูก' . $message . '
            </div>  
            ';
            }
        }
    }

    if ($_POST['action'] == 'insert_data') {

        $message = '';

        $pla_name = mysqli_real_escape_string($con, $_POST['pla_name']);


        $query_chk = "SELECT * FROM place WHERE pla_name='$pla_name' && fct_id='$fct_id'";
        $result_chk = mysqli_query($con, $query_chk) or die(mysqli_error($query_chk));
        $num_rows = mysqli_num_rows($result_chk);

        if ($num_rows == 0) {
            $query_pla = "INSERT INTO place(pla_name,fct_id) VALUES('$pla_name','$fct_id')";
          
            if (mysqli_query($con, $query_pla)) {
                $message .= 'เพิ่มข้อมูลสำเร็จแล้ว';

                echo '<div class="alert alert-success">' . $message . '</div>';
            } else {
                $message .= 'ไม่สามารถเพิ่มข้อมูลได้';
                echo '<div class="alert alert-danger">' . $message . '</div>';
            }
        } else {
            $message = "ข้อมูลซ้ำ กรุณาตรวจสอบใหม่อีกครั้ง";

            echo '<div class="alert alert-danger">' . $message . '</div>';
        }
    }
}
