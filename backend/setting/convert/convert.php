<?php

include('../../../secure/connect.php');
include('../../include/auth.php');


$query_web_config = "SELECT * FROM web_config WHERE upload_size='1'";
$result_web_config = mysqli_query($con, $query_web_config);

$query_faculty = "SELECT * FROM faculty WHERE fct_id='" . $_SESSION['fct_id'] . "'";
$result_faculty = mysqli_query($con, $query_faculty) or die(mysqli_error($query_faculty));
$fetch_faculty = mysqli_fetch_array($result_faculty);

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
            <!-- /.content-header -->


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <diV class="card">
                        <div class="card-header">
                            <h3 class="card-title">ขอพื้นที่อัพโหลดไฟล์</h3>
                        </div>
                        <div class="card-body">
                            <!-- action="../convert/fun_convert.php" -->
                            <form method="POST" class="form-horizontal" id="request_uploadsize">
                                <div class="form-group">
                                    <div class="col-sm-1" align="right"> </div>
                                    <div class="col-sm-6" align="left">

                                        <div class="form-group">
                                            <label for="">พื้นที่อัพโหลดไฟล์:</label>
                                            <!-- <input name="fct_uploadsize" id="fct_uploadsize" type="text" class="form-control" /> -->

                                            <select class="form-control select2" name="fct_uploadsize" id="fct_uploadsize" style="width: 100%;">
                                                <option value="">---กรุณาเลือก---</option>
                                                <?php while ($rows = mysqli_fetch_array($result_web_config)) {
                                                    if ($fetch_faculty['fct_uploadsize'] < $rows['wcf_name']) {


                                                        $size = $rows['wcf_name'];
                                                        $max_upload = formatSizeUnits($size);
                                                ?>
                                                        <option value="<?php echo $rows['wcf_name']; ?>"><?php echo $max_upload; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-1"> </div>
                                    <div class="col-sm-5">
                                        <button type="submit" class="btn btn-primary" id="btn">เพิ่มข้อมูล
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div id="uploadsize"></div>
                            <div id="presentuploaded"></div>

                        </div>
                    </diV>

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

    <script>
        $(document).ready(function() {
            $('#request_uploadsize').on('submit', function(event) {
                event.preventDefault();

                var fct_uploadsize = $('#fct_uploadsize').val();
                var action = 'uploadsize';

                if (fct_uploadsize == false) {
                    alert('กรุณาทำรายการก่อน ดำเนินการ');
                } else {
                    $.ajax({
                        url: 'action/action.php',
                        method: "POST",
                        data: {
                            fct_uploadsize: fct_uploadsize,
                            action: action
                        },
                        success: function(data) {

                            $('#request_uploadsize')[0].reset();
                            $('#uploadsize').html(data);


                        }
                    });
                }


            });
            load_upload();

            function load_upload() {
                var action = 'fetch';
                $.ajax({
                    url: "action/action.php",
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function(data) {
                        $('#presentuploaded').html(data);
                    }
                });
            }


        });
        // select2.select('#upload_size'. {
        //     search: true
        // })
    </script>

</body>

</html>