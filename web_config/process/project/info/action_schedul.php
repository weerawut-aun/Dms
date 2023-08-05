<?php


if(isset($_POST)){

    require_once('../../../connect.php');

    if($_POST['action'] == 'fetch'){

        $output = '';

        $query_ise = "SELECT * FROM info_schedule WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY ise_id desc";
        $result_ise = mysqli_query($con, $query_ise) or die(mysqli_error($query_ise));
        $num_rows_ise = mysqli_num_rows($result_ise);
        $rows_ise = mysqli_fetch_array($result_ise);

        $output .= '
         <ul style="list-style-type: none;">
        ';
          // Check Equals 1 row 
          if ($num_rows_ise == 1) {

            $output .= '<li>' . 'วันที่' . ' ' . DateThai($rows_ise['ise_schedule']) . '
                <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_ise['ise_date']) . '</p>
            </li>';
        }
        // check More than 1 row
        elseif ($num_rows_ise > 1) {

            $output .= '<li>' . 'วันที่' . ' ' . DateThai($rows_ise['ise_schedule']) . '
                <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows_ise['ise_date']) . '</p>
                <p>
                    มีการแก้ไข 
                    <a href="" data-toggle="modal" class="list_ise" data-target="#list_ise">
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


        $query_ise = "SELECT * FROM info_schedule WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY ise_id desc";
        $result_ise = mysqli_query($con, $query_ise) or die(mysqli_error($query_ise));
        $num_rows_ise = mysqli_num_rows($result_ise);
        $rows_ise = mysqli_fetch_array($result_ise);

        while ($rows = mysqli_fetch_array($result_ise)) {

            if ($rows_ise['ise_id'] !== $rows['ise_id']) {

                echo '<div id="list_ise">
                        <p>' . 'วันที่' . ' ' . DateThai($rows['ise_schedule']) . '</p>
                        <p><i class="far fa-clock"></i>' . ' ' . DateThai($rows['ise_date']) . '</p>
                    </div>
                    <hr>';
            }
        }
    }
    if($_POST['action'] == 'insert_data'){

        $output = '';
        $messag = '';
        $ise_schedule = mysqli_real_escape_string($con, $_POST['ise_schedule']);
        $pro_id = mysqli_real_escape_string($con, $_SESSION['pro_id']);
        $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
        $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
    
        $insert = "INSERT INTO info_schedule(`ise_schedule`,`pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES(STR_TO_DATE('$ise_schedule','%Y-%m-%d'),'$pro_id','$fct_id','$y_id','$usr_id')";
       
        $result = mysqli_query($con, $insert) or die(mysqli_error($insert));
        $ise_id = mysqli_insert_id($con);
    
        $update = "UPDATE  project_details SET ise_id='$ise_id' WHERE pro_id='$pro_id' && y_id='$y_id' && fct_id='$fct_id'";
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
?>