<aside class="main-sidebar sidebar-light-warning elevation-4">

    <?php
    if (isset($_SESSION['first_login'])) {
    ?>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">


                    </a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="<?php echo BASE_URL ?>//backend/user/frm_insert_data.php" class="nav-link">
                            <i class="fas fa-user">จัดการข้อมูลตัวเอง</i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php

    } else {
    ?>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">
                        <?php


                        echo $_SESSION['usr_prefix'] . $_SESSION['usr_firstname'] . ' ', $_SESSION['usr_lastname'];
                        ?>

                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <!-- home -->

                    <li class="nav-item">
                        <a href="<?php echo BASE_URL ?>/home" class="nav-link">
                            <i class="fas fa-home"></i>
                            <p>
                                หน้าแรก
                            </p>
                        </a>
                    </li>

                    <!-- /. home -->

                 
                    <?php

                    if (isset($_SESSION['admin']) || isset($_SESSION['dean'])) {
                    ?>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    จัดการผู้ใช้
                                    <i class="fas fa-angle-left right"></i>
                                </p>

                            </a>
                            <ul class="nav nav-treeview">
                                <?php if (isset($_SESSION['admin'])) { ?>
                                    <li class="nav-item">
                                        <!-- admin/tb_user.php -->
                                        <a href="<?php echo BASE_URL ?>/user/all_user" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ผู้ใช้งาน</p>
                                        </a>
                                    </li>
                                <?php
                                }
                                if (isset($_SESSION['dean'])) {
                                ?>
                                    <li class="nav-item">
                                        <!-- admin/tb_user.php -->
                                        <a href="<?php echo BASE_URL ?>/admin/list_admin" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ผู้ดูแลระบบ</p>
                                        </a>
                                    </li>

                                <?php } ?>
                            </ul>
                        </li>
                    <?php
                    }
                    if (isset($_SESSION['admin'])) { ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cog text-dark"></i>
                                <p>การตั้งค่า</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>/backend/setting/convert/convert.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>จัดการพื้นที่อัพโหลดไฟล์</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>/setting/tb_project_type" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>จัดการลักษณะโครงการ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>/setting/tb_respon" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>จัดการรายชื่อผู้รับผิดชอบ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo BASE_URL ?>/setting/tb_place" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>จัดการสถานที่</p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>/backend/years/tb_years.php" class="nav-link">
                                <i class="fas fa-calendar-plus"></i>
                                <p>
                                    จัดการปีการศึกษา
                                </p>
                            </a>
                        </li>

                    <?php
                    }
                    // }
                    ?>

                    <li class="nav-item has-treeview">
                        <?php
                        $query_years = "SELECT * FROM years WHERE fct_id='" . $_SESSION['fct_id'] . "'";
                        $result_years = mysqli_query($con, $query_years) or die(mysqli_error($query_years));

                        if (mysqli_num_rows($result_years) == 0) {
                            echo '
                                <a href="#" class="nav-link text-gray" disabled >
                                <i class="fas fa-calendar-week "></i>
                                <p>
                                    ปีการศึกษา
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                                ';
                        } else {
                        ?>
                            <a href="#" class="nav-link">
                                <i class="fas fa-calendar-week"></i>
                                <p>
                                    ปีการศึกษา
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        <?php
                        }
                        $query_years = "SELECT * FROM years WHERE fct_id='" . $_SESSION['fct_id'] . "' ORDER BY y_years asc";
                        $result_years = mysqli_query($con, $query_years);

                        while ($rows = mysqli_fetch_array($result_years)) {
                        ?>
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            <!-- เพิ่มปีการศึกษา -->
                                            <?php echo $rows['y_years']; ?>
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <?php
                                            //    $rows['y_id'] = $rows['y_id'];
                                            $chk_status = "SELECT * FROM agenda WHERE y_id='" . $rows['y_id'] . "'";
                                            $result_chk = mysqli_query($con, $chk_status) or die(mysqli_error($chk_status));
                                            if (mysqli_num_rows($result_chk) > 0) {

                                                $row_chk = mysqli_fetch_array($result_chk);
                                            ?>
                                               
                                                <?php

                                                if ($row_chk['agd_show'] == '1') {
                                                ?>
                                                    <a href="<?php echo BASE_URL ?>/<?= $rows['y_id'] ?>/agenda" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>วางแผน</p>
                                                        <i class="right fas fa-circle text-success"></i>

                                                    </a>
                                                <?php
                                                }
                                                if ($row_chk['agd_show'] == '0') {
                                                ?>
                                                    <a href="<?php echo BASE_URL ?>/<?= $rows['y_id'] ?>/agenda" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>วางแผน</p>
                                                        <i class="right fas fa-circle text-warning"></i>

                                                    </a>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <a href="<?php echo BASE_URL ?>/<?= $rows['y_id'] ?>/agenda" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>วางแผน</p>
                                                    <i class="right fas fa-circle text-danger"></i>

                                                </a>

                                            <?php
                                            }
                                            ?>
                                            
                                        </li>
                                        <li class="nav-item">
                                            <?php

                                            $chk_status1 = "SELECT * FROM agenda WHERE y_id='" . $rows['y_id'] . "'";
                                            $result_chk1 = mysqli_query($con, $chk_status1) or die(mysqli_error($chk_status1));
                                            $rows_S = mysqli_fetch_assoc($result_chk1);

                                            if ($rows_S['agd_show'] == "1") {

                                            ?>
                                                <a href="<?php echo BASE_URL ?>/<?= $rows['y_id'] ?>/project" id="reload_page" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>ดำเนินการ</p>
                                                    <?php
                                                    $chk_pro = "SELECT * FROM project_details WHERE y_id='" . $rows['y_id'] . "'";
                                                    $result_pro = mysqli_query($con, $chk_pro) or die(mysqli_error($chk_pro));
                                                    $rows_S2 = mysqli_fetch_assoc($result_pro);

                                                    if ($rows_S2['pdt_status'] !== "0" && $rows['y_show'] == "1") {
                                                    ?>
                                                        <i class="right fas fa-circle text-success"></i>
                                                    <?php
                                                    } elseif ($rows_S2['pdt_status'] == "1") {
                                                    ?>
                                                        <i class="right fas fa-circle text-warning"></i>

                                                    <?php } else {

                                                    ?>
                                                        <i class="right fas fa-circle text-danger"></i>
                                                    <?php } ?>
                                                </a>

                                            <?php
                                            } else {

                                            ?>
                                                <a href="" class="nav-link disabled">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p class="text-gray">ดำเนินการ</p>
                                                </a>
                                            <?php } ?>
                                        </li>
                                        <li class="nav-item">
                                            <?php

                                            $chk_status2 = "SELECT pro_show FROM project WHERE y_id='" . $rows['y_id'] . "'";
                                            $result_chk2 = mysqli_query($con, $chk_status2) or die(mysqli_error($chk_status2));
                                            $num_rows = mysqli_num_rows($result_chk2);

                                            if ($num_rows > 0) {
                                                $rows_pro2 = mysqli_fetch_array($result_chk2);

                                                // $chk_pro2 = "SELECT * FROM project WHERE y_id='" . $rows['y_id'] . "'";
                                                // $result_pro2 = mysqli_query($con, $chk_pro2) or die(mysqli_error($chk_pro2));
                                                $chk_summary = "SELECT y.*,i.ils_id FROM years as y
                                            JOIN  invitation_letter_summary as i ON i.y_id = y.y_id
                                            WHERE y.y_id='" . $rows['y_id'] . "'";
                                                $result_summary = mysqli_query($con, $chk_summary) or die(mysqli_error($chk_summary));
                                                $summary_fetch = mysqli_fetch_array($result_summary);


                                                if ($rows_pro2['pro_show'] !== "0" && $rows['y_show'] == "1") { ?>
                                                    <a href="<?php echo BASE_URL ?>/<?= $rows['y_id'] ?>/summary" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>สรุปผล</p>
                                                        <i class="right fas fa-circle text-success "></i>
                                                    </a>
                                                <?php  } elseif ($rows_pro2['pro_show'] !== "0") { ?>
                                                    <a href="<?php echo BASE_URL ?>/<?= $rows['y_id'] ?>/summary" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>สรุปผล</p>
                                                        <i class="right fas fa-circle text-danger"></i>
                                                    </a>
                                                <?php
                                                } elseif ($summary_fetch['ils_id'] > 0 && $rows['y_show'] == "0") {
                                                ?>
                                                    <a href="<?php echo BASE_URL ?>/<?= $rows['y_id'] ?>/summary" class="nav-link">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>สรุปผล</p>
                                                        <i class="right fas fa-circle text-warning"></i>
                                                    </a>
                                                <?php
                                                } elseif ($rows_pro2['pro_show'] == "0") {
                                                ?>
                                                    <a class="nav-link disabled">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>สรุปผล</p>
                                                    </a>
                                                <?php
                                                }
                                            } else { ?>
                                                <a class="nav-link disabled">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>สรุปผล</p>
                                                </a>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo BASE_URL ?>/user/list_user" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>
                                ข้อมูลสมาชิก
                            </p>
                        </a>
                    </li>
                    <!-- ออกจากระบบ -->
                    <!-- <li class="nav-item">
                        <a href="<?php echo BASE_URL ?>/secure/logout.php" onclick="return confirm('ออกจากระบบ')" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>
                                ออกจากระบบ
                            </p>
                        </a>
                    </li> -->
                    <!-- ปิดออกจากระบบ -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    <?php

    }
    ?>
</aside>