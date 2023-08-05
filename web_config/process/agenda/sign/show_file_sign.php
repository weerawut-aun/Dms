<?php
require_once('../../../connect.php');
include('../../../include/auth.php');


if (isset($_SESSION['agd_id'])) {


    $query_sig = "SELECT s.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM sign  as s 
                JOIN user as u ON u.usr_id = s.usr_id
                WHERE s.agd_id='" . $_SESSION['agd_id'] . "'
                ORDER BY s.sig_id asc";



    $result_sig = mysqli_query($con, $query_sig) or die(mysqli_error($query_sig));
    $num_rows = mysqli_num_rows($result_sig);

    if ($num_rows == 0) {
        header("location:javascript://history.go(-1)");
    }
} else {
    header("location:javascript://history.go(-1)");
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

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <?php include('../../../include/navbar.php'); ?>
            </div>
            <br>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">ใบเซ็นชื่อ</h3>

                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="../details_agenda.php?agd_id=<?= $_SESSION['agd_id']  ?>">ย้อนกลับ</a>
                            </div>
                            <table id="tb_sign" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อไฟล์เอกสาร</th>
                                        <th scope="col">วันที่บันทึก</th>
                                        <th scope="col">ผู้บันทึก</th>
                                        <th scope="col">ลิ้งดาวน์โหลด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($sig = mysqli_fetch_array($result_sig)) { ?>
                                        <tr>
                                            <?php

                                            $sig_filename = $sig['sig_filename']; //ชื่อไฟล์เอกสาร
                                            $sig_id = $sig['sig_id']; //ไอดีเอกสาร
                                            ?>
                                            <th><?php echo $sig_filename;  ?></th>
                                            <td><?php echo  DateThai($sig['sig_date']); ?></td>
                                            <td><?php echo $sig['usr_prefix'] . "" . $sig['usr_firstname'] . " " . $sig['usr_lastname']; ?></td>
                                            <td><a href="sign_file.php?sig_id=<?= $sig_id ?>" class="btn btn-info">ดาวน์โหลด</a></td>
                                        </tr>
                                    <?php } ?>
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
            $("#tb_sign").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>s