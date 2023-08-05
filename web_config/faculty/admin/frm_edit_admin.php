<?php
include('../../connect.php');
// echo $_GET['fct_id'];
// exit;
include('../../include/auth.php');

$query = "SELECT * FROM user WHERE usr_id='" . $_GET['usr_id'] . "' && fct_id='" . $_SESSION['fct_id'] . "'";

$result = mysqli_query($con, $query);
$_SESSION['usr_id'] = $_GET['usr_id'];
$row = mysqli_fetch_assoc($result);
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
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">

                        <h1>ผู้ดูแลระบบ</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <!-- captch_form -->
                        <form method="POST" id="frm_edit_admin">

                            <div class="form-group">
                                <label for="ีusr_username">ชื่อผู้ใช้งาน :</label>
                                <input type="text" class="form-control" name="usr_username" id="usr_username" value="<?php echo $row['usr_username']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="ีusr_password">รหัสผ่าน :</label>
                                <input type="password" class="form-control" name="usr_password" id="usr_password">
                            </div>

                            <div id="showErrorPwd"> </div>

                            <div class="form-group">
                                <label for="c_password">ยืนยันรหัสผ่าน :</label>
                                <input type="password" class="form-control" name="c_password" id="c_password">
                            </div>
                            <div id="showErrorcPwd"> </div>

                            <div class="form-group">
                                <label for="captcha_code">Code</label>
                                <input type="text" name="captcha_code" id="captcha_code" class="form_control">
                                <span class="input-group-addon" style="padding: 0">
                                    <img src="image.php" id="captcha_image">
                                </span>
                            </div>

                            <div id="edit_admin"></div>
                            <div class="form-group">
                                <input type="submit" name="edit" id="edit" class="btn btn-info" value="อัพเดต">
                                <a href="tb_admin.php?fct_id=<?= $_SESSION['fct_id'] ?>" type="button" class="btn btn-danger">ยกเลิก</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- ./wrapper -->

    <?php include('../../include/script_js.php'); ?>
    <!-- JAVA Script Area -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script> -->

    <script src="action/admin.js"></script>
</body>

</html>