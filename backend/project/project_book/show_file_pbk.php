<?php

require_once('../../../secure/connect.php');
// page show_pbk.php

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
                            <h3 class="card-title">เล่มโครงการ</h3>

                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="<?php echo BASE_URL ?>/project/<?= $_SESSION['pro_id'] ?>">ย้อนกลับ</a>
                            </div>
                            <table id="tb_project_book" class="table table-bordered table-striped">
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

                                    $query_pbk = "SELECT p.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM project_book  as p 
                        JOIN user as u ON u.usr_id = p.usr_id
                        WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                        ORDER BY p.pbk_id asc";

                                    $result_pbk = mysqli_query($con, $query_pbk) or die(mysqli_error($query_pbk));

                                    while ($pbk = mysqli_fetch_array($result_pbk)) {
                                    ?>
                                        <tr>
                                            <?php
                                            $pbk_id = $pbk['pbk_id']; //ไอดีเอกสาร
                                            ?>
                                            <th scope="row"><?php echo $pbk['pbk_filename'];  ?></th>
                                            <td><?php echo DateThai($pbk['pbk_date']); ?></td>
                                            <td><?php echo $pbk['usr_prefix'].$pbk['usr_firstname'] . " " . $pbk['usr_lastname']; ?></td>
                                            <td><a type="button" class="btn btn-info" href="<?php echo  BASE_URL ?>/backend/project/project_book/pbk_file.php?pbk_id=<?= $pbk_id ?>">ดาวน์โหลด</a></td>
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
            $("#tb_project_book").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>