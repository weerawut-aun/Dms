<?php

if(isset($_POST['action'])){
    include('../../secure/connect.php');

    if($_POST['action'] == 'fetch'){
        $output = '';
        $message = '';

        $query_pro = "SELECT * FROM project WHERE y_id='" . $_SESSION['y_id'] . "'";
        $result_pro = mysqli_query($con, $query_pro) or die(mysqli_error($query_pro));
        $num_rows = mysqli_num_rows($result_pro);

        $output .= '
        <table id="list_project" class="table table-bordered table-hover">
            <thead>
                <tr>

                    <th>
                        <center>โครงการ</center>
                    </th>
                    <th>
                        <center>เรียกดูข้อมูล</center>
                    </th>
                    <th>
                        <center>สถานะ</center>
                    </th>
                    <th>
                        <center>หมายเหตุ</center>
                    </th>
                </tr>
            </thead>
            <tbody>
        ';
        if ($num_rows > 0) { 
            while ($pro = mysqli_fetch_array($result_pro)) {
                $output .= '
                <tr>
                <td>
                    '. $pro['pro_name'].'
                </td>
                <td>
                    <center><a href="'.BASE_URL .'/project/'. $pro['pro_id'] .'" class="btn btn-primary" 
                    data-toggle="popover" data-trigger="hover" data-placement="right" 
                    data-content="ดูรายละเอียด">
                    <i class="fas fa-search"></i></a></center>
                </td>
                <td>
                    
                ';
                if ($pro['pro_show'] == 0) {
                    $message = '<i class="text-warning">กำลังดำเนินการอยู๋</i>';
                } elseif($pro['pro_show'] == 2){
                    $message = '<i class="text-danger">ยกเลิกโครงการ</i>';
                }else {
                    $message = '<i class="text-success">สำเร็จแล้ว</i>';
                }
                $output .= '
                <center>
                    '.$message.'
                </center>
                </td>
                <td>
                    
                        '.$pro['pro_details'].'
                    
                </td>
            </tr>
                ';
            }
        } else {
            $output .= '
            <tr class="blank_row">
            <td colspan="4">
                <center>
                    ไม่มีข้อมูล
                </center>
            </td>
            <td style="display: none"></td>
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
}
