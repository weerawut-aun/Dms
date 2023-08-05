<?php
//add_project.php
require_once('../../secure/connect.php');

// echo'<pre>';
// print_r($_SESSION);
// echo'</pre>';

if (isset($_POST['pro_name'])) {


    $pro_name = mysqli_real_escape_string($con, $_POST['pro_name']);
    $y_id = mysqli_real_escape_string($con, $_SESSION['y_id']);
    $fct_id = mysqli_real_escape_string($con,$_SESSION['fct_id']);
    $usr_id = mysqli_real_escape_string($con,$_SESSION['usr_id']);
    $pdt_status = "1";

    // echo 'pro_name='.$pro_name.'<br>'.
    // 'y_id='.$y_id.'<br>'.
    // 'fct_id='.$fct_id.'<br>'.
    // 'pdt_status='.$pdt_status.'<br>'.
    // 'usr_id='.$usr_id.'<br>';


    $query_years = "SELECT * FROM years WHERE y_id='$y_id'";
    $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
    $fetch_years = mysqli_fetch_assoc($result_years);
    // $y_years = $fetch_years['y_years'];

    // ชื่อโฟล์เดอร์(ไอดีคณะและปีการศึกษา)
    // $dir_name = $fct_id . "_" . $y_years;
    $dir_name = $fetch_years['fct_y'];
    
    $path = "../../data/$dir_name/project";

    chdir($path);
    // echo getcwd();
    // exit();

    $query_pro = "INSERT INTO  project(pro_name,y_id,fct_id,usr_id) VALUES('$pro_name','$y_id','$fct_id',$usr_id)";
   
    $result_pro = mysqli_query($con, $query_pro) or die(mysqli_error($query_pro));
    $pro_id = mysqli_insert_id($con);

    $query_pro2 = "INSERT INTO project_details(pro_id,y_id,fct_id,pdt_status) VALUES('$pro_id','$y_id','$fct_id','$pdt_status')";
    $result_pro2 = mysqli_query($con,$query_pro2) or die(mysqli_error($query_pro2));

    if ($result_pro && $result_pro2) {


        if (mkdir("pro$pro_id")) {
            chdir("./pro$pro_id");
            mkdir("image");
            echo "<script type=\"text/javascript\">";
            echo "alert(\"เพิมโครงการ เรียบร้อยแล้ว\");";
            echo "window.location='".BASE_URL."/$y_id/project'";
            echo "</script>";
            exit();
        }
    } else {
        echo "<script>";
        echo " alert('ผิดพลาด กรุณาลองใหม่คอีกครั้ง');";
        echo "window.location = '".BASE_URL."/backend/project/frm_project.php'";
        echo "</script>";
        exit();
    }
} else {
    echo "<script>";
    echo " alert('ผิดพลาด กรุณาลองใหม่คอีกครั้ง');";
    echo "window.location = '".BASE_URL."/backend/project/frm_project.php'";
    echo "</script>";
    exit();
}
