<?php
include('../../secure/connect.php');
// include('../include/auth.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
    <!-- script css -->
    <?php include('../include/script_css.php'); ?>
    <style>
        #secound,
        #third,
        #result {
            display: none;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include('../include/menu_top.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('../include/menu_l.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header"></div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">


                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">จัดการข้อมูลตัวเอง</h1>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-12">
                                    <h5 class="text-center text-light bg-success mb-2 p-2 rounded lead" id="result">Hello World!</h5>
                                    <div class="progress mb-3" style="height: 40px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%;" id="progressBar">
                                            <b class="lead" id="progressText">Step - 1/3</b>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 mt-3">
                                    <form id="frm_insert_data">
                                        <div id="first">
                                            <h4 class="text-center bg-primary p-1 rounded text-light">ข้อมูลส่่วนบุคคล</h4>
                                            <div class="form-group col-md-6">
                                                <label>คำนำหน้าชื่อ :</label>
                                                <span class="text-danger">*</span>
                                                <select class="form-control" name="usr_prefix" id="usr_prefix">
                                                    <option value="">กรุณาเลือก...</option>
                                                    <?php

                                                    $query_tpf = "SELECT * FROM title_prefix";
                                                    $result_tpf = mysqli_query($con, $query_tpf);

                                                    if (mysqli_num_rows($result_tpf) > 0) {

                                                        while ($rows = mysqli_fetch_array($result_tpf)) {

                                                    ?>
                                                            <option value="<?php echo $rows['tpf_prefix']; ?>"><?php echo $rows['tpf_prefix'];  ?></option>
                                                    <?php
                                                        }
                                                    }

                                                    ?>

                                                </select>
                                                <b class="form-text text-danger" id="prefixError"></b>
                                            </div>
                                            <div class="form-group">
                                                <label>ชื่อ :</label>
                                                <span class="text-danger">*</span>
                                                <input type="text" class="form-control" name="usr_firstname" id="usr_firstname">
                                                <b class="form-text text-danger" id="firstnameError"></b>
                                            </div>
                                            <div class="form-group ">
                                                <label>นามสกุล :</label>
                                                <span class="text-danger">*</span>
                                                <input type="text" class="form-control" name="usr_lastname" id="usr_lastname">
                                                <b class="form-text text-danger" id="lastnameError"></b>
                                            </div>
                                            <div class="form-group">
                                                <a href="#" class="btn btn-primary" id="next-1">หน้าถัดไป</a>
                                            </div>
                                        </div>
                                        <div id="secound">
                                            <h4 class="text-center bg-primary p-1 rounded text-light">ข้อมูลติดต่อ</h4>
                                            <div class="form-group">
                                                <label for="usr_email">อีเมล :</label>
                                                <input type="email" name="usr_email" id="usr_email" class="form-control">
                                                <b class="form-text text-danger" id="emailError"></b>
                                            </div>
                                            <div class="form-group">
                                                <label for="usr_tel">เบอร์โทรศัพท์ :</label>
                                                <input type="tel" name="usr_tel" id="usr_tel" class="form-control">
                                                <b class="form-text text-danger" id="telError"></b>
                                            </div>
                                            <div class="form-group">
                                                <a href="#" class="btn btn-danger" id="prev-2">ย้อนกลับ</a>
                                                <a href="#" class="btn btn-primary" id="next-2">หน้าถัดไป</a>
                                            </div>
                                        </div>
                                        <div id="third">
                                            <h4 class="text-center bg-primary p-1 rounded text-light">จัดการรหัสผ่าน</h4>
                                            <div class="form-group">
                                                <label for="usr_password">รหัสผ่านเก่า :</label>
                                                <input type="password" name="usr_password" id="usr_password" class="form-control">
                                                <b class="form-text text-danger" id="passError"></b>
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">รหัสผ่านใหม่ :</label>
                                                <input type="password" name="new_password" id="new_password" class="form-control">
                                                <b class="form-text text-danger" id="npassError"></b>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password">ยืนยันรหัสผ่าน :</label>
                                                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                                <b class="form-text text-danger" id="cpassError"></b>
                                            </div>
                                            <div class="form-group">
                                                <a href="#" class="btn btn-danger" id="prev-3">ย้อนกลับ</a>
                                                <input type="submit" name="insert" id="insert" class="btn btn-success" value="ยืนยัน">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>



                    </div>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- javascript -->
    <?php include('../include/script_js.php'); ?>
    <!-- <script src="action/action_user.js"></script> -->
    <script>
        $(document).ready(function() {

            $('#next-1').click(function(e) {
                e.preventDefault();
                $('#prefixError').html('');
                $('#firstnameError').html('');
                $('#lastnameError').html('');

                if ($('#usr_prefix').val() == '') {
                    $('#prefixError').html('* กรุณาเลือกคำนำหน้าชื่อ');
                    return false;
                } else if ($('#usr_firstname').val() == '') {
                    $('#firstnameError').html('* กรุณากรอกชื่อ');
                    return false;
                } else if ($('#usr_lastname').val() == '') {
                    $('#lastnameError').html('* กรุณานามสกุล');
                    return false;
                } else {
                    $('#secound').show();
                    $('#first').hide();
                    $('#progressBar').css("width", "60%");
                    $('#progressText').html("Step - 2/3");
                }
            });

            $('#next-2').click(function(e) {
                e.preventDefault();
                $('#emailError').html('');
                $('#telError').html('');

                if ($('#usr_email').val() == '') {
                    $('#emailError').html('* กรุณากรอกอีเมล');
                    return false;
                } else if (!validateEmail($('#usr_email').val())) {
                    $('#emailError').html('* อีเมลนี้ใช้งานไม่ได้');
                    return false;
                } else if ($('#usr_tel').val() == '') {
                    $('#telError').html('* กรุณากรอเบอร์โทรศัพท์');
                    return false;

                } else if (isNaN($('#usr_tel').val())) {
                    $('#telError').html('* อนุญาตเฉพาะตัวเลขเท่านั้น');
                    return false;
                } else if ($('#usr_tel').val().length != 10) {
                    $('#telError').html('* หมายเลขโทรศัพท์ต้องมี 10 ตัว');
                    return false;
                } else {
                    $('#third').show();
                    $('#secound').hide();
                    $('#progressBar').css("width", "100%");
                    $('#progressText').html("Step - 3/3");
                }
            });

            function validateEmail($email) {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                return emailReg.test($email);
            }

            $('#frm_insert_data').on('submit',function(e) {
                e.preventDefault();
                var action = 'insert_data';
                var usr_prefix = $('#usr_prefix').val();
                var usr_firstname = $('#usr_firstname').val();
                var usr_lastname = $('#usr_lastname').val();
                var usr_email = $('#usr_email').val();
                var usr_tel = $('#usr_tel').val();
                var usr_password = $('#usr_password').val();
                var new_password = $('#new_password').val();
                var confirm_password = $('#confirm_password').val();
             
                // var frm_insert_data = $('#frm_insert_data').serialize();
                // alert(frm_insert_data);
                $('#passError').html('');
                $('#npassError').html('');
                $('#cpassError').html('');

                if (usr_password == '') {
                    $('#passError').html('* กรุณากรอกรหัสผ่านเก่า');
                    return false;
                } else if (new_password == '') {
                    $('#npassError').html('* กรุณากรอกรหัสผ่านใหม่');
                    return false;
                } else if (confirm_password == '') {
                    $('#cpassError').html('* กรุณากรอกยืนยันรหัสผ่านใหม่');
                    return false;
                } else if (new_password !== confirm_password) {
                    $('#cpassError').html('* กรุณารหัสใหม่กับยืนยันรหัสผ่านใหม่ไม่ตรงกัน');
                    return false;
                } else {
                    $.ajax({
                        url: 'action/action.php',
                        method: 'POST',
                        data: {
                            action: action,
                            usr_prefix:usr_prefix,
                            usr_firstname:usr_firstname,
                            usr_lastname:usr_lastname,
                            usr_email:usr_email,
                            usr_tel:usr_tel,
                            usr_password:usr_password,
                            new_password:new_password,
                            confirm_password:confirm_password
                        },
                        success: function(data) {
                            if (data == 'usr_password') {
                                $('#passError').html('* รหัสผ่านเก่าผิด');
                            } else {
                                $('#result').show();
                                $('#result').html(data);
                            }

                        }
                    });
                }
            });

            $('#prev-2').click(function() {
                $('#secound').hide();
                $('#first').show();
                $('#progressBar').css("width", "20%");
                $('#progressText').html("Step - 1/3");
            });

            $('#prev-3').click(function() {
                $('#secound').show();
                $('#third').hide();
                $('#progressBar').css("width", "60%");
                $('#progressText').html("Step - 2/3");
            });
        });
    </script>

</body>

</html>