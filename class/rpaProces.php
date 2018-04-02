<?php
// Interface y clase de administración de robot
if (isset($_GET['modo'])) {
    $modo = isset($_GET['modo']) ? $_GET['modo'] : 'default';
}
elseif (isset($_POST['modo'])){
    $modo = isset($_POST['modo']) ? $_POST['modo'] : 'default';
}
else{
    $modo ='default';
}
switch($modo){
    case 'crear_robot':
    {
        if(isset($_GET['modo']) )
        {

            if(!empty($_POST['name']))
            {
                if(empty($_POST['enable'])) {
                    $_POST['enable'] = 0;
                }
                else
                {
                    $_POST['enable'] = 1;
                }
                if(empty($_POST['date']))
                {
                    $fecha = new DateTime();
                    $_POST['date']=$fecha->format('Y-m-d H:i:s');
                }
                include('rpaProcesClass.php');
                $creacion=new rpaProcesClass($_POST['name'],($_POST['des']),$_POST['enable'],($_POST['date']),($_POST['version']),($_POST['version_txt']),($_POST['add_user']),($_POST['file']),'','','',($_POST['idRpa']));
               $reto= $creacion->crear();
               if($reto) {
                   ?>
                   <script language='javascript'>
                       alert('Se ha añadido correctamente');
                       window.location.href = "../comun.php";
                   </script>
                   <?php

                   //header('location:../desarrollo/administrador.php');
               }
               else {
                   ?>
                   <script language='javascript'>
                       alert('No se ha podido introducir el bots');
                       window.location.href = "../comun.php";
                   </script>
                   <?php
             }
            }
            else
            {

                header('location:../comun.php');
            }
        }
        else
        {

            header('location:../comun.php');
        }

    }
        break;


    case 'editar_robot':
    {

        if(isset($_GET['modo']) )
        {

            if(!empty($_POST['name']))
            {
                if(isset($_POST['enable']) and !empty($_POST['enable'])){
                    $enabled = 1;
                }
                else
                {
                    $enabled = 0;
                }
                if(empty($_POST['date']))
                {
                    $fecha = new DateTime();
                    $_POST['date']=$fecha->format('Y-m-d H:i:s');
                }
                include('rpaProcesClass.php');
                $creacion=new rpaProcesClass($_POST['name'],($_POST['des']), $enabled,($_POST['date']),($_POST['version']),($_POST['version_txt']),($_POST['add_user']),($_POST['file']),($_POST['id']),'','',($_POST['idRpa']));
                $reto= $creacion->editar();
                if($reto) {
                    ?>
                    <script language='javascript'>
                        alert('Se ha Actualizado correctamente');
                        window.location.href = "../comun.php";
                    </script>
                    <?php


                    //header('location:../desarrollo/administrador.php');
                }
                else {
                    ?>
                    <script language='javascript'>
                        swal({
                            title: 'Eliminar bot´s',
                            text: 'No se ha podido actualizar este bot´s',
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(
                            function () {},
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    console.log('I was closed by the timer')
                                    window.location.href = "./comun.php";
                                }
                            }
                        )
                    </script>
                    <?php

                    header('location:../comun.php');
                }
            }
            else
            {

                header('location:../comun.php');
            }
        }
        else
        {

            header('location:../comun.php');
        }

    }
        break;

    case 'eliminar_bots': {
        if(isset($_POST['modo']) )
        {

            if(!empty($_POST['id']))
            {

                include('rpaProcesClass.php');
                $delete=new rpaProcesClass('','','','','','','','',$_POST['id'],'','','');
                $reto= $delete->eliminar();
                if($reto) {
                    ?>
                    <script type="application/javascript">
                        alert('Se ha podido eliminar el bots');

                    </script>
                    <?php
                    header('location:../desarrollo/administrador.php');
                }
                else {
                    ?>
                    <script language='javascript'>
                        swal({
                            title: 'Eliminar bot´s',
                            text: 'No se ha podido eliminar este bot´s, tiene tablas relacionadas',
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(
                            function () {},
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    console.log('I was closed by the timer')
                                    window.location.href = "./comun.php";
                                }
                            }
                        )

                    </script>
                    <?php

                }
            }
            else
            {

                header('location:../desarrollo/administrador.php');
            }
        }
        else
        {


            header('location:../desarrollo/administrador.php');
        }

    }
        break;

    case 'paginar': {
        if (isset($_POST['page'])) {

            if (!empty($_POST['page'])) {
                $page = $_POST['page'];
                $per_page = $_POST['per_page'];
                include('rpaProcesClass.php');
                $creacion = new rpaProcesClass('','','','','','','','','',$page,$per_page,'');
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