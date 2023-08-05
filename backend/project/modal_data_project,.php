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
                    <input type="submit" class="btn btn-success" name="insert" value="บันทึก">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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
                    <input type="submit" class="btn btn-success" name="insert" value="บันทึก">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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

                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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
                    <input type="submit" class="btn btn-success" name="insert" value="บันทึก">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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

                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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
                    <input type="submit" class="btn btn-success" name="insert" value="บันทึก">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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

                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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
                    <input type="submit" class="btn btn-success" name="insert" value="บันทึก">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่างนี้</button>
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