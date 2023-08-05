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
            <?php include('../include/content_header.php'); ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <?php

                                    if (isset($_GET['y_years'])) {
                                       
                                        $query_get_years = "SELECT * FROM years WHERE y_years='".$_GET['y_years']."'";
                                        $result_get_years = mysqli_query($con,$query_get_years);
                                        
                                    }
                                    ?>
                                    <h3 class="card-title">ปี: <?php echo $_GET['y_years']; ?></h3>
                                </div>
                                <div class="card-body">
                                    <center>รายละเอียด</center>
                                </div>

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

</body>

</html>