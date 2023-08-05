<?php 
      require_once('../../../secure/connect.php');

// echo $_GET['doc_id'];
// exit;

if(isset($_GET['doc_id'])) {

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

  $agd = $_SESSION['agd_id'];
  $agd_id = "agd" . $agd;

  chdir("../../../data/$path/agenda/");

  $path_upload = "$agd_id/";

  $doc_id = $_GET['doc_id'];

  $query_doc = "SELECT * FROM doc WHERE doc_id=$doc_id";
//   echo $query_doc;
//   exit;

  $result_doc = mysqli_query($con,$query_doc) or die(mysqli_error($query_doc));
  $doc = mysqli_fetch_array($result_doc);
  $filename = $doc['doc_filename'];

  $file_upload = $path_upload . basename($filename);
 // Send the file to the browser. 
 
  if(file_exists($file_upload)) {

      header("Content-Description: File Transfer");

      header("Content-Type: application/octet-stream");

      header("Content-Disposition: attachment; filename=".basename($file_upload)."");

      header("Expires: 0");

      header("Cache-Control: must-revalidate");

      header("Pragma: public");

      header("Content-Length:" .filesize($file_upload));

      flush();

      readfile($file_upload);
      exit;
  } else {
      die("Invalid file name!");
      exit;
  }
}
 