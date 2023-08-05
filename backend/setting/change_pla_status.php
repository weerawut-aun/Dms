<?php
require_once('../../../secure/connect.php');

// echo $_POST['val'];
// echo $_POST['pla_id'];
// echo $_SESSION['fct_id'];
if (!empty($_POST)) {

    $output = '';
    $message = '';
    $status = mysqli_real_escape_string($con, $_POST['val']);
    $pla_id = mysqli_real_escape_string($con, $_POST['pla_id']);
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);




    if (isset($_SESSION['pro_id'])) {

        
        $query_pla = "UPDATE place SET pla_show='$status' WHERE pla_id='$pla_id' && fct_id='$fct_id'";

        $message = 'อัพข้อมูลสำเร็จแล้ว';

        if (mysqli_query($con, $query_pla) or die(mysqli_error($query_pla))) {

            $output .= '<label class="text-success">' . $message . '</label>';

            $query_pla = "SELECT * FROM place WHERE fct_id='" . $_SESSION['fct_id'] . "' && pla_show='1'";
            $result_pla = mysqli_query($con, $query_pla) or die(mysqli_error($query_pla));
            $num_rows_pla = mysqli_num_rows($result_pla);

            $output .= '<div class="row">
                        <div class="input-group col-md-7">
                            <select class="custom-select">
                                <option selected>...กรุณาเลือก...</option>';
            if ($num_rows_pla > 0) {
                while ($rows_pla = mysqli_fetch_array($result_pla)) {
                    $output .= ' <option value="' . $rows_pla['pla_id'] . '">' . $rows_pla['pla_name'] . '</option>';
                }
            }
            $output .= '</select>
            </div>
                                <div class="col-md-1">
                                    <h3 class="text-red">*</h3>
                                </div>';
        } 
    } else {
        $query_pla = "UPDATE place SET pla_show='$status' WHERE pla_id='$pla_id' && fct_id='$fct_id'";

        $message = 'อัพข้อมูลสำเร็จแล้ว';

        if (mysqli_query($con, $query_pla) or die(mysqli_error($query_pla))) {

            $output .= '<label class="text-success">' . $message . '</label>';

            $query = "SELECT * FROM place WHERE fct_id='$fct_id'";
            $result = mysqli_query($con, $query) or die(mysqli_error($query));
            $num_rows = mysqli_num_rows($result);

            $output .= ' <table class="table table-bordered">
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
                    <th>
                        <center>
                            แก้ไข
                        </center>
                    </th>
                </tr>
            </thead>
            <tbody>';
            if ($num_rows > 0) {
                while ($rows = mysqli_fetch_array($result)) {
                    $output .= '<tr>
                                <td>
                                    ' . $rows['pla_name'] . '
                                    </td>
                                    <td>';
                    if ($rows['pla_show'] == '1') {
                        $output .= '  <center>
                                                        <strong class="text-success">เปิดใช้งาน</strong>
                                                    </center>';
                    } else {
                        $output .= ' <center>
                                                        <strong class="text-danger">ปิดใช้งาน</strong>
                                                    </center>';
                    }
                    $output .= '  </td>
                <td>
                  
                    <select onchange="active_inactive_pla(this.value,' . $rows['pla_id'] . ')">
                        <option value="">Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </td>
            </tr>';
                }
            } else {
                $output .= '<tr class="blank_row">
            <td colspan="3">
                <center>
                    ไม่มีข้อมูล
                </center>
            </td>
        </tr>';
            }
            $output .= '    </tbody>
        </table>';
        }
    }

    echo $output;
}
mysqli_close($con);
