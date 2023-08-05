<?php

require_once('../../../secure/connect.php');

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if (!empty($_FILES)) {

    //เรียกปีการศึกษา
    $y_id = $_SESSION['y_id'];
    $fct_id = $_SESSION['fct_id'];
    $max_size = mysqli_real_escape_string($con, $_POST['MAX_FILE_SIZE']);
    $query_years = "SELECT * FROM years WHERE y_id=$y_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);


    $path = $fetch_years['fct_y'];

    $agd = $_SESSION['agd_id'];
    $agd_id = "agd" . $agd;


    //เช็ค path ที่อัพไฟล์ไปหา
    chdir("../../../data/$path/agenda/");

    //dir file
    $path_upload = "$agd_id/";
    // echo $path_upload;
    // exit;

    $allowedExts = array("pdf", "docx");
    $temp = explode(".", $_FILES['sig_filename']['name']);
    $extension = end($temp);
    // echo $extension;
    // exit;
    $file_size = $_FILES['sig_filename']['size'];

    if (in_array($extension, $allowedExts)) {
     

        if ($file_size < $max_size) {

            date_default_timezone_set("Asia/Bangkok");
            date_default_timezone_get();

            $timenow = date("G.i");
            $today = date("dmy");
            $file_name = "sig" . $_SESSION['agd_id'] . '_' . $today . '_' . $timenow . "." . $extension;
            // echo $file_name;
            // exit;

            $file_upload = $path_upload . basename($file_name);
            // echo $file_upload;
            // exit;
            $chk_sign = "SELECT sig_filename,agd_id FROM sign WHERE sig_filename'$file_upload ' && agd_id='$agd'";
            $result_chk = mysqli_query($con,$chk_sign);
            $num_rows = mysqli_num_rows($result_chk);

            if($num_rows == 0){
                if (is_uploaded_file($_FILES['sig_filename']['tmp_name'])) :
                    // echo 'upload...';
                    move_uploaded_file($_FILES['sig_filename']['tmp_name'], $file_upload) or die('can not copy file.');
                // echo 'upload ok<br/>';
                endif;
    
                $query = "INSERT INTO sign(sig_filename,agd_id,usr_id,fct_id,y_id) VALUES('$file_name','$agd','" . $_SESSION['usr_id'] . "','$fct_id ','$y_id')";
                // echo  $query;
                // exit;
                $result = mysqli_query($con, $query) or die(mysqli_error($query));
                $sig_id = mysqli_insert_id($con);
    
                $query_insert2 = "UPDATE meet_detail SET sig_id='$sig_id' WHERE agd_id='$agd'";
                $result2 = mysqli_query($con, $query_insert2) or die(mysqli_error($query_insert2));
    
    
                if ($result && $result2) {
                  
    
                        // header("location: details_agenda.php?agd_id=$agd_id1");
                        echo "<script>
                                alert('อัปโหลดไฟล์สำเร็จแล้ว')
                                window.location='".BASE_URL."/agenda/$agd'
                            </script>";
                    
                    exit();
                }

            } else {
                echo "<script>
                alert('กรุณารอสักครู่นึง เพื่อให้ชื่อไฟล์wไม่ซ้ำกัน')
                window.location = 'frm_add_invite.php'
            </script>";
        exit();
            }


        
        } else {
            echo "<script>  
                    alert('ขนาดไฟล์ใหญ่เกินกำหนด')
                    window.location = 'frm_add_sign.php'
                </script>";
            exit();
        }
    } else {
        // echo "false";
        echo "<script>
                alert('ไฟล์ที่เพิ่มไม่ใช่ไฟล์ PDF และ DOCX')
                window.location = 'frm_add_sign.php'
            </script>";
        exit();
    }
}
mysqli_close($con);
