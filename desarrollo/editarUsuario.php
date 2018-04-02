<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION['admin'] == "S"){

require_once "../bbdd/modelo.php";
if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
    $query = $db->query("SELECT * FROM user where id = '".$_POST['id']."'");
    $row = $db->mostrar($query);
}

?>
<div class="row">
    <!-- Form register -->
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-6" style="padding-top: 30px;">

    <form class="form-control-feedback" method="post" action="class/rpaUser.php?modo=editar_use">
                <p class="h5 text-center mb-4">Editar Robot</p>

                <div class="md-form">
                    <input value="<?php echo $row['id_persona']; ?>" name="idPersona" type="number" id="form0" class="form-control">
                    <label class="active" for="form0">Id interno de la empresa</label>
                </div>

                    <div class="md-form">
                        <input value="<?php echo $row['first_name']; ?>" name="name" type="text" id="form1" class="form-control">
                        <label class="active" for="form1">Nombre</label>
                    </div>

                <div class="md-form">

                    <input value="<?php echo $row['last_name']; ?>" name="apellido" type="text" id="form2" class="form-control">
                    <label class="active" for="form2">Apellidos</label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input  name="enable" id="form3" <?php if($row['enabled']){echo "checked=\"checked \"";} ?>  class="form-check-input" type="checkbox">
                        ¿Desea activar al usuario?
                    </label>
                </div>

                <div class="md-form">

                    <input value="<?php echo $row['login_id']; ?>" name="loginId" type="text" id="form7" class="form-control">
                    <label class="active" for="form7">Nombre del Login (Mismo nombre que usuario de la maquina)</label>
                </div>


                <div class="md-form">

                    <input value="<?php echo $row['email']; ?>" name="email" type="email" id="form4" class="form-control">
                    <label class="active" for="form4">Email</label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input  name="admon" id="form5" <?php if($row['admon']){echo "checked=\"checked \"";} ?>  class="form-check-input" type="checkbox">
                        ¿Desea que este usuario sea administrador?
                    </label>
                </div>


                <div class="md-form">

                    <input value="<?php echo $row['password']; ?>" name="pass" type="password" id="form6" class="form-control">
                    <label class="active" for="form6">Contraseña</label>
                </div>

                <div class="text-center">
                    <button class="btn btn-unique">Actualizar<i class="fa fa-paper-plane-o ml-1"></i></button>
                    <input type="hidden" name="editar_use" value="1" />
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                </div>

            </form>
            <!-- Form register -->

    </div>
    <?php
}else
{
    session_start();
    session_destroy();
    ?>
    <script language='javascript'>
        swal({
            title: 'RPA ADMINISTRATION & ANALYTICS',
            text: 'No tienes acceso a este Área',
            timer: 2000,
            showConfirmButton: false,
        }).then(
            function () {
            },
            // handling the promise rejection
            function (dismiss) {
                if (dismiss === 'timer') {
                    console.log('I was closed by the timer')
                    window.location.href = "../comun.php";
                }
            }
        )
    </script>
    <?php

}

?>