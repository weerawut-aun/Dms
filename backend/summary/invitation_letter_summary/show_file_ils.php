<?php
require_once('../../../secure/connect.php');
include('../../include/auth.php');



$query_ils = "SELECT i.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM invitation_letter_summary as i
                JOIN user as u ON u.usr_id = i.usr_id
                WHERE i.y_id='" . $_SESSION['y_id'] . "'
                ORDER BY i.ils_id desc";
$result_ils = mysqli_query($con, $query_ils) or die(mysqli_error($query_ils));
$ils = mysqli_fetch_array($result_ils);
$ils_id = $ils['ils_id'];
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
                            <h3 class="card-title">หนังสือเชิญประชุมสรุปผล</h3>
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
                                   
                                        <th><?php echo $ils['ils_filename'];  ?></th>
                                        <td><?php echo DateThai($ils['ils_date']); ?></td>
                                        <td><?php echo $ils['usr_prefix'].$ils['usr_firstname'] . " " . $ils['usr_lastname']; ?></td>
                                        <td>
                                            <a type="button" class="btn btn-info" href="<?php echo  BASE_URL ?>/backend/summary/invitation_letter_summary/ils_file.php?ils_id=<?= $ils_id  ?>">
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