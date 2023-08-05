<?php
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
                            <h3 class="card-title">เอกสารเคลียร์โครงการ</h3>

                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" style="margin-right: 16px;" href="<?php echo BASE_URL ?>/project/<?= $_SESSION['pro_id'] ?>">ย้อนกลับ</a>
                            </div>
                            <table id="tb_complete_letter" class="table table-bordered table-striped">
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

                                    $query_clt = "SELECT c.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM complete_letter  as c 
                        JOIN user as u ON u.usr_id = c.usr_id
                        WHERE c.pro_id='" . $_SESSION['pro_id'] . "'
                        ORDER BY c.clt_id asc";

                                    $result_clt = mysqli_query($con, $query_clt) or die(mysqli_error($query_clt));

                                    while ($clt = mysqli_fetch_array($result_clt)) {
                                    ?>
                                        <tr>
                                            <?php
                                            $clt_id = $clt['clt_id']; //ไอดีเอกสาร
                                            ?>
                                            <th scope="row"><?php echo $clt['clt_filename'];  ?></th>
                                            <td><?php echo DateThai($clt['clt_date']); ?></td>
                                            <td><?php echo $clt['usr_prefix'].$clt['usr_firstname'] . " " . $clt['usr_lastname']; ?></td>
                                            <td><a type="button" class="btn btn-info" href="<?php echo  BASE_URL ?>/backend/project/complete_letter/clt_file.php?clt_id=<?= $clt_id ?>">ดาวน์โหลด</a></td>
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
            $("#tb_complete_letter").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>