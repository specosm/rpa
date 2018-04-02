<?php
if ((isset($_POST['id'])) and ($_POST['id'] != "")) {
    $id = $_POST['id'];
}

?>
<div id="procesoso" class="card text-center" style="width: 100%;">

    <div class="card-header ColorTab black-text">
        ERRORES CONTROLADOS DE EJECUCION DE PROCESOS
    </div>
    <nav class="card-body">

        <table class="table table-bordered">
            <thead class="455a64 blue-grey darken-2 white-text">
            <tr>
                <th>Id_Proceso</th>
                <th>Comentario</th>
                <th>Fecha del Error</th>
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


<script type="application/javascript">

    //Paginacion de paso

    $('document').ready(function () {
        $("#pagination a").trigger('click'); // When page is loaded we trigger a click
    });

    $('#pagination').on('click', 'a', function (e) {
        let page = this.id;
        let pagination = '';

        $('#articleArea').html('<img src="imagenes/loader.gif" alt="" />'); // Display a processing icon
        let data = {id:<?php echo $id; ?>,modo: 'paginar', page: page, per_page: 8};

        $.ajax({
            type: 'POST',
            url: 'class/rpaProcessWorkSequenceWarning.php',
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