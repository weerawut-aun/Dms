<?php

require_once('../../../secure/connect.php');


if (isset($_POST['y_years'])) {

    // $y_years = $_POST['y_years'];
    $y_years = mysqli_real_escape_string($con, $_POST['y_years']);

   
    $fct_id = mysqli_real_escape_string($con, $_SESSION['fct_id']);

    $chk_years = "SELECT * FROM years WHERE y_years=$y_years && fct_id='$fct_id'";
    $result_chk = mysqli_query($con, $chk_years) or die(mysqli_error($chk_years));
    $num_years = mysqli_num_rows($result_chk);

    if ($num_years < 1) {

        // echo 'Not have a row';

        $fct_y = $fct_id . "_" . $y_years;
        // path ที่

        $directory = chdir("../../../data");

        // echo getcwd();

        if (!mkdir("$fct_y")) {
            echo "Can't created";
        } else {

            $insert_years = "INSERT INTO years (y_years,fct_id,fct_y) VALUE ('$y_years','$fct_id','$fct_y')";
            // echo  $insert_years;
            // exit;

            $query_years = mysqli_query($con, $insert_years);

            if ($query_years) {

                // echo "Directory created <br>";
                chdir("./$fct_y");
                mkdir("agenda");
                mkdir("project");
                mkdir("summary");

                echo "Directory created";
            }
        }



    } else {
     

        echo 'Have a row';
    }
} else {
    echo "<script type=\"text/javascript\">
            alert(\"ผิดพลา่ด\")
            window.history.back()
        </script>";
    exit();
}
