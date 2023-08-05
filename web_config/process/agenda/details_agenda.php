<?php
require_once('../../connect.php');
include('../../include/auth.php');



if (isset($_GET['agd_id'])) {
    $_SESSION['agd_id'] = $_GET['agd_id'];
}

if (isset($_SESSION['fct_id']) && isset($_GET['agd_id'])) {

    $fct_id = $_SESSION['fct_id'];

    $agd_id = $_GET['agd_id'];

    $chk_fct = "SELECT * FROM agenda WHERE fct_id='$fct_id' && agd_id='$agd_id'";


    $result_fct = mysqli_query($con, $chk_fct);
    $num_rows = mysqli_num_rows($result_fct);

    if ($num_rows == 0) {
        header("location:javascript://history.go(-1)");
    }
}

$query1 = "SELECT m.*,a.agd_name,u.usr_id,u.usr_prefix,u.usr_firstname,u.usr_lastname
        FROM meet_detail as m
        JOIN agenda as a ON a.agd_id = m.agd_id
        JOIN user as u ON u.usr_id = m.usr_id
        WHERE m.agd_id='" . $_SESSION['agd_id'] . "'
        ORDER BY m.mtd_id asc";
// echo $query1;
// exit;
$result1 = mysqli_query($con, $query1) or die(mysqli_error($query1));
$agd_id = $_SESSION['agd_id'];


