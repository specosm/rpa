<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION['admin'] == "S"){
?>
<div class="row ">
    <!-- Form register -->
    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-6" style="padding-top: 30px;">

        <!--Panel-->
        <div class="card card-body">
            <h4 class="card-title">Instalador de nuevos Proceso</h4>
            <p class="card-text">Pulsa el boton de comprobar para instalar un nuevo bots</p>
            <div class="flex-row">
                <a onclick="comprobar(<?php echo $_SESSION['id']; ?>)" class="btn btn-elegant">Comprobar</a>
            </div>
        </div>
        <!--/.Panel-->


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