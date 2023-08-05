<?php
 if(!isset($_SESSION['wcf_name'])){
    header('Location: '.BASE_URL.'/web_config/ghost.php');
    exit();
}

?>