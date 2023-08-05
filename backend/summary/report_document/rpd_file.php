<?php

// page rpd_file.php
require_once('../../../secure/connect.php');


if (isset($_GET['rpd_id'])) {

    //เรียกปีการศึกษา
    $y_id = mysqli_real_escape_string($con,$_SESSION['y_id']);
    $fct_id = mysqli_real_escape_string($con,$_SESSION['fct_id']);
    $query_years = "SELECT * FROM years WHERE y_id=$y_id && fct_id=$fct_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

  
    $path = $fetch_years['fct_y'];


    $rpdid = "rpd" .$y_id;

    chdir("../../../data/$path/summary/");

    $rpd_id = $_GET['rpd_id'];
    
    $query_rpd = "SELECT * FROM report_document WHERE rpd_id=$rpd_id";
    // echo$query_rpdk;
    // exit;

    $result_rpd = mysqli_query($con, $query_rpd) or die(mysqli_error($query_rpd));
    $fetch_rpd = mysqli_fetch_array($result_rpd);
    $filename = $fetch_rpd['rpd_filename'];

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
