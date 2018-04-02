<?php

//Interface y clase de asiganacion de robot_User
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
    case 'crear_robot_user': {
        if (isset($_POST['bot']) and isset($_POST['user']) and isset($_POST['date'])) {

            if (!empty($_POST['bot']) and !empty($_POST['user']) and !empty($_POST['date'])) {
                if (empty($_POST['date'])) {
                    $_POST['date'] = date_create()->format('Y-m-d H:i:s');
                }
                include('rpaProcesUserClass.php');
                $creacion = new rpaProcesUserClass('', $_POST['bot'],$_POST['user'], $_POST["id_persona"], $_POST['date'],"","");
                $reto = $creacion->crear();
                if ($reto) {
                    ?>
                    <script type="application/javascript">
                        alert('Se ha asignado correctamente');
                        window.location.href = "../comun.php";
                    </script>
                    <?php
                } else {
                    ?>
                    <script type="application/javascript">
                        alert('La asignación existe');
                        window.location.href = "../comun.php";
                    </script>
                    <?php
                }
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
                include('rpaProcesUserClass.php');
                $creacion = new rpaProcesUserClass('','','', '', '',$page,$per_page);

                $creacion->Paginador();
            } else {

                header('location:../comun.php');
            }
        } else {

            header('location:../comun.php');
        }

    }
        break;



    case 'nuevos_bots': {

        include('rpaProcesUserClass.php');
        $creacion = new rpaProcesUserClass('', '', $_POST['id'],$_POST["id_persona"], '',"","");
        $ok=$creacion->comprobar();
        if ($ok)
        {
            ?>
            <script language='javascript'>
                swal({
                    title: 'Instalador de Robots',
                    text: 'No hay nuevos bot pendientes',
                    timer: 3000,
                    showConfirmButton: false
                }).then(
                    function () {
                    },
                    // handling the promise rejection
                    function (dismiss) {
                        if (dismiss === 'timer') {
                            window.location.href = "./comun.php";
                        }
                    }
                )
            </script>
            <?php

        }
        else
        {
echo "";
        }

    }
        break;


    case 'editar_robot_use': {

        if (isset($_GET['modo'])) {

            if (!empty($_POST['name'])) {
                if (empty($_POST['date'])) {
                    $fecha = new DateTime();
                    $_POST['date'] = $fecha->format('Y-m-d H:i:s');
                }
                include('rpaProcesUserClass.php');
                $creacion = new rpaProcesUserClass('', '', '','', '',"","");
                $reto = $creacion->editar();
                if ($reto) {
                    ?>
                    <script language='javascript'>
                        alert('Se ha Actualizado correctamente');
                        window.location.href = "../comun.php";
                    </script>
                    <?php


                    //header('location:../desarrollo/administrador.php');
                } else {
                    ?>
                    <script language='javascript'>
                        swal({
                            title: 'Eliminar bot´s',
                            text: 'No se ha podido actualizar este bot´s',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(
                            function () {
                            },
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    console.log('I was closed by the timer');
                                    window.location.href = "./comun.php";
                                }
                            }
                        )
                    </script>
                    <?php

                    header('location:../comun.php');
                }
            } else {

                header('location:../comun.php');
            }
        } else {

            header('location:../comun.php');
        }

    }
        break;

    case 'eliminar_bots_user': {
        if (isset($_POST['modo'])) {

            if (!empty($_POST['id'])) {

                include('rpaProcesUserClass.php');
                $delete = new rpaProcesUserClass($_POST['id'], '', '', '','',"","");
                $reto = $delete->eliminar();
                if ($reto) {
                    ?>
                    <script type="application/javascript">
                        alert('Se ha podido eliminar el bots');
                    </script>
                    <?php
                    header('location:../desarrollo/asignacion.php');
                } else {
                    ?>
                    <script language='javascript'>
                        swal({
                            title: 'Eliminar bot´s',
                            text: 'No se ha podido eliminar este bot´s, tiene tablas relacionadas',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(
                            function () {
                            },
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    console.log('I was closed by the timer');
                                    window.location.href = "./comun.php";
                                }
                            }
                        )

                    </script>
                    <?php

                }
            } else {

                header('location:../desarrollo/administrador.php');
            }
        } else {


            header('location:../desarrollo/administrador.php');
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



