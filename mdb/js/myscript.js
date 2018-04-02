//Actualizar contenido de la página paso
function actualizar(){
    $("#procesoso").empty().load("proceso/paso.php");
}

//Actualizar contenido de la pagina proceso
function actualizarProceso(){


    $("#procesoso").empty().load("proceso/proceso.php");
}

//back contenido grafico tiempo porcesos
function procesoInformeTiempografico(id)
{

    $.post("estadisticas/diferentesInformes.php", {id: id }, function(htmlexterno){
        $("#procesoso").html(htmlexterno);
    });
}


//back contenido grafico porcesos
function procesoInforme()
{
    $("#procesoso").empty().load("estadisticas/informes.php");
}


function filtro(id_filtro) {

    $.post("proceso/paso.php", {id: id_filtro }, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });

}


function filtroError(id_filtro) {

    $.post("proceso/pasoError.php", {id: id_filtro }, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });

}

function filtroWarning(id_filtro) {

    $.post("proceso/pasoWarning.php", {id: id_filtro }, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });

}

// ejecutar el bot´s según el boton pulsado de la página estádisticas
function identificador(id,modo) {

    $.ajax({
        type: "POST",
        dataType: "json",
        data:  {'modo' :modo, 'id':id},
        url: "bat/bot.php",
        success: function (dataR)
        {
            alert(dataR);

            $.post("proceso/proceso.php", {id: dataR}, function(htmlexterno){
                $("#contenido").html(htmlexterno);
            });

        }
    });


}


// Eliminar y editar de la parte de adminsitrar de bot´s
function eliminarPorcessClass (id) {
    $.post("./class/rpaProces.php", {id: id, modo:'eliminar_bots'}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

function editarProcessClass (id) {
    $.post("./desarrollo/editar.php", {id: id}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

// Eliminar y editar de la parte de asignacion de bot´s
function eliminarPorcess_userClass (id) {
    $.post("./class/rpaProcesUse.php", {id: id, modo:'eliminar_bots_user'}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}


// comprobat nuevas versiones
function comprobar (id) {
    $.post("./class/rpaProcesUse.php", {id:id, modo:'nuevos_bots'}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

// Eliminar y editar de la parte de adminsitrar de usuarios
function eliminarUser(id) {
    $.post("./class/rpaUser.php", {id: id, modo:'eliminarUser'}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

function editarUser (id) {
    $.post("./desarrollo/editarUsuario.php", {id: id}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

// Ver Graficos por id

function verGraficos (id) {
    $.post("./estadisticas/diferentesGraficos.php",{id: id}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

// Ver informes por id

function verInformes (id) {
    $.post("./estadisticas/diferentesInformes.php",{id: id}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

function informesContable (id) {
    $.post("./estadisticas/informesContable.php",{id: id}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

function informesNoContable (id) {
    $.post("./estadisticas/informesNoContable.php",{id: id}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

function informesTiempo (id) {
    $.post("./estadisticas/InformesTiempo.php",{id: id}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}

function informesTiempoGrafico (id) {

    $.post("./estadisticas/informeGraficosTiempo.php",{id: id}, function(htmlexterno){
        $("#contenido").html(htmlexterno);
    });
}



