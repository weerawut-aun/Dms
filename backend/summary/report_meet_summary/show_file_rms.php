<?php
require_once('../../../secure/connect.php');
include('../../include/auth.php');




$query_rms = "SELECT r.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM report_meet_summary as r
                JOIN user as u ON u.usr_id = r.usr_id
                WHERE r.y_id='" . $_SESSION['y_id'] . "'
                ORDER BY r.rms_id desc";
$result_rms = mysqli_query($con, $query_rms) or die(mysqli_error($query_rms));
$rms = mysqli_fetch_array($result_rms);
$rms_id = $rms['rms_id'];
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
                            <h3 class="card-title">รายงานประชุม</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="<?php echo BASE_URL ?>/<?= $_SESSION['y_id'] ?>/summary">
                                    <i class="fa fa-fw  fa-reply"></i> ย้อนกลับ
                                </a>
                            </div>
                            <table id="tb_invitation_letter_summary" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อไฟล์เอกสาร</th>
                                        <th scope="col">วันที่บันทึก</th>
                                        <th scope="col">ผู้บันทึก</th>
                                        <th scope="col">ลิ้งดาวน์โหลด</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>

                                        <th><?php echo $rms['rms_filename'];  ?></th>
                                        <td><?php echo DateThai($rms['rms_date']); ?></td>
                                        <td><?php echo $rms['usr_prefix'] .$rms['usr_firstname'] . " " . $rms['usr_lastname']; ?></td>
                                        <td>
                                            <a type="button" class="btn btn-info" href="<?php echo  BASE_URL ?>/backend/summary/report_meet_summary/rms_file.php?rms_id=<?= $rms_id  ?>">
                                                <i class="glyphicon glyphicon-save"></i> ดาวน์โหลด
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
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
    <script>
        $(function() {
            $("#tb_invitation_letter_summary").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>