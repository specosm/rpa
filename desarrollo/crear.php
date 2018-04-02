<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION['admin'] == "S"){
?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 col-xl-2" style="padding-top: 30px;">
    </div>
    <div class="col-sm-8 col-lg-8 col-md-8 col-xl-8" style="padding-top: 30px;">
        <div class="text-center">
        <!-- Form contact -->
        <form class="form-control-feedback" method="post" action="class/rpaProces.php?modo=crear_robot">

            <p class="h5 text-center mb-4">Crear Procesos</p>

            <div class="md-form">

                <input required name="idRpa" type="number" id="form1" class="form-control text-center">
                <label for="form1">Id del Proceso</label>
            </div>

            <div class="md-form">

                <input required name="name" type="text" id="form1" class="form-control text-center">
                <label for="form1">Nombre</label>
            </div>

            <div class="md-form">

                <input name="des" type="text" id="form2" class="form-control text-center">
                <label for="form2">Descripción</label>
            </div>

            <div class="form-check">
                <label class="form-check-label ">
                    <input name="enable" id="form3" class="form-check-input" type="checkbox" value="1">
                    ¿Desea activar el Proceso´s para su ejecución?
                </label>
            </div>


            <div class="md-form">

                <input name="version" type="text" id="form4" class="form-control text-center">
                <label for="form4">Versión</label>
            </div>

            <div class="md-form">

                <label for="form6">Comentario de la versión</label>
                <textarea name="version_txt" type="text" id="form6" class="form-control text-center" rows="7"></textarea>
            </div>

            <div class="md-form">

                <input readonly value="<?php echo $_SESSION["id_persona"]; ?>" name="add_user" type="text" id="form8" class="form-control text-center">
                <label for="form8">Add User</label>
            </div>

            <div class="form-group">
                <input name="file" type="file" class=" right" id="form7" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Puedes adjuntar un archivo</small>
            </div>


            <div class="md-form">
                <i class="fa fa-calendar prefix green-text" aria-hidden="true"></i>
                <input data-format="Y-m-d"  data-lang="es" name="date" type="text" id="form5" class="form-control" >
                <label for="form5"></label>
            </div>
            <script type="application/javascript">

                $('#form5').dateDropper();
            </script>

            <div class="text-center">
                <button class="btn btn-unique">Crear Proceso<i class="fa fa-paper-plane-o ml-1"></i></button>
                <input type="hidden" name="crear_robot" value="1" />
            </div>

        </form>
        <!-- Form register -->
</div>
</div>
    <div class="col-sm-2 col-lg-2 col-md-2 col-xl-2" style="padding-top: 30px;">
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

?>