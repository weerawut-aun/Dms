<?php
include('../../../secure/connect.php');
include('../../include/auth.php');

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';


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
            <!-- Content Header (Page header) -->
            <div class="content-header"></div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ผู้รับผิดชอบ</h3>
                        </div>
                        <div class="card-body">
                            <div id="message_repon"></div>
                            <div class="card-tool">
                                <button type="button" name="add_rpt" id="add_rpt" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_data_rpt">
                                    เพิ่มข้อมูล
                                </button>

                            </div>
                            <div id="list_person"></div>
                        </div>
                    </div>

                    <div class="modal fade" id="add_data_rpt">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">เพิ่มชื่อผู้รับผิดชอบ</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form id="frm_insert_rpt">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>คำนำหน้าชื่อ</label>
                                            <select class="form-control" name="tpf_prefix" id="prefix_repon">
                                                <option value="">กรุณาเลือก...</option>
                                                <?php
                                                $query_prefix = "SELECT * FROM title_prefix";
                                                $result_prefix = mysqli_query($con, $query_prefix) or die(mysqli_error($query_prefix));

                                                while ($rows = mysqli_fetch_array($result_prefix)) {
                                                ?>
                                                    <option value="<?php echo $rows['tpf_prefix']; ?>"><?php echo $rows['tpf_prefix'];  ?></option>
                                                <?php

                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="rpt_person">ชื่อ</label>
                                            <input type="text" class="form-control" name="rpt_firstname" id="rpt_firstname" placeholder="กรอกชื่อผู้รับผิดชอบ">
                                        </div>
                                        <div class="form-group">
                                            <label for="rpt_person">นามสกุล</label>
                                            <input type="text" class="form-control" name="rpt_lastname" id="rpt_lastname" placeholder="กรอกนามสกุลผู้รับผิดชอบ">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="insert" id="insert" value="บันทึก" class="btn btn-success">
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
    <script src="../backend/setting/respon/action/repon.js"></script>

</body>

</html>