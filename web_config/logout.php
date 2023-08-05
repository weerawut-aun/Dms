<?php
session_start();
session_destroy();
header("location: ghost.php");
?>