<?php

require_once('../../../secure/connect.php');



if (isset($_POST['agd_name'])) {

    //post value for frm_agenda.php
    $agd_name = mysqli_real_escape_string($con, $_POST['agd_name']);
    // $mtd_day = $_POST['mtd_day'];
    $mtd_day = mysqli_real_escape_string($con, $_POST['mtd_day']);
    //  $mtd_deatil = $_POST['mtd_detail'];
    $mtd_deatil = mysqli_real_escape_string($con, $_POST['mtd_detail']);
    // $usr_id = $_SESSION['usr_id'];
    $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
    // $y_id = $_SESSION['y_id'];
    $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);

    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

 
    $query_years = "SELECT * FROM years WHERE y_id=$y_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch = mysqli_fetch_array($result_years);

    $path = $fetch['fct_y'];

    chdir("../../../data/$path/agenda");
   

    // INSERT data to database agenda
    $query = "INSERT INTO agenda(agd_name,y_id,fct_id) VALUES ('$agd_name','$y_id','$fct_id')";

    

    $result = mysqli_query($con, $query) or die(mysqli_error(($query)));

    $agd_id = mysqli_insert_id($con);

  

    $query1 = "INSERT INTO `meet_detail`(`mtd_day`, `agd_id`, `usr_id`, `y_id`,`fct_id`, `mtd_detail`)
        VALUES ('$mtd_day',$agd_id,$usr_id,$y_id,'$fct_id','$mtd_deatil')";

    $result1 = mysqli_query($con, $query1) or die(mysqli_error(($query1)));


    // //Checked $result
    if ($result && $result1) {

        mkdir("agd$agd_id");

        echo "<script>
                alert('เพิ่มวาระการประชุมสำเร็จสำเร็จแล้ว')
                window.location='".BASE_URL."/$y_id/agenda'
            </script>";
        exit();

    } else {


        echo "<script>
                    alert('เกิดข้อผิดพลาด')
                    window.history.back()
            </script>";
        exit();
    }
} else {
    // echo "เกิดข้อผิดพลาด" . mysqli_error($con);
    echo "<script>
            alert(\"ผิดพลา่ด โปรดลองอีกครั้ง\")
            window.history.back()
        </script>";
    exit();
}
mysqli_close($con);
