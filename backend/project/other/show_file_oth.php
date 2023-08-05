<?php
// page show_file_wpt.php
require_once('../../../secure/connect.php');


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
                            <h3 class="card-title">อื่นๆ</h3>

                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="<?php echo BASE_URL ?>/project/<?= $_SESSION['pro_id'] ?>">ยกเลิก</a>
                            </div>
                            <table id="tb_other" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อไฟล์เอกสาร</th>
                                        <th scope="col">วันที่บันทึก</th>
                                        <th scope="col">ผู้บันทึก</th>
                                        <th scope="col">ลิ้งดาวน์โหลด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query_oth = "SELECT o.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM other  as o 
                        JOIN user as u ON u.usr_id = o.usr_id
                        WHERE o.pro_id='" . $_SESSION['pro_id'] . "'
                        ORDER BY o.oth_id asc";

                                    $result_oth = mysqli_query($con, $query_oth) or die(mysqli_error($query_oth));

                                    while ($oth = mysqli_fetch_array($result_oth)) {
                                    ?>
                                        <tr>
                                            <?php
                                            $oth_id = $oth['oth_id']; //ไอดีเอกสาร
                                            ?>
                                            <th scope="row"><?php echo $oth['oth_filename'];  ?></th>
                                            <td><?php echo DateThai($oth['oth_date']); ?></td>
                                            <td><?php echo $oth['usr_prefix'] .$oth['usr_firstname'] . " " . $oth['usr_lastname']; ?></td>
                                            <td><a type="button" class="btn btn-info" href="<?php echo  BASE_URL ?>/backend/project/other/other_file.php?oth_id=<?= $oth_id ?>">ดาวน์โหลด</a></td>
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
    <?php include('../../include/script_js.php'); ?>
    <script>
        $(function() {
            $("#tb_other").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>