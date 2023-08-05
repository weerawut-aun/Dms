<?php
require_once('../../../secure/connect.php');
include('../../include/auth.php');
include('../../include/max_upload.php');
chk_management();

// page frm_don.php
// don ย่อมาจาก document_other

chk_management();

$query_don = "SELECT pro_id,don_id FROM project_details WHERE pro_id='" . $_SESSION['pro_id'] . "'";
$result_don = mysqli_query($con, $query_don) or die(mysqli_error($query_don));
$fetch_rows_don = mysqli_fetch_assoc($result_don);


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

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">



                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">เอกสารอื่นๆ</h2>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <form name="uploadFormdon" id="uploadFormdon" method="POST" action="../document_other/uploaded_don.php">
                                    <div class="form-group">
                                        <input type="file" name="don_filename" id="don_filename" class="form-control-file">
                                        <br>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $size;  ?>">
                                        <?php if ($fetch_rows_don['don_id'] != 0) { ?>
                                            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="บันทึก" onclick="return confirm('ต้องการอัพอีกครั้งรึไหม ?')">
                                        <?php  } else { ?>
                                            <input type="submit" class="btn btn-primary" id="submit1" name="submit" value="บันทึก">
                                        <?php } ?>
                                        <a href="<?php echo BASE_URL ?>/project/<?= $_SESSION['pro_id'] ?>" class="btn btn-danger">ยกเลิก</a>

                                    </div>
                                </form>
                                <!-- progress-bar -->
                                <div class="progress" id="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div id="targetLayer" style="display: none;"></div>
                                <!-- ขนาดไฟล์ที่อัพโหลด -->
                                <div>
                                    <?php
                                    $max_upload = formatSizeUnits($size);

                                    echo '<p style="color: red;">*อัพโหลดไฟล์ได้ไม่เกิน ' . $max_upload . '</p>
                                    <p style="color: red;">*เฉพาะไฟล์ docx หรือ pdf</p>';
                                    ?>

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
    <?php include('../../include/script_js.php'); ?>

</body>

</html>