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
                            <h3 class="card-title"><i class="fas fa-user"></i> สิทธิ์ผู้ดูแลระบบ</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a href="../backend/admin/frm_insert_admin.php" class="btn btn-info float-md-right">เพิ่มผู้ดูแลระบบ</a>
                            </div>
                            <div id="message"></div>
                            <div id="all_admin"></div>

                            <div class="modal fade" id="modal-edit_password">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">เปลี่ยนรหัสผ่านผู้ดูแลระบบ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="frm_reset_password">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="usr_id" id="usr_id" value="">
                                                <label for="usr_password">รหัสผ่านใหม่ :</label>
                                                <input type="password" class="form-control" name="usr_password" id="usr_password">
                                                <label for="c_password">ยืนยันรหัสผ่าน :</label>
                                                <input type="password" class="form-control" name="c_password" id="c_password">
                                            </div>
                                            <div id=showErrorPwd></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
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
    <script src="../backend/admin/action/load_admin.js"></script>

</body>

</html>