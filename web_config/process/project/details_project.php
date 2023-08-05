<?php
require_once('../../connect.php');
include('../../include/auth.php');
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

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
        header("location:javascript://history.go(-1)");
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
    <?php include('../../include/script_css.php'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <?php include('../../include/navbar.php'); ?>
            </div>
            <br>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <!-- heading -->
                            <h3>ดำเนินการ : โครงการ <?php echo $rows_pro['pro_name']; ?></h3>

                        </div>

                        <div class="card-body">

                            <div class="row">
                                <!-- ข้อมูลโครงการ -->
                                <div class="col-md-12">
                                    <h2>
                                        <!-- // เช็คสถานะการอัพโหลดข้อมูลโครงการ -->
                                        <a class="subheading">1. ข้อมูลโครงการ</a>
                                        <i class="fa fa-fw  fa-folder"></i><a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลโครงการให้ครบ">*</a>
                                    </h2>
                                    <div class="col-7">
                                        <hr class="line">
                                    </div>
                                    <!-- ##################################################### วัตถุประสงค์ ##################################################### -->
                                    <div class="row">
                                        <div class="col-8 ml-5">
                                            <h5>
                                                <a>วัตถุประสงค์</a>
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
                                                <a>ลักษณะโครงการ</a>
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
                                                <a>กำหนดการ</a>
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
                                                <a>สถานที่</a>
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
                                                <a>ผู้รับผิดชอบ</a>
                                            </h5>
                                            <div id="message_repon"></div>
                                            <div id="data_repon"></div>
                                        </div>
                                        <!-- ##################################################### ./ ผู้รับผิดชอบ ##################################################### -->

                                    </div>
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

                                                <a class="file_link">เขียนโครงการ</a>
                                                <?php


                                                $check_wpt = "SELECT p.wpt_id,w.wpt_filename FROM project_details as p
                                                    JOIN write_project as w ON w.wpt_id = p.wpt_id
                                                    WHERE p.pro_id = '" . $_SESSION['pro_id'] . "'
                                                    ORDER BY p.pdt_id asc";

                                                $result_wpt = mysqli_query($con, $check_wpt) or die(mysqli_error($check_wpt));

                                                if (mysqli_num_rows($result_wpt)) {
                                                    // echo '1 rows';
                                                    echo '<a href="write_pro/show_file_wpt.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์เขียนโครงการ">
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

                                                <a class="file_link">หนังสือขออนุมัติโครงการ</a>
                                                <?php


                                                $check_alt = "SELECT p.alt_id,a.alt_filename FROM project_details as p
                                                JOIN approval_letter as a ON a.alt_id = p.alt_id
                                                WHERE p.pro_id = '" . $_SESSION['pro_id'] . "'
                                                ORDER BY p.pdt_id asc";

                                                $result_alt = mysqli_query($con, $check_alt) or die(mysqli_error($check_alt));

                                                if (mysqli_num_rows($result_alt)) {
                                                    //    ถ้ามีไฟล์เอกสาร
                                                    echo '<a href="approve_pro/show_file_alt.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์หนังสือขออนุมัติโครงการ">
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

                                                <a class="file_link">หนังสือแต่งตั้งคณะกรรมการ</a>
                                                <?php

                                                $check_apt = "SELECT p.apt_id,apt.apt_filename FROM project_details as p
                                                            JOIN appoint_letter as apt ON apt.apt_id = p.apt_id
                                                            WHERE p.pro_id ='" . $_SESSION['pro_id'] . "'
                                                            ORDER BY p.pdt_id asc";

                                                $result_apt = mysqli_query($con, $check_apt) or die(mysqli_error($check_apt));

                                                if (mysqli_num_rows($result_apt)) {
                                                    echo '<a href="appoint_pro/show_file_apt.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์หนังสือแต่งตั้งคณะกรรมการ">
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

                            <!-- ########################################################## Modal Details data project ##########################################################-->
                            <!-- MOdal Oject -->
                            <div class="modal fade" id="modal-newobject">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">วัตถุประสงค์</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- action="./../project/info/insert_oject.php" -->
                                        <form id="frm_new_object">
                                            <div class="modal-body">

                                                <label for="iof_object_new">กรอกข้อมูลวัตถุประสงค์:</label>
                                                <div class="form-group">
                                                    <textarea name="new_object" class="form-control" id="new_object" cols="30" rows="5"></textarea>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" name="insert" value="บันทึกข้อมูล">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <div class="modal fade" id="list_iof">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ย้อนหลังวัตถุประสงค์</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body" id="oject-reloaded">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Close MOdal Oject -->


                            <!-- Modal Projecttype -->
                            <div class="modal fade" id="modal-newipt">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ลักษณะโครงการ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="frm_new_ipt">
                                            <div class="modal-body">
                                                <div class="form-group clearfix">
                                                    <?php
                                                    $query_pty = "SELECT * FROM project_type WHERE fct_id='" . $_SESSION['fct_id'] . "' && pty_show='1'";
                                                    $result_pty = mysqli_query($con, $query_pty) or die(mysqli_error($query_pty));
                                                    $num_rows1 = mysqli_num_rows($result_pty);

                                                    if ($num_rows1 > 0) {
                                                        while ($rows_pty = mysqli_fetch_assoc($result_pty)) { ?>

                                                            <div class="icheck-primary">
                                                                <label>
                                                                    <input type="checkbox" name="ipt_pty[]" class="get_value" value="<?php echo $rows_pty['pty_type'] ?>">
                                                                    <label><?php echo $rows_pty['pty_type'] ?></label>
                                                                    <br>
                                                                </label>
                                                            </div>

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" name="insert" value="บันทึกข้อมูล">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <div class="modal fade" id="list_ipt">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ย้อนหลังลักษณะโครงการ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="projecttype-reloaded"></div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Close Modal Projecttype -->



                            <!-- Modal schedule -->
                            <div class="modal fade" id="modal-newise">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">กำหนดการ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="frm_new_schedule">
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <input type="date" name="ise_schedule" id="ise_schedule" class="form-control" data-inputmask-alias="datetime" data-mask im-insert="false">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" name="insert" value="บันทึกข้อมูล">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <div class="modal fade" id="list_ise">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ย้อนหลังกำหนดเวลา</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="schedul-reloaded">

                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Close Modal schedule -->

                            <!-- Modal Place-->
                            <div class="modal fade" id="modal-newipe">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">สถานที่</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="frm_new_place">
                                            <div class="modal-body">
                                                <?php
                                                $query_pla = "SELECT * FROM place WHERE fct_id='" . $_SESSION['fct_id'] . "' && pla_show='1'";
                                                $result_pla = mysqli_query($con, $query_pla) or die(mysqli_error($query_pla));
                                                $num_rows_pla = mysqli_num_rows($result_pla);
                                                ?>
                                                <div class="form-group">
                                                    <select class="custom-select" id="select_ipe_place" name="ipe_place">
                                                        <option value="">...กรุณาเลือก...</option>
                                                        <?php
                                                        if ($num_rows_pla > 0) {
                                                            while ($rows_pla = mysqli_fetch_array($result_pla)) {
                                                        ?>
                                                                <option value="<?php echo $rows_pla['pla_name'] ?>"><?php echo $rows_pla['pla_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" name="insert" value="บันทึกข้อมูล">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <div class="modal fade" id="list_ipe">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ย้อนหลังสถานที่</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="place-reloaded">

                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Close Modal Place-->

                            <!-- Modal Repon -->
                            <div class="modal fade" id="modal-newirn">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ผู้รับผิดชอบ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="frm_new_repon">
                                            <div class="modal-body">


                                                <?php
                                                $query_rpt = "SELECT * FROM responsible_project WHERE fct_id='" . $_SESSION['fct_id'] . "' && rpt_show='1'";
                                                $result_rpt = mysqli_query($con, $query_rpt);
                                                $num_rows_rpt = mysqli_num_rows($result_rpt);

                                                ?>
                                                <div class="form-group">
                                                    <select class="custom-select" id="irn_repon" name="irn_repon">
                                                        <option value="">...กรุณาเลือก...</option>
                                                        <?php
                                                        if ($num_rows_rpt > 0) {
                                                            while ($rows_rpt = mysqli_fetch_array($result_rpt)) {
                                                        ?>
                                                                <option value="<?php echo  $rows_rpt['rpt_person']; ?>"><?php echo $rows_rpt['rpt_person']; ?></option>
                                                        <?php }
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" name="insert" value="บันทึกข้อมูล">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


                            <div class="modal fade" id="list_irn">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ย้อนหลังผู้รับผิดชอบ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="repon-reloaded">

                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- Close Modal Repon -->

                            <!-- ########################################################## /. Modal Details data project ##########################################################-->


                            <!--  ########################################################## ดำเนินการโครงการ   ##########################################################-->


                            <div class="row">
                                <div class="col-sm-12 col-md-12">

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
                                            <h2 style="font-size: 25px;">
                                                2. ดำเนินโครงการ <a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลรูปภาพและใบเซ็นชื่อ">*</a>
                                            </h2>
                                            <div>
                                                <ol>
                                                    <!-- รูปภาพ -->
                                                    <li>

                                                        <a class="file_link">รูปภาพ</a>
                                                        <?php

                                                        $chk_image = "SELECT p.img_id FROM project_details as p
                                                    JOIN image as i ON i.img_id = p.img_id
                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                    ORDER BY p.pdt_id asc";

                                                        $result_image = mysqli_query($con, $chk_image) or die(mysqli_error($chk_image));

                                                        if (mysqli_num_rows($result_image) > 0) {
                                                            echo '<a href="image/show_image.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์รูปภาพ"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                                        } else {
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }

                                                        ?>

                                                    </li>
                                                    <!--tag ปิด รูปภาพ -->

                                                    <!-- ใบเซ็นชื่อผู้เข้าร่วมโครงการ -->
                                                    <li>

                                                        <a class="file_link">ใบเซ็นชื่อผู้ร่วมโครงการ</a>
                                                        <?php
                                                        $chk_lat = "SELECT p.alt_id,l.lat_filename FROM project_details as p
                                                    JOIN list_attend as l ON l.lat_id = p.lat_id 
                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                    ORDER by p.pdt_id asc";

                                                        $result_lat = mysqli_query($con, $chk_lat) or die(mysqli_error($chk_lat));

                                                        if (mysqli_num_rows($result_lat) > 0) {
                                                            echo '<a href="attendees/show_file_lat.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์ใบเซ็นชื่อผู้ร่วมโครงการ"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                                        } else {
                                                            echo '  <i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }
                                                        ?>

                                                    </li>
                                                    <!-- tag ปิด ใบเซ็นชื่อผู้เข้าร่วมโครงการ -->

                                                    <!-- อื่นๆ -->
                                                    <li>
                                                        <a class="file_link">อื่นๆ</a>
                                                        <?php
                                                        $chk_oth = "SELECT p.oth_id,o.oth_filename FROM project_details as p
                                                                    JOIN other as o ON o.oth_id = p.oth_id
                                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                                    ORDER by p.pdt_id asc";

                                                        // echo $chk_oth;
                                                        $result_oth = mysqli_query($con, $chk_oth) or die(mysqli_error($chk_oth));

                                                        if (mysqli_num_rows($result_oth) > 0) {
                                                            echo '<a href="other/show_file_oth.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์อื่นๆ"><i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i></a>';
                                                        } else {
                                                            echo '<i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                        }
                                                        ?>

                                                    </li>
                                                    <!--tag ปิด อื่นๆ -->
                                                </ol>

                                            </div>
                                        <?php
                                        } else { ?>

                                            <h2 class="subheading text-gray">
                                                2. ดำเนินโครงการ<a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลรูปภาพและใบเซ็นชื่อ">*</a>
                                            </h2>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <!--  ########################################################## /. ดำเนินการโครงการ   ##########################################################-->

                            <!--  ########################################################## สุปโครงการ   ##########################################################-->

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <?php
                                    $chk2 = "SELECT img_id,lat_id,oth_id FROM project_details WHERE pro_id='" . $_SESSION['pro_id'] . "'";
                                    $result_chk2 = mysqli_query($con, $chk2) or die(mysqli_error($chk2));
                                    $fetch_chk2 = mysqli_fetch_assoc($result_chk2);

                                    if ($fetch_chk2['img_id'] > 0 && $fetch_chk2['lat_id'] > 0) { ?>

                                        <h2 style="font-size: 25px;">
                                            3. สุปโครงการ<a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลเล่มโครงการและเอกสารเคลียร์โครงการ">*</a>
                                        </h2>

                                        <!-- <hr class="line ruler_hr"> -->

                                        <ol>
                                            <li>

                                                <a class="file_link">เล่มโครงการ</a>
                                                <?php

                                                $chk_pbk = "SELECT p.pbk_id FROM  project_details as p
                                                    JOIN project_book as pbk ON pbk.pbk_id = p.pbk_id
                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                    ORDER BY p.pdt_id asc";

                                                $result_pbk = mysqli_query($con, $chk_pbk) or die(mysqli_error($chk_pbk));

                                                if (mysqli_num_rows($result_pbk) > 0) {
                                                    echo '<a href="project_book/show_file_pbk.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์เล่มโครงการ">
                                                            <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                        </a>';
                                                } else {
                                                    echo ' <i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                }
                                                ?>
                                            </li>

                                            <li>

                                                <a class="file_link">เอกสารเคลียร์โครงการ</a>
                                                <?php

                                                $chk_cpt = "SELECT p.clt_id FROM project_details as p
                                                    JOIN complete_letter as c ON c.clt_id = p.clt_id
                                                    WHERE p.pro_id='" . $_SESSION['pro_id'] . "'
                                                    ORDER BY p.pdt_id asc";

                                                $resutl_cpt = mysqli_query($con, $chk_cpt) or die(mysqli_error($chk_cpt));

                                                if (mysqli_num_rows($resutl_cpt) > 0) {
                                                    echo '<a href="complete_letter/show_file_clt.php" data-toggle="popover" data-trigger="hover" data-content="ลิ้งไฟล์เอกสารเคลียร์โครงการ">
                                                            <i class="fas fa-paperclip" style="font-size: 21px; color:#5BDF1D;"></i>
                                                        </a>';
                                                } else {
                                                    echo ' <i class="fas fa-paperclip" style="font-size: 21px; color:gray;"></i>';
                                                }

                                                ?>
                                            </li>

                                        </ol>


                                    <?php  } else {
                                    ?>
                                        <h2 style="font-size: 25px;">
                                            <a class="subheading text-gray"> 3. สุปโครงการ<a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="อัพโหลดข้อมูลเล่มโครงการและเอกสารเคลียร์โครงการ">*</a>
                                        </h2>
                                        <!-- <hr class="line ruler_hr"> -->

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>

                            <!--  ########################################################## /. สุปโครงการ   ##########################################################-->

                            <!--  ##########################################################  เอกสารอื่นๆ  ##########################################################-->
                            <div class="row">
                                <div class="col-sm-12 col-md-12 ">
                                    <h2 class="subheading">

                                        <!-- // เช็คสถานะการอัพโหลดข้อมูลโครงการ -->


                                        <a> 4. เอกสารอื่นๆ</a>


                                        <?php

                                        $query_don = "SELECT d.*,u.usr_firstname,u.usr_lastname FROM document_other as d 
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
                                                        <td><?php echo $rows_don['usr_firstname'] . ' ' . $rows_don['usr_lastname']; ?></td>
                                                        <td>
                                                            <a type="button" class="btn btn-info" href="document_other/don_file.php?don_id=<?= $rows_don['don_id'] ?>">ดาวน์โหลด
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

                            <div class="row">
                                <div class="col-sm-12" style="text-align: center;">


                                    <a href="../procedure.php?y_id=<?= $_SESSION['y_id']; ?>" class="btn btn-danger">
                                        <i class="fa fa-fw  fa-reply"></i> ย้อนกลับก่อนหน้า
                                    </a>

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
    <?php include('../../include/script_js.php'); ?>
    <script src="info/object.js"></script>
    <script src="info/projecttpye.js"></script>
    <script src="info/schedul.js"></script>
    <script src="info/place.js"></script>
    <script src="info/repon.js"></script>

</body>

</html>