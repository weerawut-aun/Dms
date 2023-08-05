<?php
require_once('../../../../secure/connect.php');

if (isset($_POST['action'])) {

    if ($_POST['action'] == 'fetch') {



        function convert($size, $unit)
        {
            if ($unit == "MB") {
                return $fileSize = round($size / 1024 / 1024, 4) . 'MB';
            }
        }

        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

        $query_uploadsize = "SELECT * FROM faculty WHERE fct_id='$fct_id'";
        $resuyl_uploadsize = mysqli_query($con, $query_uploadsize) or die(mysqli_error($query_uploadsize));
        $num_rows = mysqli_num_rows($resuyl_uploadsize);


        if ($num_rows >= 1) {
            $fetch_rows = mysqli_fetch_array($resuyl_uploadsize);

            $size = $fetch_rows['fct_uploadsize'];
            $unit = "MB";
            $size = convert($size, $unit);
            echo '<p style="color: red;">*อัพโหลดได้ไม่เกิน ' . $size.' เท่านั้น</p>';
        }
    }

    if ($_POST['action'] == 'uploadsize') {

        $output = '';
        $messag = '';
        $fct_uploadsize = mysqli_real_escape_string($con, $_POST['fct_uploadsize']);
       

        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

        $query_chk = "SELECT * FROM  faculty WHERE fct_id='$fct_id'";
        $result_chk = mysqli_query($con, $query_chk) or die(mysqli_error($query_chk));
        $fet_rows = mysqli_fetch_array($result_chk);


        if ($fet_rows['fct_uploadsize'] > $fct_uploadsize || $fet_rows['fct_uploadsize'] == $fct_uploadsize) {
            $messag = 'ขนาดพิ้นที่นี้ใช้แล้ว';
            $output .= '<label class="text-danger">' . $messag . '</label>';
        } else {
            
            $update_query = "UPDATE faculty SET fct_uploadsize='$fct_uploadsize' WHERE fct_id='$fct_id'";


            $result_uploadsize = mysqli_query($con, $update_query);

            if ($result_uploadsize) {
                echo "<script>
                    alert(\"คำขอสำเร็จ\")
                    window.location='convert.php'
                </script>";
            } else {
                echo "<script>
                    alert(\"ล้มเหลว\")
                    window.location='convert.php'
                 </script>";
            }
        }
        echo $output;
    }
}
mysqli_close($con);
