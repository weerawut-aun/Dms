<?php

// page ils_file.php
require_once('../../../secure/connect.php');


if (isset($_GET['ils_id'])) {

    //เรียกปีการศึกษา
    $y_id = mysqli_real_escape_string($con,$_SESSION['y_id']);
    $fct_id = mysqli_real_escape_string($con,$_SESSION['fct_id']);
    $query_years = "SELECT * FROM years WHERE y_id=$y_id && fct_id=$fct_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

  
    $path = $fetch_years['fct_y'];


    $rpdid = "ils" .$y_id;

    chdir("../../../data/$path/summary/");

    $ils_id = $_GET['ils_id'];
    
    $query_ils = "SELECT * FROM invitation_letter_summary WHERE ils_id=$ils_id";
    // echo$query_ilsk;
    // exit;

    $result_ils = mysqli_query($con, $query_ils) or die(mysqli_error($query_ils));
    $fetch_ils = mysqli_fetch_array($result_ils);
    $filename = $fetch_ils['ils_filename'];

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
