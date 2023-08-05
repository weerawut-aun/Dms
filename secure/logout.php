<?php
require_once('connect.php');
unset($_SESSION);
session_destroy();
// header("location: frm_login.php");
header("location: login.php");
?>