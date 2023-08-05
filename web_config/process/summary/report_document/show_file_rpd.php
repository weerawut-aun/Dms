<?php
require_once('../../../connect.php');
include('../../../include/auth.php');


$query_rpd = "SELECT r.*,u.usr_firstname,u.usr_lastname FROM report_document as r
                JOIN user as u ON u.usr_id = r.usr_id
                WHERE r.y_id='" . $_SESSION['y_id'] . "'
                ORDER BY r.rpd_id desc";
$result_rpd = mysqli_query($con, $query_rpd) or die(mysqli_error($query_rpd));

$rpd = mysqli_fetch_array($result_rpd);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- script css -->
    <?php include('../../../include/script_css.php'); ?>

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
                            <h3 class="card-title">รายงานการประชุมสรุปผล</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="../../procedure.php?y_id=<?= $_SESSION['y_id']; ?>">
                                    <i class="fa fa-fw  fa-reply"></i> ยกเลิก
                                </a>
                            </div>
                            <table id="tb_report_document" class="table table-bordered table-striped">
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
                                        <?php
                                        $rpd_id = $rpd['rpd_id']; //ไอดีเอกสาร
                                        ?>
                                        <th><?php echo $rpd['rpd_filename'];  ?></th>
                                        <td><?php echo DateThai($rpd['rpd_date']); ?></td>
                                        <td><?php echo $rpd['usr_firstname'] . " " . $rpd['usr_lastname']; ?></td>
                                        <td>
                                            <a type="button" class="btn btn-info" href="rpd_file.php?rpd_id=<?= $rpd_id  ?>">
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
    <?php include('../../../include/script_js.php'); ?>
    <script>
        $(function() {
            $("#tb_report_document").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>