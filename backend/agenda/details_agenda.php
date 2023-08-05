<?php
include('../../secure/connect.php');
include('../include/auth.php');



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
        header("location:" . BASE_URL . "/backend/unaccess.php");
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
            <div class="content-header">
                <h3> วางแผน : <?php echo $data['agd_name']; ?></h3>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">


                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">ข้อมูลรายละเอียด</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">เอกสารที่เกี่ยวข้องและเอกสารประกอบอื่นๆ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">แสดงความคิดเห็น</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="row">

                                        <div class="col-12 col-md-12 col-lg-8">
                                            <p><b> วันที่จัดการประชุม : </b><?php echo "วันที่" . " " . DateThai($data['mtd_day']); ?></p>
                                            <p><b>ผู้บันทึกข้อมูล : </b><?php echo $data['usr_prefix'] . $data['usr_firstname'] . ' ' . $data['usr_lastname']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-8">
                                            <h4>เอกสารที่เกี่ยวข้อง</h4>

                                            <ul>

                                                <!-- หนังสือเชิญประชุม -->
                                                <li>
                                                    <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                        <!-- <a href="frm_add_invite.php?agd_id=<?= $_SESSION['agd_id']; ?>" class="sansserif">หนังสือเชิญประชุม</a> -->
                                                        <a href="<?php echo BASE_URL ?>/backend/agenda/invite/frm_add_invite.php">หนังสือเชิญประชุม</a>
                                                    <?php } else {
                                                        echo ' <a class="file_link">หนังสือเชิญประชุม</a>';
                                                    }
                                                    $check_inv = "SELECT m.inv_id,i.inv_filename FROM meet_detail as m
                                                        JOIN invite as i ON i.inv_id = m.inv_id
                                                        WHERE m.agd_id='$agd_id'
                                                        ORDER BY m.mtd_id asc";

                                                    $result_check = mysqli_query($con, $check_inv) or die(mysqli_error($check_inv));

                                                    if (mysqli_num_rows($result_check) > 0) {
                                                    ?>
                                                        <a href="<?php echo BASE_URL ?>/backend/agenda/invite/show_file_invite.php">
                                                            <i class="fas fa-paperclip paperclip-success" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์หนังสือเชิญประชุม"></i>
                                                        </a>
                                                    <?php

                                                    } else {
                                                        echo '<i class="fas fa-paperclip paperclip-gray"></i>';
                                                    }

                                                    ?>
                                                </li>
                                                <!-- /. หนังสือเชิญประชุม -->

                                                <!-- ใบลงทะเบียนผู้เข้าร่วมประชุม -->
                                                <li>
                                                    <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>

                                                        <a href="<?php echo BASE_URL ?>/backend/agenda/sign/frm_add_sign.php">ใบลงทะเบียนผู้เข้าร่วมประชุม</a>
                                                    <?php } else {
                                                        echo '<a class="file_link">ใบลงทะเบียนผู้เข้าร่วมประชุม</a>';
                                                    }

                                                    $check_sig = "SELECT m.sig_id,s.sig_filename FROM meet_detail as m 
                                                JOIN sign as s ON s.sig_id = m.sig_id
                                                WHERE m.agd_id='$agd_id'
                                                ORDER BY m.mtd_id asc";

                                                    $ressult_check2 = mysqli_query($con, $check_sig) or die(mysqli_error($check_sig));

                                                    if (mysqli_num_rows($ressult_check2) > 0) { ?>
                                                        <a href="<?php echo BASE_URL ?>/backend/agenda/sign/show_file_sign.php">
                                                            <i class="fas fa-paperclip  paperclip-success" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์ใบลงทะเบียนผู้เข้าร่วมประชุม"></i>
                                                        </a>
                                                    <?php

                                                    } else {
                                                        echo ' <i class="fas fa-paperclip paperclip-gray"></i>';
                                                    }

                                                    ?>

                                                </li>
                                                <!-- /. ใบลงทะเบียนผู้เข้าร่วมประชุม -->

                                                <!-- รายงานการประชุม -->
                                                <li>
                                                    <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                        <a href="<?php echo BASE_URL ?>/backend/agenda/minutes/frm_add_minutes.php">รายงานการประชุม</a>
                                                    <?php } else { ?>
                                                        <a class="file_link">รายงานการประชุม</a>
                                                    <?php } ?>
                                                    <?php

                                                    $check_min = "SELECT m.min_id,n.min_filename FROM meet_detail as m
                                                    JOIN minutes as n ON n.min_id = m.min_id
                                                    WHERE m.agd_id='$agd_id'
                                                    ORDER BY m.mtd_id asc";

                                                    $result_check3 = mysqli_query($con, $check_min) or die(mysqli_error($check_min));


                                                    if (mysqli_num_rows($result_check3) > 0) {

                                                    ?>

                                                        <a href="<?php echo BASE_URL ?>/backend/agenda/minutes/show_file_minutes.php">
                                                            <i class="fas fa-paperclip  paperclip-success" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์รายงานการประชุม"></i>
                                                        </a>
                                                    <?php

                                                    } else {
                                                        echo '<i class="fas fa-paperclip paperclip-gray"></i>';
                                                    }
                                                    ?>
                                                </li>

                                            </ul>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-12">
                                            <!-- เอกสารประกอยอื่นๆ -->
                                            <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                <a href="<?php echo BASE_URL ?>/backend/agenda/doc/frm_add_doc.php" class="subheading">เอกสารประกอบอื่นๆ</a>
                                            <?php } else { ?>
                                                <a style="font-size: 25px; color:black;">เอกสารประกอบอื่นๆ</a>
                                            <?php }


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
                                                        <?php if (mysqli_num_rows($result_doc)) { ?>

                                                            <?php while ($doc = mysqli_fetch_array($result_doc)) { ?>
                                                                <tr>
                                                                    <?php

                                                                    $doc_filename = $doc['doc_filename']; //ชื่อไฟล์เอกสาร
                                                                    $doc_id = $doc['doc_id']; //ไอดีเอกสาร
                                                                    ?>
                                                                    <th scope="row"><?php echo $doc_filename;  ?></th>
                                                                    <td><?php echo  DateThai($doc['doc_date']); ?></td>
                                                                    <td><?php echo $doc['usr_prefix'] . $doc['usr_firstname'] . " " . $doc['usr_lastname']; ?></td>
                                                                    <td><a href="<?php echo BASE_URL ?>/backend/agenda/doc/doc_file.php?doc_id=<?= $doc_id ?>" class="btn btn-info">ดาวน์โหลด</a></td>
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
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                    <div class="row">
                                        <div class="col-sm-2 col-md-2" align="right"></div>
                                        <div class="col-sm-12 col-md-5" align="left">
                                            <h3><i class="fa fa-envelope"></i> แสดงความคิดเห็น </h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2" align="right"></div>
                                        <div class="col-sm-5" align="left">
                                            <form method="POST" class="form-horizontal" id="comment_form">
                                                <div class="form-group">
                                                    <div class="col-sm-2" align="right"></div>
                                                    <div class="col-sm-5" align="left">
                                                        <input type="hidden" id="usr_id" name="usr_id" value="<?php echo $_SESSION['usr_id'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <textarea id="cmg_comment" name="cmg_comment" class="form-control" rows="6"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-2" align="right"> </div>
                                                    <div class="col-sm-5" align="left">
                                                        <input type="hidden" name="comment_id" id="comment_id" value="0">
                                                        <button type="button" name="submit" class="btn btn-primary  bnt-xs action" data-usr_id="<?php echo $_SESSION['usr_id']; ?>" data-agd_id="<?php echo $_SESSION['agd_id']; ?>">บันทึก</button>

                                                    </div>
                                                </div>
                                                <span id="comment_message"></span>
                                            </form>

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
                        <div class="card-footer">
                            <a class="btn btn-danger " href="<?php echo BASE_URL ?>/<?= $_SESSION['y_id'] ?>/agenda">ย้อนกลับ</a>
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
        $(document).ready(function() {
            load_comment();

            function load_comment() {

                var action = 'fetch';

                $.ajax({
                    url: '../backend/agenda/fetch_comment.php',
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function(response) {
                        $('#display_comment').html(response);
                    }
                })
            }

            $(document).on('click', '.action', function(event) {
                event.preventDefault();
                var cmg_comment = $('#cmg_comment').val();
                var comment_id = $('#comment_id').val();
                var usr_id = $(this).data('usr_id');
                var agd_id = $(this).data('agd_id');
                var action = 'insert_comment';
                $('#comment_message').html('');

                $.ajax({
                    url: '../backend/agenda/fetch_comment.php',
                    method: "POST",
                    data: {
                        cmg_comment: cmg_comment,
                        comment_id: comment_id,
                        usr_id: usr_id,
                        agd_id: agd_id,
                        action: action
                    },
                    success: function(data) {
                        load_comment();
                        $('#comment_form')[0].reset();
                        $('#comment_message').html(data);
                    }
                });


            });
        });
    </script>

</body>

</html>