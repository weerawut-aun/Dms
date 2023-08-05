<?php

require_once('./../../../secure/connect.php');

// echo'<pre>';
// print_r($_POST);
// echo'</pre>';

if (!empty($_POST)) {

    // $iof_object = $_POST['iof_object'];
    $iof_object = mysqli_real_escape_string($con, $_POST['iof_object']);
    // $ipt_pty = implode(',', $_POST['ipt_pty']);
    $ipt_pty = mysqli_real_escape_string($con, $_POST['ipt_pty']);
    // $ise_schedule = $_POST['ise_schedule'];
    $ise_schedule = mysqli_real_escape_string($con, $_POST['ise_schedule']);
    // $ipe_place = $_POST['ipe_place'];
    $ipe_place = mysqli_real_escape_string($con, $_POST['ipe_place']);
    // $irn_repon = $_POST['irn_repon'];
    $irn_repon = mysqli_real_escape_string($con, $_POST['irn_repon']);
    // $usr_id = $_SESSION['usr_id'];
    $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
    // $pro_id = $_SESSION['pro_id'];
    $pro_id = mysqli_real_escape_string($con, $_SESSION['pro_id']);
    // $y_id = $_SESSION['y_id'];
    $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
    // $fct_id = $_SESSION['fct_id'];
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

    // echo 'วัตถุประสงค์='.$iof_object.'<br>'
    // .'ประเภทโครงการ='.$ipt_pty,'<br>'
    // .'กำหนกการ'.$ise_schedule.'<br>'
    // .'สถานที่จัดงาน'.$ipe_place.'<br>'
    // .'ผู้รับผิดชอบ='.$irn_repon.'<br>'
    // .'ผู้บันทึกโครงการ='.$usr_id.'<br>'
    // .'ไอดีโครงการ='.$pro_id.'<br>'
    // .'ปีการศึกษา='.$y_id.'<br>'
    // .'ไอดีคณะ='.$fct_id.'<br>';

    // exit();

    //    echo 'ข้อมูลสำเร็จ';

    // insert into info_object
    $insert_iof = "INSERT INTO info_object( `iof_object`, `pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES('$iof_object','$pro_id','$fct_id','$y_id','$usr_id')";
    $result_iof = mysqli_query($con, $insert_iof) or die(mysqli_error($insert_iof));
    $_SESSION['iof_id'] = mysqli_insert_id($con);


    // insert into info_projecttype
    $insert_ipt = "INSERT INTO info_projecttype( `ipt_pty`, `pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES('$ipt_pty','$pro_id','$fct_id','$y_id','$usr_id')";
    $result_ipt = mysqli_query($con, $insert_ipt) or die(mysqli_error($insert_ipt));
    $_SESSION['ipt_id'] = mysqli_insert_id($con);

    // insert into info_schedule
    $insert_ise = "INSERT INTO info_schedule(`ise_schedule`,`pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES(STR_TO_DATE('$ise_schedule','%Y-%m-%d'),'$pro_id','$fct_id','$y_id','$usr_id')";
    $result_ise = mysqli_query($con, $insert_ise) or die(mysqli_error($insert_ise));
    $_SESSION['ise_id'] = mysqli_insert_id($con);

    // echo $_SESSION['ise_id'];


    // insert into  info_place
    $insert_ipe = "INSERT INTO `info_place`(`ipe_place`, `pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES ('$ipe_place','$pro_id','$fct_id','$y_id','$usr_id')";
    $result_ipe = mysqli_query($con, $insert_ipe) or die(mysqli_error($insert_ipe));
    $_SESSION['ipe_id'] = mysqli_insert_id($con);

    // insert into  info_repon
    $insert_irn = "INSERT INTO `info_repon`(`irn_repon`, `pro_id`,`fct_id`,`y_id`,`usr_id`) VALUES ('$irn_repon','$pro_id','$fct_id','$y_id','$usr_id')";
    $result_irn = mysqli_query($con, $insert_irn) or die(mysqli_error($insert_irn));
    $_SESSION['irn_id'] = mysqli_insert_id($con);

    // $insert_pdt = "INSERT INTO project_details( `iof_id`, `ipt_id`,`ise_id`,`ipe_id`,`irn_id`,`pro_id`,`fct_id`,`y_id`) 
    //             VALUES('" . $_SESSION['iof_id'] . "',
    //             '" . $_SESSION['ipt_id'] . "',
    //             '" . $_SESSION['ise_id'] . "'
    //             ,'" . $_SESSION['ipe_id'] . "'
    //             ,'" . $_SESSION['irn_id'] . "'
    //             ,'$pro_id'
    //             ,'$fct_id'
    //             ,'$y_id')" or die(mysqli_error($insert_irn));
    $update_pdt = "UPDATE project_details SET `iof_id`='" . $_SESSION['iof_id'] . "'
                    ,`ipt_id`= '" . $_SESSION['ipt_id'] . "'
                    ,`ise_id`='" . $_SESSION['ise_id'] . "'
                    ,`ipe_id`='" . $_SESSION['ipe_id'] . "'
                    ,`irn_id`='" . $_SESSION['irn_id'] . "'
                    WHERE pro_id='$pro_id' && fct_id='$fct_id' && y_id='$y_id'";
    $result_pdt = mysqli_query($con, $update_pdt) or die(mysqli_error($update_pdt));

    if ($result_pdt) {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"เพิ่มข้อมูลเรียบร้อย\");";
        echo "window.location='".BASE_URL."/project/$pro_id'";
        echo "</script>";
        exit();
    } else {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"ผิดพลา่ด โปรดลองอีกครั้ง\");";
        echo "window.location='".BASE_URL."/backend/project/info/frm_info.php'";
        echo "</script>";
        exit();
    }
} else {
    echo "เกิดข้อผิดพลาด" . mysqli_error($con);
    echo "<script type=\"text/javascript\">";
    echo "alert(\"ผิดพลา่ด โปรดลองอีกครั้ง\");";
    echo "window.location='".BASE_URL."/backend/project/info/frm_info.php'";
    echo "</script>";
    exit();
}
mysqli_close($con);
