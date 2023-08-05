<?php

// page mss_file.php
require_once('../../../connect.php');


if (isset($_GET['mss_id'])) {

    //เรียกปีการศึกษา
    $y_id = mysqli_real_escape_string($con,$_SESSION['y_id']);
    $fct_id = mysqli_real_escape_string($con,$_SESSION['fct_id']);
    $query_years = "SELECT * FROM years WHERE y_id=$y_id && fct_id=$fct_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

  
    $path = $fetch_years['fct_y'];


    $rpdid = "mss" .$y_id;

    chdir("../../../../data/$path/summary/");

    $mss_id = $_GET['mss_id'];
    
    $query_mss = "SELECT * FROM meet_sign_summary WHERE mss_id=$mss_id";
    // echo$query_mssk;
    // exit;

    $result_mss = mysqli_query($con, $query_mss) or die(mysqli_error($query_mss));
    $fetch_mss = mysqli_fetch_array($result_mss);
    $filename = $fetch_mss['mss_filename'];

    $file_upload = $path_upload . basename($filename);
    // echo $file_upload;
    // exit;
    //  Send the file to the browser. 

    if (file_exists($file_upload)) {

        header("Content-Description: File Transfer");

        header("Content-Type: application/octet-stream");

        header("Content-Disposition: attachment; filename=" . basename($file_upload) . "");

        header("Expires: 0");

        header("Cache-Control: must-revalidate");

        header("Pragma: public");

        header("Content-Length:" . filesize($file_upload));

        flush();

        readfile($file_upload);
        die();
    } else {
        die("Invalid file name!");
        exit;
    }
}
