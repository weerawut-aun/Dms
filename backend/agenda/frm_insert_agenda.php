<?php
include('../../secure/connect.php');
include('../include/auth.php');
chk_management();

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
            <div class="content-header">

            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- header agenda main -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">เพิ่มการประชุม</h3>
                        </div>

                        <form id="frm_insert_agenda">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-sm-12 col-md-8 mt_15">

                                        <!-- agenda topic วาระการประชุม -->
                                        <div class="form-group mt_15">
                                            <label>การประชุม</label>
                                            <input type="text" class="form-control" name="agd_name" id="agd_name" placeholder="กรอกหัวข้อการประชุม">
                                        </div>
                                        <!-- วันที่จัดประชุม -->
                                        <div class="form-group">
                                            <label>วันที่จัดประชุม</label>
                                            <div class="input-group mt_15">
                                                <input type="date" class="form-control float-right" id="mtd_day" name="mtd_day">
                                            </div>

                                        </div>
                                        <!--หมายเหตุ  -->
                                        <div class="form-group ">
                                            <label>หมายเหตุ</label>
                                            <textarea class="form-control" name="mtd_detail" id="mtd_detail" rows="5"></textarea>
                                        </div>
                                        <div id="result_agenda"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="cal-sm-12 col-md-8 mt-15">
                                        <input type="submit" name="add_agd" id="sadd_agd" class="btn btn-primary" value="บันทึก">
                                        <a href="<?php echo BASE_URL ?>/<?= $_SESSION['y_id'] ?>/agenda" class="btn btn-danger">ย้อนกลับ</a>

                                    </div>
                                </div>
                            </div>
                        </form>

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
    <script src="action/action.js"></script>

</body>

</html>