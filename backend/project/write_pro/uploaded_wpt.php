<?php

require_once('../../../secure/connect.php');

// page yploaded_wpt.php



if (!empty($_FILES)) {
    // echo "Have file";

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
    // echo getcwd();
    // exit;

    //dir file
    $path_upload = "$proid/";
    // echo $path_upload;
    // exit;

    //กำหนดไฟล์ทีี่สามารถอัพโหลดได้
    $allowedExts = array("pdf", "docx", "rar");
    $temp = explode(".", $_FILES['wpt_filename']['name']);
    $extension = end($temp);
    //  echo $extension;
    //  exit;
    $file_size = $_FILES['wpt_filename']['size'];

    // เช็คนามสกุลวไฟล์จากตัวแปล $allowedExts
    if (in_array($extension, $allowedExts)) {

     
        // เช็คขนาดไฟล์ที่น้อยกว่า 2 mb
        if ($file_size < $max_size) {

            // echo 'อัพโหลดสำเร็จแล้ว';
            date_default_timezone_set("Asia/Bangkok");
            date_default_timezone_get();

            $timenow = date("G.i");
            $today = date("dmy");
            $file_name = "wpt" . $pro_id . '_' . $today . '_' . $timenow . "." . $extension;

            $file_upload = $path_upload . basename($file_name); //ทำการเอาชื่อไฟล์ไปต่อไดเรทธอรี่

            $chk_wpt = "SELECT wpt_filename,pro_id FROM  write_project WHERE wpt_filename='$file_name' && pro_id='$pro_id'";
           
            $result_wpt = mysqli_query($con, $chk_wpt);
            $num_rows = mysqli_num_rows($result_wpt);

            if ($num_rows == 0) {
               
                //ทำการอัพไฟล์ลงตามที่อยู่ในตัวแปร $file_upload
                if (is_uploaded_file($_FILES['wpt_filename']['tmp_name'])) :
                    // echo 'upload...';
                    move_uploaded_file($_FILES['wpt_filename']['tmp_name'], $file_upload) or die('can not copy file.');
                // echo 'upload ok<br/>';
                endif;

                $insert_wpt1 = "INSERT INTO write_project(wpt_filename,pro_id,fct_id,y_id,usr_id) 
                VALUES('$file_name','$pro_id','$fct_id','$y_id','$usr_id')";
                //    echo $insert_wpt1;
                //    exit;
                $result_wpt1 = mysqli_query($con, $insert_wpt1) or die(mysqli_error($insert_wpt1));
                $wpt_id =  mysqli_insert_id($con);

                $insert_wpt2 = "UPDATE project_details SET wpt_id=$wpt_id WHERE pro_id='$pro_id'";
               
                $result_wpt2 = mysqli_query($con, $insert_wpt2);


                if ($result_wpt2) {

                    echo "<script>
                            alert('อัปโหลดไฟล์สำเร็จแล้ว')
                            window.location='" . BASE_URL . "/project/$pro_id'
                        </script>";
                        exit();
                } else {
                    echo "<script>
                            alert('ผิดพลาดกรุณาลองใหม่อีกครั้ง')
                            window.location = 'frm_wpt.php'
                        </script>";
                        exit();
                 }
            } else {
                echo "<script>
                        alert('กรุณารอสักครู่นึง เพื่อให้ชื่อไฟล์wไม่ซ้ำกัน')
                        window.location = 'frm_wpt.php'
                    </script>";
                exit();
            }


            // เช็คขนาดไฟล์ที่ใหญ่กว่าที่กำหนด
        } else {
            echo "<script>
                    alert('ขนาดไฟล์ใหญ่เกินกำหนด')
                    window.location = 'frm_wpt.php'
                </script>";
            exit();
        }
        // เช็คนามสกุลไฟล์ที่ไม่ตรงเงื่อนไข $allowedExts
    } else {
        // echo "false";
        echo "<script>
                alert('ไฟล์ที่เพิ่มไม่ใช่ไฟล์ PDF หรือ DOCX')
                window.location = 'frm_wpt.php'
            </script>";
        exit();
    }
    // เช็คการเข้าถึงของหน้า uploaded_wpt.php
} else {
    // echo "No have file.";
    echo "<script>
            alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง')
            window.location = 'frm_wpt.php'
        </script>";
    exit();
}


mysqli_close($con);
