<?php
include('../../connect.php');

include('../../include/auth.php');

if (isset($_GET['fct_id'])) {

  $_SESSION['fct_id'] = $_GET['fct_id'];

  $query_faculty = "SELECT * FROM faculty WHERE fct_id='" . $_GET['fct_id'] . "'";
  $result_faculty = mysqli_query($con, $query_faculty);
  $fct = mysqli_fetch_array($result_faculty);
} else {
  header('Location: ' . BASE_URL . '/web_config/index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include('../../include/script_css.php'); ?>
</head>

<body>
  <div class="wrapper">
    <?php include('../../include/navbar.php'); ?>
    <section class="content">
      <div class="container">
        <h3>
          <?php echo $fct['fct_name']; ?>
        </h3>
        <h3>  ผู้ดูและระบบ</h3>
        <div id="message_admin"></div>
        <div class="float-right">
          <a href="frm_admin.php" type="button" class="btn btn-primary ">
            เพิ่มข้อมูล
          </a>
          <a href="../index.php" type="button" class="btn btn-danger">
            ย้อนกลับ
          </a>
        </div>
        <div id="list_member"></div>

      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- ./wrapper -->
  <?php include('../../include/script_js.php'); ?>
  <script src="action/fetch_admin.js"></script>

</body>

</html>