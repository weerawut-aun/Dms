<?php

include('../../../secure/connect.php');
include('../../include/auth.php');

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
                    <div class="card ">
                        <div class="card-header">
                            <h1 class="card-title">ประเภทโครงการ</h1>

                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                <div id="message_project_type"></div>
                                    <div class="card-tools">
                                        <button type="button" name="add" id="add" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_data_Modal">
                                            เพิ่มข้อมูล
                                        </button>
                                    </div>
                                   
                                    <div id="project_type_list"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal fade" id="add_data_Modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">เพิ่มประเภทโครงการ</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" id="insert_form_pty">
                                    <div class="modal-body">
                                        <!-- <p>One fine body&hellip;</p> -->

                                        <div class="form-group">
                                            <label for="pty_type">ประเภทโครงการ</label>
                                            <input type="text" class="form-control" name="pty_type" id="pty_type">
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
    <script src="../backend/setting/project_type/action/project_type.js"></script>



</body>

</html>