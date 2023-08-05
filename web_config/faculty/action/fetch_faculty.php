<?php


if (isset($_POST['action'])) {

    include('../../connect.php');



    if ($_POST['action'] == 'fetch') {

        $output = '';
        $query_fct = mysqli_query($con, "SELECT * FROM faculty");
        $output .= '
       <table id="table_faculty" class="table table-bordered table-hover">
       <thead>
           <tr>
               <th>
                    <center>คณะ</center>
               </th>
               <th>
                    <center>ผู้ดูแลระบบ</center>
               </th>
               <th></th>
           </tr>
       </thead>
       <tbody>
       ';
        while ($data_fct = mysqli_fetch_array($query_fct)) {

            $output .= '
               <tr>
                    <td>' . $data_fct['fct_name'] . '</td>
                    <td>
                       <center>
                            <a class="btn btn-primary" href="admin/tb_admin.php?fct_id=' . $data_fct['fct_id'] . '">ผู้ดูแลระบบ</a>
                       </center>
                    </td>
                  
                    <td>
                       <center>
                        <a class="btn btn-primary" href="../years/all_years.php?fct_id=' . $data_fct['fct_id'] . '">ดูรายระเอียด</a>
                       </center>
                    </td>
                </tr>
               ';
        }

        $output .= '
        </tbody>
   </table>
   ';
        echo $output;
    }
    if ($_POST['action'] == 'insert_data') {

        $fct_name = mysqli_real_escape_string($con, $_POST['fct_name']);
        $fct_uploadsize = mysqli_real_escape_string($con, $_POST['fct_uploadsize']);
       

        $query = "SELECT * FROM faculty WHERE fct_name='$fct_name'";
        $result = mysqli_query($con, $query) or die(mysqli_error($query));

        if (mysqli_num_rows($result) > 0) {
         
            echo '<p class="text-danger">ชื่อคณะนี้ถูกใช้งานแล้ว</p>';
        } else {
          
            // echo 'เพิ่มชื่อคณะนี้เรียบร้อย';
            $insert_faculty = "INSERT INTO faculty (fct_name,fct_uploadsize) VALUES ('$fct_name','$fct_uploadsize')";
            $result = mysqli_query($con, $insert_faculty) or die(mysqli_error($con));
            // if (mysqli_query($con, $insert_faculty) or die(mysqli_error($insert_faculty))) {

            //     $fct_id = mysqli_insert_id($con);
            //     $_SESSION['fct_id'] = $fct_id;
            //     echo "<script>
            //                         alert(\"เพิ่มชื่อคณะสำเร็จแล้ว\")
            //                         window.location='../admin/frm_admin.php'
            //                     </script>";
            //     exit();
            // }
        }
    }
}
