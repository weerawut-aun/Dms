<?php
if (isset($_POST['action'])) {
    require_once('../../../connect.php');

    if ($_POST['action'] == 'fetch') {
        $output = '';

        $query_ipe = "SELECT * FROM info_place WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY ipe_id desc";
        $result_ipe = mysqli_query($con, $query_ipe) or die(mysqli_error($query_ipe));
        $num_rows_ipe = mysqli_num_rows($result_ipe);
        $rows_ipe = mysqli_fetch_array($result_ipe);

        $output .= '
            <ul style="list-style-type: none;">
        ';
        // Check Equals 1 row   
        if ($num_rows_ipe == 1) {

            $output .= '<li>' . nl2br($rows_ipe['ipe_place']) . '
                 <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_ipe['ipe_date']) . '</p>
            </li>';
        }
        // check More than 1 row
        else if ($num_rows_ipe > 1) {

            $output .= '<li>' . nl2br($rows_ipe['ipe_place']) . '
            <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_ipe['ipe_date']) . '</p>
            <p>
                            มีการแก้ไข 
                            <a href="" data-toggle="modal" class="list_ipe" data-target="#list_ipe">
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
        $query_ipe = "SELECT * FROM info_place WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY ipe_id desc";
        $result_ipe = mysqli_query($con, $query_ipe) or die(mysqli_error($query_ipe));
        $num_rows_ipe = mysqli_num_rows($result_ipe);
        $rows_ipe = mysqli_fetch_array($result_ipe);

        while ($rows = mysqli_fetch_array($result_ipe)) {

            if ($rows_ipe['ipe_id'] !== $rows['ipe_id']) {

                echo '<div id="list_ipe">
                        <p>' . nl2br(($rows['ipe_place'])) . '</p>
                        <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows['ipe_date']) . '</p>
                    </div>
                    <hr>';
            }
        }
    }
    if ($_POST['action'] == 'insert_data') {

        $output = '';
        $messag = '';
        $ipe_place = mysqli_real_escape_string($con, $_POST['ipe_place']);
        $pro_id = mysqli_real_escape_string($con, $_SESSION['pro_id']);
        $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
        $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);

        $insert = "INSERT INTO `info_place`(`ipe_place`, `pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES ('$ipe_place','$pro_id','$fct_id','$y_id','$usr_id')";

        $result = mysqli_query($con, $insert) or die(mysqli_error($insert));
        $ipe_id = mysqli_insert_id($con);

        $update = "UPDATE  project_details SET ipe_id='$ipe_id' WHERE pro_id='$pro_id' && y_id='$y_id' && fct_id='$fct_id'";
        $result1 = mysqli_query($con, $update) or die(mysqli_error($update));

        if ($result && $result1) {
            $messag = 'เพิ่มข้อมูลสำเร็จแล้ว';

            $output .= '<label class="text-success">' . $messag . '</label><br>';
        } else {
            $messag = 'ผิดพลาด';

            $output .= '<label class="text-danger">' . $messag . '</label><br>';
        }
         echo $output;
    }
}
