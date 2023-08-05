<?php

include('../connect.php');

$qeury = "SELECT wcf_name FROM web_config WHERE wcf_id=4";
$result = mysqli_query($con, $qeury) or die(mysqli_error($qeury));
$rows = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../include/script_css.php'); ?>
</head>

<body>
    <div class="wrapper">
        <?php include('../include/navbar.php'); ?>
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6 bg-light p-4 rounded mt-5">
                        <h5 class="text-center text-light bg-success mb-2 p-2 rounded lead" id="result">Hello World!</h5>

                        <div class="progress mb-3" style="height: 40px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 50%;" id="progressBar">
                                <b class="lead" id="progressText">Step - 1/2</b>
                            </div>
                        </div>
                        <form action="" method="post" id="insert_faculty">
                            <div id="first">
                                <h4 class="text-center bg-primary p-1 rounded text-light">เพิ่มคณะ</h4>
                                <div class="form-group">
                                    <label for="fct_name">คณะ :</label>
                                    <input type="text" name="fct_name" class="form-control" placeholder="กรอกชื่อคณะ" id="fct_name">
                                    <b class="form-text text-danger" id="fct_nameError"></b>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="fct_uploadsize" class="form-control" value="<?php echo $rows['wcf_name']; ?>" id="fct_uploadsize">
                                </div>
                                <div class="form-group">
                                    <a href="index.php" class="btn btn-danger">ย้อนกลับ</a>
                                    <a href="#" class="btn btn-primary" id="next-1">หน้าถัดไป</a>
                                </div>
                            </div>
                            <div id="secound">
                                <h4 class="text-center bg-primary p-1 rounded text-light">เพิ่มผู้ดูแลระบบ</h4>
                                <div class="form-group">
                                    <label for="usr_username">ชื่อผู้ใช้งาน :</label>
                                    <input type="text" name="usr_username" class="form-control" placeholder="กรอกชื่อผู้ใช้งาน" id="usr_username">
                                    <b class="form-text text-danger" id="usr_usernameError"></b>
                                </div>
                                <div class="form-group">
                                    <label for="usr_password">รหัสผ่าน :</label>
                                    <input type="password" name="usr_password" class="form-control" placeholder="กรอกรหัสผ่าน" id="usr_password">
                                    <b class="form-text text-danger" id="usr_passwordError"></b>
                                </div>
                                <div class="form-group">
                                    <label for="cpass">ยืนยันรหัสผ่าน :</label>
                                    <input type="password" name="cpass" class="form-control" placeholder="กรอกยืนยันรหัสผ่านอีกครั้ง" id="cpass">
                                    <b class="form-text text-danger" id="cpassError"></b>

                                </div>
                                <div class="form-group">
                                    <a href="#" class="btn btn-danger" id="prev-2">ย้อนกลับก่อนหน้า</a>
                                    <input type="submit" name="submit" value="บันทึก" id="submit" class="btn btn-success">
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>

        </section>
    </div>

    <?php include('../include/script_js.php'); ?>
    <script src="action/action.js"></script>
  
      
</body>

</html>