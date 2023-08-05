<?php

require_once('../../../secure/connect.php');
include('../../include/auth.php');


if (isset($_SESSION['agd_id'])) {


    $query_inv = "SELECT i.*,u.usr_prefix,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM invite  as i 
                JOIN user as u ON u.usr_id = i.usr_id
                WHERE i.agd_id='" . $_SESSION['agd_id'] . "'
                ORDER BY i.inv_id desc";



    $result_inv = mysqli_query($con, $query_inv) or die(mysqli_error($query_inv));
    $num_rows = mysqli_num_rows($result_inv);

    if($num_rows == 0){
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
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">หนังสือเชฺิญประชุม</h3>

                        </div>
                        <div class="card-body">
                            <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="<?php echo BASE_URL ?>/agenda/<?= $_SESSION['agd_id']  ?>">ย้อนกลับ</a>
                            </div>
                            <table id="tb_invite" class="table table-bordered table-hover">
                                <thead class="table thead-light" style="font-family: 'Bai Jamjuree', sans-serif;">
                                    <tr>
                                        <th scope="col">ชื่อไฟล์เอกสาร</th>
                                        <th scope="col">วันที่บันทึก</th>
                                        <th scope="col">ผู้บันทึก</th>
                                        <th scope="col">ลิ้งดาวน์โหลด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($inv = mysqli_fetch_array($result_inv)) { ?>
                                        <tr>
                                            <?php


                                            $inv_filename = $inv['inv_filename']; //ชื่อไฟล์เอกสาร
                                            $inv_id = $inv['inv_id']; //ไอดีเอกสาร
                                            ?>
                                            <th><?php echo $inv_filename;  ?></th>
                                            <td><?php echo DateThai($inv['inv_date']); ?></td>
                                            <td><?php echo $inv['usr_prefix']."".$inv['usr_firstname'] . " " . $inv['usr_lastname']; ?></td>
                                            <td><a class="btn btn-info" href="<?php echo BASE_URL  ?>/backend/agenda/invite/invite_file.php?inv_id=<?= $inv_id ?>" >ดาวน์โหลด</a></td>
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
            $("#tb_invite").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>
</body>

</html>