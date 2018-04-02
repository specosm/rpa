<?php
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
    case 'estadoTiempo':
        {
            if (isset($_POST['id_rpa'])) {

                if (!empty($_POST['id_rpa'])) {
                    include('rpaGraficosClass.php');
                    $creacion = new rpaGraficosClass('','','','','','','','','','',$_POST['id_rpa']);
                    $creacion->GraficoEstadoTiempo();
                } else {

                    header('location:../comun.php');
                }
            } else {

                header('location:../comun.php');
            }


        }
        break;


    case 'informeGraficoEstadoTiempo':
        {
            if (isset($_POST['id_rpa'])) {

                if (!empty($_POST['id_rpa'])) {
                    include('rpaGraficosClass.php');
                    $creacion = new rpaGraficosClass('','','','','','','','','','',$_POST['id_rpa']);
                    $creacion->informeGraficoEstadoTiempo();
                } else {

                    header('location:../comun.php');
                }
            } else {

                header('location:../comun.php');
            }


        }
        break;



    case 'editar_perfil':
        {

        }
        break;

    case 'eliminarUser':
        {

        }
        break;

    case 'paginar': {
        if (isset($_POST['page'])) {

            if (!empty($_POST['page'])) {
                $page = $_POST['page'];
                $per_page = $_POST['per_page'];
                include('rpaGraficosClass.php');
                $creacion = new rpaGraficosClass('','','','','','','','',$page,$per_page,'');
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



