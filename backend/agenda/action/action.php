<?php

if (isset($_POST['action'])) {
    include('../../../secure/connect.php');

    if ($_POST['action'] == 'fetch') {
        $output = '';

        $query_agenda = "SELECT m.*,a.*
                FROM meet_detail as m
                JOIN agenda as a ON a.agd_id = m.agd_id
                WHERE m.y_id='" . $_SESSION['y_id'] . "'
                ORDER BY m.mtd_id asc";

        $result1 = mysqli_query($con, $query_agenda) or die(mysqli_error($query_agenda));
        $num_rows = mysqli_num_rows($result1);

        $output .= '
            <table id="tb_agenda" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            <center>วันที่</center>
                        </th>
                        <th>
                            <center>หัวข้อการประชุม</center>
                        </th>
                      
                        <th>
                            <center>ดูรายละเอียด</center>
                        </th>
                        <th>
                            <center>หมายเหตุ</center>
                        </th>
                      
                       
                    </tr>
                </thead>
                <tbody>
            ';
        //     <th>
        //     <center>แก้ไข</center>
        // </th>

        if ($num_rows > 0) {
            while ($data = mysqli_fetch_array($result1)) {
                $output .= '
                <tr>
                <td>
                    <center>
                        ' . DateThai($data['agd_day']) . '
                    </center>
                </td>
                <td>
                   
                        <a name="agd_id" style="text-decoration: none; 
                        color:black;">
                            ' . $data['agd_name'] . '
                        </a>
                 
                </td>
               
                <td>
                    <center>
                        <a href="' . BASE_URL . '/agenda/' . $data['agd_id'] . '" 
                            class="btn btn-primary" data-toggle="popover" data-trigger="hover" 
                            data-placement="top" data-content="ดูรายละเอียด" title="ดูรายละเอียด">
                                <i class="fas fa-search"></i>
                        </a>
                    </center>
                </td>
                <td>
                    ' . $data['mtd_detail'] . '
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
    //     <td>
    //     <a href="' . BASE_URL . '/backend/agenda/frm_edit_agenda.php?agd_id=' . $data['agd_id'] . '" class="btn btn-warning"
    //     title="แก้ไขหัวข้อการประชุม">
    //         <i class="fas fa-edit"></i>
    //     </a>
    // </td>
    }
    if ($_POST['action'] == 'edit_agd') {

       
        $agd_id = mysqli_real_escape_string($con, $_POST['agd_id']);
        $agd_name = mysqli_real_escape_string($con, $_POST['agd_name']);
        $y_id = mysqli_real_escape_string($con,$_SESSION['y_id']);

        $update_agd = "UPDATE agenda SET agd_name='$agd_name' WHERE agd_id='$agd_id'";
        $result_updata  = mysqli_query($con, $update_agd) or die(mysqli_error($update_agd));

        if ($result_updata) {
            echo "<script>
            alert('แก้ไขหัวข้อประชุมสำเร็จสำเร็จแล้ว')
            window.location='" . BASE_URL . "/$y_id/agenda'
        </script>";
            exit();
        } else {
            echo "<script>
            alert('เกิดข้อผิดพลาด')
            window.history.back()
    </script>";
            exit();
        }
    }
}
mysqli_close($con);
