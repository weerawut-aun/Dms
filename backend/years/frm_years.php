<?php

include('../../secure/connect.php');
include('../include/auth.php');
chk_admin();

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

          <!-- Main row -->
          <div class="card">

            <div class="card-header">
              <h3><i class="fas fa-cog"></i> เพิ่มปีการศึกษา </h3>
            </div>
            <form method="POST" name="add_years" class="form-horizontal" id="frm_add_years">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-sm-12 col-md-8 mt_15">
                    <div class="form-group has-warning">
                      <b> ปีการศึกษา </b>
                      <input name="y_years" id="y_years" type="text" class="form-control" placeholder="ปีการศึกษา" />
                    </div>

                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-sm-12 col-md-8 mt_15">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" id="btn">
                        <i class="fa fa-fw fa-plus"></i> บันทึก
                      </button>
                      <a href="<?php echo BASE_URL ?>/backend/years/tb_years.php" class="btn btn-danger">ย้อนกลับก่อนหน้า</a>
                    </div>
                  </div>
                </div>
            </form>
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
      $('#frm_add_years').on('submit', function(event) {
        event.preventDefault()

        var y_years = $('#y_years').val();

        if (y_years == '') {
          alert("กรุณากรอกปีการศึกษา");
        } else {
          $.ajax({
            url: 'action/add_years.php',
            method: 'POST',
            data: {
              y_years: y_years
            },
            success: function(data) {
              // alert(data);

              if (data == 'Have a row') {
                alert("ข้อมูลปีการศึกษานี้ซ้ำ");
              }
              if (data == "Can't created") {
                alert("ไม่สามารถสร้างข้อมูลได้");
              }
              if (data == 'Directory created') {

                alert("เพิ่มปีการศึกษา เรียบร้อยแล้ว");
                window.location.href = 'tb_years.php';
              }
            }
          });
        }

      });
    });
  </script>

</body>

</html>