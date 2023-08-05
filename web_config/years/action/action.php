<?php

if (isset($_POST['action'])) {

    include('../../connect.php');


    if ($_POST['action'] == 'fetch') {


        $output = '';
        $query_years = mysqli_query($con, "SELECT * FROM years WHERE fct_id='" . $_SESSION['fct_id'] . "'");
        $num_rows = mysqli_num_rows($query_years);

        $output .= '
            <table id="tb_years" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>
                        <center>
                            คณะ
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

            while ($row = mysqli_fetch_array($query_years)) {


                $output .= '
                  <tr>
                  <td>' . $row['y_years'] . '</td>
                  <td>
                      <center>';

                if ($row['y_show'] == 0) {
                    $output .= '
                              <i class="text-warning">กำลังดำเนินการอยู๋</i>
                              ';
                } else {
                    $output .= '<i class="text-success">สำเร็จแล้ว</i>';
                }
                $output .= '
                      </center>
                  </td>
                  <td>
                        <center>
                        <a class="btn btn-primary" href="../process/procedure.php?y_id=' . $row['y_id'] . '">
                            ดูรายละเอียด
                        </a>
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
        </table>
        ';
        echo $output;
    }
}
