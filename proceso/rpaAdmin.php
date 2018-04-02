<!--Panel-->
<div class="card text-center" style="width: 100%;">
    <div class="card-header ColorTab black-text">
        <a class="black-text"> Número de procesos disponibles</a>
    </div>
    <div class="card-body ">
        <table class="table table-bordered">
            <thead class="455a64 blue-grey darken-2 white-text">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Activado</th>
                <th>Versión</th>
                <th>Comentario de la versión</th>
                <th>Fecha de creación</th>
                <th>ID_Creador</th>
                <th>Ejecutar</th>
                <th>Parar</th>
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
<script type="application/javascript">
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
            url: 'class/rpaProcessAdmin.php',
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
