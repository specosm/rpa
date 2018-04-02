<?php
//Interface y clase de ejecucion de robot
session_start();
if (isset($_GET['modo'])) {
    $modo = isset($_GET['modo']) ? $_GET['modo'] : 'default';
}
elseif (isset($_POST['modo'])){
    $modo = isset($_POST['modo']) ? $_POST['modo'] : 'default';
}
else{
    $modo ='default';
}
switch($modo) {


    case 'paginar': {
        if (isset($_POST['page'])) {

            if (!empty($_POST['page'])) {
                $page = $_POST['page'];
                $per_page = $_POST['per_page'];
                include('rpaProcessAdminClass.php');
                $creacion = new rpaProcessAdminClass('','','','','','','','',$page,$per_page,'');
                $creacion->paginador();
            } else {

                header('location:../comun.php');
            }
        } else {

            header('location:../comun.php');
        }

    }
        break;
    default: {
        ?>
        <script language='javascript'>
            alert('No se ha seleccionado ninguna opción');
        </script>
        <?php

        header('location:../comun.php');
    }
        break;
}



