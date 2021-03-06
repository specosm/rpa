<?php
session_start();
if(isset($_SESSION["user"]) and $_SESSION['admin'] == "S"){

require_once "../bbdd/modelo.php";
$query = $db->query("SELECT user.first_name as nombre, user.last_name as apellido, rpa_process_user.id_rpa_process as id_rpa_process, rpa_process.name as name,
rpa_process_user.id_user as id_user, rpa_process_user.add_date as add_date, rpa_process_user.add_user as add_user,
rpa_process_user.id as id 
FROM rpa_process_user,rpa_process,user where rpa_process_user.id_rpa_process=rpa_process.id_rpa and rpa_process_user.id_user=user.id");
$num = $db->row_num($query);
?>
<!--Panel-->
<div class="card text-center" style="width: 100%;">
    <div class="card-header ColorTab black-text">
        Asignación de procesos disponibles a bot´s
    </div>
    <div class="card-body ">
        <table class="table table-bordered">
            <thead class="455a64 blue-grey darken-2 white-text">
            <tr>
                <th>Id</th>
                <th>Nombre del bot´s</th>
                <th>Id del usuario</th>
                <th>Fecha de creación</th>
                <th>Id de desarrollador</th>
                <th class="text-center">
                    <div class="btn-group">
                        <button class="btn dropdown-toggle 455a64 blue-grey darken-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-gear fa-3x white-text" aria-hidden="true"></i></button>
                        <div class="dropdown-menu">
                            <a onclick="crearProcess_userClass()" >Crear asignación de Proceso</a>
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
    <div class="card-footer text-muted success-color white-text">
        <p class="mb-0"> <?php echo $num;?></p>
    </div>
</div>
<script type="application/javascript">
    function crearProcess_userClass () {
        $.post("./desarrollo/crearUser.php", function(htmlexterno){
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
            url: 'class/rpaProcesUse.php',
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