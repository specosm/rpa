<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION['admin'] == "S"){
?>
<div class="row">
<!-- Form register -->
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-6" style="padding-top: 30px;">
        <div class="text-center">
        <!-- Form contact -->
        <form class="form-control-feedback" method="post" action="class/rpaUser.php?modo=crearUser">

            <p class="h5 text-center mb-4">Crear Robot</p>

            <div class="md-form">

                <input required name="idInterno" type="number" id="form1" class="form-control">
                <label for="form1">Id interno de la empresa</label>
            </div>

            <div class="md-form">

                <input required name="name" type="text" id="form1" class="form-control">
                <label for="form1">Nombre</label>
            </div>

            <div class="md-form">

                <input name="apellidos" type="text" id="form2" class="form-control">
                <label for="form2">Apellidos</label>
            </div>


            <div class="md-form">

                <input name="email" type="email" id="form3" class="form-control">
                <label for="form3">Email</label>
            </div>

            <div class="md-form">

                <input name="logIn" type="text" id="form4" class="form-control">
                <label for="form4">Nombre del Login (Mismo nombre que usuario de la maquina)</label>
            </div>

            <div class="form-check">
                <label class="form-check-label ">
                    <input name="enable" id="form5" class="form-check-input" type="checkbox" value="1">
                    ¿Desea activar al usuario?
                </label>
            </div>

            <div class="md-form">

                <input required name="pass" type="password" id="form6" class="form-control">
                <label for="form6">Contraseña</label>
            </div>

            <div class="form-check">
                <label class="form-check-label ">
                    <input name="admin" id="form7" class="form-check-input" type="checkbox" value="1">
                    ¿Desea que este usuario sea administrador?
                </label>
            </div>

            <div class="text-center">
                <button class="btn btn-unique">Crear <i class="fa fa-paper-plane-o ml-1"></i></button>
                <input type="hidden" name="crearUser" value="1" />
                <input type="hidden" name="addUser" value="<?php echo $_SESSION['id_persona']; ?>" />
            </div>

        </form>
        <!-- Form register -->
</div>
</div>
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