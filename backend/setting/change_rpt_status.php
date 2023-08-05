<?php
require_once('../../secure/connect.php');
// echo $_POST['val'];
// echo $_POST['rpt_id'];
// echo $_SESSION['fct_id'];

if (!empty($_POST)) {
    $output = '';
    $messag = '';
    $status =  $_POST['val'];
    $rpt_id = $_POST['rpt_id'];
    $fct_id = $_SESSION['fct_id'];

    if (isset($_SESSION['pro_id'])) {

        $query_rpt = "UPDATE responsible_project SET rpt_show='$status' WHERE rpt_id='$rpt_id' && fct_id='$fct_id'";

        $messag = 'อัพข้อมูลสำเร็จแล้ว';

        if (mysqli_query($con, $query_rpt) or die(mysqli_error($query_rpt))) {
            $output .= '<label class="text-success">' . $messag . '</label>';

            $query_rpt = "SELECT * FROM responsible_project WHERE fct_id='" . $_SESSION['fct_id'] . "' && rpt_show='1'";
            $result_rpt = mysqli_query($con, $query_rpt) or die(mysqli_error($query_rpt));
            $num_rows_rpt = mysqli_num_rows($result_rpt);


            $output .= ' <div class="row"> 
            <div class="input-group col-md-7" >
                <select class="custom-select">
                    <option selected>เลือก...</option>';
            if ($num_rows_rpt > 0) {
                while ($rows_rpt = mysqli_fetch_array($result_rpt)) {
                    $output .= ' <option value="' . $rows_rpt['rpt_id'] . '">' . $rows_rpt['rpt_person'] . '</option>';
                }
            }
            $output .= '    </select>
                        <div>
                            <h3 class="text-red">*</h3>
                        </div>
                    </div>
                    </div>';
        }
    } else {

        $query_rpt = "UPDATE responsible_project SET rpt_show='$status' WHERE rpt_id='$rpt_id' && fct_id='$fct_id'";

        $messag = 'อัพข้อมูลสำเร็จแล้ว';

        if (mysqli_query($con, $query_rpt) or die(mysqli_error($query_rpt))) {
            $output .= '<label class="text-success">' . $messag . '</label>';

            $query = "SELECT * FROM responsible_project WHERE fct_id='" . $_SESSION['fct_id'] . "'";
            $result = mysqli_query($con, $query) or die(mysqli_error($query));
            $num_rows = mysqli_num_rows($result);

            $output .= ' <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>รายชื่อ</th>
                                    <th>สถานะ</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>';

            if ($num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $output .= ' <tr>
                                    <td>
                                         ' . $row['rpt_person'] . '
                                    </td>
                                    <td>';
                    if ($row['rpt_show'] == 1) {
                        $output .= '<center>
                                                        <span class="badge bg-success">เปิดใช้งาน</span>
                                                    </center>';
                    } else {
                        $output .= ' <center>
                                                        <span class="badge bg-danger">ปิดใช้งาน</span>
                                                     </center>';
                    }
                    $output .= '</td>
                                    <td>
                                    <select onchange="active_inactive_rpt(this.value,' . $row['rpt_id'] . ')">
                                        <option value="">เลือก</option>
                                        <option value="1">เปิดใช้งาน</option>
                                        <option value="0">ปิดใช้งาน</option>
                                    </select>
                                    </td>
                                </tr>
                         ';
                }
            } else {
                $output .= '<tr class="blank_row">
                            <td colspan="3">
                                <center>
                                    ไม่มีข้อมูล
                                </center>
                            </td>
                        </tr>
                        </tbody>
                        </table>';
            }
        }
    }
    echo $output;
} 
mysqli_close($con);
