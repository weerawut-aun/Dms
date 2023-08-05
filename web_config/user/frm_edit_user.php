<?php

require_once("../connect.php");
include('../include/auth.php');

// if(isset($_POST['edit'])){
//     echo $_POST['usr_username'].$_POST['usr_pasword'];
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../include/script_css.php'); ?>

<body>
    <div class="wrapper">
        <?php include('../include/navbar.php'); ?>
        <section class="content">
            <div class="container-fluid">
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title">เปลี่ยนรหัสผ่าน</h1>
                            </div>
                            <form id="frm_edit_ghost">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>รหัสผ่านเก่า :</label>
                                                <input type="password" name="old_wcf_password" id="old_wcf_password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>รหัสผ่าน :</label>
                                                <input type="password" name="wcf_password" id="wcf_password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>ยืนยันรหัสผ่าน :</label>
                                                <input type="password" name="cn_password" id="cn_password" class="form-control">
                                            </div>
                                            <div id="showPwd"></div>
                                            <div id="message"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-xs" name="edit_data" id="edit_data" value="ยืนยัน">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- ./wrapper -->
    <?php include('../include/script_js.php'); ?>
    <!-- <script src="action/action.js"></script> -->
    <script>
        $(document).ready(function() {


            $('#cn_password').on('keyup', function() {
                if ($('#wcf_password').val() == $('#cn_password').val()) {
                    $('#showPwd').html('รหัสผ่านตรง').css('color', 'green');
                } else {
                    $('#showPwd').html('**รหัสไม่ตรงกัน').css('color', 'red');
                }
            });

            $('#frm_edit_ghost').on('submit', function(event) {
                event.preventDefault();

                var old_wcf_password = $('#old_wcf_password').val();
                var wcf_password = $('#wcf_password').val();
                var cn_password = $('#cn_password').val();


                if (old_wcf_password == false || wcf_password == false || cn_password == false) {
                    alert('กรุณากรอกข้อมูลให้ครบ ก่อนทำรายการ');
                } else {


                    $.ajax({
                        url: "action/edit_user.php",
                        method: "POST",
                        data: {
                            old_wcf_password: old_wcf_password,
                            wcf_password: wcf_password,
                            cn_password: cn_password
                        },
                        success: function(data) {

                            $('#frm_edit_ghost')[0].reset();
                            $('#showPwd').hide();
                            $('#message').html(data);
                        }
                    });
                }
            });



        });
    </script>
</body>

</html>