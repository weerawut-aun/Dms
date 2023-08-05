<?php

// page rms_file.php
require_once('../../../connect.php');


if (isset($_GET['rms_id'])) {

    //เรียกปีการศึกษา
    $y_id = mysqli_real_escape_string($con,$_SESSION['y_id']);
    $fct_id = mysqli_real_escape_string($con,$_SESSION['fct_id']);
    $query_years = "SELECT * FROM years WHERE y_id=$y_id && fct_id=$fct_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

  
    $path = $fetch_years['fct_y'];


    $rpdid = "rms" .$y_id;

    chdir("../../../../data/$path/summary/");

    $rms_id = $_GET['rms_id'];
    
    $query_rms = "SELECT * FROM report_meet_summary WHERE rms_id=$rms_id";
    // echo$query_rmsk;
    // exit;

    $result_rms = mysqli_query($con, $query_rms) or die(mysqli_error($query_rms));
    $fetch_rms = mysqli_fetch_array($result_rms);
    $filename = $fetch_rms['rms_filename'];

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
