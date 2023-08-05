<?php

// page wpt_file.php
require_once('../../../secure/connect.php');


if (isset($_GET['wpt_id'])) {

    //เรียกปีการศึกษา
    $y_id = $_SESSION['y_id'];
    $fct_id = $_SESSION['fct_id'];
    $pro_id = $_SESSION['pro_id'];

    $query_years = "SELECT * FROM years WHERE y_id=$y_id && fct_id=$fct_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

    // //หาปี่การศึกษาและคณะ
    // $y_years = $fetch_years['y_years'];
    // $fct_id = $_SESSION['fct_id'];

    // //path ไปยัง folder ที่อยู่ใน data
    // $path = $fct_id . '_' . $y_years;
    $path = $fetch_years['fct_y'];


    $proid = "pro" .$pro_id;

    chdir("../../../data/$path/project/");
    // echo getcwd();
    // exit;


    $path_upload = "$proid/";

    $wpt_id = $_GET['wpt_id'];
    
    $query_wpt = "SELECT * FROM write_project WHERE wpt_id=$wpt_id";
    // echo $query_wpt;
    // exit;

    $result_wpt = mysqli_query($con, $query_wpt) or die(mysqli_error($query_wpt));
    $write_project = mysqli_fetch_array($result_wpt);
    $filename = $write_project['wpt_filename'];

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
