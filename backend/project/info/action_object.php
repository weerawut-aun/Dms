<?php

if (isset($_POST['action'])) {

    require_once('./../../../secure/connect.php');

    if ($_POST['action'] == 'fetch') {

        $output = '';

        $query_iof = "SELECT * FROM info_object WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY iof_id desc";
        $result_iof = mysqli_query($con, $query_iof) or die(mysqli_error($query_iof));
        $num_rows_iof = mysqli_num_rows($result_iof);
        $rows_iof = mysqli_fetch_array($result_iof);

        $output .= '
            <ul style="list-style-type: none;">    
        ';
        if ($num_rows_iof == 1) {
            $output .= '<li>
            ' . nl2br($rows_iof['iof_object']) . '
                <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_iof['iof_date']) . '</p>
        </li>';
        } else if ($num_rows_iof > 1) {
            $output .= '
            <li>
            ' . nl2br($rows_iof['iof_object']) . '
            <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_iof['iof_date']) . '</p>
            <p>
            มีการแก้ไข 
            <a href="" data-toggle="modal" class="list_iof" data-target="#list_iof">
                <u>ดูย้อนหลัง</u>
            </a>
        </p>
        </li>
            ';
        } else {
            $output .= '
                <p>ไม่มีข้อมูล</p>
            ';
        }
        $output .= '
        </ul>
        ';


        echo $output;
    }
    if ($_POST['action'] == 'fetch_modal') {

        $query_iof = "SELECT * FROM info_object WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY iof_id desc";
        $result_iof = mysqli_query($con, $query_iof) or die(mysqli_error($query_iof));
        $num_rows_iof = mysqli_num_rows($result_iof);
        $rows_iof = mysqli_fetch_array($result_iof);

        while ($rows = mysqli_fetch_array($result_iof)) {
            if ($rows_iof['iof_id'] !== $rows['iof_id']) {

                echo '<div>
                            <p>' . nl2br($rows['iof_object']) . '</p>
                            <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_iof['iof_date']) . '</p>
                    </div>
                    <hr>';
            }
        }
    }
    if ($_POST['action'] == 'insert_data') {

        $output = '';
        $messag = '';
        $iof_object = mysqli_real_escape_string($con, $_POST['new_object']);
        $pro_id = mysqli_real_escape_string($con, $_SESSION['pro_id']);
        $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
        $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);

        $insert = "INSERT INTO info_object(`iof_object`,`pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES('$iof_object','$pro_id','$fct_id','$y_id','$usr_id')";
      
        $result = mysqli_query($con, $insert) or die($insert) or die(mysqli_error($insert));
        $iof_id = mysqli_insert_id($con);

        $update = "UPDATE  project_details SET iof_id='$iof_id' WHERE pro_id='$pro_id' && y_id='$y_id' && fct_id='$fct_id'";
        $result1 = mysqli_query($con, $update) or die(mysqli_error($update));

        if ($result1) {

            $messag .= 'เพิ่มข้อมูลสำเร็จแล้ว';

            $output .= '<label class="text-success">' . $messag . '</label><br>';
        } else {
            $messag .= 'ผิดพลาด';

            $output .= '<label class="text-danger">' . $messag . '</label><br>';
        }
        echo $output;
    }
}
