<?php

require_once('../../../secure/connect.php');

// page uploaded_alt.php



if (!empty($_FILES)) {
    // echo "Have file";

    //เรียกปีการศึกษา
    $y_id = $_SESSION['y_id'];
    $fct_id = $_SESSION['fct_id'];
    $pro_id = $_SESSION['pro_id'];
    $usr_id = $_SESSION['usr_id'];
    $max_size = mysqli_real_escape_string($con, $_POST['MAX_FILE_SIZE']);
    $query_years = "SELECT * FROM years WHERE y_id=$y_id && fct_id=$fct_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

    $path = $fetch_years['fct_y'];

    $proid = "pro" . $pro_id;

    //เช็ค path ที่อัพไฟล์ไปหา
    chdir("../../../data/$path/project/");
    // echo getcwd();
    // exit();


    //dir file
    $path_upload = "$proid/";
    // echo $path_upload;
    // exit;

    //กำหนดไฟล์ทีี่สามารถอัพโหลดได้
    $allowedExts = array("pdf", "docx", "rar");
    $temp = explode(".", $_FILES['alt_filename']['name']);
    $extension = end($temp);
    //  echo $extension;
    //  exit;
    $file_size = $_FILES['alt_filename']['size'];

    // เช็คนามสกุลวไฟล์จากตัวแปล $allowedExts
    if (in_array($extension, $allowedExts)) {


        // เช็คขนาดไฟล์ที่น้อยกว่า 2 mb
        if ($file_size < $max_size) {

            // echo 'อัพโหลดสำเร็จแล้ว';
            date_default_timezone_set("Asia/Bangkok");
            date_default_timezone_get();

            $timenow = date("G.i");
            $today = date("dmy");
            $file_name = "alt" . $pro_id . '_' . $today . '_' . $timenow . "." . $extension;

            $file_upload = $path_upload . basename($file_name); //ทำการเอาชื่อไฟล์ไปต่อไดเรทธอรี่

            $chk_alt = "SELECT alt_filename,pro_id FROM approval_letter WHERE alt_filename='$file_name' && pro_id='$pro_id'";

            $result_alt = mysqli_query($con, $chk_alt);
            $num_rows = mysqli_num_rows($result_alt);


            if ($num_rows == 0) {
                echo 'อัปโหลดไฟล์สำเร็จแล้ว';
                //ทำการอัพไฟล์ลงตามที่อยู่ในตัวแปร $file_upload
                if (is_uploaded_file($_FILES['alt_filename']['tmp_name'])) :
                    // echo 'upload...';
                    move_uploaded_file($_FILES['alt_filename']['tmp_name'], $file_upload) or die('can not copy file.');
                // echo 'upload ok<br/>';
                endif;

                $insert_alt1 = "INSERT INTO approval_letter(alt_filename,pro_id,fct_id,y_id,usr_id) 
            VALUES('$file_name','$pro_id','$fct_id','$y_id','$usr_id')";
                //    echo $insert_wpt1;
                //    exit;
                $result_alt1 = mysqli_query($con, $insert_alt1) or die(mysqli_error($insert_alt1));
                $alt_id =  mysqli_insert_id($con);

                $insert_alt2 = "UPDATE project_details SET alt_id='$alt_id' WHERE pro_id='$pro_id'";
                $result_alt2 = mysqli_query($con, $insert_alt2);


                if ($result_alt2) {
                    echo "<script>
                            alert('อัปโหลดไฟล์สำเร็จแล้ว')
                            window.location='" . BASE_URL . "/project/$pro_id'
                        </script>";
                    exit();
                } else {
                    echo "<script>
                            alert('ผิดพลาดกรุณาลองใหม่อีกครั้ง')
                            window.location = 'frm_alt.php'
                        </script>";
                    exit();
                }
            } else {
                echo "<script>
                    alert('กรุณารอสักครู่นึง เพื่อให้ชื่อไฟล์wไม่ซ้ำกัน')
                    window.location = 'frm_alt.php'
                </script>";
                exit();
            }

            // เช็คขนาดไฟล์ที่ใหญ่กว่าที่กำหนด
        } else {
            echo "<script>
                    alert('ขนาดไฟล์ใหญ่เกินกำหนด')
                    window.location = 'frm_alt.php'
                </script>";
            exit();
        }
        // เช็คนามสกุลไฟล์ที่ไม่ตรงเงื่อนไข $allowedExts
    } else {
        // echo "false";
        echo "<script>
                    alert('ไฟล์ที่เพิ่มไม่ใช่ไฟล์ PDF และ DOCX')
                    window.location = 'frm_alt.php'
                </script>";
        exit();
    }
    // เช็คการเข้าถึงของหน้า uploaded_alt.php
} else {
    // echo "No have file.";
    echo "<script>
            alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง')
            window.location = 'frm_alt.php'
        </script>";
    exit();
}


mysqli_close($con);
