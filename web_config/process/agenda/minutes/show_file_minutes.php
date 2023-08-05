<?php
require_once('../../../connect.php');
include('../../../include/auth.php');

if (isset($_SESSION['agd_id'])) {


    $query_min = "SELECT n.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM minutes  as n 
                JOIN user as u ON u.usr_id = n.usr_id
                WHERE n.agd_id='" . $_SESSION['agd_id'] . "'
                ORDER BY n.min_id asc";


    $result_min = mysqli_query($con, $query_min) or die(mysqli_error($query_min));
    $num_rows = mysqli_num_rows($result_min);

    if ($num_rows == 0) {
        header("location:" . BASE_URL . "/backend/unaccess.php");
    }
} else {
    header("location:" . BASE_URL . "/backend/unaccess.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
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
            <!-- /.content-header -->
            <br>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">รายงานการประชุม</h3>

                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="../details_agenda.php?agd_id=<?= $_SESSION['agd_id']  ?>">ย้อนกลับ</a>
                            </div>
                            <table id="tb_minutes" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อไฟล์เอกสาร</th>
                                        <th scope="col">วันที่บันทึก</th>
                                        <th scope="col">ผู้บันทึก</th>
                                        <th scope="col">ลิ้งดาวน์โหลด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($min = mysqli_fetch_array($result_min)) { ?>
                                        <tr>
                                            <?php

                                            $min_filename = $min['min_filename']; //ชื่อไฟล์เอกสาร
                                            $min_id = $min['min_id']; //ไอดีเอกสาร
                                            ?>
                                            <th><?php echo $min_filename;  ?></th>
                                            <td><?php echo  DateThai($min['min_date']); ?></td>
                                            <td><?php echo $min['usr_prefix'] . $min['usr_firstname'] . " " . $min['usr_lastname']; ?></td>
                                            <td>
                                                <a href="minutes_file.php?min_id=<?= $min_id ?>" class="btn btn-info">ดาวน์โหลด</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
            $("#tb_minutes").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>