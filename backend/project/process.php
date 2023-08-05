<?php
require_once('../../secure/connect.php');
include('../include/auth.php');

if (isset($_SESSION['iof_id'])) {

    unset($_SESSION['iof_id']);
}
if (isset($_SESSION['ipt_id'])) {
    unset($_SESSION['ipt_id']);
}
if (isset($_SESSION['ise_id'])) {
    unset($_SESSION['ise_id']);
}
if (isset($_SESSION['ipe_id'])) {
    unset($_SESSION['ipe_id']);
}
if (isset($_SESSION['irn_id'])) {
    unset($_SESSION['irn_id']);
}

if (isset($_GET['pro_id'])) {
    $_SESSION['pro_id'] = $_GET['pro_id'];
}

if (isset($_SESSION['fct_id']) && isset($_GET['pro_id'])) {

    $chk_fct = "SELECT * FROM  project WHERE fct_id='" . $_SESSION['fct_id'] . "' && pro_id='" . $_GET['pro_id'] . "'";
    $result_fct = mysqli_query($con, $chk_fct);

    if (mysqli_num_rows($result_fct) == 0) {
        header("location:" . BASE_URL . "/backend/unaccess.php");
    }
}


$query_pro = "SELECT * FROM project WHERE pro_id='" . $_SESSION['pro_id'] . "'";
$result_pro = mysqli_query($con, $query_pro) or die(mysqli_error($query_pro));
$rows_pro = mysqli_fetch_array($result_pro);



