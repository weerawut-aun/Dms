<?php
require_once('../../secure/connect.php');
include('../include/auth.php');

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
if (isset($_GET['y_id'])) {
    $_SESSION['y_id'] = $_GET['y_id'];
}
$query_years = "SELECT y_years FROM years WHERE fct_id='" . $_SESSION['fct_id'] . "' && y_id='" . $_SESSION['y_id'] . "'";
$result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));
$rows_years = mysqli_fetch_array($result_years);

$_SESSION['summary'] = 1;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
    <!-- script css -->
    <?php include('../include/script_css.php'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include('../include/menu_top.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('../include/menu_l.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header"></div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">สรุปผล ปีการศึกษา <?php echo  $rows_years['y_years'];  ?></h3>
                        </div>
                        <div class="card-body">
                            <h3>เอกสารสรุปผลต่อปี</h3>
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <ol>
                                        <!--  invitation_letter_summary  -->
                                        <li>
                                            <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                <a href="<?php echo BASE_URL ?>/backend/summary/invitation_letter_summary/frm_upload_ils.php" class="file_link">หนังสือเชิญประชุมสรุปผล</a>
                                            <?php } else { ?>
                                                <a>หนังสือเชิญประชุมสรุปผล</a>
                                            <?php
                                            }

                                            $query_ils = "SELECT * FROM invitation_letter_summary WHERE y_id='" . $_SESSION['y_id'] . "' && fct_id='" . $_SESSION['fct_id'] . "'";
                                            $result_ils = mysqli_query($con, $query_ils) or die(mysqli_error($query_ils));
                                            $num_rows_ils = mysqli_num_rows($result_ils);

                                            if ($num_rows_ils == 0) {
                                                echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                            } else {
                                                echo '<a href="' . BASE_URL . '/backend/summary/invitation_letter_summary/show_file_ils.php" data-toggle="popover" 
                                                    data-trigger="hover" data-content="ลิ้งไฟล์หนังสือเชิญประชุมสรุปผล">
                                                        <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                    </a>';
                                            }

                                            ?>

                                        </li>
                                        <!-- /. invitation_letter_summary  -->

                                        <!-- meet_sign_summary -->
                                        <li>
                                            <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                <a href="<?php echo BASE_URL ?>/backend/summary/meet_sign_summary/frm_upload_mss.php" class="file_link">ใบลงทะเบียนผู้เข้าร่วมประชุมสรุปผล</a>
                                            <?php } else { ?>
                                                <a>ใบลงทะเบียนผู้เข้าร่วมประชุมสรุปผล</a>
                                            <?php
                                            }
                                            $query_mss = "SELECT * FROM meet_sign_summary WHERE y_id='" . $_SESSION['y_id'] . "' && fct_id='" . $_SESSION['fct_id'] . "'";
                                            $reuslt_mss = mysqli_query($con, $query_mss) or die(mysqli_error($query_mss));
                                            $num_rows_mss = mysqli_num_rows($reuslt_mss);

                                            if ($num_rows_mss == 0) {
                                                echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                            } else {
                                                echo '<a href="' . BASE_URL . '/backend/summary/meet_sign_summary/show_file_mss.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์ใบลงทะเบียนผู้เข้าร่วมประชุมสรุปผล"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                            }
                                            ?>

                                        </li>
                                        <!-- /. meet_sign_summary -->
                                        <li>
                                            <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                <a href="<?php echo BASE_URL ?>/backend/summary/report_meet_summary/frm_upload_rms.php" class="file_link">รายงานประชุม</a>
                                            <?php } else { ?>
                                                <a>รายงานประชุมสรุปผล</a>
                                            <?php
                                            }
                                            $query_rms = "SELECT * FROM report_meet_summary WHERE y_id='" . $_SESSION['y_id'] . "' && fct_id='" . $_SESSION['fct_id'] . "'";
                                            $result_rms = mysqli_query($con,$query_rms) or die(mysqli_error($query_rms));
                                            $num_rows_rms = mysqli_num_rows($result_rms);

                                            if ($num_rows_rms == 0) {
                                                echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                            } else {
                                                echo '<a href="' . BASE_URL . '/backend/summary/report_meet_summary/show_file_rms.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์รายงานประชุม"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                            }
                                            ?>

                                        </li>
                                        <li>
                                            <?php
                                            if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                <a href="<?php echo BASE_URL ?>/backend/summary/report_document/frm_report_document.php" class="file_link">รายงานการประชุมสรุปผล</a>
                                            <?php } else { ?>
                                                <a>รายงานการประชุมสรุปผลต่อปี</a>
                                            <?php } ?>

                                            <?php
                                            $query_rpd = "SELECT * FROM report_document WHERE y_id='" . $_SESSION['y_id'] . "' &&  fct_id='" . $_SESSION['fct_id'] . "'";
                                            $result_rpd = mysqli_query($con, $query_rpd) or die(mysqli_error($query_rpd));
                                            $num_rows_rpd = mysqli_num_rows($result_rpd);

                                            if ($num_rows_rpd == 0) {
                                                echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                            } else {
                                                echo '<a href="' . BASE_URL . '/backend/summary/report_document/show_file_rpd.php" data-toggle="popover" data-trigger="hover" 
                                                    data-content="ลิ้งไฟล์รายงานการประชุมสรุปผล">
                                                        <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                    </a>';
                                            }
                                            ?>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <table id="list_project" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>

                                                <th>
                                                    <center>โครงการ</center>
                                                </th>
                                                <th>
                                                    <center>เรียกดูข้อมูล</center>
                                                </th>
                                                <th>
                                                    <center>สถานะ</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_pro = "SELECT * FROM project WHERE fct_id='" . $_SESSION['fct_id'] . "' && y_id='" . $_SESSION['y_id'] . "'";
                                            $result_pro = mysqli_query($con, $query_pro) or die(mysqli_error($query_pro));
                                            $num_rows_pro = mysqli_num_rows($result_pro);

                                            if ($num_rows_pro > 0) {
                                                while ($rows = mysqli_fetch_array($result_pro)) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $rows['pro_name']; ?>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <a href="<?php echo BASE_URL ?>/project/<?= $rows['pro_id']; ?>" class="btn btn-primary" data-toggle="popover" 
                                                                    data-trigger="hover" data-placement="right" data-content="ดูรายละเอียด">
                                                                        <i class="fas fa-search"></i>
                                                                </a>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <?php
                                                                if ($rows['pro_show'] == 0) {
                                                                    echo '<i class="text-warning">กำลังดำเนินการอยู๋</i>';
                                                                } elseif ($rows['pro_show'] == 1) {
                                                                    echo '<i class="text-success">สำเร็จแล้ว</i>';
                                                                } else {
                                                                    echo '<i class="text-danger">ยกเลิกโครงการ</i>';
                                                                }
                                                                ?>
                                                            </center>

                                                        </td>
                                                    </tr>

                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr class="blank_row">
                                                    <td colspan="4">
                                                        <center>
                                                            ไม่มีข้อมูล
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <?php if (isset($_SESSION['endorser'])) { ?>
                                <hr>
                                <div class="row">
                                    <a href="<?php echo BASE_URL ?>/backend/summary/chk_premit_summary.php" id="chk_summary_successfuly" class="btn btn-success">เสร็จสิ้นปีการศึกษา</a>
                                </div>
                            <?php } ?>
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
    <?php include('../include/script_js.php'); ?>
    <script>
        $(function() {
            $("#list_project").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>
</body>

</html>