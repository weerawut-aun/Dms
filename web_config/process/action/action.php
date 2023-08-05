<?php

if (isset($_POST['action'])) {

    require_once('../../connect.php');

    if ($_POST['action'] == 'fetch_agenda') {

        $output = '';
        $qeury = "SELECT m.*,a.*
        FROM meet_detail as m
        JOIN agenda as a ON a.agd_id = m.agd_id
        WHERE m.y_id='" . $_SESSION['y_id'] . "'
        ORDER BY m.mtd_id asc";


        $result = mysqli_query($con, $qeury) or die(mysqli_error($qeury));


        $output .= '
            <table id="tb_agenda" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>
                        <center>วันที่</center>
                    </th>
                    <th>
                        <center>วาระประชุม</center>
                    </th>
                    <th>
                        <center>หมายเหตุ</center>
                    </th>
                    <th>
                        <center>ดูรายละเอียด</center>
                    </th>
                </tr>
            </thead>
            <tbody>
       ';
        if (mysqli_num_rows($result) == 0) {
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
        } else {
            while ($data = mysqli_fetch_array($result)) {
                $output .= '
                <tr>
                    <td>
                        <center>
                            ' . DateThai($data['agd_day']) . '
                        </center>
                    </td>
                    <td>
                        <center>
                            <a name="agd_id" style="text-decoration: none; 
                            color:black;">
                                ' . $data['agd_name'] . '
                            </a>
                        </center>
                    </td>
                    <td>
                        ' . $data['mtd_detail'] . '
                    </td>
                    <td>
                        <center>
                            <a href="agenda/details_agenda.php?agd_id=' . $data['agd_id'] . '" 
                            class="btn btn-primary" data-toggle="popover" data-trigger="hover" 
                            data-placement="top" data-content="ดูรายละเอียด"><i class="fas fa-search"></i></a>
                        </center>
                    </td>
                </tr>
                ';
            }
        }
        $output .= '
            </tbody>
        </table>
        ';
        echo $output;
    }
    if ($_POST['action'] == 'fetch_project') {

        $output = '';
        $message = '';

        $query_pro = "SELECT * FROM project WHERE y_id='" . $_SESSION['y_id'] . "'";
        $result_pro = mysqli_query($con, $query_pro) or die(mysqli_error($query_pro));
        $num_rows = mysqli_num_rows($result_pro);

        $output .= '
        <table id="tb_project" class="table table-bordered table-hover">
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
        if ($num_rows == 0) {
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
        } else {
            while ($pro = mysqli_fetch_array($result_pro)) {
                $output .= '
                <tr>
                <td>
                    <center>' . $pro['pro_name'] . '</center>
                </td>
                <td>
                    <center><a href="project/details_project.php?pro_id=' . $pro['pro_id'] . '" class="btn btn-primary" 
                    data-toggle="popover" data-trigger="hover" data-placement="right" 
                    data-content="ดูรายละเอียด">
                    <i class="fas fa-search"></i></a></center>
                </td>
                <td>
                    
                ';
                if ($pro['pro_show'] == 0) {
                    $message = '<i class="text-warning">กำลังดำเนินการอยู๋</i>';
                } elseif ($pro['pro_show'] == 2) {
                    $message = '<i class="text-danger">ยกเลิกโครงการ</i>';
                } else {
                    $message = '<i class="text-success">สำเร็จแล้ว</i>';
                }
                $output .= '
                <center>
                    ' . $message . '
                </center>
                </td>
                <td>
                    <center>
                        ' . $pro['pro_details'] . '
                    </center>
                </td>
            </tr>
                ';
            }
        }
        $output .= '
        </tbody>
    </table>';
        echo $output;
    }
}
