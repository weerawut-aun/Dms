<?php

if (!isset($_SESSION['usr_username'])) {
    header('Location: ' . BASE_URL . '/secure/login.php');
    exit();
}
if (isset($_SESSION['first_login'])) {
    echo "<script LANGUAGE='JavaScript'>
        window.alert('เนื่องจากเข้าสู่ระบบครั้งแรก กรุณาจัดการข้อมูลส่วนตัวเองก่อน');
        window.location.href='" . BASE_URL . "/backend/user/frm_insert_data.php';
        </script>";
}

