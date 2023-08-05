<?php
if (isset($_POST['action'])) {
    require_once('./../../../secure/connect.php');

    if ($_POST['action'] == 'fetch') {
        $output = '';

        $query_irn = "SELECT * FROM info_repon WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY irn_id desc";
        $result_irn = mysqli_query($con, $query_irn) or die(mysqli_error($query_irn));
        $num_rows_irn = mysqli_num_rows($result_irn);
        $rows_irn = mysqli_fetch_array($result_irn);

        $output .= '
            <ul style="list-style-type: none;">
        ';
        // Check Equals 1 row 
        if ($num_rows_irn == 1) {
            $output .= '<li>' . $rows_irn['irn_repon'] . '
                <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_irn['irn_date']) . '</p>
            </li>';
        }
        // check More than 1 row
        elseif ($num_rows_irn > 1) {
            $output .= '<li>' . $rows_irn['irn_repon'] . '
                    <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_irn['irn_date']) . '</p>
                    <p>
                            มีการแก้ไข 
                            <a href="" data-toggle="modal" class="list_irn" data-target="#list_irn">
                                <u>ดูย้อนหลัง</u>
                            </a>
                        </p>
            </li>';
        }
        // check not more rows 
        else {

            $output .= '<p>ไม่มีข้อมูล</p>';
        }
        $output .= '
        </ul>
        ';

        echo $output;
    }
    if ($_POST['action'] == 'fetch_modal') {

        $query_irn = "SELECT * FROM info_repon WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY irn_id desc";
        $result_irn = mysqli_query($con, $query_irn) or die(mysqli_error($query_irn));
        $num_rows_irn = mysqli_num_rows($result_irn);
        $rows_irn = mysqli_fetch_array($result_irn);

        while ($rows = mysqli_fetch_array($result_irn)) {

            if ($rows_irn['irn_id'] !== $rows['irn_id']) {

                echo '<div id="list_irn">
                        <p>' . $rows['irn_repon'] . '</p>
                        <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows['irn_date']) . '</p>
                    </div>
                    <hr>';
            }
        }
    }

    if ($_POST['action'] == 'insert_data') {

        $output = '';
        $messag = '';
        $irn_repon = mysqli_real_escape_string($con, $_POST['irn_repon']);
        $pro_id = mysqli_real_escape_string($con, $_SESSION['pro_id']);
        $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
        $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);

        $insert = "INSERT INTO `info_repon`(`irn_repon`, `pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES ('$irn_repon','$pro_id','$fct_id','$y_id','$usr_id')";

        $result = mysqli_query($con, $insert) or die(mysqli_error($insert));
        $irn_id = mysqli_insert_id($con);

        $update = "UPDATE  project_details SET irn_id='$irn_id' WHERE pro_id='$pro_id' && y_id='$y_id' && fct_id='$fct_id'";
        $result1 = mysqli_query($con, $update) or die(mysqli_error($update));

        if ($result && $result1) {
            $messag .= 'เพิ่มข้อมูลสำเร็จแล้ว';
            $output .= '<label class="text-success">' . $messag . '</label><br>';
        } else {
            $messag .= 'ผิดพลาด';

            $output .= '<label class="text-danger">' . $messag . '</label><br>';
        }
        echo $output;
    }
}
