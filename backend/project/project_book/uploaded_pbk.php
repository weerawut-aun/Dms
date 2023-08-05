<?php
require_once('../../../secure/connect.php');
// page uploaded_pbk.php

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
if (!empty($_FILES)) {
    //เรียกปีการศึกษา
    $y_id = $_SESSION['y_id'];
    $fct_id = $_SESSION['fct_id'];
    $pro_id = $_SESSION['pro_id'];
    $usr_id = $_SESSION['usr_id'];
    $max_size = mysqli_real_escape_string($con, $_POST['MAX_FILE_SIZE']);
    $query_years = "SELECT * FROM years WHERE y_id=$y_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);


    $path = $fetch_years['fct_y'];

    $proid = "pro" . $pro_id;

    //เช็ค path ที่อัพไฟล์ไปหา
    chdir("../../../data/$path/project/");


    //dir file
    $path_upload = "$proid/";
    // echo $path_upload;
    // exit;

    //กำหนดไฟล์ทีี่สามารถอัพโหลดได้
    $allowedExts = array("pdf", "docx", "rar");
    $temp = explode(".", $_FILES['pbk_filename']['name']);
    $extension = end($temp);
    //  echo $extension;
    //  exit;
    $file_size = $_FILES['pbk_filename']['size'];

    if (in_array($extension, $allowedExts)) {


        if ($file_size < $max_size) {

            // echo 'อัพโหลดสำเร็จแล้ว';
            date_default_timezone_set("Asia/Bangkok");
            date_default_timezone_get();

            $timenow = date("G.i");
            $today = date("dmy");
            $file_name = "pbk" . $_SESSION['pro_id'] . '_' . $today . '_' . $timenow . "." . $extension;

            $file_upload = $path_upload . basename($file_name); //ทำการเอาชื่อไฟล์ไปต่อไดเรทธอรี่

            $chk_pbk = "SELECT pbk_filename,pro_id FROM project_book WHERE pbk_filename='$file_name ' && pro_id='$pro_id'";
            $result_pbk = mysqli_query($con, $chk_pbk);
            $num_rows = mysqli_num_rows($result_pbk);

            if ($num_rows == 0) {

                //ทำการอัพไฟล์ลงตามที่อยู่ในตัวแปร $file_upload
                if (is_uploaded_file($_FILES['pbk_filename']['tmp_name'])) :
                    // echo 'upload...';
                    move_uploaded_file($_FILES['pbk_filename']['tmp_name'], $file_upload) or die('can not copy file.');
                // echo 'upload ok<br/>';
                endif;

                $insert_pbk = "INSERT INTO project_book(pbk_filename,pro_id,fct_id,y_id,usr_id) 
                        VALUES('$file_name','$pro_id','$fct_id','$y_id','$usr_id')";

                $reuslt_pbk = mysqli_query($con, $insert_pbk) or die(mysqli_error($insert_pbk));
                $pbk_id = mysqli_insert_id($con);

                $insert_pbk2 = "UPDATE project_details SET pbk_id='$pbk_id' WHERE pro_id='$pro_id'";
                $result_pbk2 = mysqli_query($con, $insert_pbk2) or die(mysqli_error($insert_pbk2));

                if ($reuslt_pbk && $result_pbk2) {
                 
                        echo "<script>
                            alert('อัปโหลดไฟล์สำเร็จแล้ว')
                            window.location='" . BASE_URL . "/project/$pro_id'
                        </script>";
                        exit();
                    
                } else {
                    echo "<script>
                        alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง')
                        window.location = 'frm_pbk.php'
                    </script>";
                    exit();
                }
            } else {
                echo "<script>
                        alert('กรุณารอสักครู่นึง เพื่อให้ชื่อไฟล์wไม่ซ้ำกัน')
                        window.location = 'frm_pbk.php'
                        </script>";
                exit();
            }
        } else {
            echo "<script>
                        alert('ขนาดไฟล์ใหญ่เกินกำหนด')
                        window.location = 'frm_pbk.php'
                    </script>";
            exit();
        }
    } else {
        // echo "false";
        echo "<script>
                    alert('ไฟล์ที่เพิ่มไม่ใช่ไฟล์ PDF หรือ DOCX')
                    window.location = 'frm_pbk.php'
                </script>";
        exit();
    }
} else {
    echo "<script>
                alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง')
                window.location = './../../frm_pbk.php'
            </script>";
    exit();
}
mysqli_close($con);
