<?php
include('../../secure/connect.php');
include('../include/auth.php');

chk_admin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['wcf_name']; ?></title>
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
            <div class="content-header"> </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">สมัครสมาชิก</h1>
                        </div>
                        <form method="POST" id="frm_registered">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- action="insert_user.php" -->

                                                <div class="form-row">

                                                    <div class="form-group col-sm-12">
                                                        <label for="usr_username">ชื่อผู้ใช้งาน : <b class="form-text text-danger" style="display:inline;">*</b></label>
                                                        <input type="text" class="form-control" name="usr_username" id="usr_username">
                                                        <b class="form-text text-danger" id="usernameError"></b>
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <label for="usr_password">รหัสผ่าน : <b class="form-text text-danger" style="display:inline;">*</b></label>
                                                        <input type="password" class="form-control" name="usr_password" id="usr_password">
                                                        <b class="form-text text-danger" id="passError"></b>
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <label for="cpassword">ยืนยันรหัสผ่าน :</label>
                                                        <input type="password" class="form-control" name="cpassword" id="cpassword">
                                                        <b class="form-text text-danger" id="cpassError"></b>
                                                    </div>
                                                    <!-- <div class="col-sm-6"></div> -->
                                                    <div class="form-group col-sm-5">
                                                        <label>คำนำชื่อ : <b class="form-text text-danger" style="display:inline;">*</b></label>
                                                        <select class="form-control" name="tpf_prefix" id="tpf_prefix">
                                                            <option value="">กรุณาเลือก...</option>
                                                            <?php

                                                            $query_tpf = "SELECT * FROM title_prefix";
                                                            $result_tpf = mysqli_query($con, $query_tpf);

                                                            if (mysqli_num_rows($result_tpf) > 0) {

                                                                while ($rows = mysqli_fetch_array($result_tpf)) {

                                                            ?>
                                                                    <option value="<?php echo $rows['tpf_prefix']; ?>"><?php echo $rows['tpf_prefix'];  ?></option>
                                                            <?php
                                                                }
                                                            }

                                                            ?>

                                                        </select>
                                                        <b class="form-text text-danger" id="prefixError"></b>
                                                    </div>
                                                   

                                                    <div class="form-group col-sm-12">
                                                        <label for="usr_firstname">ชื่อ : <b class="form-text text-danger" style="display:inline;">*</b></label>
                                                        <input type="text" class="form-control" name="usr_firstname" id="usr_firstname">
                                                        <b class="form-text text-danger" id="firstnameError"></b>
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <label for="usr_lastname">นามสกุล : <b class="form-text text-danger" style="display:inline;">*</b></label>
                                                        <input type="text" class="form-control" name="usr_lastname" id="usr_lastname">
                                                        <b class="form-text text-danger" id="lastnameError"></b>
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <label for="usr_tel">เบอร์โทรศัพท์ : <b class="form-text text-danger" style="display:inline;">*</b></label>
                                                        <input type="tel" class="form-control" name="usr_tel" id="usr_tel">
                                                        <b class="form-text text-danger" id="telError"></b>
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <label for="usr_email">อีเมล : <b class="form-text text-danger" style="display:inline;">*</b></label>
                                                        <input type="text" class="form-control" name="usr_email" id="usr_email">
                                                        <b class="form-text text-danger" id="emailError"></b>
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <label for="usr_permit">สิทธิ์การใช้งาน : <b class="form-text text-danger" style="display:inline;">*</b></label>
                                                        <select class="form-control" name="usr_permit" id="usr_permit">
                                                            <option value="">กรุณาเลือก...</option>
                                                            <?php
                                                            $query_pmu = "SELECT * FROM permit_user";
                                                            $result_pmu = mysqli_query($con, $query_pmu);

                                                            if (mysqli_num_rows($result_pmu) > 0) {
                                                                while ($rows = mysqli_fetch_array($result_pmu)) {

                                                            ?>
                                                                    <option value="<?php echo  $rows['pmu_id'] ?>"><?php echo  $rows['pmu_permit'] ?></option>

                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <b class="form-text text-danger" id="permitError"></b>
                                                    </div>
                                                </div>
                                                <div id="error_user"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-7">

                                        <input type="submit" name="insert_user" id="insert_user" class="btn btn-primary" value="สมัครสมาชิก">
                                        <a href="<?php echo BASE_URL ?>/user/all_user" class="btn btn-danger">ย้อนกลับ</a>
                                    </div>
                                </div>
                            </div>
                        </form>

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
    <script src="../backend/user/action/user.js"></script>

</body>

</html>