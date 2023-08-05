<?php
include('../../secure/connect.php');
include('./../include/auth.php');


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
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">เปลี่ยนรหัสผ่าน <i class="nav-icon fas fa-users"></i></h1>
                        </div>
                        <?php
                        // echo '<pre>';
                        // print_r($_SESSION);
                        // echo '</pre>';

                        $query_usr = "SELECT * FROM user WHERE usr_id='" . $_SESSION['usr_id'] . "'";
                        $result_usr = mysqli_query($con, $query_usr) or die(mysqli_error($query_usr));
                        $num_rows = mysqli_num_rows($result_usr);

                        ?>
                        <form action="change_usrpassword.php" method="POST" role="form" id="frm_change_password">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7" id="frm_changePwd">

                                        <?php

                                        if ($num_rows > 0) {
                                            while ($rows = mysqli_fetch_array($result_usr)) {

                                        ?>
                                                <div class="form-group">
                                                    <label for="">รหัสผ่านเก่า</label>
                                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="กรอกรหัสผ่านเก่าของคูณ">
                                                </div>
                                                <div id="f_password"></div><br>
                                                <div class="form-group">
                                                    <label for="">รหัสผ่านใหม่</label>
                                                    <input type="password" class="form-control" name="new_password" id="new_Password" placeholder="รหัสผ่านใหม่ของคูณ">
                                                </div>
                                                <div id="fn_password"></div><br>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">ยืนรหัสผ่าน</label>
                                                    <input type="password" class="form-control" name="cpassword" id="cPassword" placeholder="ยืนยันรหัสผ่านใหม่อีกครั้ง">
                                                </div>
                                                <div id="ErrorPwd"></div><br>
                                                <div id="show_data"></div>

                                        <?php
                                            }
                                        }
                                        ?>

                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" name="submit" id="change_password" value="บันทึก">
                                        </div>
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
    <script src="../backend/user/action/action_user.js"></script>

</body>

</html>