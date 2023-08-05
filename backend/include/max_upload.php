<?php

$query_fct  = "SELECT * FROM faculty WHERE fct_id='" . $_SESSION['fct_id'] . "'";
$result_fct = mysqli_query($con, $query_fct) or die(mysqli_error($query_fct));
$num_rows_fct = mysqli_num_rows($result_fct);
$fetch_rows = mysqli_fetch_array($result_fct);

$size = $fetch_rows['fct_uploadsize'];



?>