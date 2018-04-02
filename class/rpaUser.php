<?php
//Interface y clase de administracion de usuarios
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
    case 'crearUser': {
        if (isset($_POST['idInterno']) and isset($_POST['logIn']) and isset($_POST['name'])) {

            if (!empty($_POST['idInterno']) and !empty($_POST['logIn'])) {

                    $fehcaActual = date_create()->format('Y-m-d H:i:s');
                if(isset($_POST['enable']) and !empty($_POST['enable'])){
                    $enabled = 1;
                }
                else
                {
                    $enabled = 0;
                }

                if(isset($_POST['admin']) and !empty($_POST['admin'])){
                    $admin = "S";
                }
                else
                {
                    $admin = "N";
                }



                include('rpaUserClass.php');
                $creacion = new rpaUserClass('',$_POST['idInterno'],$_POST['name'],$_POST['apellidos'],$_POST['email'],$_POST['logIn'],md5($_POST['pass']),$admin,'',$enabled,$_POST['addUser'],$fehcaActual,'','');
                $reto = $creacion->crear();
                if ($reto) {

                    ?>
                    <script language='javascript'>
                        alert('Se ha añadido correctamente');
                        window.location.href = "../comun.php";
                    </script>
                    <?php

                   // header('location:../comun.php');
                } else {

                    ?>
                    <script language='javascript'>
                        alert('Ya existe un Nombre del Login, elige otro');
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


    case 'editar_use': {

        if (isset($_GET['modo'])) {

            if (!empty($_POST['loginId'])) {
                if(isset($_POST['enable']) and !empty($_POST['enable'])){
                    $enabled = 1;
                }
                else
                {
                    $enabled = 0;
                }

                if(isset($_POST['admin']) and !empty($_POST['admin'])){
                    $admin = "S";
                }
                else
                {
                    $admin = "N";
                }
                if($_POST['pass'] == $_SESSION['pass'])
                {
                    $passwordd=$_POST['pass'];
                }
                else{
                    $passwordd=md5($_POST['pass']);

                }
                include('rpaUserClass.php');
                $creacion = new rpaUserClass($_POST['id'], $_POST['idPersona'], $_POST['name'], $_POST['apellido'],  $_POST['email'], $_POST['loginId'],$passwordd,$admin,'',$enabled,'','','','');
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
                            title: 'Administrador de usuarios',
                            text: 'No se ha podido actualizar este usuario',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(
                            function () {
                            },
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    console.log('I was closed by the timer');
                                    window.location.href = "../comun.php";
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

    case 'editar_perfil': {

        if (isset($_GET['modo'])) {

            if (!empty($_POST['loginId'])) {

                if($_POST['pass'] == $_SESSION['pass'])
                {
                    $passwordd=$_POST['pass'];
                }
                else{
                    $passwordd=md5($_POST['pass']);

                }
                include('rpaUserClass.php');
                $creacion = new rpaUserClass($_POST['id'], '', $_POST['name'], $_POST['apellido'],  $_POST['email'], $_POST['loginId'],$passwordd,'','','','','','','');
                $reto = $creacion->editarPerfil();
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
                            title: 'Administrador de usuarios',
                            text: 'No se ha podido actualizar este usuario',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(
                            function () {
                            },
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    console.log('I was closed by the timer');
                                    window.location.href = "../comun.php";
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

    case 'eliminarUser': {
        if (isset($_POST['modo'])) {

            if (!empty($_POST['id'])) {

                include('rpaUserClass.php');
                $delete = new rpaUserClass($_POST['id'], '', '', '','','','','','','','','','','');
                $reto = $delete->eliminar();
                if ($reto) {
                    ?>
                    <script language='javascript'>
                        swal({
                            title: 'Eliminar bot´s',
                            text: 'Se ha podido eliminar este usaurio',
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
                } else {
                    ?>
                    <script language='javascript'>
                        swal({
                            title: 'Eliminar bot´s',
                            text: 'No se ha podido eliminar este usaurio',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(
                            function () {
                            },
                            // handling the promise rejection
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    console.log('I was closed by the timer');
                                    window.location.href = "../comun.php";
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

    case 'paginar': {
        if (isset($_POST['page'])) {

            if (!empty($_POST['page'])) {
                $page = $_POST['page'];
                $per_page = $_POST['per_page'];
                include('rpaUserClass.php');
                $creacion = new rpaUserClass('','','','','','','','','','','','',$page,$per_page);
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



