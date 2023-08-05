<?php
require_once('../../../secure/connect.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';


if (!empty($_FILES)) {
    //เรียกปีการศึกษา
    $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
    $fct_id =  mysqli_real_escape_string($con, $_SESSION['fct_id']);
    $usr_id =  mysqli_real_escape_string($con, $_SESSION['usr_id']);
    $max_size = mysqli_real_escape_string($con, $_POST['MAX_FILE_SIZE']);
    $query_years = "SELECT * FROM years WHERE y_id=$y_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

    $path = $fetch_years['fct_y'];


    // เปลี่ยน path  เพื่ออัพโหลดไฟล์
    chdir("../../../data/$path/summary/");


    //กำหนดไฟล์ที่สามารถอัพโหลดได้
    $allowedExts = array("pdf", "docx", "rar");
    $temp = explode(".", $_FILES['ils_filename']['name']);
    $extension = end($temp);

    $file_size = $_FILES['ils_filename']['size'];

    if (in_array($extension, $allowedExts)) {

        if ($file_size < $max_size) {

            date_default_timezone_set("Asia/Bangkok");
            date_default_timezone_get();

            $timenow = date("G.i");
            $today = date("dmy");
            $file_name = "ils" . $y_id . '_' . $today . '_' . $timenow . "." . $extension;



            $file_upload = basename($file_name); //ทำการเอาชื่อไฟล์ไปต่อไดเรทธอรี่


            $chk_ils = "SELECT ils_filename,fct_id FROM invitation_letter_summary WHERE ils_filename='$file_name' && fct_id='$fct_id'";
            $result_ils = mysqli_query($con, $chk_ils);
            $num_rows  = mysqli_num_rows($result_ils);

            if ($num_rows == 0) {

                //ทำการอัพไฟล์ลงตามที่อยู่ในตัวแปร $file_upload
                if (is_uploaded_file($_FILES['ils_filename']['tmp_name'])) :
                    // echo 'upload...';
                    move_uploaded_file($_FILES['ils_filename']['tmp_name'], $file_upload) or die('can not copy file.');
                // echo 'upload ok<br/>';
                endif;

                $insert_ils = "INSERT INTO invitation_letter_summary(ils_filename,fct_id,y_id,usr_id) 
                    VALUES('$file_name','$fct_id','$y_id','$usr_id')";
                //    echo $insert_ils;
                //    exit;
                $result_ils = mysqli_query($con, $insert_ils) or die(mysqli_error($insert_ils));

                if ($result_ils) {
                    echo "<script>
                            alert('อัพโหลดไฟล์สำเร็จแล้ว')
                            window.location='" . BASE_URL . "/$y_id/summary'
                        </script>";
                    exit();
                } else {

                    echo "<script>
                            alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง');
                            window.location = 'frm_upload_ils.php'
                        </script>";
                }
            } else {

                echo "<script>
                alert('กรุณารอสักครู่นึง เพื่อให้ชื่อไฟล์wไม่ซ้ำกัน')
                window.location = 'frm_upload_ils.php'
            </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('ขนาดไฟล์ใหญ่เกินกำหนด')
                    window.location = 'frm_upload_ils.php'
                </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('ไฟล์ที่เพิ่มไม่ใช่ไฟล์ PDF หรือ DOCX')
                window.location = 'frm_upload_ils.php'
            </script>";
        exit();
    }
} else {
    echo "<script>
            alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง');
            window.location = 'frm_report_document.php'
        </script>";
    exit();
}
mysqli_close($con);
