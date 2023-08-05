<?php 
require_once('../../../connect.php');

if (isset($_GET['don_id'])) {

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

    $don_id = $_GET['don_id'];
    
    $query_don = "SELECT * FROM document_other WHERE don_id=$don_id";
    // echo $query_don;
    // exit;

   $result_don = mysqli_query($con,$query_don) or die(mysqli_error($query_don));
   $fetch_rows_don = mysqli_fetch_array($result_don);
   $filename = $fetch_rows_don['don_filename'];

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