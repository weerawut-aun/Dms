<?php
require_once('../../../connect.php');



//เรียกปีการศึกษา
$y_id = $_SESSION['y_id'];
$query_years = "SELECT y_years FROM years WHERE y_id=$y_id";
$result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
$fetch_years = mysqli_fetch_assoc($result_years);

//หาปี่การศึกษาและคณะ
$y_years = $fetch_years['y_years'];
$fct_id = $_SESSION['fct_id'];

//path ไปยัง folder ที่อยู่ใน data
$path = $fct_id . '_' . $y_years;

$pro_id = "pro" . $_SESSION['pro_id'];
// chdir("../../../data/$path/project/$pro_id");

$query_pro = "SELECT pro_name FROM project WHERE pro_id='" . $_SESSION['pro_id'] . "'";
$result_pro = mysqli_query($con, $query_pro) or die(mysqli_error($query_pro));
$pro = mysqli_fetch_assoc($result_pro);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
    <!-- script css -->
    <?php include('../../../include/script_css.php'); ?>
    <!-- Ekko Lightbox -->
<link rel="stylesheet" href="../../../../plugins/ekko-lightbox/ekko-lightbox.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <?php include('../../../include/navbar.php'); ?>
            </div>
            <br>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">รูปภาพโครงการ <?php echo $pro['pro_name']; ?> </h1>

                        </div>
                        <div class="card-body">

                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="row">
                                        <?php

                                        $query_image = "SELECT * FROM image WHERE pro_id='" . $_SESSION['pro_id'] . "' ORDER BY img_id asc";

                                        $result_image = mysqli_query($con, $query_image) or die(mysqli_errno($query_image));
                                        $num_rows = mysqli_num_rows($result_image);


                                        if ($num_rows > 0) {

                                            while ($row = mysqli_fetch_array($result_image)) {

                                                $url = " http://localhost/myfriend/data/$path/project/$pro_id/image/"

                                        ?>

                                                <div class="col-sm-2">
                                                    <a href="<?php echo $url . $row['img_name']; ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?php echo $row['img_name']; ?>" class="col-sm-4">
                                                        <img class="img-fluid mb-2" src="<?php echo $url . $row['img_name']; ?>" alt="<?php echo $row['img_name']; ?>">
                                                    </a>
                                                </div>

                                        <?php

                                            }
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer clearfix">
                            <a type="button" class="btn btn-danger pull-right" style="margin-right: 16px;" href="../details_project.php?pro_id=<?= $_SESSION['pro_id'] ?>">ยกเลิก</a>
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
    <?php include('../../../include/script_js.php'); ?>
    <!-- Ekko Lightbox -->
    <script src="../../../../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>


</body>

</html>