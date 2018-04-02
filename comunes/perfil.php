<?php
require_once "../bbdd/modelo.php";
session_start();
    $query = $db->query("SELECT * FROM user where id = '".$_SESSION['id']."'");
    $row = $db->mostrar($query);


?>
<div class="row">
    <!-- Form register -->
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-6" style="padding-top: 30px;">

    <form class="form-control-feedback" method="post" action="class/rpaUser.php?modo=editar_perfil">
                <p class="h5 text-center mb-4">Editar Usuario</p>

                    <div class="md-form">
                        <input value="<?php echo $row['first_name']; ?>" name="name" type="text" id="form1" class="form-control">
                        <label class="active" for="form1">Nombre</label>
                    </div>

                <div class="md-form">

                    <input value="<?php echo $row['last_name']; ?>" name="apellido" type="text" id="form2" class="form-control">
                    <label class="active" for="form2">Apellidos</label>
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
                <input disabled id="form3" <?php if($row['enabled']){echo "checked=\"checked \"";} ?>  class="form-check-input" type="checkbox">
                Usuario Activado
            </label>
        </div>






                <div class="md-form">

                    <input value="<?php echo $row['password']; ?>" name="pass" type="password" id="form6" class="form-control">
                    <label class="active" for="form6">Contraseña</label>
                </div>

        <div class="form-check">
            <label class="form-check-label">
                <input disabled id="form5" <?php if($row['admon']){echo "checked=\"checked \"";} ?>  class="form-check-input" type="checkbox">
                Administrador
            </label>
        </div>

                <div class="text-center">
                    <button class="btn btn-unique">Actualizar<i class="fa fa-paper-plane-o ml-1"></i></button>
                    <input type="hidden" name="editar_perfil" value="1" />
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                </div>

            </form>
            <!-- Form register -->

    </div>
