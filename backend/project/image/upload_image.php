<?php

require_once('../../../secure/connect.php');

// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';
// exit();
$upload = 'error';

if (!empty($_FILES)) {

    //เรียกปีการศึกษา
    $y_id = $_SESSION['y_id'];
    $fct_id = $_SESSION['fct_id'];
    $pro_id = $_SESSION['pro_id'];
    $usr_id = $_SESSION['usr_id'];
    $query_years = "SELECT * FROM years WHERE y_id=$y_id";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);

   
    $path = $fetch_years['fct_y'];

    $proid = "pro" . $pro_id;

    //เช็ค path ที่อัพไฟล์ไปหา
    chdir("../../../data/$path/project/");

    //dir file
    $path_upload = "$proid/image/";
    //  echo $path_upload;
    //  exit;
    $maxsize = 2 * 1024 * 1024;

    $allowedExts = array("jpg", "png", "jpeg", "gif");

    $images_arr = array();
    // วนลูปรูปตามจำนวนที่ input เข้ามา
    foreach ($_FILES['img_name']['name'] as $key => $value) {

        $image_name = $_FILES['img_name']['name'][$key];
        $tmp_name = $_FILES['img_name']['tmp_name'][$key];
        $size = $_FILES['img_name']['size'][$key];
        $type = $_FILES['img_name']['type'][$key];
        $error = $_FILES['img_name']['error'][$key];

        //file upolad path
        $fileName = basename($_FILES['img_name']['name'][$key]);
        $imagepath = $path_upload .  $fileName;
        // echo $imagepath;
        // exit;
        $image_ext = pathinfo($imagepath, PATHINFO_EXTENSION);
        // เช็คเงื่อนไขตรงกับ $allowedExts
        if (in_array($image_ext, $allowedExts)) {

            //     //ทำการอัพไฟล์ลงตามที่อยู่ในตัวแปร $file_upload
            if (is_uploaded_file($tmp_name)) :
                // echo 'upload...';
                move_uploaded_file($_FILES['img_name']['tmp_name'][$key], $imagepath) or die('can not copy file.');
            // echo 'upload ok<br/>';
            endif;

            $insert_image = "INSERT INTO image(img_name,pro_id,fct_id,y_id,usr_id) VALUES('{$image_name}','$pro_id','$fct_id','$y_id','$usr_id')";


            $result_image = mysqli_query($con, $insert_image) or die(mysqli_error($insert_image));
            $img_id = mysqli_insert_id($con);

            $insert_pdt = "UPDATE project_details SET img_id='$img_id' WHERE pro_id=' $pro_id'";
            $result_pdt = mysqli_query($con, $insert_pdt);

            // if ($result_image && $result_pdt) {

            // }
        } else {
            echo $upload;
        }
      
    }
    echo "<script>
        alert('อัปโหลดไฟล์สำเร็จแล้ว');
        window.location='" . BASE_URL . "/project/$pro_id'
    </script>";
} else {
    // echo "No have file.";
    echo "<script>";
    echo " alert('ผิดพลาด กรุณาลองใหม่อีกครั้ง');";
    echo "window.location = 'frm_image.php'";
    echo "</script>";
    exit();
}
mysqli_close($con);
