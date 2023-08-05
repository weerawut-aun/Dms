<?php
include('../../secure/connect.php');
include('../include/auth.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
    <!-- script css -->
    < <?php include('../include/script_css.php'); ?> </head> <body class="hold-transition sidebar-mini layout-fixed">
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

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">สมาชิก</h3>
                            </div>
                            <div class="card-body">
                                <div id="list_user"></div>
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
        <script src="../backend/user/action/user.js"></script>
        <script>
            $(document).ready(function() {
                load_list_user();

                function load_list_user() {
                    var action = 'fetch_user';
                    $.ajax({
                        url: '../backend/user/action/action.php',
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function(data) {

                            $('#list_user').html(data);
                            $("#tb_user").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                            });
                        }
                    });
                }
            });
        </script>
        </body>

</html>