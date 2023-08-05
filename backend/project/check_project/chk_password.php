<?php
require_once('../../../secure/connect.php');
chk_eds();

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

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-cog"></i> ยืนยันรหัสผ่านผู้อนุมัติ </h3>
                        </div>
                        <div class="card-body">
                            <!-- action="../backend/project/check_project/check_status.php" -->
                            <form action="check_status.php" method="POST" id="frm_chk_eds" class="form-horizontal">

                                <div class="form-group has-warning">
                                    <div class="col-sm-2" align="right"> </div>
                                    <div class="col-sm-5" align="left">
                                        <b>กรุณากรอกรหัสผ่าน </b>
                                        <input name="usr_password" type="password" required class="form-control" />
                                        <?php
                                        // echo '<pre>';
                                        // print_r($_GET);
                                        // echo '</pre>';
                                     
                                            if (password_verify('1', $_GET['chk'])) {
                                                // echo '2';
                                                $pro_show = 1;
                                                echo '<input name="pro_show" type="hidden" class="form-control" value="' . $pro_show . '" />';
                                            }
                                            elseif (password_verify('2', $_GET['chk'])) {
                                                // echo '0';
                                                $pro_show = 2;
                                                echo '<input name="pro_show" type="hidden" class="form-control" value="' . $pro_show . '" />';
                                            }
                                      

                                        ?>
                                        <label>หมายเหตุ</label>
                                        <textarea name="pro_details" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2"> </div>
                                    <div class="col-sm-5">
                                        <button type="submit" name="submit" class="btn btn-primary" id="btn"> ยืนยัน</button>
                                        <a href="<?php echo BASE_URL ?>/project/<?= $_SESSION['pro_id'] ?>" class="btn btn-danger">ยกเลิก</a>
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
    <?php include('../../include/script_js.php'); ?>

</body>

</html>