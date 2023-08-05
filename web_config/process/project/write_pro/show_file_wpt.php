<?php
// page show_file_wpt.php
require_once('../../../connect.php');

$query_wpt = "SELECT w.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM write_project  as w 
JOIN user as u ON u.usr_id = w.usr_id
WHERE w.pro_id='" . $_SESSION['pro_id'] . "'
ORDER BY w.wpt_id asc";

$result_wpt = mysqli_query($con, $query_wpt) or die(mysqli_error($query_wpt));

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
                            <h3 class="card-title" class="subheading">เอกสารเขียนโครงการ</h3>

                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="../details_project.php?pro_id=<?= $_SESSION['pro_id'] ?>">
                                    ยกเลิก
                                </a>
                            </div>
                            <table id="tb_write_project" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อไฟล์เอกสาร</th>
                                        <th scope="col">วันที่บันทึก</th>
                                        <th scope="col">ผู้บันทึก</th>
                                        <th scope="col">ลิ้งดาวน์โหลด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($wpt = mysqli_fetch_array($result_wpt)) { ?>
                                        <tr>
                                            <?php
                                            $wpt_id = $wpt['wpt_id']; //ไอดีเอกสาร
                                            ?>
                                            <th scope="row"><?php echo $wpt['wpt_filename'];  ?></th>
                                            <td><?php echo DateThai($wpt['wpt_date']); ?></td>
                                            <td><?php echo $wpt['usr_prefix'] . $wpt['usr_firstname'] . " " . $wpt['usr_lastname']; ?></td>
                                            <td>
                                                <a type="button" class="btn btn-info" href="wpt_file.php?wpt_id=<?= $wpt_id  ?>">
                                                    <i class="glyphicon glyphicon-save"></i> ดาวน์โหลด
                                                </a>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
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
            $("#tb_write_project").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>