<?php

require_once('../../../secure/connect.php');
include('../../include/auth.php');
chk_admin();


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
    <!-- script css -->
    <?php include('../../include/script_css.php'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include('../../include/menu_top.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('../../include/menu_l.php'); ?>

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

                            <h3 class="card-title">รายการสถานที่จัดโครงการ</h3>

                        </div>
                        <div class="card-body">
                            <div id="message_place_list"></div>
                            <div class="card-tool">
                                <!-- <button type="button"  class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_add_pla">
                                    <i class="fas fa-plus"></i> เพิ่มข้อมูล
                                </button> -->
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_insert_pla">
                                    เพิ่มข้อมูล
                                </button>
                            </div>

                            <div id="place_liest"></div>
                        </div>
                    </div>


                    <div class="modal fade" id="modal_insert_pla">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">เพิ่มรายการสถานที่จัดโครงการ</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="frm_insert_pla">
                                    <div class="modal-body">
                                    <div class="form-group">
                                            <label for="pla_name">สถานที่จัดโครงการ</label>
                                            <input type="text" class="form-control" name="pla_name" id="pla_name">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success" name="insert_pla" id="insert_pla" value="บันทึก">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

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
    <?php include('../../include/script_js.php'); ?>
    <script src="../backend/setting/place/action/place.js"></script>

</body>

</html>