$data = mysqli_fetch_array($result1);
$_SESSION['y_id'] = $data['y_id'];
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
        <div class="content-header">
            <?php include('../../include/navbar.php'); ?>
        </div>
        <br>
        <!-- Main content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">



                                <div class="card-header">
                                    <h3 class="card-title">วางแผน : วาระการประชุม <?php echo $data['agd_name']; ?></h3>
                                </div>
                                <div class="card-body">


                                    <!--  ##########################################################  ข้อมูลวาระประชุม  ##########################################################-->
                                    <div class="row">

                                        <div class="col-12 col-md-12 col-lg-8">
                                            <h4>รายละเอียด</h4>
                                            <p><b> วันที่จัดการประชุม : </b><?php echo "วันที่" . " " . DateThai($data['mtd_day']); ?></p>
                                            <p><b>ผู้บันทึกข้อมูล : </b><?php echo $data['usr_prefix'] . $data['usr_firstname'] . ' ' . $data['usr_lastname']; ?></p>
                                            <hr class="line">
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-8">
                                            <h4>เอกสารที่เกี่ยวข้อง</h4>

                                            <ul class="list-unstyled">

                                                <!-- หนังสือเชิญประชุม -->
                                                <li>
                                                    <a class="file_link">หนังสือเชิญประชุม</a>
                                                    <?php

                                                    $check_inv = "SELECT m.inv_id,i.inv_filename FROM meet_detail as m
                                                            JOIN invite as i ON i.inv_id = m.inv_id
                                                            WHERE m.agd_id='$agd_id'
                                                            ORDER BY m.mtd_id asc";

                                                    $result_check = mysqli_query($con, $check_inv) or die(mysqli_error($check_inv));

                                                    if (mysqli_num_rows($result_check) > 0) {
                                                    ?>
                                                        <a href="invite/show_file_invite.php">
                                                            <i class="fas fa-paperclip paperclip-success" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์หนังสือเชิญประชุม"></i>
                                                        </a>
                                                    <?php

                                                    } else {
                                                        echo '<i class="fas fa-paperclip paperclip-gray"></i>';
                                                    }

                                                    ?>
                                                </li>
                                                <!-- /. หนังสือเชิญประชุม -->

                                                <!-- ใบเซ็นชื่อ -->
                                                <li>
                                                    <a class="file_link">ใบเซ็นชื่อ</a>
                                                    <?php

                                                    $check_sig = "SELECT m.sig_id,s.sig_filename FROM meet_detail as m 
                                                        JOIN sign as s ON s.sig_id = m.sig_id
                                                        WHERE m.agd_id='$agd_id'
                                                        ORDER BY m.mtd_id asc";

                                                    $ressult_check2 = mysqli_query($con, $check_sig) or die(mysqli_error($check_sig));

                                                    if (mysqli_num_rows($ressult_check2) > 0) { ?>
                                                        <a href="sign/show_file_sign.php">
                                                            <i class="fas fa-paperclip  paperclip-success" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์ใบเซ็นชื่อ"></i>
                                                        </a>
                                                    <?php

                                                    } else {
                                                        echo ' <i class="fas fa-paperclip paperclip-gray"></i>';
                                                    }

                                                    ?>

                                                </li>
                                                <!-- /. ใบเซ็นชื่อ -->

                                                <!-- รายงานการประชุม -->
                                                <li>
                                                    <a class="file_link">รายงานการประชุม</a>
                                                    <?php

                                                    $check_min = "SELECT m.min_id,n.min_filename FROM meet_detail as m
                            JOIN minutes as n ON n.min_id = m.min_id
                            WHERE m.agd_id='$agd_id'
                            ORDER BY m.mtd_id asc";

                                                    $result_check3 = mysqli_query($con, $check_min) or die(mysqli_error($check_min));


                                                    if (mysqli_num_rows($result_check3) > 0) {

                                                    ?>

                                                        <a href="minutes/show_file_minutes.php">
                                                            <i class="fas fa-paperclip  paperclip-success" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์รายงานการประชุม"></i>
                                                        </a>
                                                    <?php

                                                    } else {
                                                        echo '<i class="fas fa-paperclip paperclip-gray"></i>';
                                                    }
                                                    ?>
                                                </li>

                                            </ul>
                                            <hr class="line">

                                        </div>
                                    </div>
                                    <!--  ########################################################## /. ข้อมูลวาระประชุม  ##########################################################-->

                                    <!--  ##########################################################  เอกสารประกอบอื่นๆ  ##########################################################-->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-12">
                                            <!-- เอกสารประกอยอื่นๆ -->

                                            <a style="font-size: 25px; color:black;">เอกสารประกอบอื่นๆ</a>
                                            <?php

                                            $check_doc = "SELECT m.doc_id,d.doc_filename FROM meet_detail as m
                                                JOIN doc as d ON d.doc_id = m.doc_id
                                                WHERE m.agd_id='$agd_id'
                                                ORDER BY m.mtd_id asc";

                                            $result_check4 = mysqli_query($con, $check_doc) or die(mysqli_error($check_doc));

                                            if (mysqli_num_rows($result_check4) > 0) {

                                                echo '<i class="fas fa-paperclip paperclip-success" ></i>';
                                            } else {
                                                echo '<i class="fas fa-paperclip paperclip-gray"></i>';
                                            }

                                            $query_doc = "SELECT d.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM doc as d 
                                                JOIN user as u ON u.usr_id = d.usr_id
                                                WHERE d.agd_id='" . $_SESSION['agd_id'] . "'
                                                ORDER BY d.doc_id asc ";

                                            $result_doc = mysqli_query($con, $query_doc) or die($query_doc);

                                            ?>
                                        </div>
                                        <div class="col-sm-3 col-md-6 col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>ชื่อไฟล์เอกสาร</th>
                                                            <th>วันที่บันทึก</th>
                                                            <th>ผู้บันทึก</th>
                                                            <th>ลิ้งดาวน์โหลด</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (mysqli_num_rows($result_doc)) {

                                                            while ($doc = mysqli_fetch_array($result_doc)) { ?>
                                                                <tr>
                                                                    <?php

                                                                    $doc_filename = $doc['doc_filename']; //ชื่อไฟล์เอกสาร
                                                                    $doc_id = $doc['doc_id']; //ไอดีเอกสาร
                                                                    ?>
                                                                    <th scope="row"><?php echo $doc_filename;  ?></th>
                                                                    <td><?php echo  DateThai($doc['doc_date']); ?></td>
                                                                    <td><?php echo $doc['usr_prefix'] . $doc['usr_firstname'] . " " . $doc['usr_lastname']; ?></td>
                                                                    <td><a href="doc/doc_file.php?doc_id=<?= $doc_id ?>" class="btn btn-info">ดาวน์โหลด</a></td>
                                                                </tr>
                                                            <?php } ?>


                                                        <?php  } else {  ?>

                                                            <tr class="blank_row">
                                                                <td colspan="4">
                                                                    <center>
                                                                        ไม่มีข้อมูล
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <!--  ########################################################## /.  เอกสารประกอบอื่นๆ  ##########################################################-->



                                </div>

                            </div>
                        </div>
                    </div>
                    <br>

                    <!--  ##########################################################  แสดงความคิดเห็น  ##########################################################-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-2 col-md-2" align="right"></div>
                                        <div class="col-sm-12 col-md-5" align="left">
                                            <h3><i class="fa fa-envelope"></i> แสดงความคิดเห็น </h3>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="display_comment"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  ########################################################## /.  แสดงความคิดเห็น  ##########################################################-->
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-footer">
                                    <a href="../procedure.php?y_id=<?= $_SESSION['y_id']; ?>" class="btn btn-danger">ย้อนกลับ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        </div>
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
    <script src="action/agenda.js"></script>

</body>

</html>