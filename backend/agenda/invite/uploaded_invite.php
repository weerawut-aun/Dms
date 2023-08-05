<?php
require_once('../../../secure/connect.php');

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if (!empty($_FILES)) {
    // echo "have file";

    //เรียกปีการศึกษา
    $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
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

    //กำหนดไฟล์ทีี่สามารถอัพโหลดได้
    $allowedExts = array("pdf", "docx");
    $temp = explode(".", $_FILES['inv_filename']['name']);
    $extension = end($temp);
    // echo $extension;
    // exit;
    $file_size = $_FILES['inv_filename']['size'];
    //    ไฟล์อัพได้ 48 M 
    // 2097152    
    if (in_array($extension, $allowedExts)) {



        if ($file_size < $max_size) {

            date_default_timezone_set("Asia/Bangkok");
            date_default_timezone_get();

            $timenow = date("G.i");
            $today = date("dmy");
            $file_name = "inv" . $_SESSION['agd_id'] . '_' . $today . '_' . $timenow . "." . $extension;

            $file_upload = $path_upload . basename($file_name);
           

            $chk_invite = "SELECT inv_filename,agd_id FROM invite WHERE inv_filename='$file_name' && agd_id='$agd'";
            $result_chk = mysqli_query($con,$chk_invite);
            $num_rows = mysqli_num_rows($result_chk);

            if($num_rows == 0){

               
                if (is_uploaded_file($_FILES['inv_filename']['tmp_name'])) :
                    // echo 'upload...';
                    move_uploaded_file($_FILES['inv_filename']['tmp_name'], $file_upload) or die('can not copy file.');
                // echo 'upload ok<br/>';
                endif;
    
                $query = "INSERT INTO invite(inv_filename,agd_id,usr_id,fct_id,y_id) VALUES('$file_name','$agd',
                '" . $_SESSION['usr_id'] . "','$fct_id','$y_id')";
                // print_r($query);
                // exit();
    
                $result = mysqli_query($con, $query) or die(mysqli_error($query));
                $inv_id = mysqli_insert_id($con);
    
                $query2 = "UPDATE meet_detail SET inv_id='$inv_id' WHERE agd_id='" . $_SESSION['agd_id'] . "'";
                $result2 = mysqli_query($con, $query2) or die(mysqli_error($query2));
    
                if ($result && $result2) {
    
                        // header("location: details_agenda.php?agd_id=$agd");
                        echo "<script>
                                alert('อัพโหลดไฟล์สำเร็จแล้ว')
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

        } 

        else {
            echo "<script>
                    alert('ขนาดไฟล์ใหญ่เกินกำหนด')
                    window.location = 'frm_add_invite.php'
                </script>";
            exit();
        }
    } else {
        // echo "false";
        echo "<script>
                    alert('ไฟล์ที่เพิ่มไม่ใช่ไฟล์ PDF และ DOCX')
                    window.location = 'frm_add_invite.php'
                </script>";
        exit();
    }

}

mysqli_close($con);
