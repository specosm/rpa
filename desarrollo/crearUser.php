<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION['admin'] == "S"){

require_once "../bbdd/modelo.php";
$query = $db->query("SELECT DISTINCT rpa_process.id as idBot,rpa_process.id_rpa as idRpa, rpa_process.name as nameBot FROM rpa_process");
$queryUser = $db->query("SELECT DISTINCT user.id as idUser, user.first_name as nombre, user.last_name as apellido FROM user");
?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 col-xl-2" style="padding-top: 30px;">
    </div>
    <div class="col-sm-8 col-lg-8 col-md-8 col-xl-8" style="padding-top: 30px;">
        <div class="text-center">
            <!-- Form contact -->
            <form class="form-control-feedback" method="post" action="./class/rpaProcesUse.php?modo=crear_robot_user">

                <p class="h5 text-center mb-4">Asignación de Procesos a Robot´s</p>
                <div class="md-form">
                    <select style="width: 500px" title="Nombre del bot´s"  name="bot" class="custom-select">
                        <?php
                        while($row=$query->fetch_array(MYSQLI_ASSOC)) {
                            ?>

                            <option value="<?php echo $row['idRpa'];?>"><?php echo "(".$row['idRpa'].")".$row['nameBot'];?></option>
                            <?php
                        }

                        $rows= $id->num_rows;

                        if($rows > 0) {
                            mysqli_data_seek($id, 0);
                            $row=$query->fetch_assoc();

                        }
                        $query->close();
                        ?>
                    </select>
                    <label>Procesos</label>
                </div>

                <div class="md-form">
                    <select style="width: 500px" title="id del usuario"  name="user" class="custom-select">
                        <?php
                        while($row=$queryUser->fetch_array(MYSQLI_ASSOC)) {
                            ?>

                            <option value="<?php echo $row['idUser'];?>"><?php echo "(".$row['idUser'].")".$row['nombre']." ".$row['apellido'];?></option>
                            <?php
                        }
                        $rows= $id->num_rows;

                        if($rows > 0) {
                            mysqli_data_seek($id, 0);
                            $row=$queryUser->fetch_assoc();

                        }
                        ?>
                    </select>
                    <label>Robot´s</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-calendar prefix green-text" aria-hidden="true"></i>
                    <input data-format="Y-m-d"  data-lang="es" name="date" type="text" id="form5" class="" >
                    <label for="form5"></label>
                </div>
                <script type="application/javascript">

                    $('#form5').dateDropper();
                </script>

                <div class="text-center">
                    <button class="btn btn-unique">Crear <i class="fa fa-paper-plane-o ml-1"></i></button>
                    <input type="hidden" name="crear_robot_user" value="1" />
                    <input type="hidden" name="id_persona" value="<?php echo $_SESSION["id_persona"] ?>" />
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