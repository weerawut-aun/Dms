<?php 

require_once('../../../secure/connect.php');

if(!empty($_POST)){
    $output = '';
    $messag = '';
    $rpt_person = mysqli_real_escape_string($con, $_POST['rpt_person']);
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);


    $query_chk = "SELECT * FROM responsible_project WHERE fct_id='$fct_id'";
    $result_chk = mysqli_query($con,$query_chk) or die(mysqli_error($query_chk));
    $fetch_rows = mysqli_fetch_array($result_chk);

    if($fetch_rows['rpt_person'] == $rpt_person){

        $messag .= 'รายการนี้มีอยู่ในฐานข้อมูลแล้ว กรุณาตรวจใหม่อีกครั้ง';

        $output .= '<label class="text-danger">' . $messag . '</label>';

        $query_rpt = "SELECT * FROM responsible_project WHERE fct_id='" . $_SESSION['fct_id'] . "' && rpt_show='1'";
        $result_rpt = mysqli_query($con, $query_rpt) or die(mysqli_error($query_rpt));
        $num_rows_rpt  = mysqli_num_rows($result_rpt);

        $output .= ' <div class="row"> 
                    <div class="input-group col-md-7" >
                        <select class="custom-select">
                            <option selected>เลือก...</option>';
            if($num_rows_rpt > 0){ 
                while($rows_rpt = mysqli_fetch_array($result_rpt )){
                    $output.= ' <option value="'.$rows_rpt['rpt_id'].'">'. $rows_rpt['rpt_person'].'</option>';
                }
            } 
        $output .= '    </select>
                        <div>
                            <h3 class="text-red">*</h3>
                        </div>
                    </div>
                    </div>';
    
    } else {
        
        $query_rpt = "INSERT INTO responsible_project(rpt_person,fct_id) VALUES('$rpt_person','$fct_id')";

        $messag .= 'เพิ่มข้อมูลสำเร็จแล้ว';

        if (mysqli_query($con, $query_rpt) or die(mysqli_error($query_rpt))) {

            $output .= '<label class="text-success">' . $messag . '</label>';

            $query_rpt = "SELECT * FROM responsible_project WHERE fct_id='" . $_SESSION['fct_id'] . "' && rpt_show='1'";
            $result_rpt = mysqli_query($con, $query_rpt) or die(mysqli_error($query_rpt));
            $num_rows_rpt = mysqli_num_rows($result_rpt);

           
            $output .= ' <div class="row"> 
            <div class="input-group col-md-7" >
                <select class="custom-select">
                    <option selected>เลือก...</option>';
            if($num_rows_rpt > 0){ 
                while($rows_rpt = mysqli_fetch_array($result_rpt )){
                    $output.= ' <option value="'.$rows_rpt['rpt_id'].'">'. $rows_rpt['rpt_person'].'</option>';
                }
            } 
            $output .= '    </select>
                        <div>
                            <h3 class="text-red">*</h3>
                        </div>
                    </div>
                    </div>';
        }
                    
    }
    echo $output;

}
mysqli_close($con);
?>