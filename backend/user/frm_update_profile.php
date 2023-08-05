<?php
include('../../secure/connect.php');
include('../include/auth.php');


$query_user = "SELECT * FROM user WHERE usr_id='" . $_SESSION['usr_id'] . "'";
$result_user = mysqli_query($con, $query_user) or die(mysqli_error($query_user));
$user = mysqli_fetch_array($result_user);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
    <!-- script css -->
    <?php include('../include/script_css.php'); ?>

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
                        <div class="card-header">แก้ข้อมูลส่วนตัว</div>
                        <form id="edit_admit">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3"> </div>
                                    <div class="col-md-7">
                                        <!-- action="edit_admin.php" -->

                                        <div class="row">
                                            <div class="form-row">
                                                <div class="form-group col-sm-7">
                                                    <label for="usr_prefix">คำนำชื่อ :</label>
                                                    <input type="text" class="form-control" disabled name="usr_prefix" id="usr_prefix" value="<?php echo $user['usr_prefix']; ?>">
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <label for="usr_firstname">ชื่อ :</label>
                                                    <input type="text" class="form-control" name="usr_firstname" id="usr_firstname" value="<?php echo $user['usr_firstname']; ?>">
                                                    <b class="form-text text-danger" id="usernameError"></b>
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <label for="usr_lastname">นามสกุล :</label>
                                                    <input type="text" class="form-control" name="usr_lastname" id="usr_lastname" value="<?php echo $user['usr_lastname']; ?>">
                                                    <b class="form-text text-danger" id="lastnameError"></b>
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <label for="usr_tel">เบอร์โทรศัพท์ :</label>
                                                    <input type="tel" class="form-control" name="usr_tel" id="usr_tel" value="<?php echo $user['usr_tel']; ?>">
                                                    <b class="form-text text-danger" id="telError"></b>
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <label for="usr_email">อีเมล :</label>
                                                    <input type="email" class="form-control" name="usr_email" id="usr_email" value="<?php echo $user['usr_email']; ?>">
                                                    <b class="form-text text-danger" id="emailError"></b>
                                                </div>

                                                <div id="data_show"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-7">
                                        <input type="submit" class="btn btn-success" name="update_admin" id="update_admin" value="บันทึก">
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script>
        $(document).ready(function() {

            $('#edit_admit').on('submit', function(event) {
                event.preventDefault();
                var usr_prefix = $('#usr_prefix').val();
                var usr_firstname = $('#usr_firstname').val();
                var usr_lastname = $('#usr_lastname').val();
                var usr_tel = $('#usr_tel').val();
                var usr_email = $('#usr_email').val();
                var action = 'edit_profile';

                $('#usernameError').html('');
                $('#lastnameError').html('');
                $('#telError').html('');
                $('#emailError').html('');

                if (usr_firstname == '') {
                    $('#usernameError').html('* กรุณากรอกชื่อ');
                    return false;
                } else if (usr_lastname == '') {
                    $('#lastnameError').html('* กรุณากรอกนามสกุล');
                    return false;
                } else if (usr_tel == '') {
                    $('#telError').html('* กรุณากรอกเบอร์โทรศุัพท์');
                    return false;
                } else if (isNaN(usr_tel)) {
                    $('#telError').html('* กรุณากรอกเบอร์โทรศัพท์เป็นตัวเลข');
                    return false;
                } else if (usr_tel.length != 10) {
                    $('#telError').html('* กรุณากรอกเบอร์โทรศัพท์ 10 ตัว');
                    return false;
                } else if (usr_tel == '') {
                    $('#emailError').html('* กรุณากรอกอีเมล');
                    return false;
                } else if (usr_email == '') {
                    $('#emailError').html('* กรุณากรอกอีเมล');
                    return false;
                } else if (!validateEmail(usr_email)) {
                    $('#emailError').html('* กรุณาตรวจสอบอีเมลใหม่');
                    return false;
                } else {
                    if (confirm('คุณแน่ใจรึเปล่าว่าจะ อัพเดตข้อมูลนี้')) {
                        $.ajax({
                            url: "../backend/user/action/action.php",
                            method: "POST",
                            data: {
                                usr_prefix: usr_prefix,
                                usr_firstname: usr_firstname,
                                usr_lastname: usr_lastname,
                                usr_tel: usr_tel,
                                usr_email: usr_email,
                                action: action
                            },
                            success: function(data) {
                                location.reload(true);
                                $('#data_show').html(data);

                            }
                        });
                    }
                }

                function validateEmail($email) {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    return emailReg.test($email);
                }
            });
        });
    </script>

</body>

</html>