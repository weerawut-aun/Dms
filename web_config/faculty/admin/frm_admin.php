<?php
include('../../connect.php');
// echo $_SESSION['fct_id'];
include('../../include/auth.php');

$query_fct = "SELECT * FROM faculty WHERE fct_id='" . $_SESSION['fct_id'] . "'";
$result_fct = mysqli_query($con, $query_fct);
$fct = mysqli_fetch_array($result_fct);

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
        <div class="container">
            <h1>
                <?php echo $fct['fct_name']; ?>
            </h1>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-7">
                    <h1>เพิ่มผู้ดูแลระบบ</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    <!-- action="insert_admin.php" -->
                    <form id="frm_insert_admin">
                        <div class="form-group col-sm-12">
                            <label for="usr_username">ชื่อผู้ดูแลระบบ :</label>
                            <input type="text" class="form-control" name="usr_username" id="usr_username">
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="usr_password">รหัสผ่าน :</label>
                            <input type="password" class="form-control" name="usr_password" id="usr_password">
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="c_password">ยืนยันรหัสผ่าน :</label>
                            <input type="password" class="form-control" name="c_password" id="c_password">
                        </div>
                        <input type="hidden" name="fct_id" id="fct_id" value="<?php echo $_SESSION['fct_id']; ?>">
                        <div id="success"></div>
                        <div id="showErrorcPwd"></div>
                        <br>
                        <input type="submit" name="register" id="register" class="btn btn-primary" value="ยืนยัน">
                        <a href="tb_admin.php?fct_id=<?= $_SESSION['fct_id'] ?>" type="button" class="btn btn-danger">
                            ย้อนกลับ
                        </a>
                    </form>

                </div>
            </div>
        </div>
        </section>
    </div>


    <?php include('../../include/script_js.php'); ?>
    <script src="action/admin.js"></script>

</body>

</html>