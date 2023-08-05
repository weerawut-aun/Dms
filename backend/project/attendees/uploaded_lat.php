<?php

require_once('../../../secure/connect.php');

// page uploaded_lat.php

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';


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

    //หาปี่การศึกษาและคณะ
    $y_years = $fetch_years['y_years'];
    $fct_id = $_SESSION['fct_id'];


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
    $temp = explode(".", $_FILES['lat_filename']['name']);
    $extension = end($temp);
    //  echo $extension;
    //  exit;
    $file_size = $_FILES['lat_filename']['size'];

    // เช็คนามสกุลวไฟล์จากตัวแปล $allowedExts
    if (in_array($extension, $allowedExts)) {



        // เช็คขนาดไฟล์ที่น้อยกว่า 2 mb
        if ($file_size < $max_size) {

            // echo 'อัพโหลดสำเร็จแล้ว';
            date_default_timezone_set("Asia/Bangkok");
            date_default_timezone_get();

            $timenow = date("G.i");
            $today = date("dmy");
            $file_name = "lat" . $pro_id . '_' . $today . '_' . $timenow . "." . $extension;

            $file_upload = $path_upload . basename($file_name); //ทำการเอาชื่อไฟล์ไปต่อไดเรทธอรี่

            $chk_lat = "SELECT lat_filename,pro_id FROM list_attend WHERE lat_filename='$file_name' && pro_id='$pro_id'";
            $result_lat = mysqli_query($con, $chk_lat);
            $num_rows = mysqli_num_rows($result_lat);

            if($num_rows == 0){
                      //ทำการอัพไฟล์ลงตามที่อยู่ในตัวแปร $file_upload
            if (is_uploaded_file($_FILES['lat_filename']['tmp_name'])) :
                // echo 'upload...';
                move_uploaded_file($_FILES['lat_filename']['tmp_name'], $file_upload) or die('can not copy file.');
            // echo 'upload ok<br/>';
            endif;

            $insert_lat1 = "INSERT INTO list_attend(lat_filename,pro_id,fct_id,y_id,usr_id) 
                        VALUES('$file_name','$pro_id','$fct_id','$y_id','$usr_id')";
            //    echo $insert_lat1;
            //    exit;
            $result_lat1 = mysqli_query($con, $insert_lat1) or die(mysqli_error($insert_lat1));
            $lat_id =  mysqli_insert_id($con);

            $insert_lat2 = "UPDATE project_details SET lat_id='$lat_id' WHERE pro_id='$pro_id'";
            $result_lat2 = mysqli_query($con, $insert_lat2);


            if ($result_lat1 && $result_lat2) {
                echo "<script>
                            alert('อัปโหลดไฟล์สำเร็จแล้ว')
                            window.location='" . BASE_URL . "/project/$pro_id'
                        </script>";
                exit();
            } else {
                echo "<script>
                        alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง')
                        window.location = 'frm_lat.php'
                    </script>";
                exit();
            }
            } else{
                echo "<script>
                        alert('กรุณารอสักครู่นึง เพื่อให้ชื่อไฟล์wไม่ซ้ำกัน')
                        window.location = 'frm_lat.php'
                    </script>";
                exit();
            }

    
            // เช็คขนาดไฟล์ที่น้อยกว่าขอพื้นที่เพิ่ม
        } else {
            echo "<script>
                        alert('ขนาดไฟล์ใหญ่เกินกำหนด')
                        window.location = 'frm_lat.php'
                    </script>";
            exit();
        }
      
        // เช็คนามสกุลไฟล์ที่ไม่ตรงเงื่อนไข $allowedExts
    } else {
        // echo "false";
        echo "<script>
                    alert('ไฟล์ที่เพิ่มไม่ใช่ไฟล์ PDF และ DOCX')
                    window.location = 'frm_lat.php'
                </script>";
        exit();
    }
   
    // เช็คการเข้าถึงของหน้า uploaded_lat.php
} else {
    // echo "No have file.";
    echo "<script>
                alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง')
                window.location = './../../frm_lat.php'
            </script>";
    exit();
}

mysqli_close($con);
