<?php
require_once('../../../secure/connect.php');
include('../../include/auth.php');
chk_management();

$query_ils = "SELECT ils_id,y_id FROM invitation_letter_summary WHERE y_id='" . $_SESSION['y_id'] . "'";
$result_ils = mysqli_query($con, $query_ils) or die(mysqli_errno($query_ils));
// $num_rows = mysqli_num_rows($result_ils);
$ils = mysqli_fetch_array($result_ils);

$query_fct  = "SELECT * FROM faculty WHERE fct_id='" . $_SESSION['fct_id'] . "'";
$result_fct = mysqli_query($con, $query_fct) or die(mysqli_error($query_fct));
$fetch_rows = mysqli_fetch_array($result_fct);

$size = $fetch_rows['fct_uploadsize'];



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
                            <h2 class="card-title">หนังสือเชิญประชุมสรุปผล</h2>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <form id="uploadFormils" method="POST" action="uploaded_ils.php">
                                    <div class="form-group">
                                        <input type="file" name="ils_filename" id="ils_filename" class="form-control-file">
                                        <br>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $size;  ?>">
                                        <?php if ($ils['ils_id'] != 0) { ?>
                                            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="บันทึก" onclick="return confirm('ไฟล์เอกสารก่อนจะหายไป คุณแน่ใจรึว่าจะอัพโหลดเอกสาร ?')">
                                        <?php  } else { ?>
                                            <input type="submit" class="btn btn-primary" id="submit1" name="submit" value="บันทึก">
                                        <?php } ?>

                                        <a href="<?php echo BASE_URL ?>/<?= $_SESSION['y_id']; ?>/summary" class="btn btn-danger">ย้อนกลับ</a>

                                    </div>
                                </form>
                                <!-- progress-bar -->
                                <div class="progress" id="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div id="targetLayer" style="display: none;"></div>
                                <div id="loader-icon" style="display: none;"></div>
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