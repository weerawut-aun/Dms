<?php

require_once('../../../connect.php');
include('../../../include/auth.php');



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
</div>
<br>';
        }
        echo $output;
    }
   
}