$query_years = "SELECT * FROM years WHERE y_id='" . $_SESSION['y_id'] . "'";
$result_years = mysqli_query($con, $query_years);
$rows_years = mysqli_fetch_array($result_years);
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
                <h3>ดำเนินการ : โครงการ <?php echo $rows_pro['pro_name']; ?></h3>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">1. ข้อมูลโครงการ</a>
                                </li>
                                <li class="nav-item">
                                    <?php
                                    $chk1 = "SELECT iof_id,ipt_id,ise_id,ipe_id,irn_id,wpt_id,alt_id,apt_id FROM project_details
 WHERE pro_id='" . $_SESSION['pro_id'] . "'";

                                    $result_chk1 = mysqli_query($con, $chk1) or die(mysqli_error($chk1));
                                    $num_rows_chk1 = mysqli_num_rows($result_chk1);


                                    if ($num_rows_chk1 > 0) {

                                        $fetch_chk1 = mysqli_fetch_array($result_chk1);

                                        if (
                                            $fetch_chk1['iof_id'] > 0 && $fetch_chk1['ipt_id'] > 0 && $fetch_chk1['ise_id'] > 0 && $fetch_chk1['ipe_id'] > 0
                                            && $fetch_chk1['irn_id'] > 0 && $fetch_chk1['wpt_id'] > 0 && $fetch_chk1['alt_id'] > 0 && $fetch_chk1['apt_id'] > 0
                                        ) {
                                    ?>
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">2. ดำเนินโครงการ</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="nav-link disabled " href="#">2. ดำเนินโครงการ</a>
                                    <?php
                                        }
                                    }
                                    ?>


                                </li>
                                <li class="nav-item">
                                    <?php
                                    $chk2 = "SELECT img_id,lat_id,oth_id FROM project_details WHERE pro_id='" . $_SESSION['pro_id'] . "'";
                                    $result_chk2 = mysqli_query($con, $chk2) or die(mysqli_error($chk2));
                                    $fetch_chk2 = mysqli_fetch_assoc($result_chk2);

                                    if ($fetch_chk2['img_id'] > 0 && $fetch_chk2['lat_id'] > 0) {
                                    ?>
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">3. สรุปโครงการ</a>
                                    <?php
                                    } else {

                                    ?>
                                        <a class="nav-link disabled"  href="#">3. สรุปโครงการ</a>
                                    <?php
                                    }
                                    ?>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">4. เอกสารอื่นๆ</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="row">
                                        <!-- ข้อมูลโครงการ -->
                                        <div class="col-md-12">
                                            <h2>
                                                <?php

                                                // เช็คสถานะการอัพโหลดข้อมูลโครงการ
                                                if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>

                                                    <a href="<?php echo BASE_URL ?>/backend/project/info/frm_info.php" class="file_link" style="font-size: 25px;" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="ลิ้งอัพโหลดรายละเอียดโครงการ">
                                                        1. ข้อมูลโครงการ
                                                    </a>
                                                    <i class="fa fa-fw  fa-folder"></i><a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลโครงการให้ครบ">*</a>

                                                    <!-- <hr class="line ruler_hr"> -->
                                                <?php } else { ?>


                                                    <a class="subheading">1. ข้อมูลโครงการ</a>
                                                    <i class="fa fa-fw  fa-folder"></i><a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลโครงการให้ครบ">*</a>



                                                <?php } ?>
                                            </h2>
                                            <div class="col-12">
                                                <hr class="line ruler_hr">
                                            </div>
                                            <!-- ##################################################### วัตถุประสงค์ ##################################################### -->
                                            <div class="row">
                                                <div class="col-8 ml-5">
                                                    <h5>
                                                        <?php
                                                        if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                            echo '
                                                        <a class="file_link" href="" title="อัพข้อมูลวัตถุประสงค์"  data-toggle="modal" data-target="#modal-newobject"> 
                                                            วัตถุประสงค์
                                                        </a>
                                                    ';
                                                        } else {
                                                            echo '<a>วัตถุประสงค์</a>';
                                                        }
                                                        ?>
                                                    </h5>
                                                    <div id="message_object"></div>
                                                    <div id="data_oject"></div>

                                                </div>
                                                <!-- ##################################################### ./วัตถุประสงค์ ##################################################### -->
                                                <div class="col-12">
                                                    <hr class="ruler_hr">
                                                </div>
                                                <!-- ##################################################### ลักษณะโครงการ##################################################### -->
                                                <div class="col-8 ml-5">
                                                    <h5>
                                                        <?php
                                                        if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                            echo '<a class="file_link" href="" title="อัพข้อมูลลักษณะโครงการ" data-toggle="modal" data-target="#modal-newipt">ลักษณะโครงการ</a>';
                                                        } else {
                                                            echo '<a>ลักษณะโครงการ</a>';
                                                        }
                                                        ?>
                                                    </h5>
                                                    <div id="message_projecttpye"></div>
                                                    <div id="data_projecttpye"></div>
                                                </div>
                                                <!-- ##################################################### ./ ลักษณะโครงการ##################################################### -->
                                                <div class="col-12">
                                                    <hr class="ruler_hr">
                                                </div>
                                                <!-- #####################################################  กำหนดการ ##################################################### -->
                                                <div class="col-8 ml-5">
                                                    <h5>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                            echo ' <a class="file_link" href="" title="อัพข้อมูลกำหนดการ" data-toggle="modal" data-target="#modal-newise">กำหนดการ</a>';
                                                        } else {
                                                            echo ' <a>กำหนดการ</a>';
                                                        }
                                                        ?>
                                                    </h5>
                                                    <div id="message_schedul"></div>
                                                    <div id="data_schedule"></div>
                                                </div>
                                                <!-- ##################################################### ./ กำหนดการ ##################################################### -->

                                                <div class="col-12">
                                                    <hr class="ruler_hr">
                                                </div>
                                                <!-- #####################################################  สถานที่ ##################################################### -->
                                                <!-- Place -->
                                                <div class="col-8 ml-5">
                                                    <h5>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                            echo '<a class="file_link" href="" title="อัพข้อมูลสถานที่" data-toggle="modal" data-target="#modal-newipe">สถานที่</a>';
                                                        } else {
                                                            echo '<a>สถานที่</a>';
                                                        }
                                                        ?>
                                                    </h5>
                                                    <div id="message_place"></div>
                                                    <div id="data_place"></div>

                                                </div>
                                                <!-- ##################################################### ./ สถานที่ ##################################################### -->
                                                <div class="col-12">
                                                    <hr class="ruler_hr">
                                                </div>
                                                <!-- #####################################################  ผู้รับผิดชอบ ##################################################### -->
                                                <div class="col-8 ml-5">
                                                    <h5>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                            echo '<a class="file_link" href="" title="อัพข้อมูลผู้รับผิดชอบ" data-toggle="modal" data-target="#modal-newirn">ผู้รับผิดชอบ</a>';
                                                        } else {
                                                            echo '<a>ผู้รับผิดชอบ</a>';
                                                        }
                                                        ?>
                                                    </h5>
                                                    <div id="message_repon"></div>
                                                    <div id="data_repon"></div>
                                                </div>
                                                <!-- ##################################################### ./ ผู้รับผิดชอบ ##################################################### -->

                                            </div>

                                        </div>

                                        <div class="col-12">
                                            <hr class="ruler_hr">
                                        </div>

                                        <!-- ข้อมูลโครงการ -->

                                        <div class="row">
                                            <div class="col-12 ml-4">
                                                <h3 class="subheading padding_header">
                                                    เอกสารโครงการ <i class="fa fa-fw  fa-file"></i>
                                                </h3>
                                                <ol>
                                                    <!-- เอกสารเขียนโครงการ -->
                                                    <li>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                            <a href="<?php echo BASE_URL ?>/backend/project/write_pro/frm_wpt.php" class="file_link">เอกสารโครงการ</a>
                                                        <?php } else { ?>
                                                            <a class="file_link">เอกสารโครงการ</a>
                                                        <?php

                                                        }
                                                        $check_wpt = "SELECT p.wpt_id,w.wpt_filename FROM project_details as p
                                    JOIN write_project as w ON w.wpt_id = p.wpt_id
                                    WHERE p.pro_id = '" . $_SESSION['pro_id'] . "'
                                    ORDER BY p.pdt_id asc";

                                                        $result_wpt = mysqli_query($con, $check_wpt) or die(mysqli_error($check_wpt));

                                                        if (mysqli_num_rows($result_wpt)) {
                                                            // echo '1 rows';
                                                            echo '<a href="' . BASE_URL . '/project/write_project" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์เขียนโครงการ">
                                                                <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                        </a>';
                                                        } else {
                                                            // echo '0 rows';
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }
                                                        ?>

                                                    </li>
                                                    <!--  Tag ปิด เอกสารเขียนโครงการ -->

                                                    <!-- หนังสือขออนุมัติโครงการ -->
                                                    <li>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                            <a href="<?php echo BASE_URL ?>/backend/project/approve_pro/frm_alt.php" class="file_link">หนังสือขออนุมัติโครงการ</a>
                                                        <?php } else { ?>
                                                            <a class="file_link">หนังสือขออนุมัติโครงการ</a>
                                                        <?php

                                                        }
                                                        $check_alt = "SELECT p.alt_id,a.alt_filename FROM project_details as p
                                    JOIN approval_letter as a ON a.alt_id = p.alt_id
                                    WHERE p.pro_id = '" . $_SESSION['pro_id'] . "'
                                    ORDER BY p.pdt_id asc";

                                                        $result_alt = mysqli_query($con, $check_alt) or die(mysqli_error($check_alt));

                                                        if (mysqli_num_rows($result_alt)) {
                                                            //    ถ้ามีไฟล์เอกสาร
                                                            echo '<a href="' . BASE_URL . '/project/approve_project" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์หนังสือขออนุมัติโครงการ">
                                                            <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                        </a>';
                                                        } else {
                                                            //    ถ้าไม่มีไฟล์เอกสาร
                                                            echo ' <i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }
                                                        ?>
                                                    </li>
                                                    <!--Tag ปิด  หนังสือขออนุมัติโครงการ -->

                                                    <!-- หนังสือแต่งตั้งคณะกรรมการ  -->
                                                    <li>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>

                                                            <a href="<?php echo BASE_URL ?>/backend/project/appoint_pro/frm_apt.php" class="file_link">หนังสือแต่งตั้งคณะกรรมการ</a>
                                                        <?php } else { ?>
                                                            <a class="file_link">หนังสือแต่งตั้งคณะกรรมการ</a>
                                                        <?php
                                                        }
                                                        $check_apt = "SELECT p.apt_id,apt.apt_filename FROM project_details as p
                                                            JOIN appoint_letter as apt ON apt.apt_id = p.apt_id
                                                            WHERE p.pro_id ='" . $_SESSION['pro_id'] . "'
                                                            ORDER BY p.pdt_id asc";

                                                        $result_apt = mysqli_query($con, $check_apt) or die(mysqli_error($check_apt));

                                                        if (mysqli_num_rows($result_apt)) {
                                                            echo '<a href="' . BASE_URL . '/project/appoint_project" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์หนังสือแต่งตั้งคณะกรรมการ">
                                                            <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                        </a>';
                                                        } else {
                                                            echo ' <i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }

                                                        ?>
                                                    </li>
                                                    <!-- Tag ปิด หนังสือแต่งตั้งคณะกรรมการ  -->
                                                </ol>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr class="ruler_hr">
                                        </div>

                                    </div>
                                    <!-- tag ปิดข้อมูลโครงการ -->
                                    <?php include('modal_data_project,.php'); ?>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <!--  ########################################################## ดำเนินการโครงการ   ##########################################################-->


                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">

                                            <h2 style="font-size: 25px;">
                                                2. ดำเนินโครงการ <a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลรูปภาพและใบลงทะเบียนผู้เข้าร่วมโครงการ">*</a>
                                            </h2>
                                            <div>
                                                <ol>
                                                    <!-- รูปภาพ -->
                                                    <li>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                        ?>
                                                            <a href="<?php echo BASE_URL ?>/backend/project/image/frm_image.php" class="file_link">รูปภาพ</a>
                                                        <?php  } else {
                                                        ?>
                                                            <a class="file_link">รูปภาพ</a>
                                                        <?php
                                                        }
                                                        $chk_image = "SELECT p.img_id FROM project_details as p
                                                    JOIN image as i ON i.img_id = p.img_id
                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                    ORDER BY p.pdt_id asc";

                                                        $result_image = mysqli_query($con, $chk_image) or die(mysqli_error($chk_image));

                                                        if (mysqli_num_rows($result_image) > 0) {
                                                            echo '<a href="' . BASE_URL . '/backend/project/image/show_image.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์รูปภาพ"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                                        } else {
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }

                                                        ?>

                                                    </li>
                                                    <!--tag ปิด รูปภาพ -->

                                                    <!-- ใบเซ็นชื่อผู้เข้าร่วมโครงการ -->
                                                    <li>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                        ?>
                                                            <a href="<?php echo BASE_URL ?>/backend/project/attendees/frm_lat.php" class="file_link">ใบลงทะเบียนผู้เข้าร่วมโครงการ</a>
                                                        <?php } else {
                                                        ?>
                                                            <a class="file_link">ใบเซ็นชื่อผู้ร่วมโครงการ</a>
                                                        <?php }
                                                        $chk_lat = "SELECT p.alt_id,l.lat_filename FROM project_details as p
                                                    JOIN list_attend as l ON l.lat_id = p.lat_id 
                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                    ORDER by p.pdt_id asc";

                                                        $result_lat = mysqli_query($con, $chk_lat) or die(mysqli_error($chk_lat));

                                                        if (mysqli_num_rows($result_lat) > 0) {
                                                            echo '<a href="' . BASE_URL . '/project/attendees" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์ใบเซ็นชื่อผู้ร่วมโครงการ"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                                        } else {
                                                            echo '  <i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }
                                                        ?>

                                                    </li>
                                                    <!-- tag ปิด ใบเซ็นชื่อผู้เข้าร่วมโครงการ -->

                                                    <!-- อื่นๆ -->
                                                    <li>
                                                        <?php if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                        ?>
                                                            <a href="<?php echo BASE_URL ?>/backend/project/other/frm_oth.php" class="file_link">อื่นๆ</a>
                                                        <?php } else {
                                                        ?>
                                                            <a class="file_link">อื่นๆ</a>
                                                        <?php
                                                        }

                                                        $chk_oth = "SELECT p.oth_id,o.oth_filename FROM project_details as p
                                                                    JOIN other as o ON o.oth_id = p.oth_id
                                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                                    ORDER by p.pdt_id asc";

                                                        // echo $chk_oth;
                                                        $result_oth = mysqli_query($con, $chk_oth) or die(mysqli_error($chk_oth));

                                                        if (mysqli_num_rows($result_oth) > 0) {
                                                            echo '<a href="' . BASE_URL . '/project/other" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์อื่นๆ"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                                        } else {
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }
                                                        ?>

                                                    </li>
                                                    <!--tag ปิด อื่นๆ -->
                                                </ol>

                                            </div>

                                        </div>
                                    </div>
                                    <!--  ########################################################## /. ดำเนินการโครงการ   ##########################################################-->
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                    <!--  ########################################################## สรุปโครงการ   ##########################################################-->

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <?php
                                            // $chk2 = "SELECT img_id,lat_id,oth_id FROM project_details WHERE pro_id='" . $_SESSION['pro_id'] . "'";
                                            // $result_chk2 = mysqli_query($con, $chk2) or die(mysqli_error($chk2));
                                            // $fetch_chk2 = mysqli_fetch_assoc($result_chk2);

                                            // if ($fetch_chk2['img_id'] > 0 && $fetch_chk2['lat_id'] > 0) { 
                                            ?>

                                            <h2 class="subheading">
                                                3. สรุปโครงการ<a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลเล่มโครงการและเอกสารเคลียร์โครงการ">*</a>
                                            </h2>

                                            <!-- <hr class="line ruler_hr"> -->

                                            <ol>
                                                <li>
                                                    <?php

                                                    if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {

                                                    ?>
                                                        <a href="<?php echo BASE_URL ?>/backend/project/project_book/frm_pbk.php" class="file_link">เล่มโครงการ</a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a class="file_link">เล่มโครงการ</a>
                                                    <?php
                                                    }
                                                    $chk_pbk = "SELECT p.pbk_id FROM  project_details as p
                                                    JOIN project_book as pbk ON pbk.pbk_id = p.pbk_id
                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                    ORDER BY p.pdt_id asc";

                                                    $result_pbk = mysqli_query($con, $chk_pbk) or die(mysqli_error($chk_pbk));

                                                    if (mysqli_num_rows($result_pbk) > 0) {
                                                        echo '<a href="' . BASE_URL . '/project/project_book" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์เล่มโครงการ">
                                                            <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                        </a>';
                                                    } else {
                                                        echo ' <i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                    }
                                                    ?>
                                                </li>
                                                <li>
                                                    <?php
                                                    if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) {
                                                    ?>
                                                        <a href="<?php echo BASE_URL ?>/backend/project/complete_letter/frm_clt.php" class="file_link">เอกสารเคลียร์โครงการ</a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a class="file_link">เอกสารเคลียร์โครงการ</a>
                                                    <?php
                                                    }
                                                    $chk_cpt = "SELECT p.clt_id FROM project_details as p
                                                    JOIN complete_letter as c ON c.clt_id = p.clt_id
                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                    ORDER BY p.pdt_id asc";

                                                    $resutl_cpt = mysqli_query($con, $chk_cpt) or die(mysqli_error($chk_cpt));

                                                    if (mysqli_num_rows($resutl_cpt) > 0) {
                                                        echo '<a href="' . BASE_URL . '/project/complete_letter" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์เอกสารเคลียร์โครงการ">
                                                            <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                        </a>';
                                                    } else {
                                                        echo ' <i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                    }

                                                    ?>
                                                </li>

                                            </ol>


                                            <?php
                                            //  } else {
                                            ?>
                                            <!-- <h2>
                                                    <a class="subheading text-gray"> 3. สรุปโครงการ<a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลเล่มโครงการและเอกสารเคลียร์โครงการ">*</a>
                                                </h2> -->
                                            <!-- <hr class="line ruler_hr"> -->

                                            <?php
                                            // }
                                            ?>

                                        </div>
                                    </div>

                                    <!--  ########################################################## /. สรุปโครงการ   ##########################################################-->
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                    <!--  ##########################################################  เอกสารอื่นๆ  ##########################################################-->
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 ">
                                            <h2 class="subheading">
                                                <?php

                                                // เช็คสถานะการอัพโหลดข้อมูลโครงการ
                                                if (isset($_SESSION['staff']) || isset($_SESSION['secretary'])) { ?>
                                                    <a href="<?php echo BASE_URL ?>/backend/project/document_other/frm_don.php" style="font-size: 25px;" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลเอกสารอื่นๆ ">
                                                        4. เอกสารอื่นๆ
                                                    </a>
                                                <?php } else { ?>

                                                    4. เอกสารอื่นๆ

                                                <?php }

                                                $query_don = "SELECT d.*,u.usr_prefix,u.usr_firstname,u.usr_lastname FROM document_other as d 
                                                    JOIN user as u ON u.usr_id = d.usr_id
                                                    WHERE d.pro_id ='" . $_SESSION['pro_id'] . "'
                                                    ORDER BY d.don_id asc";

                                                $result_don = mysqli_query($con, $query_don) or die(mysqli_error($query_don));
                                                $num_rows_don = mysqli_num_rows($result_don);

                                                if (mysqli_num_rows($result_don) == 0) {
                                                    echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i> ';
                                                } else {
                                                    echo '<i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>';
                                                }

                                                ?>
                                            </h2>

                                            <div class="col-8">
                                                <hr class="line ruler_hr">
                                            </div>

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
                                                    <?php if ($num_rows_don > 0) {

                                                        while ($rows_don = mysqli_fetch_array($result_don)) {
                                                    ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $rows_don['don_filename']; ?></th>
                                                                <td><?php echo DateThai($rows_don['don_date']); ?></td>
                                                                <td><?php echo $rows_don['usr_prefix'] .$rows_don['usr_firstname'] . ' ' . $rows_don['usr_lastname']; ?></td>
                                                                <td>
                                                                    <a type="button" class="btn btn-info" href="<?php echo  BASE_URL ?>/backend/project/document_other/don_file.php?don_id=<?= $rows_don['don_id'] ?>">ดาวน์โหลด
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else { ?>
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
                                    <!--  ########################################################## /. เอกสารอื่นๆ  ##########################################################-->

                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12" style="text-align: center;">

                                    <?php
                                    if (isset($_SESSION['summary'])) {
                                    ?>
                                        <a href="<?php echo BASE_URL ?>/<?= $_SESSION['y_id']; ?>/summary" class="btn btn-danger">
                                            <i class="fa fa-fw  fa-reply"></i> ย้อนกลับหน้าสรุปผล
                                        </a>
                                        <?php
                                    } else {
                                        if (isset($_SESSION['endorser'])) {

                                            $hash_1 =  password_hash(1, PASSWORD_DEFAULT);
                                            // echo $hash_1;


                                            $hash_2 =  password_hash(2, PASSWORD_DEFAULT);
                                            // echo $hash_2;

                                        ?>
                                            <a href="<?php echo BASE_URL ?>/backend/project/check_project/chk_password.php?chk=<?= $hash_1 ?>" 
                                                id="chk_project_successfully" class="btn btn-success" data-toggle="popover" data-placement="top" 
                                                data-trigger="hover" data-content="ปิดโครงการ">
                                                   ดำเนินการเสร็จสิ้น
                                            </a>
                                            <a href="<?php echo BASE_URL ?>/backend/project/check_project/chk_password.php?chk=<?= $hash_2 ?>" id="chk_project_cancel" class="btn btn-danger" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="ยกเลิกโครงการ">
                                                ยกเลิกโครงการ
                                            </a>
                                        <?php } ?>
                                        <a href="<?php echo BASE_URL ?>/<?= $_SESSION['y_id']; ?>/project" class="btn btn-danger">
                                            <i class="fa fa-fw  fa-reply"></i> ย้อนกลับก่อนหน้า
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>

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
    <script src="./../backend/project/info/object.js"></script>
    <script src="./../backend/project/info/projecttpye.js"></script>
    <script src="./../backend/project/info/schedul.js"></script>
    <script src="./../backend/project/info/place.js"></script>
    <script src="./../backend/project/info/repon.js"></script>

</body>

</html>