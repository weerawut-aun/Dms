<?php

require_once('../../../secure/connect.php');

if (!empty($_POST)) {
    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';
    $output = '';
    $pty_type = mysqli_real_escape_string($con, $_POST['pty_type-1']);

    $query_chk = "SELECT * FROM project_type WHERE pty_type='$pty_type'";
    $result_chk = mysqli_query($con, $query_chk) or die($query_chk);
    $num_rows1 = mysqli_num_rows($result_chk);

    if ($num_rows1 > 0) {
        // echo 'ชื่อนี้มีแล้ว';
        $output .= '<label class="text-danger">ประเภทนี้ซ้ำกับฐานข้อมูล กรุณาตรวจสอบ</label>';
        $query_pty = "SELECT * FROM project_type WHERE pty_show='1'";
        $result_pty = mysqli_query($con, $query_pty) or die(mysqli_error($query_pty));
        $num_rows1 = mysqli_num_rows($result_pty);
        $output .= '<div class="col-md-7">
                        <div class="form-group clearfix">';
        if ($num_rows1 > 0) {

            while ($rows_pty = mysqli_fetch_assoc($result_pty)) {
                $output .= '
              
                        <div class="icheck-primary">
                            <label>
                                <input type="checkbox" name="inf_type[]" id="inf_type" value="' . $rows_pty['pty_id'] . '">
                                 ' . $rows_pty['pty_type'] . '
                                 <br>
                            </label>
                        </div>
                    ';
            }
        }
        $output .= ' </div>
                </div>';
        echo $output;
    } else {
        // echo $pty_type;

        $query_pty1 = "INSERT INTO project_type(pty_type) VALUES('$pty_type')";


        if (mysqli_query($con, $query_pty1) or die(mysqli_error($query_pty1))) {

            $query_pty = "SELECT * FROM project_type WHERE pty_show='1'";
            $result_pty = mysqli_query($con, $query_pty) or die(mysqli_error($query_pty));
            $num_rows1 = mysqli_num_rows($result_pty);
            $output .= '  <div class="col-md-7">
                            <div class="form-group clearfix">';
            if ($num_rows1 > 0) {

                while ($rows_pty = mysqli_fetch_assoc($result_pty)) {
                    $output .= '
              
                        <div class="icheck-primary">
                            <label>
                                <input type="checkbox" name="inf_type[]" id="inf_type" value="' . $rows_pty['pty_id'] . '">
                                 ' . $rows_pty['pty_type'] . '
                                 <br>
                            </label>
                        </div>
                    ';
                }
            }
            $output .= '</div>
                </div>';
            echo $output;
        }
    }
}
mysqli_close($con);
