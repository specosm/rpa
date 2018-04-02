<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION['admin'] == "S"){

require_once "../bbdd/modelo.php";
if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
    $query = $db->query("SELECT * FROM rpa_process where id = '".$_POST['id']."'");
    $row = $db->mostrar($query);
}

?>
<div class="row">
    <!-- Form register -->
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-6" style="padding-top: 30px;">
        <div class="text-center">
            <!-- Form contact -->
            <form class="form-control-feedback" method="post" action="class/rpaProces.php?modo=editar_robot">

                <p class="h5 text-center mb-4">Editar Proceso</p>

                <div class="md-form">
                    <input value="<?php echo $row['id_rpa']; ?>" name="idRpa" type="text" id="form1" class="form-control">
                    <label class="active" for="form1">Id del Bots</label>
                </div>

                    <div class="md-form">
                        <input value="<?php echo $row['name']; ?>" name="name" type="text" id="form1" class="form-control">
                        <label class="active" for="form1">Nombre</label>
                    </div>

                <div class="md-form">

                    <input value="<?php echo $row['description']; ?>" name="des" type="text" id="form2" class="form-control">
                    <label class="active" for="form2">Descripción</label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input  name="enable" id="form3" <?php if($row['enabled']){echo "checked=\"checked \"";} ?>  class="form-check-input" type="checkbox">
                        ¿Desea activar el bot´s para su ejecución?
                    </label>
                </div>


                <div class="md-form">

                    <input value="<?php echo $row['version']; ?>" name="version" type="text" id="form4" class="form-control">
                    <label class="active" for="form4">Versión</label>
                </div>

                <div class="md-form">

                    <label class="active" for="form6">Comentario de la versión</label>
                    <textarea name="version_txt" type="text" id="form6" class="form-control" rows="5"><?php echo $row['version_comments']; ?></textarea>
                </div>

                <div class="md-form">

                    <input value="<?php echo $row['add_user']; ?>" name="add_user" type="text" id="form8" class="form-control">
                    <label class="active" for="form8">Add User</label>
                </div>

                <div class="form-group">
                    <input value="<?php echo $row['proyect']; ?>" name="file" type="file" class=" right" id="form7" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Puedes subir el proyecto comprimido</small>
                </div>


                <div class="md-form">
                    <i class="fa fa-pencil prefix grey-text"></i>
                    <input value="" data-format="Y-m-d"  data-lang="es" name="date" type="text" id="form5" class="form-control" >
                    <label class="active" for="form5">Actual: <?php echo $row['add_date']; ?></label>
                </div>
                <script type="application/javascript">
                    $('#form5').dateDropper();
                </script>

                <div class="text-center">
                    <button class="btn btn-unique">Actualizar <i class="fa fa-paper-plane-o ml-1"></i></button>
                    <input type="hidden" name="editar_robot" value="1" />
                    <input type="hidden" name="id" value="<?php echo $row['id']?>" />
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