<?php
include('../../../secure/connect.php');

if (isset($_POST['action'])) {

    // insert data firstlogin
    if ($_POST['action'] == 'insert_data') {

 
        $output = '';
        $message = '';
        $usr_prefix = mysqli_real_escape_string($con, $_POST['usr_prefix']);
        $usr_firstname = mysqli_real_escape_string($con, $_POST['usr_firstname']);
        $usr_lastname = mysqli_real_escape_string($con, $_POST['usr_lastname']);
        $usr_email = mysqli_real_escape_string($con, $_POST['usr_email']);
        $usr_tel = mysqli_real_escape_string($con, $_POST['usr_tel']);
        $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);
        $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);
        $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);
        $first_login = mysqli_real_escape_string($con, $_SESSION['first_login']);

        if ($first_login == '0') {
            $first_login = '1';
        }

        $query = "SELECT * FROM user WHERE usr_id='$usr_id'";
        $result = mysqli_query($con, $query) or die(mysqli_error($query));
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            if (password_verify($usr_password, $row['usr_password'])) {
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                $update_user = "UPDATE  user SET usr_password='$hash',usr_prefix='$usr_prefix',
                                usr_firstname='$usr_firstname',usr_lastname = '$usr_lastname',
                                usr_email='$usr_email',usr_tel='$usr_tel'
                                WHERE usr_id='$usr_id'";

                if (mysqli_query($con, $update_user) or die(mysqli_errno($update_user))) {


                    if (isset($_SESSION['admin'])) {
                        $update_admin = "UPDATE admin SET adm_show='$first_login' WHERE usr_id='$usr_id'";

                        if (mysqli_query($con, $update_admin) or die(mysqli_error($update_admin))) {
                            $output .= '
                        <script>
                            alert("เรียบร้อย ออกจากระบบ")
                                location = "' . BASE_URL . '/secure/logout.php"
                        </script>
                    ';
                        }
                    } else if (isset($_SESSION['dean'])) {
                        $update_dean = "UPDATE dean SET dea_show='$first_login' WHERE usr_id='$usr_id'";

                        if (mysqli_query($con, $update_dean) or die(mysqli_error($update_dean))) {
                            $output .= '
                            <script>
                                alert("เรียบร้อย ออกจากระบบ")
                                    location = "' . BASE_URL . '/secure/logout.php"
                            </script>
                        ';
                        }
                    }
                }
            } else {
                $output .= 'usr_password';
            }
            echo $output;
        }
    }

    // fetch all user 
    if ($_POST['action'] == 'fetch') {

        $fct_id = $_SESSION['fct_id'];
        $output = '';

        $usr_premi = "SELECT * FROM user  WHERE fct_id =$fct_id";
        $result_premit = mysqli_query($con, $usr_premi) or die(mysqli_error($usr_premi));
        // $result_usr = mysqli_fetch_array($result_premit);
        $output .= '<table id="table_user" class="table table-bordered table-hover">

    <thead class="table thead-light">
        <tr>

            <th>
                <center>ชื่อ-นามสกุล</center>
            </th>
            <th>
                <center>ชื่อผู้ใช้</center>
            </th>
            <th>
                <center>สิทธิ์การใช้งาน</center>
            </th>
            <th>
                <center>สถานะ</center>
            </th>
            <th></th>

        </tr>
        </thead>
        <tbody>';
        while ($row = mysqli_fetch_array($result_premit)) {

            $status = '';
            $premit = '';

            $output .= '
                    <tr>
                        <td>' . $row['usr_prefix'] . ' ' . $row['usr_firstname'] . ' ' . $row['usr_lastname'] . '</td>
                        <td>' . $row['usr_username'] . '</td>
                        <td>';
            $premit_user = $row['usr_id'];

            $query_dean = "SELECT u.usr_id,d.dea_id FROM user as u
                JOin dean as d ON d.usr_id = u.usr_id
                WHERE u.usr_id = $premit_user
                ORDER BY u.usr_id asc";

            $result_dean = mysqli_query($con, $query_dean) or die(mysqli_errno($query_dean));
            $num_dea = mysqli_num_rows($result_dean);

            if ($num_dea  == 1) {
                $premit = 'คณบดี';
            }

            $query_admin = "SELECT u.usr_id,a.adm_id FROM user as u
                    JOIN admin as a ON a.usr_id = u.usr_id
                    WHERE u.usr_id= $premit_user
                    ORDER BY u.usr_id asc";
            $result_admin = mysqli_query($con, $query_admin) or die(mysqli_error($query_admin));
            $num_adm  = mysqli_num_rows($result_admin);

            if ($num_adm  == 1) {
                $premit = 'ผู้ดูแลระบบ';
            }

            $query_staff = "SELECT u.usr_id,s.stf_id FROM user as u
                    JOIN staff as s ON s.usr_id = u.usr_id
                    WHERE u.usr_id= $premit_user
                    ORDER BY u.usr_id asc";

            $result_staff = mysqli_query($con, $query_staff) or die(mysqli_error($query_staff));
            $num_stf = mysqli_num_rows($result_staff);

            if ($num_stf == 1) {
                $premit = 'เจ้าที่ฝาย';
            }

            $query_secretary = "SELECT u.usr_id,st.str_id FROM user as u
                        JOIN secretary as st ON st.usr_id = u.usr_id
                        WHERE u.usr_id= $premit_user
                        ORDER BY u.usr_id asc";

            $result_secretary = mysqli_query($con, $query_secretary) or die(mysqli_error($query_secretary));
            $num_str = mysqli_num_rows($result_secretary);

            if ($num_str == 1) {
                $premit = 'เลขานุการ';
            }

            $query_endorser = "SELECT u.usr_id,e.eds_id FROM user as u
                        JOIN endorser as e ON e.usr_id = u.usr_id
                        WHERE u.usr_id= $premit_user
                        ORDER BY u.usr_id asc";

            $result_endorser = mysqli_query($con, $query_endorser) or die(mysqli_error($query_endorser));
            $num_eds = mysqli_num_rows($result_endorser);

            if ($num_eds == 1) {
                $premit = 'ผู้อนุมัติ';
            }

            $query_student = "SELECT u.usr_id,std.std_id FROM user as u
                    JOIN student as std ON std.usr_id = u.usr_id
                    WHERE u.usr_id= $premit_user
                    ORDER BY u.usr_id asc";

            $result_student = mysqli_query($con, $query_student) or die(mysqli_error($query_student));
            $num_std = mysqli_num_rows($result_student);

            if ($num_std == 1) {
                $premit = 'สโมสรนักศึกษา';
            }

            $query_teacher = "SELECT u.usr_id,t.tec_id FROM user as u
                    JOIN teacher as t ON t.usr_id = u.usr_id
                    WHERE u.usr_id= $premit_user
                    ORDER BY u.usr_id asc";

            $result_teacher = mysqli_query($con, $query_teacher) or die(mysqli_error($query_teacher));
            $num_tec = mysqli_num_rows($result_teacher);

            if ($num_tec == 1) {
                $premit = 'อาจารย์';
            }
            $output .= '
                                            <span>' . $premit . '<span>
                                            </td>
                                            <td>
                                                <center>';
            if ($row['usr_show'] == 1) {
                $status = '<span class="badge bg-success">เปิดใช้งาน</span>';
            } else {
                $status = '<span class="badge bg-danger">ปิดใช้งาน</span>';
            }

            $output .= '<span>' . $status . '<span>

                                                </center>
                                            </td>
                                            <td>';

            // โปรไฟล์ผู้ใช้งาน
            $output .= '
                        <button type="button" class="btn btn-info view_user" data-usr_id="' . $row['usr_id'] . '" 
                            data-toggle="modal" data-target="#modal-view" title="ข้อมูลผู้ใช้งาน">
                                <i class="fas fa-user"></i>
                        </button>
                                            ';
            if ($num_eds == 1 || $num_stf == 1 || $num_str == 1 || $num_std == 1 || $num_tec == 1) {
                $output .= '
                   
                    <button type="button" class="btn btn-warning edit_pasword" data-usr_id="' . $row['usr_id'] . '" 
                        data-toggle="modal" data-target="#modal-edit_password" title="เปลี่ยนรหัสผ่าน">
                            <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" name="action" 
                        class="btn btn-success bnt-xs  on" 
                        data-usr_id="' . $row['usr_id'] . '" 
                        data-usr_show="' . $row['usr_show'] . '"
                        title="เปิดผู้ใช้งาน">
                            <i class="fas fa-eye"></i>
                    </button>
                    <button type="button" name="action" 
                        class="btn btn-danger bnt-xs off" 
                        data-usr_id="' . $row['usr_id'] . '" 
                        data-usr_show="' . $row['usr_show'] . '"
                        title="ปิดผู้ใช้งาน">
                            <i class="fas fa-eye-slash"></i>
                    </button>';
            }
            if ($num_dea == 1) {
                $output .= '
           
            <button type="button" class="btn btn-warning edit_pwd" data-usr_id_dea="' . $row['usr_id'] . '" 
            data-toggle="modal" data-target="#modal_edit_pwd_dea" title="เปลี่ยนรหัสผ่าน">
                <i class="fas fa-edit"></i>
            </button>
           
            ';
            }

            $output .= '
            </td>
        </tr>';
        }


        $output .= '
        </tbody>
    </table>
    ';
        echo $output;
    }

    if ($_POST['action'] == 'fetch_user') {

        $output = '';
        $message = '';
        $query_user = "SELECT * FROM user WHERE fct_id='" . $_SESSION['fct_id'] . "' && usr_show='1'";

        $result_user = mysqli_query($con, $query_user) or die(mysqli_error($query_user));

        $output .= '<table id="tb_user" class="table table-bordered table-hover">

        <thead class="table thead-light">
            <tr>
    
                <th>
                    <center>ชื่อ-นามสกุล</center>
                </th>
                <th>
                    <center>เบอร์โทรศัพท์</center>
                </th>
                <th>
                    <center>อีเมล</center>
                </th>
                <th></th>
    
            </tr>
            </thead>
            <tbody>';
        while ($row = mysqli_fetch_array($result_user)) {
            $output .= '
                <tr>
                <td>
            ';

            if ($row['usr_prefix'] == '' || $row['usr_firstname'] == '' || $row['usr_lastname'] == '') {
                $message = 'ไม่มีข้อมูล';
            } else {
                $message =  $row['usr_prefix'] . $row['usr_firstname'] . ' ' . $row['usr_lastname'];
            }
            $output .=  $message . '</td>
            <td>';
            if ($row['usr_tel'] == '') {
                $message = 'ไม่มีข้อมูล';
            } else {
                $message = $row['usr_tel'];
            }
            $output .=  $message . '</td>
             <td>
            ';
            if ($row['usr_email'] == '') {
                $message = 'ไม่มีข้อมูล';
            } else {
                $message = $row['usr_email'];
            }

            $output .= $message . '</td>';

            $usr_id = $row['usr_id'];

            $query_admin = "SELECT * FROM admin WHERE usr_id='$usr_id'";
            $result_admin = mysqli_query($con, $query_admin) or die(mysqli_error($query_admin));

            if (mysqli_num_rows($result_admin) == 1) {
                $message = 'ผู้ดูแลระบบ';
            }

            $query_dean = "SELECT * FROM dean WHERE usr_id='$usr_id'";
            $result_dean = mysqli_query($con, $query_dean) or die(mysqli_error($query_dean));

            if (mysqli_num_rows($result_dean) == 1) {
                $message = 'คณบดี';
            }

            $query_endorser = "SELECT * FROM endorser WHERE usr_id='$usr_id'";
            $result_endorser = mysqli_query($con, $query_endorser) or die(mysqli_error($query_endorser));

            if (mysqli_num_rows($result_endorser) == 1) {
                $message = 'ผู้อนุมัติ';
            }

            $query_staff = "SELECT * FROM staff WHERE usr_id='$usr_id'";
            $result_staff = mysqli_query($con, $query_staff) or die(mysqli_error($query_staff));

            if (mysqli_num_rows($result_staff) == 1) {
                $message = 'เจ้าหน้าที่';
            }

            $query_secretary = "SELECT * FROM secretary WHERE usr_id='$usr_id'";
            $result_secretary = mysqli_query($con, $query_secretary) or die(mysqli_error($query_secretary));

            if (mysqli_num_rows($result_secretary) == 1) {
                $message = 'เลขานุการ';
            }

            $query_student = "SELECT * FROM student WHERE usr_id='$usr_id'";
            $result_student = mysqli_query($con, $query_student) or die(mysqli_error($query_student));

            if (mysqli_num_rows($result_student) == 1) {
                $message = 'สโมสรนักศึกษา';
            }

            $query_teacher = "SELECT * FROM teacher WHERE usr_id='$usr_id'";
            $result_teacher = mysqli_query($con, $query_teacher) or die(mysqli_error($query_teacher));

            if (mysqli_num_rows($result_teacher) == 1) {
                $message = 'สโมสรนักศึกษา';
            }
            $output .= '
            <td>
                <center>' . $message . '</center>
            </td>';
        }


        $output .= '</t>
            </tbody>
            </table>
            ';
        echo $output;
    }

    // reset password dean user
    if ($_POST['action'] == 'reset_pwd') {

   
        $output = '';
        $message = '';
        $usr_id = mysqli_real_escape_string($con, $_POST['usr_id']);
        $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
        $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
        $con_password = mysqli_real_escape_string($con, $_POST['con_password']);
       

        $chk_password = "SELECT * FROM user WHERE usr_id='$usr_id'";
       
        $result_pasword = mysqli_query($con, $chk_password) or die(mysqli_error($chk_password));
        if (mysqli_num_rows($result_pasword) == 1) {

            while ($user = mysqli_fetch_array($result_pasword)) {


                if (password_verify($old_password, $user['usr_password'])) {
                    if ($new_password !== $con_password) {
                        $message = '<i class="text-danger">รหัสผ่านใหม่ไม่ตรงกับยืนยันรหัสผ่าน กรุณาลองใหม่อีกครั้ง</i>';

                        $output .= '
                <div class="alert alert-light">
                    ' .  $message . '
                </div>
                ';
                    } else {
                        $usr_password = password_hash($new_password, PASSWORD_DEFAULT);

                        $update = "UPDATE user SET usr_password ='$usr_password' WHERE usr_id='$usr_id'";

                        if (mysqli_query($con, $update)) {
                            $message = '<i class="text-success">เปลี่ยนรหัสผ่านเรียบร้อยแล้ว</i>';

                            $output .= '
                        <div class="alert alert-light">
                            ' .  $message . '
                        </div>
                        ';
                        }
                    }
                } else {
                    $message = '<i class="text-danger">รหัสผ่านเก่าไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</i>';

                    $output .= '
                <div class="alert alert-light">
                    ' .  $message . '
                </div>
                ';
                }
            }
        }
        echo $output;
    }

    // reset password user 
    if ($_POST['action'] == 'reset_password') {
        $message = '';

        if ($_POST['old_pwd'] == $_POST['c_pwd']) {
            $usr_id = mysqli_real_escape_string($con, $_POST['usr_id']);
            $usr_password = mysqli_real_escape_string($con, $_POST['old_pwd']);
            $hash_password = password_hash($usr_password, PASSWORD_DEFAULT);

            $update = "UPDATE user SET usr_password='$hash_password' WHERE usr_id='$usr_id'";

            if (mysqli_query($con, $update) or die(mysqli_error($update))) {
                $message = '<i class="text-success">เปลี่ยนรหัสผ่านเรียบร้อยแล้ว</i>';

                echo '
            <div class="alert alert-light">
                รายการนี้ถูก' .  $message . '
            </div>
            ';
            }
        } else {
            $message = '<i class="text-danger">รหัสผ่านไม่ตรงกัน กรุณาลองใหม่อีกครั้ง</i>';

            echo '
        <div class="alert alert-light">
            รายการนี้ถูก' .  $message . '
        </div>
        ';
        }
    }
    if($_POST['action'] == 'change_usrpassword'){

  
        $output = '';
        $message = '';
        $old_password = mysqli_real_escape_string($con,$_POST['old_password']);
        $new_password = mysqli_real_escape_string($con,$_POST['new_Password']);
        $cpassword = mysqli_real_escape_string($con,$_POST['cPassword']);
        $usr_id = mysqli_real_escape_string($con,$_SESSION['usr_id']);
        
    
        $query_usr = "SELECT * FROM  user WHERE usr_id='$usr_id'";
       
        $result_usr = mysqli_query($con,$query_usr) or die(mysqli_error($query_usr));
        
        if(mysqli_num_rows($result_usr) == 1){
    
            while($rows_user = mysqli_fetch_array($result_usr)){
    
                if(password_verify($old_password, $rows_user['usr_password'])){
    
                    // echo 'current password';
                    if($new_password !== $cpassword){
                        // echo 'not Maching';
                        $message = '<i class="text-danger">รหัสผ่านใหม่และยืนยันรหัสไม่ตรงกัน กรุณาลองใหม่อีกครั้ง</i>';
                    } else {
                      
                        // echo 'Maching';
                        $hash = password_hash($new_password,PASSWORD_DEFAULT);
    
                        $update_password = "UPDATE  user SET usr_password='$hash' WHERE usr_id='$usr_id'";
                        $result_password = mysqli_query($con,$update_password) or die(mysqli_error($update_password));
                       
                        if($result_password == true){
                            $message = '<i class="text-success">เปลี่ยนรหัสผ่านเรียบร้อยแล้ว</i>';
                        } else {
                            $message = '<i class="text-danger">ผิดพลาด กรุณาลองใหม่อีกครั้ง</i>';
                        }
    
                    }
    
                } else {
                    // echo 'not password';
                    $message = '<i class="text-danger">รหัสผ่านเก่าไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</i>';
                }
    
            }
        } 
        $output .= '
            <div class="alert alert-light">
                ' . $message . '
            </div>
        ';
        echo $output;
    }

    // active user 
    if ($_POST['action'] == 'status_on') {

      
        $status_on = '';
        $status = '';

        $query_status = "SELECT * FROM user WHERE usr_id='" . $_POST['usr_id'] . "'";
        $result_status = mysqli_query($con, $query_status) or die(mysqli_error($query_status));
        $user = mysqli_fetch_array($result_status);
        if ($_POST['usr_show'] == '0') {

            $status = '1';
            $update_status = "UPDATE user SET usr_show='$status' WHERE usr_id='" . $_POST['usr_id'] . "'";
            if (mysqli_query($con, $update_status)) {
                $status_on = '<span class="badge bg-success text-white">เปิดใช้งาน</span>';

                echo '
    <div class="alert alert-light text-while">
        รายการนี้ถูก' . $status_on . '
    </div>  
    ';
            }
        } else {
            $status_on = '<i class="text-danger">เปิดใช้งานอยู่แล้ว</i>';

            echo '
        <div class="alert alert-light">
            รายการนี้ถูก' . $status_on . '
        </div>
        ';
        }
    }

    // disactive user
    if ($_POST['action'] == 'status_off') {
        $status_off = '';
        $status = '';

        $query_status = "SELECT * FROM user WHERE usr_id='" . $_POST['usr_id'] . "'";
        $result_status = mysqli_query($con, $query_status) or die(mysqli_error($query_status));
        $user = mysqli_fetch_array($result_status);
        if ($_POST['usr_show'] == '1') {
            $status = '0';

            $update_status = "UPDATE user SET usr_show='$status' WHERE usr_id='" . $_POST['usr_id'] . "'";
            // echo $update_status;
            $result_update  = mysqli_query($con, $update_status);

            if ($result_update) {
                $status_off = '<span class="badge bg-danger text-white">ปิดใช้งาน</span>';

                echo '
        <div class="alert alert-light text-while">
            รายการนี้ถูก' . $status_off . '
        </div>  
        ';
            }
        } else {
            $status_off = '<i class="text-danger">ปิดใช้งานอยู่แล้ว</i>';

            echo '
        <div class="alert alert-light">
            รายการนี้ถูก' . $status_off . '
        </div>
        ';
        }
    }

    // insert dean
    if ($_POST['action'] == 'insert_dean') {
        $output = '';

        $usr_username = mysqli_real_escape_string($con, $_POST['usr_username']);
        $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);


        $query_chk_username = "SELECT usr_username FROM user WHERE usr_username='$usr_username'";
        $result_username = mysqli_query($con, $query_chk_username) or die(mysqli_error($query_chk_username));

        if (mysqli_num_rows($result_username) == 0) {
            // echo 'ชื่อผู้ใช้งานใช้ได้';

            $hash_password = password_hash($usr_password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO user(usr_username,usr_password,fct_id) 
                VALUES('$usr_username','$hash_password','$fct_id')";
            $result = mysqli_query($con, $insert) or die(mysqli_error($insert));

            if ($result == true) {
                $usr_id = mysqli_insert_id($con);

                $insert_dean = "INSERT INTO dean(usr_id) VALUES('$usr_id')";
                $result_dean = mysqli_query($con, $insert_dean) or die(mysqli_errno($insert_dean));

                $output .= 'สมัครคณบดีสำเร็จแล้ว';
            } else {
                header("location:javascript://history.go(-1)");
            }
        } else {
            $output .= 'DuplicateUserName';
        }
        echo $output;
    }

    if ($_POST['action'] == 'fetch_data') {

        $output = '';
        $message = '';
        $query = "SELECT * FROM user WHERE usr_id='" . $_POST['usr_id'] . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($query));


        while ($user = mysqli_fetch_array($result)) {

            $output .= '<p><b>ชื่อ-นามสกุล :</b>  ';
            if ($user['usr_prefix'] == '' || $user['usr_firstname'] == '' || $user['usr_lastname'] == '') {
                $message = 'ไม่มีข้อมูล';
            } else {
                $message =  $user['usr_prefix'] . $user['usr_firstname'] . ' ' . $user['usr_lastname'];
            }
            $output .=  $message . '</p>
            <p><b>เบอร์โทรศัพท์ :</b> ';
            if ($user['usr_tel'] == '') {
                $message = 'ไม่มีข้อมูล';
            } else {
                $message = $user['usr_tel'];
            }
            $output .=  $message . '</p>
            <p><b>อีเมล : </b>
            ';
            if ($user['usr_email'] == '') {
                $message = 'ไม่มีข้อมูล';
            } else {
                $message = $user['usr_email'];
            }
            $output .=  $message . '</p>';
        }
        echo $output;
    }

    if ($_POST['action'] == 'insert_user') {

        $output = '';
        $message = '';
        $usr_username = mysqli_real_escape_string($con, $_POST['usr_username']);
        $usr_password = mysqli_real_escape_string($con, $_POST['usr_password']);
        $prefix = mysqli_real_escape_string($con, $_POST['prefix']);
        $usr_firstname = mysqli_real_escape_string($con, $_POST['usr_firstname']);
        $usr_lastname = mysqli_real_escape_string($con, $_POST['usr_lastname']);
        $usr_tel = mysqli_real_escape_string($con, $_POST['usr_tel']);
        $usr_email = mysqli_real_escape_string($con, $_POST['usr_email']);
        $usr_permit = mysqli_real_escape_string($con, $_POST['usr_permit']);
        $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);


        $query_username = "SELECT * FROM  user WHERE usr_username='$usr_username'";
        $result_username = mysqli_query($con, $query_username) or die(mysqli_error($query_username));

        if (mysqli_num_rows($result_username) !== 0) {
            $output .= 'username';
        } else {
            $hash_password = password_hash($usr_password, PASSWORD_DEFAULT);
            $insert_user  = "INSERT INTO user(usr_username,usr_password,usr_prefix,usr_firstname,usr_lastname,usr_tel,usr_email,fct_id) 
                    VALUES('$usr_username','$hash_password','$prefix','$usr_firstname','$usr_lastname','$usr_tel','$usr_email','$fct_id')";
            $result_usr1 = mysqli_query($con, $insert_user);

            if ($result_usr1) {
                $usr_id = mysqli_insert_id($con);

                $query_permit = "SELECT pmu_id FROM permit_user WHERE pmu_id='$usr_permit'";
                $result_permit = mysqli_query($con, $query_permit);
                $rows_permit = mysqli_fetch_array($result_permit);

                // endorser
                if ($rows_permit['pmu_id'] == '1') {
                    // echo 'endorser';
                    $insert_endorser = "INSERT INTO endorser(usr_id) VALUES('$usr_id')";
                    $result_endorser = mysqli_query($con, $insert_endorser);
                }
                // staff
                elseif ($rows_permit['pmu_id'] == '2') {
                    // echo 'staff';
                    $insert_staff = "INSERT INTO staff(usr_id) VALUES('$usr_id')";
                    $result_staff = mysqli_query($con, $insert_staff);
                }
                // secretary
                elseif ($rows_permit['pmu_id'] == '3') {
                    // echo 'secretary';
                    $insert_secretary = "INSERT INTO secretary(usr_id) VALUES('$usr_id')";
                    $result_secretary = mysqli_query($con, $insert_secretary);
                }
                //student
                elseif ($rows_permit['pmu_id'] == '4') {
                    // echo 'student';
                    $insert_student = "INSERT INTO student(usr_id) VALUES('$usr_id')";
                    $result_student = mysqli_query($con, $insert_student);
                }
                // teacher
                elseif ($rows_permit['pmu_id'] == '5') {
                    // echo 'teacher';
                    $insert_teacher = "INSERT INTO teacher(usr_id) VALUES('$usr_id')";
                    $result_teacher = mysqli_query($con, $insert_teacher);
                }

                $output .= '
                <script>
                alert("สมัครสมาชิกสำเร็จแล้ว")
                    location = "' . BASE_URL . '/user/all_user"
            </script>
                ';
            }
        }
        echo $output;
    }

    if ($_POST['action'] == 'edit_profile') {
        $output = '';
        $usr_prefix = mysqli_real_escape_string($con, $_POST['usr_prefix']);
        $usr_firstname = mysqli_real_escape_string($con, $_POST['usr_firstname']);
        $usr_lastname = mysqli_real_escape_string($con, $_POST['usr_lastname']);
        $usr_tel = mysqli_real_escape_string($con, $_POST['usr_tel']);
        $usr_email = mysqli_real_escape_string($con, $_POST['usr_email']);
        $usr_id = mysqli_real_escape_string($con, $_SESSION['usr_id']);

       
        $update_user  = "UPDATE user SET usr_prefix='$usr_prefix', usr_firstname='$usr_firstname',
        usr_lastname='$usr_lastname',usr_tel='$usr_tel',usr_email='$usr_email' 
        WHERE usr_id='$usr_id'";
        
      if(mysqli_query($con,$update_user) or die(mysqli_error($update_user))){
        $output .= '<span class="text-success">แก้ไขสำเร็จ</span>';
      } else {
        $output .= '<span class="text-danger">ผิดพลาด</span>';
      }

    echo $output;
    }
}
