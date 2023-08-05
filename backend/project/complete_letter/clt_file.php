<?php

// page clt_file.php
require_once('../../../secure/connect.php');


if (isset($_GET['clt_id'])) {

    //เรียกปีการศึกษา
    $y_id = $_SESSION['y_id'];
    $fct_id = $_SESSION['fct_id'];
    $pro_id = $_SESSION['pro_id'];

    $query_years = "SELECT * FROM years WHERE y_id=$y_id && fct_id=$fct_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

    //หาปี่การศึกษาและคณะ
    // $y_years = $fetch_years['y_years'];
    // $fct_id = $_SESSION['fct_id'];

    //path ไปยัง folder ที่อยู่ใน data
    // $path = $fct_id . '_' . $y_years;


    // $pro_id = "pro" . $_SESSION['pro_id'];
    $path = $fetch_years['fct_y'];


    $proid = "pro" .$pro_id;

    chdir("../../../data/$path/project/");


    $path_upload = "$proid/";

    $clt_id = $_GET['clt_id'];
    
    $query_clt = "SELECT * FROM complete_letter WHERE clt_id=$clt_id";
    // echo $query_clt;
    // exit;

    $result_clt = mysqli_query($con, $query_clt) or die(mysqli_error($query_clt));
    $comple_project = mysqli_fetch_array($result_clt);
    $filename = $comple_project['clt_filename'];

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
