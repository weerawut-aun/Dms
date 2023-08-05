<?php 
require_once('../../../connect.php');

if (isset($_GET['lat_id'])) {

    //เรียกปีการศึกษา
    $y_id = $_SESSION['y_id'];
    $query_years = "SELECT y_years FROM years WHERE y_id=$y_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

    //หาปี่การศึกษาและคณะ
    $y_years = $fetch_years['y_years'];
    $fct_id = $_SESSION['fct_id'];

    //path ไปยัง folder ที่อยู่ใน data
    $path = $fct_id . '_' . $y_years;


    $pro_id = "pro" . $_SESSION['pro_id'];

    chdir("../../../../data/$path/project/");


    $path_upload = "$pro_id/";

    $lat_id = $_GET['lat_id'];
    
    $query_lat = "SELECT * FROM list_attend WHERE lat_id=$lat_id";
    // echo $query_lat;
    // exit;

   $result_lat = mysqli_query($con,$query_lat) or die(mysqli_error($query_lat));
   $fetch_rows_lat = mysqli_fetch_array($result_lat);
   $filename = $fetch_rows_lat['lat_filename'];

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
?>