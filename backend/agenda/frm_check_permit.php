<?php
require_once('../../secure/connect.php');
include('../include/auth.php');

chk_eds();


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
                                <h3>ยืนยันรหัสผ่าน</h3>
                            </div>
                            <div class="card-body">
                            <?php
                        //     echo '<pre>';
                        // print_r($_SESSION);
                        // echo '</pre>';
                            ?>
                            <!-- name="add"  id="add" action="check_status.php"-->
                                <form class="form-horizontal" id="chcek_agenda">
                                    <div class="form-group has-warning">
                                        <div class="col-sm-2" align="right"> </div>
                                        <div class="col-sm-5" align="left">
                                            <b>กรุณากรอกรหัสผ่าน </b>
                                            <input name="usr_password" id="password_agd" type="password" class="form-control" />
                                        </div>
                                    </div>
                                    <div id="error_password"></div>
                                    <div class="form-group">
                                        <div class="col-sm-2"> </div>
                                        <div class="col-sm-5">
                                            <!-- <input type="hidden" name="mtd_status" value="S"> -->
                                            <button type="submit" name="submit" class="btn btn-primary" id="btn"> ยืนยัน</button>
                                            <a href="<?php echo BASE_URL ?>/<?= $_SESSION['y_id'] ?>/agenda" class="btn btn-danger">ยกเลิก</a>
                                        </div>

                                    </div>
                                </form>

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

</body>

</html>