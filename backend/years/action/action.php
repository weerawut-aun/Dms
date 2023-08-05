<?php

if (isset($_POST['action'])) {
    include('../../../secure/connect.php');

    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

    if ($_POST['action'] == 'fetch') {
        $output = '';

        $query_years = "SELECT * from years WHERE fct_id=$fct_id ORDER BY y_years asc ";
        $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
        $num_rows = mysqli_num_rows($result_years);

        $output .= '
                <table id="tb_years" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                <center>ปีการศึกษา</center>
                            </th>
                            <th>
                                <center>สถานะ</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        if ($num_rows > 0) {
            while ($rows = mysqli_fetch_array($result_years)) {
                $status = '';
                $output .= '
                <tr>
                    <td>
                        ' . $rows['y_years'] . '
                    </td>
                    <td>
                    
                ';
                if ($rows['y_show'] == 0) {
                    $status = '<i class="text-warning">กำลังดำเนินการอยู๋</i>';
                } else {
                    $status = '<i class="text-success">สำเร็จแล้ว</i>';
                }

                $output .= '
                        <center>
                            <span>' . $status . '<span>
                        </center>
                    </tb>';
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
    </table>';
        echo $output;
    }
}
