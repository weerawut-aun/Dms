<?php
require_once('./../../../secure/connect.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
//ฟังก์ชั่นแปลงวันที่ไทย 
// function DateThai($strDate)
// {
//     $strYear = date("Y", strtotime($strDate));
//     $strMonth = date("n", strtotime($strDate));
//     $strDay = date("j", strtotime($strDate));
//     $strHour = date("H", strtotime($strDate));
//     $strMinute = date("i", strtotime($strDate));
//     // $strSeconds = date("s", strtotime($strDate));
//     $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
//     $strMonthThai = $strMonthCut[$strMonth];
//     return "$strDay $strMonthThai $strYear";
// }

if (!empty($_POST)) {
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

    $messag .= 'เพิ่มข้อมูลสำเร็จแล้ว';

    if ($result && $result1) {

        $output .= '<label class="text-success">' . $messag . '</label><br>';

        $output .= ' <ul style="list-style-type: none;">';

        $query_irn = "SELECT * FROM info_repon WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY irn_id desc";
        $result_irn = mysqli_query($con, $query_irn) or die(mysqli_error($query_irn));
        $num_rows_irn = mysqli_num_rows($result_irn);
        $rows_irn = mysqli_fetch_array($result_irn);

        // Check Equals 1 row 
        if ($num_rows_irn == 1) {
            $output .='<li>' . $rows_irn['irn_repon'] . '
            <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_irn['irn_date']) . '</p>
            </li>';
        }
        // check More than 1 row
        elseif ($num_rows_irn > 1) {
            $output .='<li>' . $rows_irn['irn_repon'] . '
                        <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_irn['irn_date']) . '</p>
                        <p>
                            มีการแก้ไข 
                            <a href="" data-toggle="modal" data-target="#list_irn">
                                <u>ดูย้อนหลัง</u>
                            </a>
                        </p>
                </li>';

         
        }
        // check not more rows 
        else {

            $output .= '<p>ไม่มีข้อมูล</p>';
        }
        $output .= '</ul>';
    } else {
        $messag .= 'ผิดพลาด';

        $output .= '<label class="text-danger">' . $messag . '</label><br>';

        $output .= ' <ul style="list-style-type: none;">';

        $query_irn = "SELECT * FROM info_repon WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY irn_id desc";
        $result_irn = mysqli_query($con, $query_irn) or die(mysqli_error($query_irn));
        $num_rows_irn = mysqli_num_rows($result_irn);
        $rows_irn = mysqli_fetch_array($result_irn);

        // Check Equals 1 row 
        if ($num_rows_irn == 1) {
            $output .='<li>' . $rows_irn['irn_repon'] . '
                <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_irn['irn_date']) . '</p>
            </li>';
        }
        // check More than 1 row
        elseif ($num_rows_irn > 1) {
            $output .='<li>' . $rows_irn['irn_repon'] . '
                <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_irn['irn_date']) . '</p>
                <p>
            มีการแก้ไข 
            <a href="" data-toggle="modal" data-target="#list_irn">
                <u>ดูย้อนหลัง</u>
            </a>
        </p>
            </li>';

            
        }
        // check not more rows 
        else {

            $output .= '<p>ไม่มีข้อมูล</p>';
        }
        $output .= '</ul>';
    }
    echo $output;
} else {
    echo "เกิดข้อผิดพลาด" . mysqli_error($con);
    echo "<script type=\"text/javascript\">";
    echo "alert(\"ผิดพลา่ด โปรดลองอีกครั้ง\");";
    echo "window.location='" . BASE_URL . "/backend/project/info/frm_info.php''";
    echo "</script>";
    exit();
}

mysqli_close($con);
