<?php
include('../../secure/connect.php');
include('../include/auth.php');
chk_admin();
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

                            <div class="d-flex bd-highlight mb-3">
                                <div class="mr-auto p-2 bd-highlight">
                                    <h3 class="card-title"><i class="fas fa-user"></i> สิทธิ์ผู้ใช้งานทั้งหมด </h3>
                                </div>
                                <div class="p-2 bd-highlight"><a href="<?php echo BASE_URL ?>/user/registration" class="btn btn-info float-md-right">เพิ่มสมาชิก</a></div>
                                <div class="p-2 bd-highlight"><a href="<?php echo BASE_URL ?>/user/dean-registration" class="btn btn-info  float-md-right">เพิ่มคณบดี</a></div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div id="message"></div>
                            <div id="user_data"></div>


                            <div class="modal fade" id="modal_edit_pwd_dea">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">เปลี่ยนรหัสผ่านคณบดี</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="frm_reset_pwd">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="usr_id" id="usr_id_dea" value="">
                                                    <label for="old_password">รหัสผ่านเก่า</label>
                                                    <input type="password" class="form-control" name="old_password" id="old_password">
                                                    <label for="usr_password">รหัสผ่านใหม่ :</label>
                                                    <input type="password" class="form-control" name="new_password" id="new_password">
                                                    <label for="c_password">ยืนยันรหัสผ่าน :</label>
                                                    <input type="password" class="form-control" name="con_password" id="con_password">
                                                </div>
                                                <div id=showErrorPwd></div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success" name="edit_dean" id="edit_dean" value="บันทึก">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <div class="modal fade" id="modal-edit_password">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">เปลี่ยนรหัสผ่านสมาชิก</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="frm_reset_password">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="usr_id" id="usr_id" value="">
                                                    <label for="usr_password">รหัสผ่านใหม่ :</label>
                                                    <input type="password" class="form-control" name="old_pwd" id="old_pwd">
                                                    <label for="c_password">ยืนยันรหัสผ่าน :</label>
                                                    <input type="password" class="form-control" name="c_pwd" id="c_pwd">
                                                </div>
                                                <div id=showPwd></div>
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

                            <div class="modal fade" id="modal-view">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ข้อมูลสมาชิก</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body" id="data_user">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
                                        </div>

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
    <script src="../backend/user/action/user.js"></script>

</body>

</html>