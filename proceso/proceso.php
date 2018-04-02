<div id="procesoso" class="card text-center" style="width: 100%;">
    <div class="card-header ColorTab black-text">
       PROCESOS
    </div>
    <div class="card-body process">
        <table class="table table-bordered">
            <thead class=" 455a64 blue-grey darken-2 white-text">
            <tr>
                <th>Id</th>
                <th>Id_bots</th>
                <th>Referencia</th>
                <th>Fecha de Inicio</th>
                <th>Usuario de sesión</th>
                <th>Fecha de Fín Ok</th>
                <th>Estado del proceso</th>
                <th>Ver Tracking</th>
                <th>Ver Warning</th>
                <th>Ver Errores</th>
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
    <div class="card-footer text-muted ColorTab black-text">
        <input onclick="actualizarProceso()" class="btn bcaaa4 brown lighten-3" type="button" id="start" value="Actualizar Datos">
    </div>

</div>
<!--/.Panel-->
<!--<script>
    function actualizarProceso(){


        $("#procesoso").empty().load("proceso/proceso.php");
    }
    //setInterval( "actualizar()", 10000 );
    function filtro(id_filtro) {
        $.post("proceso/paso.php", {id: id_filtro}, function(htmlexterno){
            $("#contenido").html(htmlexterno);
        });

    }
</script>-->

<script type="application/javascript">

    //Paginacion de paso

    $('document').ready(function () {
        $("#pagination a").trigger('click'); // When page is loaded we trigger a click
    });

    $('#pagination').on('click', 'a', function (e) {
        let page = this.id;
        let pagination = '';

        $('#articleArea').html('<img src="imagenes/loader.gif" alt="" />'); // Display a processing icon
        let data = {modo: 'paginar', page: page, per_page: 8};

        $.ajax({
            type: 'POST',
            url: 'class/rpaProcessWork.php',
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
