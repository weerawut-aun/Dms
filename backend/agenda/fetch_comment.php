<?php

include('../../secure/connect.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if (isset($_POST['action'])) {

    $output = '';

    if ($_POST['action'] == 'fetch') {
        $commentQuery = "SELECT c.cmg_comment,c.cmg_date,u.usr_username,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM comment_meeting as c
JOIN user as u ON  u.usr_id = c.usr_id 
WHERE  c.agd_id='" . $_SESSION['agd_id'] . "' ORDER BY c.cmg_id ASC";


        $commentResult = mysqli_query($con, $commentQuery) or die(mysqli_error($commentQuery));


        while ($rows = mysqli_fetch_array($commentResult)) {

            $output .= '<div class="card card-primary">
    <div class="card-header">
        ความคิดเห็น :
    </div>
    <div class="card-body">

        <div class="panel-heading">โดย <b>';

        if($rows['usr_prefix'] == '' || $rows['usr_firstname'] == '' || $rows['usr_lastname'] == ''){
            $message = $rows['usr_username'];
        } else {
            $message = $rows['usr_prefix'].$rows['usr_firstname'].' '.$rows['usr_lastname'];
        }
        $output .= $message;
        
        $output .= '
            </b> วันที่ <i>
                  ' . DateThai2($rows["cmg_date"]) . ' </i></div>
        <div class="panel-body">' . $rows['cmg_comment'] . '</div>
    </div>
</div>';
        }
        echo $output;
    }
    if ($_POST['action'] == 'insert_comment') {

        $usr_id = $_POST['usr_id'];
        $cmg_comment = $_POST['cmg_comment'];
        $comment_id = $_POST['comment_id'];
        $agd_id = $_SESSION['agd_id'];
        $message = '';

        $insert = "INSERT INTO `comment_meeting`(`parent_id`, `cmg_comment`, `agd_id`,`usr_id`) VALUES ('$comment_id','$cmg_comment','$agd_id','$usr_id')";
        $result = mysqli_query($con, $insert) or die(mysqli_error($insert));

        if ($result) {

            $message = 'เรียบร้อยแล้ว';

            echo '<spqn class="text-success">' . $message . '</span>';
        } else {
            $message = 'ไม่สามารถเพิ่มข้อมูลนี้ได้';

            echo '<div class="alert alert-danger">' . $message . '</div>';
        }
    }
}
