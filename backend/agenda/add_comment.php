<?php 
    require_once('../../secure/connect.php');
  
//  echo '<pre>'; 
//  print_r($_POST);  
//  echo '</pre>';

if(!empty($_POST['usr_id']) && !empty($_POST['cmg_comment'])){

    $usr_id = $_POST['usr_id'];
    $cmg_comment = $_POST['cmg_comment'];
    $comment_id = $_POST['comment_id'];
    $agd_id = $_SESSION['agd_id'];


    $insert = "INSERT INTO `comment_meeting`(`parent_id`, `cmg_comment`, `agd_id`,`usr_id`) VALUES ('$comment_id','$cmg_comment','$agd_id','$usr_id')";
    $result = mysqli_query($con,$insert) or die(mysqli_error($insert));

    $message = '<label class="text-success">Comment posted Successfully .</label>';
    $status = array(
        'error' => 0,
        'message' => $message
    );
} else {
    $message = '<label class="text-danger">Error:  Comment not posted.</label>';
    $status = array(
        'error' => 1,
        'message' => $message
    );
}
echo json_encode($status);