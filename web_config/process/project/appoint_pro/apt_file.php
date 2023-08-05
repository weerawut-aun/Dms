<?php

// page apt_file.php
require_once('../../../connect.php');


if (isset($_GET['apt_id'])) {

    //เรียกปีการศึกษา
    $y_id = $_SESSION['y_id'];
    $fct_id = $_SESSION['fct_id'];
    $pro_id = $_SESSION['pro_id'];

    $query_years = "SELECT * FROM years WHERE y_id=$y_id && fct_id=$fct_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

   
    $path = $fetch_years['fct_y'];

    $proid = "pro" .$pro_id;

    chdir("../../../../data/$path/project/");


    $path_upload = "$proid/";

    
    $apt_id = $_GET['apt_id'];
    
    $query_apt = "SELECT * FROM appoint_letter WHERE apt_id=$apt_id";
    // echo $query_apt;
    // exit;

    $result_apt = mysqli_query($con, $query_apt) or die(mysqli_error($query_apt));
    $write_project = mysqli_fetch_array($result_apt);
    $filename = $write_project['apt_filename'];

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
