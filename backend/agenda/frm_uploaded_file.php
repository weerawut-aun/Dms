<?php
include('../../secure/connect.php');
// chk_staff();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/new_project.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <?php
    if (isset($_GET['agd_id'])) {

         $_GET['agd_id'];

        $join_2 = mysqli_query($con, "SELECT agenda.agd_id, doc.doc_name FROM agenda 
                    INNER JOIN doc ON agenda.agd_id = doc.agd_id 
                    WHERE agd_id=' ".$_GET['agd_id']."'
                    ORDER BY agenda.agd_id asc");

        $_SESSION['agd_id'] = $_GET['agd_id'];
        // print_r($_SESSION['agd_id']);
        // exit();
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <form name="uploaed" action="uploaded_file.php" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" name="doc_name" class="form-control-file" require>
                        <br>
                        <button type="submit" class="btn btn-primary" name="submit">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../js/jquery-3.4.1.min.js"></script>
<script src="../../js/bootstrap.bundle.js"></script>
</body>

</html>