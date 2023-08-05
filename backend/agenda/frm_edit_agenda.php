<?php
include('../../secure/connect.php');
include('../include/auth.php');
chk_management();

$query_agd = "SELECT * FROM agenda WHERE agd_id='".$_GET['agd_id']."'";
$result_agd = mysqli_query($con,$query_agd) or die(mysqli_error($query_agd));
$agd = mysqli_fetch_array($result_agd);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
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

                    <!-- header agenda main -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">แก้ไขหัวข้อประชุม</h3>
                        </div>
                      

                        <form id="frm_edit_agenda">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-sm-12 col-md-8 mt_15">

                                        <!-- agenda topic วาระการประชุม -->
                                        <div class="form-group mt_15">
                                            <label>การประชุม</label>
                                            <input type="hidden" class="form-control" name="agd_id" id="agd_id" value="<?php echo $agd['agd_id']; ?>">
                                            <input type="text" class="form-control" name="agd_name_new" id="agd_name_new" value="<?php echo $agd['agd_name']; ?>">
                                        </div>
                                        <div id="edit_agenda"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="cal-sm-12 col-md-8 mt-15">
                                        <input type="submit" name="add_agd" id="add_agd" class="btn btn-primary" value="บันทึก" onclick="return confirm('คุณแน่ใจแล้วจะแก้ไขหัวข้อการประชุม ?')">
                                        <a href="<?php echo BASE_URL ?>/<?= $_SESSION['y_id'] ?>/agenda" class="btn btn-danger">ย้อนกลับ</a>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div><!-- /.container-fluid -->


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