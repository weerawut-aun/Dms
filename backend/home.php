<?php
include('../secure/connect.php');
include('./include/auth.php');

if (!isset($_SESSION['fct_id'])) {
    header("location:javascript://history.go(-1)");
}
if (isset($_SESSION['first_login'])) {

    // location:".BASE_URL."/backend/user/frm_insert_data.php"

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('เนื่องจากเข้าสู่ระบบครั้งแรก กรุณาจัดการข้อมูลส่วนตัวเองก่อน');
    window.location.href='" . BASE_URL . "/backend/user/frm_insert_data.php';
    </script>");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
    <!-- script css -->
    <?php include('./include/script_css.php'); ?>
    <style>
        .bg_lightblue{
            background: #8699F1;
            color: white;
        }
    
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include('./include/menu_top.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('./include/menu_l.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header"></div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-body bg_lightblue">

                            <h1>ยินดีต้อนรับสู่ <?php echo $_SESSION['wcf_name'];  ?></h1>
                            
                            <?php
                            $query_fct = "SELECT * FROM faculty WHERE fct_id='" . $_SESSION['fct_id'] . "'";
                            $result_fct = mysqli_query($con, $query_fct) or die(mysqli_error($query_fct));
                            $num_rows_fct = mysqli_num_rows($result_fct);

                            if ($num_rows_fct == 1) {
                                while ($row_fct = mysqli_fetch_array($result_fct)) {
                                    echo '<p style="font-size:27px">';
                                    echo 'คณะ' . ' ' . $row_fct['fct_name'];
                                    echo '</p>';
                                }
                            }

                            ?>
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
    <?php include('./include/script_js.php'); ?>

</body>

</html>