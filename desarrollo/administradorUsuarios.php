<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION['admin'] == "S"){
?>
<!--Panel-->
<div class="card text-center" style="width: 100%;">
    <div class="card-header ColorTab black-text">
        Administrador de bot´s
    </div>
    <div class="card-body ">
        <table class="table table-bordered">
            <thead class="455a64 blue-grey darken-2 white-text">
            <tr>
                <th>Id_persona</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>email</th>
                <th>Login</th>
                <th>Administrador</th>
                <th>Ultima sesión abierta</th>
                <th>Activado</th>
                <th>usuario Creador</th>
                <th>Fecha de creación</th>
                <th colspan="2">Opciones

                    <div class="btn-group">
                        <button class="btn dropdown-toggle 455a64 blue-grey darken-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-gear fa-3x white-text" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                            <a onclick="crearUsuarioNuevo()" >Crear Robot nuevo</a>
                        </div>
                    </div>

                </th>
            </tr>
            </thead>

            <tbody id="articleArea">


            </tbody>
            <nav class="my-4" id="pagination">
                <ul class="pagination pagination-circle pg-blue mb-0">
                    <a href="#" id="1"></a>
                </ul>
            </nav>

        </table>
    </div>
</div>
<!--/.Panel-->
<!--<script type="application/javascript">

    function eliminarPorcessClass (id) {
        $.post("class/rpaProces.php", {id: id, modo:'eliminar_bots'}, function(htmlexterno){
            $("#contenido").html(htmlexterno);
        });
    }

    function editarProcessClass (id) {
        $.post("./desarrollo/editar.php", {id: id}, function(htmlexterno){
            $("#contenido").html(htmlexterno);
        });
    }

</script>-->

<script type="application/javascript">
    function crearUsuarioNuevo () {
        $.post("./desarrollo/crearUsuarioNuevo.php", function(htmlexterno){
            $("#contenido").html(htmlexterno);
        });
    }

    //Paginacion de paso

    $('document').ready(function () {
        $("#pagination a").trigger('click'); // When page is loaded we trigger a click
    });

    $('#pagination').on('click', 'a', function (e) {
        let page = this.id;
        let pagination = '';

        $('#articleArea').html('<img src="imagenes/loader.gif" alt="" />'); // Display a processing icon
        let data = {modo: 'paginar', page: page, per_page: 5};

        $.ajax({
            type: 'POST',
            url: 'class/rpaUser.php',
            data: data,
            dataType: 'json',
            timeout: 3000,
            success: function (data) {

                $('#articleArea').html(data.articleList);

                if (page == 1) pagination += '<div class="cell_disabled"><span class="page-link">Primera</span></div><div class="cell_disabled"><span class="page-link">Anterior</span></div>';
                else pagination += '<div class="cell"><a href="#" id="1">Primera</a></div><div class="cell"><a href="#" id="' + (page - 1) + '">Anterior</span></a></div>';

                for (let i = parseInt(page) - 3; i <= parseInt(page) + 3; i++) {
                    if (i >= 1 && i <= data.numPage) {
                        pagination += '<div';
                        if (i == page) pagination += ' class="cell_active"><span>' + i + '</span>';
                        else pagination += ' class="cell"><a href="#" id="' + i + '">' + i + '</a>';
                        pagination += '</div>';
                    }
                }
                if (page == data.numPage) pagination += '<div class="cell_disabled"><span>Siguiente</span></div><div class="cell_disabled"><span>Ultima</span></div>';
                else pagination += '<div class="cell page-item"><a  href="#" id="' + (parseInt(page) + 1) + '">Siguiente</a></div><div class="cell"><a href="#" id="' + data.numPage + '">Ultima</span></a></div>';

                $('#pagination').html(pagination); // We update the pagination DIV
            },
            error: function () {
            }
        });
        return false;
    });
</script>
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