<?php


if (isset($_POST)) {
    require_once('../../../connect.php');

    if ($_POST['action'] == 'fetch') {

        $output = '';

        $query_ipt = "SELECT * FROM info_projecttype WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY ipt_id desc";
        $result_ipt = mysqli_query($con, $query_ipt) or die(mysqli_error($query_ipt));
        $num_rows_ipt = mysqli_num_rows($result_ipt);
        $rows_ipt = mysqli_fetch_array($result_ipt);

        $output .= '
            <ul style="list-style-type: none;">
        ';
        if ($num_rows_ipt == 1) {

            $output .= '<li>' . nl2br($rows_ipt['ipt_pty']) . '
            <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_ipt['ipt_date']) . '</p>
            </li>';
        }
        // check More than 1 row
        else if ($num_rows_ipt > 1) {

            $output .= '<li>
                ' . nl2br($rows_ipt['ipt_pty']) .
                '<p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_ipt['ipt_date']) . '</p>
                <p>
                            มีการแก้ไข 
                            <a href="" data-toggle="modal" class="list_ipt" data-target="#list_ipt">
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

        $query_ipt = "SELECT * FROM info_projecttype WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY ipt_id desc";
        $result_ipt = mysqli_query($con, $query_ipt) or die(mysqli_error($query_ipt));
        $num_rows_ipt = mysqli_num_rows($result_ipt);
        $rows_ipt = mysqli_fetch_array($result_ipt);

        while ($rows = mysqli_fetch_array($result_ipt)) {
            if ($rows_ipt['ipt_id'] !== $rows['ipt_id']) {

                echo '<div id="list_ipt">
                        <p>' . nl2br($rows['ipt_pty']) . '<br></p>
                        <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows['ipt_date']) . '</p>
                    </div>
                    <hr>';
            }
        }
    }
    if($_POST['action'] == 'insert_data'){
        $output = '';
        $messag = '';
        $ipt_pty = mysqli_real_escape_string($con, $_POST['ipt_pty']);
        $pro_id = mysqli_real_escape_string($con, $_SESSION['pro_id']);
        $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
        $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);

        $insert = "INSERT INTO info_projecttype(`ipt_pty`, `pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES('$ipt_pty','$pro_id','$fct_id','$y_id','$usr_id')";

        $result = mysqli_query($con, $insert) or die(mysqli_error($inseret));
        $ipt_id = mysqli_insert_id($con);
    
        $update = "UPDATE project_details SET ipt_id='$ipt_id' WHERE pro_id='$pro_id' && y_id='$y_id' && fct_id='$fct_id'";
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
