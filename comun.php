<?php
session_start();
if(isset($_SESSION["user"])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPA</title>

    <!-- CSS de Bootstrap -->
    <link href="MDB/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="MDB/css/style.css" rel="stylesheet" media="screen">
    <link href="MDB/css/mdb.min.css" rel="stylesheet" media="screen">
    <link href="MDB/css/datedropper.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="MDB/css/sweetalert2.min.css">
    <link rel="stylesheet" href="MDB/font/font-awesome/css/font-awesome.min.css">



</head>
<body>

<div class="container-fluid">
    <?php
    include 'comunes/nav.php';
    ?>
    <div class="row">
        <div  class="col-sm-12 col-lg-12 col-md-12 col-xl-12">

            <div id="contenido"> </div>
        </div>

    </div>
    <?php
    include 'comunes/footer.php';
    ?>


</div>

<!-- Librería jQuery requerida por los plugins de JavaScript -->
<script src="MDB/js/jquery.min.js"></script>
<script src="MDB/js/popper.min.js"></script>
<script src="MDB/js/bootstrap.min.js"></script>
<script src="buscar.js"></script>
<script src="MDB/js/mdb.min.js"></script>
<script src="MDB/js/Chart.bundle.min.js"></script>
<script src="MDB/js/utils.js"></script>
<script src="MDB/js/datedropper.js"></script>
<script src="MDB/js/sweetalert2.min.js"></script>
<script src="MDB/js/core.js"></script>
<script src="MDB/js/myscript.js"></script>





</body>
</html>

    <?php
}else
{
    session_start();
    session_destroy();
    header ("Location: index.php");


}

?>