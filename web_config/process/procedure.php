<?php
require_once('../connect.php');
include('../include/auth.php');


if (isset($_GET['y_id'])) {
    $_SESSION['y_id'] = $_GET['y_id'];
}

$query = "SELECT * FROM years WHERE y_id='" . $_SESSION['y_id'] . "' 
    && fct_id='" . $_SESSION['fct_id'] . "'";
$result = mysqli_query($con, $query) or die(mysqli_error($query));
$row = mysqli_fetch_array($result);
if (mysqli_num_rows($result) == 0) {
    header("location:javascript://history.go(-1)");
}
$query_fct = "SELECT * FROM faculty WHERE fct_id='" . $_SESSION['fct_id'] . "'";
$resutl_fct = mysqli_query($con, $query_fct) or die(mysqli_error($query_fct));
$fct  = mysqli_fetch_array($resutl_fct);

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../include/script_css.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-header">
            <?php include('../include/navbar.php'); ?>
        </div>
        <br>
        <!-- /.content-header -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container -fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex bd-highlight mb-3">
                                        <div class="mr-auto p-2 bd-highlight">
                                            <h3>คณะ <?php echo $fct['fct_name'];  ?></h3>
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h3>ปีการศีกษา <?php echo $row['y_years']; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">วางแผน</h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="list_agenda"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">ดำเนินการ</h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="list_project"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">สรุปผล</h3>
                                            </div>
                                            <div class="card-body">
                                                <h5>เอกสารสรุปผลต่อปี</h5>
                                                <ol>
                                                    <!--  invitation_letter_summary  -->
                                                    <li>

                                                        <a>หนังสือเชิญประชุมสรุปผล</a>
                                                        <?php

                                                        $query_ils = "SELECT * FROM invitation_letter_summary WHERE y_id='" . $_SESSION['y_id'] . "' && fct_id='" . $_SESSION['fct_id'] . "'";
                                                        $result_ils = mysqli_query($con, $query_ils) or die(mysqli_error($query_ils));
                                                        $num_rows_ils = mysqli_num_rows($result_ils);

                                                        if ($num_rows_ils == 0) {
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        } else {
                                                            echo '<a href="summary/invitation_letter_summary/show_file_ils.php" data-toggle="popover" 
                                                    data-trigger="hover" data-content="ลิ้งไฟล์หนังสือเชิญประชุมสรุปผล">
                                                        <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                    </a>';
                                                        }

                                                        ?>

                                                    </li>
                                                    <!-- /. invitation_letter_summary  -->

                                                    <!-- meet_sign_summary -->
                                                    <li>

                                                        <a>ใบเซ็นชื่อประชุมสรุปผล</a>
                                                        <?php

                                                        $query_mss = "SELECT * FROM meet_sign_summary WHERE y_id='" . $_SESSION['y_id'] . "' && fct_id='" . $_SESSION['fct_id'] . "'";
                                                        $reuslt_mss = mysqli_query($con, $query_mss) or die(mysqli_error($query_mss));
                                                        $num_rows_mss = mysqli_num_rows($reuslt_mss);

                                                        if ($num_rows_mss == 0) {
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        } else {
                                                            echo '<a href="summary/meet_sign_summary/show_file_mss.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์หนังสือเชิญประชุมสรุปผล"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                                        }
                                                        ?>

                                                    </li>
                                                    <!-- /. meet_sign_summary -->
                                                    <li>
                                                        <a>รายงานประชุมสรุปผล</a>
                                                        <?php

                                                        $query_rms = "SELECT * FROM report_meet_summary WHERE y_id='" . $_SESSION['y_id'] . "' && fct_id='" . $_SESSION['fct_id'] . "'";
                                                        $result_rms = mysqli_query($con, $query_rms) or die(mysqli_error($query_rms));
                                                        $num_rows_rms = mysqli_num_rows($result_rms);

                                                        if ($num_rows_rms == 0) {
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        } else {
                                                            echo '<a href="summary/report_meet_summary/show_file_rms.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์หนังสือเชิญประชุมสรุปผล"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                                        }
                                                        ?>

                                                    </li>
                                                    <li>
                                                        <a>รายงานการประชุมสรุปผลต่อปี</a>
                                                        <?php
                                                        $query_rpd = "SELECT * FROM report_document WHERE y_id='" . $_SESSION['y_id'] . "' &&  fct_id='" . $_SESSION['fct_id'] . "'";
                                                        $result_rpd = mysqli_query($con, $query_rpd) or die(mysqli_error($query_rpd));
                                                        $num_rows_rpd = mysqli_num_rows($result_rpd);

                                                        if ($num_rows_rpd == 0) {
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        } else {
                                                            echo '<a href="summary/report_document/show_file_rpd.php" data-toggle="popover" data-trigger="hover" 
                                                    data-content="ลิ้งไฟล์หนังสือแต่งตั้งคณะกรรมการ">
                                                        <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                    </a>';
                                                        }
                                                        ?>
                                                    </li>
                                                </ol>
                                                <div id="list_summary"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-footer">
                                    <a href="../years/all_years.php?fct_id=<?= $_SESSION['fct_id']; ?>" class="btn btn-danger">ย้อนกลับ</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    <?php include('../include/script_js.php'); ?>
    <script src="action/process.js"></script>

</body>

</html>