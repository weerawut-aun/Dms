<?php
include('../../secure/connect.php');
include('../include/auth.php');
chk_dea();
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
                        <div class="card-header">
                            <h1 class="card-title">สมัครผู้ดูแลระบบ</h1>
                        </div>
                        <form id="frm_insert_admin">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <div class="form-gropu col-sm-9">
                                            <label for="usr_username">ชื่อผู้ใช้งาน :</label>
                                            <input type="text" class="form-control" name="usr_username" id="usr_username">
                                        </div>
                                        <div class="form-group col-sm-9">
                                            <label for="usr_password">รหัสผ่าน :</label>
                                            <input type="password" class="form-control" name="usr_password" id="usr_password">
                                        </div>
                                        <div class="form-group col-sm-9">
                                            <label for="c_password">ยืนยันรหัสผ่าน :</label>
                                            <input type="password" class="form-control" name="c_password" id="c_password">
                                        </div>
                                        <div id="showErrorPwd"></div>
                                        <div id="message"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">

                                        <input type="submit" class="btn btn-success" name="insert" id="insert" value="บันทึกข้อมูล">
                                        <a href="../../admin/list_admin" class="btn btn-danger">ย้อนกลับ</a>

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
    <script src="action/admin.js"></script>

</body>

</html>