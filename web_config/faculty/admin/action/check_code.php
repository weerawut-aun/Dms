<?php 

include('../../../connect.php');

$code = $_POST['code'];

// $usr_username = $_['usr_username'];


if($code == $_SESSION['captcha_code']) {
    echo 'success';
    // return true;
} else {
    echo 'false';
    // return false;
}

?>