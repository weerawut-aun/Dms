<?php
require_once('../../secure/connect.php');
include('../include/auth.php');

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if (isset($_SESSION['pro_id'])) {
    unset($_SESSION['pro_id']);
}
if (isset($_GET['y_id'])) {
    $_SESSION['y_id'] = $_GET['y_id'];
}
if (isset($_SESSION['summary'])) {
    unset($_SESSION['summary']);
}

if (isset($_SESSION['fct_id'])) {

    $chk_fct = "SELECT * FROM years WHERE fct_id='" . $_SESSION['fct_id'] . "' && y_id='" . $_SESSION['y_id'] . "'";
    $result_fct = mysqli_query($con, $chk_fct);

    if (mysqli_num_rows($result_fct) == 0) {
        header("location:" . BASE_URL . "/backend/unaccess.php");
    }
}

$query_years1 = "SELECT * FROM years WHERE y_id='".$_SESSION['y_id']."'";
$result_years1 = mysqli_query($con,$query_years1) or die(mysqli_error($query_years1));
$years = mysqli_fetch_array($result_years1);
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
            <br><br>

            <!-- Main content -->
            <section class="content">


                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">ดำเนินการ ปีการศึกษา<?php echo $years['y_years'];  ?></h1>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-12">
                                <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                    <a href="<?php echo BASE_URL ?>/backend/project/frm_project.php" class="btn btn-primary float-right">
                                        <i class="fa fa-plus"></i> จัดสรรโครงการ
                                    </a>

                                <?php } ?>
                                <div id="project_list"></div>

                            </div>
                        </div>
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
            load_project();

            function load_project() {
                var action = 'fetch';
                $.ajax({
                    url: "../backend/project/action.php",
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function(data) {
                        $('#project_list').html(data);
                        $("#list_project").DataTable();
                    }
                });
            }
        });
    </script>

</body>

</html>