<?php
require_once('../../../secure/connect.php');


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
    $temp = explode(".", $_FILES['clt_filename']['name']);
    $extension = end($temp);
    //  echo $extension;
    //  exit;
    $file_size = $_FILES['clt_filename']['size'];

    if (in_array($extension, $allowedExts)) {

        if ($file_size < $max_size) {

            // echo 'อัพโหลดสำเร็จแล้ว';
            date_default_timezone_set("Asia/Bangkok");
            date_default_timezone_get();

            $timenow = date("G.i");
            $today = date("dmy");
            $file_name = "clt" . $pro_id . '_' . $today . '_' . $timenow . "." . $extension;
           
          
            $file_upload = $path_upload . basename($file_name); //ทำการเอาชื่อไฟล์ไปต่อไดเรทธอรี่

            $chk_clt = "SELECT clt_filename,pro_id FROM complete_letter WHERE clt_filename='$file_name' && pro_id='$pro_id'";
        
            $result_clt = mysqli_query($con, $chk_clt);
            $num_rows = mysqli_num_rows($result_clt);

        
            if ($num_rows == 0) {
               
                if (is_uploaded_file($_FILES['clt_filename']['tmp_name'])) :
                    // echo 'upload...';
                    move_uploaded_file($_FILES['clt_filename']['tmp_name'], $file_upload) or die('can not copy file.');
                // echo 'upload ok<br/>';
                endif;

                $insert_clt  = "INSERT INTO complete_letter(clt_filename,pro_id,fct_id,y_id,usr_id) 
                 VALUES('$file_name','$pro_id','$fct_id','$y_id','$usr_id')";

                $resutl_clt = mysqli_query($con, $insert_clt) or die(mysqli_error($insert_clt));
                $clt_id = mysqli_insert_id($con);

                $insert_clt2 = "UPDATE project_details SET clt_id='$clt_id' WHERE pro_id='$pro_id'";
                $result_clt2 = mysqli_query($con, $insert_clt2) or die(mysqli_error($insert_clt2));


                if ($resutl_clt && $result_clt2) {
                    if (isset($_SESSION['pro_id'])) {
                        echo "<script>
                                alert('อัปโหลดไฟล์สำเร็จแล้ว')
                                window.location='" . BASE_URL . "/project/$pro_id'
                                </script>";
                        exit();
                    }
                } else {
                    echo "<script>
                            alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง')
                            window.location ='frm_clt.php'
                        </script>";
                    exit();
                }
            } else {
             
                echo "<script>
                        alert('กรุณารอสักครู่นึง เพื่อให้ชื่อไฟล์wไม่ซ้ำกัน')
                        window.location ='frm_clt.php'
                    </script>";
            exit();
            }
        } else {
            echo "<script>
                    alert('ขนาดไฟล์ใหญ่เกินกำหนด')
                    window.location ='frm_clt.php'
                </script>";
            exit();
        }
    } else {
        // echo "false";
        echo "<script>
                    alert('ไฟล์ที่เพิ่มไม่ใช่ไฟล์ PDF,RAR หรือ DOCX')
                    window.location ='frm_clt.php'
                </script>";
        exit();
    }
} else {
    echo "<script>
            alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง')
            window.location = 'frm_clt.php'
        </script>";
    exit();
}
mysqli_close($con);
