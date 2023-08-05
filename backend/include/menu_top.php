<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
       
    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" ">
                <i class=" fas fa-chevron-circle-down" style="font-size: 21px;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="<?php echo BASE_URL ?>/user/update_profile" class="dropdown-item">
                    <i class="fas fa-user-cog"></i> ข้อมูลส่วนตัว
                </a>
                <a href="<?php echo BASE_URL ?>/user/change_password" class="dropdown-item">
                    <i class="fas fa-unlock-alt"></i> เปลี่ยนรหัสผ่าน
                </a>
                <a href="<?php echo BASE_URL ?>/secure/logout.php" onclick="return confirm('ออกจากระบบ')" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                </a>
            </div>
        </li>
    </ul>
</nav>