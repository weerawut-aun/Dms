<?php
include('../connect.php');

// echo'<pre>';
// print_r($_SESSION);
// echo '</pre>';
include('../include/auth.php');


if (isset($_SESSION['fct_id'])) {
    unset($_SESSION['fct_id']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../include/script_css.php'); ?>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="content-header">
            <?php include('../include/navbar.php'); ?>
        </div>
        <br>
        <!-- /.content-header -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="card-title">คณะ</h1>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="frm_faculty.php" type="button" class="btn btn-primary float-right">
                                            เพิ่มชื่อคณะ
                                        </a>

                                        <div id="list_faculty"></div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>


    <?php include('../include/script_js.php'); ?>
    <script src="action/faculty.js"></script>
</body>

</html>