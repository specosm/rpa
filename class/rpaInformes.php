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

                } else {

                    header('location:../comun.php');
                }
            } else {

                header('location:../comun.php');
            }


        }
        break;


    case 'indiInformes':
        {

            if (isset($_POST['modo'])) {

                if (!empty($_POST['modo'])) {
                    $page = $_POST['page'];
                    $id=$_POST['id'];
                    $per_page = $_POST['per_page'];
                    include('rpaInformesClass.php');
                    $creacion = new rpaInformesClass('','','','','','','','',$page,$per_page,$id);
                    $creacion->indiInformes();
                } else {

                    header('location:../comun.php');
                }
            } else {

                header('location:../comun.php');
            }

        }
        break;


    case 'informesNoContables':
        {

            if (isset($_POST['modo'])) {

                if (!empty($_POST['modo'])) {
                    $page = $_POST['page'];
                    $id=$_POST['id'];
                    $per_page = $_POST['per_page'];
                    include('rpaInformesClass.php');
                    $creacion = new rpaInformesClass('','','','','','','','',$page,$per_page,$id);
                    $creacion->informesNoContables();
                } else {

                    header('location:../comun.php');
                }
            } else {

                header('location:../comun.php');
            }

        }
        break;


    case 'TiempoInformes':
        {

            if (isset($_POST['modo'])) {

                if (!empty($_POST['modo'])) {
                    $page = $_POST['page'];
                    $id=$_POST['id'];
                    $per_page = $_POST['per_page'];
                    include('rpaInformesClass.php');
                    $creacion = new rpaInformesClass('','','','','','','','',$page,$per_page,$id);
                    $creacion->TiempoInformes();
                } else {

                    header('location:../comun.php');
                }
            } else {

                header('location:../comun.php');
            }

        }
        break;


    case 'paginarInformes':
        {
            if (isset($_POST['page'])) {

                if (!empty($_POST['page'])) {
                    $page = $_POST['page'];
                    $per_page = $_POST['per_page'];
                    $id=$_POST['id'];
                    include('rpaInformesClass.php');
                    $creacion = new rpaInformesClass('','','','','','','','',$page,$per_page,$id);
                    $creacion->paginadorInformes();
                } else {

                    header('location:../comun.php');
                }
            } else {

                header('location:../comun.php');
            }
        }
        break;

    case 'paginar': {
        if (isset($_POST['page'])) {

            if (!empty($_POST['page'])) {
                $page = $_POST['page'];
                $per_page = $_POST['per_page'];
                include('rpaInformesClass.php');
                $creacion = new rpaInformesClass('','','','','','','','',$page,$per_page,'');
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



