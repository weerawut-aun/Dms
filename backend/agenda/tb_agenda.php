<?php

// echo '<pre>';
// print_r($_GET);
// echo '</pre>';

require_once('../../secure/connect.php');
include('../include/auth.php');


if (isset($_SESSION['agd_id'])) {
    unset($_SESSION['agd_id']);
}


if (isset($_GET['y_id'])) {
    $_SESSION['y_id'] = $_GET['y_id'];
}

if (isset($_SESSION['fct_id'])) {

    $chk_fct = "SELECT * FROM years WHERE fct_id='" . $_SESSION['fct_id'] . "' && y_id='" . $_SESSION['y_id'] . "'";
    $result_fct = mysqli_query($con, $chk_fct);
    $years  = mysqli_fetch_array($result_fct);

    if (mysqli_num_rows($result_fct) == 0) {
        header("location:" . BASE_URL . "/backend/unaccess.php");
    }
}

$query  = "SELECT * FROM years WHERE y_id='" . $_SESSION['y_id'] . "'";
$result = mysqli_query($con, $query) or die(mysqli_errno($query));
$years = mysqli_fetch_array($result);


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
                            <h1 class="card-title">การประชุม ปีการศึกษา<?php echo $years['y_years'];   ?></h1>
                        </div>

                        <div class="card-body table-responsive">
                            <div class="card-tools">
                                <?php

                                if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {

                                ?>
                                    <!-- <a href="<?php echo BASE_URL ?>/agenda/frm_insert_agenda" class="btn btn-primary float-right"> -->
                                    <a href="<?php echo BASE_URL ?>/backend/agenda/frm_insert_agenda.php" class="btn btn-primary float-right">
                                        <i class="fa fa-fw fa-plus"></i> เพิ่มข้อมูล
                                    </a>
                                <?php
                                }

                                if (isset($_SESSION['endorser'])) {
                                ?>
                                    <a href="<?php echo BASE_URL ?>/backend/agenda/frm_check_permit.php" id="usr_id1" class="btn btn-success float-right">
                                        <i class="fas fa-clipboard-check"></i> ดำเนินการเสร็จสิ้น
                                    </a>
                                <?php
                                }


                                ?>
                            </div>
                       

                            <div id="agenda_list"></div>
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
    <script>
        $(document).ready(function() {

            load_agenda();

            function load_agenda() {
                var action = 'fetch';
                $.ajax({
                    url: "../backend/agenda/action/action.php",
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function(data) {
                        $('#agenda_list').html(data);
                        $("#tb_agenda").DataTable();
                    }
                });

            }
        });
    </script>

</body>

</html>