<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เข้าสู่ระบบ</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card" style="width: 518px;">
            <div class="card-body login-card-body">

                <form method="POST" id="frm_login">
                    <h3 align="center">เข้าสู่ระบบ</h3>
                    <h4 align="center">ระบบบริหารจัดการโครงการสโมสรนักศึกษา</h4>
                    <div class="input-group mb-4">
                        <!-- <label for="usr_username">ชื่อผู้ใช้</label> -->
                        <input type="text" class="form-control" name="usr_username" id="log_username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <!-- <label for="usr_password">รหัสผ่าน</label> -->
                        <input type="password" class="form-control" name="usr_password" id="log_password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div id="error"></div>
                    <!-- <button type="submit" name="login" class="btn btn-primary w-100">เข้าสู่ระบบ</button> -->
                    <input type="submit" name="sign_in" value="เข้าสู่ระบบ" class="btn btn-primary w-100">

                </form>



            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/adminlte.min.js"></script>
    <script src="../js/form_login.js"></script>

</body>

</html>