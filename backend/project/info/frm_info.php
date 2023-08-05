<?php

require_once('../../../secure/connect.php');
include('../../include/auth.php');
chk_management();
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

$selcet_pty = "SELECT * FROM project_type";
$result = mysqli_query($con, $selcet_pty) or die(mysqli_error($selcet_pty));
$num_rows_pty = mysqli_num_rows($result);
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
                            <h3>ดำเนินการ</h3>
                           
                        </div>

                        <form method="POST" name="frm_add_details" class="form-horizontal" id="frm_add_details">
                            <div class="card-body">
                                <?php

                                // echo '<pre>';
                                // print_r($_SESSION);
                                // echo '</pre>';

                                ?>
                               <h5 ><i class="fas fa-cog"></i> ข้อมูลโครงการ</h5>
                              
                                <div class="row" id="frm_info">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-10">


                                        <div class="form-group">
                                            <label for="inf_objective">วัตถุประสงค์</label>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <textarea name="iof_object" class="form-control" id="iof_object" cols="30" rows="5"></textarea>
                                                </div>
                                                <div class="col-md-1">
                                                    <h3>
                                                        <a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="กรอกวัตถุประสงค์">*</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group has-success">

                                            <label>ประเภทโครงการ </label>

                                            <div id="list_pty">
                                                <div class="col-md-7">
                                                    <!-- checkbox -->
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
                                            </div>




                                        </div>
                                        <div class="form-group">
                                            <label for="inf_schedule"> กำหนดการ </label>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" name="ise_schedule" id="ise_schedule" class="form-control" data-inputmask-alias="datetime" data-mask im-insert="false">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <h3>
                                                        <a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="กรอกกำหนดการ">*</a>
                                                    </h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="inf_place">สถานที่</label>
                                            <?php if (isset($_SESSION['staff'])) { ?>
                                                <i class="fas fa-cog text-dark" title="เพิ่มผู้รับผิดชอบ" data-toggle="modal" data-target="#modal-pla"></i>
                                            <?php } ?>
                                            <div id="selecet_place">
                                                <div class="row">
                                                    <?php
                                                    $query_pla = "SELECT * FROM place WHERE fct_id='" . $_SESSION['fct_id'] . "' && pla_show='1'";
                                                    $result_pla = mysqli_query($con, $query_pla) or die(mysqli_error($query_pla));
                                                    $num_rows_pla = mysqli_num_rows($result_pla);
                                                    ?>
                                                    <div class="input-group col-md-7">
                                                        <!-- <textarea name="inf_place" class="form-control" id="inf_place" cols="30" rows="3"></textarea> -->
                                                        <select class="custom-select" id="ipe_place" name="ipe_place">
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
                                                    <div class="col-md-1">
                                                        <h3>
                                                            <a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="กรอกสถานที่">*</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group has-success">
                                            <label>ผู้รับผิดชอบ</label>
                                            <div id="select_person">
                                                <div class="row">
                                                    <?php
                                                    $query_rpt = "SELECT * FROM responsible_project WHERE fct_id='" . $_SESSION['fct_id'] . "' && rpt_show='1'";
                                                    $result_rpt = mysqli_query($con, $query_rpt);
                                                    $num_rows_rpt = mysqli_num_rows($result_rpt);

                                                    ?>
                                                    <div class="input-group col-md-7">
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
                                                    <div class="col-sm-1">
                                                        <h3>
                                                            <a href="#" class="text-red" data-toggle="popover" data-trigger="hover" data-content="กรอกผู้รับผิดชอบ">*</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="info"></div>


                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-xl-2"></div>
                                    <div class="col-xl-10">
                                        <div class="form-group">
                                            <div class="col-sm-5">
                                                <button type="submit" name="submit" class="btn btn-primary" id="btn"> บันทึก
                                                </button>
                                                <a href="<?php echo BASE_URL ?>/project/<?= $_SESSION['pro_id'] ?>" class="btn btn-danger">ย้อนกลับ</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Modal pla -->
                    <div class="modal fade" id="modal-pla">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="card-title">การตั้งค่า</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" id="modal_insert_pla">
                                        <div class="form-group">
                                            <div class="input-group sm-3">
                                                <input type="text" class="form-control" name="pla_name" id="pla_name1">
                                                <!-- <input type="submit" name="add" id="add" value="เพิ่มข้อมูล" class="btn btn-primary float-right"> -->
                                                <div class="input-group-append">
                                                    <input type="submit" class="btn btn-primary" value="เพิ่มประเภท">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="table_pla">
                                        <table class="table table-bordered dataTable" role="grid" aria-describedby="example1_info">
                                            <thead class="table thead-light" style="font-family: 'Bai Jamjuree', sans-serif;">
                                                <tr>
                                                    <th>รายการสถานที่</th>
                                                    <th>สถานะ</th>
                                                    <!-- <th></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query_pla1 = "SELECT * FROM place WHERE fct_id='" . $_SESSION['fct_id'] . "'";
                                                $result_pla1 = mysqli_query($con, $query_pla1) or die(mysqli_error($query_pla1));
                                                $num_rows_pla1 = mysqli_num_rows($result_pla1);


                                                if ($num_rows_pla1 > 0) {
                                                    while ($rows_pla1 = mysqli_fetch_array($result_pla1)) { ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $rows_pla1['pla_name'] ?>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php if ($rows_pla1['pla_show'] == '1') { ?>
                                                                        <center>
                                                                            <span class="badge bg-success">เปิดใช้งาน</span>
                                                                        </center>
                                                                    <?php } else { ?>
                                                                        <center>
                                                                            <span class="badge bg-danger">ปิดใช้งาน</span>
                                                                        </center>
                                                                    <?php } ?>
                                                                </center>
                                                            </td>
                                                            <!-- <td>
                                                                <select onchange="modal_change_pla(this.value,<?php echo $rows_pla1['pla_id'] ?>)">
                                                                    <option value="">Select</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </td> -->
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr class="blank_row">
                                                        <td colspan="3">
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
    <?php include('../../include/script_js.php'); ?>

</body>

</html>