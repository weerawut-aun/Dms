<?php
require_once('../connect.php');

if (isset($_GET['fct_id'])) {
    $_SESSION['fct_id'] = $_GET['fct_id'];
}
$query_fct = mysqli_query($con, "SELECT * FROM faculty WHERE fct_id='" . $_SESSION['fct_id'] . "'");
$row_fct = mysqli_fetch_array($query_fct);

// if(mysqli_num_rows($result_fct) == 0){
//     header("location:javascript://history.go(-1)");
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../include/script_css.php'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-header">
            <?php include('../include/navbar.php'); ?>
        </div>
        <br>
        <!-- /.content-header -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>ปีการศึกษา คณะ<?php echo $row_fct['fct_name']; ?></h3>
                            <div class="col-sm-12">
                                <div class="card-tools">
                                    <a type="button" href="../faculty/index.php" class="btn btn-danger float-right">ย้อนกลับ</a>
                                </div>
                                <div id="list_years"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
    </div>

    <?php include('../include/script_js.php'); ?>
    <script src="action/years.js"></script>
</body>

</html>