<div class="container ">
    <h2 class="mt_15">ระบบบริหารจัดการโครงการสโมสรนักศึกษา</h2>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <a class="navbar-brand mr-auto" href="index.php"><i class="fas fa-home"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL ?>/web_config/faculty/index.php">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL ?>/web_config/user/frm_edit_user.php">เปลี่ยนรหัสผ่าน</a>
                </li>

            </ul>
            <a class="nav-link btn btn-outline-danger" href="<?php echo BASE_URL ?>/web_config/logout.php" onclick="return confirm('ออกจากระบบ')">ออกจากระบบ</a>

        </div>

    </nav>
</div>