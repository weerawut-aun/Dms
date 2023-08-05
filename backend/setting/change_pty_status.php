<?php
require_once('../../secure/connect.php');
//  echo $_POST['val'];
// echo $_POST['pty_id'];
// echo $_SESSION['fct_id'];
// echo $_SESSION['pro_id'];


if(!empty($_POST)){

    $output = '';
    $message = '';
    $status = $_POST['val'];
    $pty_id = $_POST['pty_id'];
    $fct_id = $_SESSION['fct_id'];


    if(isset($_SESSION['pro_id'])){

        $query_pty = "UPDATE project_type SET pty_show='$status' WHERE pty_id='$pty_id' && fct_id='$fct_id'";

        $message = 'อัพข้อมูลสำเร็จแล้ว';

        if (mysqli_query($con, $query_pty) or die(mysqli_error($query_pty))) {
            $output .= '<label class="text-success">' . $message . '</label>';

            $query_pty = "SELECT * FROM project_type WHERE pty_show='1'";
            $result_pty = mysqli_query($con, $query_pty) or die(mysqli_error($query_pty));
            $num_rows1 = mysqli_num_rows($result_pty);

            $output .= ' <div class="col-md-7">
                            <!-- checkbox -->
                            <div class="form-group clearfix">';

                    if($num_rows1 > 0){
                        while ($rows_pty = mysqli_fetch_assoc($result_pty)) {
                            $output .= '
                    
                                <div class="icheck-primary">
                                    <label>
                                        <input type="checkbox" class="get_pty_id" value="' . $rows_pty['pty_id'] . '">
                                        ' . $rows_pty['pty_type'] . '
                                        <br>
                                    </label>
                                </div>
                            ';
                        }
                    }
            $output .= '</div>
                    </div>';
           
            }
        
    } else {
        $query_pty = "UPDATE project_type SET pty_show='$status' WHERE pty_id='$pty_id' && fct_id='$fct_id'";

        $message = 'อัพข้อมูลสำเร็จแล้ว';
    
        if (mysqli_query($con, $query_pty) or die(mysqli_error($query_pty))) {
            $output .= '<label class="text-success">' . $message . '</label>';
            $selcet_pty = "SELECT * FROM project_type";
            $result = mysqli_query($con, $selcet_pty) or die(mysqli_error($selcet_pty));
            $num_rows = mysqli_num_rows($result);
    
            $output .= ' <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ประเภทโครงการ</th>
                                    <th>สถานะ</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>';
            if ($num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $output .= ' <tr>
                        <td>
                            ' . $row['pty_type'] . '
                        </td>
                        <td>';
                        if ($row['pty_show'] == '1') {
                            $output .= ' <center>
                                <strong class="text-success">เปิดใช้งาน</strong>
                            </center>';
                        } else {
                            $output .= ' <center>
                                <strong class="text-danger">ปิดใช้งาน</strong>
                            </center>';
                        }
                    $output .= '</td>
                                <td>
                                    <select onchange="active_inactive_pty(this.value,' . $row['pty_id'] . ')">
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
                            </tr>
                            </tbody>
                            </table>';
            }
           
        }
        
    }
    echo $output;
}
mysqli_close($con);
