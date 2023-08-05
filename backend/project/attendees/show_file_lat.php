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
                            <h3 class="card-title">ใบเซ็นชื่อผู้ร่วมโครงการ</h3>
                          
                        </div>
                        <div class="card-body">
                        <div class="card-tools">
                                <a type="button" class="btn btn-danger float-right" href="<?php echo BASE_URL ?>/project/<?= $_SESSION['pro_id'] ?>">ย้อนกลับ</a>
                            </div>
                            <table id="tb_attendes" class="table table-bordered table-striped">
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

                                    $query_lat = "SELECT l.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM list_attend  as l 
                        JOIN user as u ON u.usr_id = l.usr_id
                        WHERE l.pro_id='" . $_SESSION['pro_id'] . "'
                        ORDER BY l.lat_id asc";

                                    $result_lat = mysqli_query($con, $query_lat) or die(mysqli_error($query_lat));

                                    while ($lat = mysqli_fetch_array($result_lat)) {
                                    ?>
                                        <tr>
                                            <?php
                                            $lat_id = $lat['lat_id']; //ไอดีเอกสาร
                                            ?>
                                            <th><?php echo $lat['lat_filename'];  ?></th>
                                            <td><?php echo DateThai($lat['lat_date']); ?></td>
                                            <td><?php echo $lat['usr_prefix'] .$lat['usr_firstname'] . " " . $lat['usr_lastname']; ?></td>
                                            <td>
                                                <a type="button" class="btn btn-info" href="<?php echo  BASE_URL?>/backend/project/attendees/lat_file.php?lat_id=<?= $lat_id ?>">ดาวน์โหลด</a>
                                            </td>
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
            $("#tb_attendes").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

</body>

</html>