if ( $("#contenido").length > 0 ) {
    $.ajax({
        type: "POST",
        async: true,
        url: 'estadisticas/graficos.php',
        success: function(data){
            $('#contenido').fadeIn(1000).html(data);}
    });
}




$('#link').click(function(e){
    let id = e.target.id;
    switch (id) {
        case 'estadistica':

            $.ajax({
                type: "POST",
                async: true,
                url: 'proceso/rpaAdmin.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;
        case 'process':

            $.ajax({
                type: "POST",
                async: true,
                url: 'proceso/proceso.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;
        case 'paso':

            $.ajax({
                type: "POST",
                async: true,
                url: 'proceso/paso.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;
        case 'grafo':

            $.ajax({
                type: "POST",
                async: true,
                url: 'estadisticas/graficos.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;

        case 'informes':

            $.ajax({
                type: "POST",
                async: true,
                url: 'estadisticas/informes.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;

        default:
            $.ajax({
                type: "POST",
                async: true,
                url: 'estadisticas/graficos.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
    }
});

    /*$(document).ready(function() {
        function update(){
            var current = $('#id').text();
            var sum = Number(current) + 3;
            var dataString = 'sum='+sum;

            $.ajax({
                type: "POST",
                url: "sum.php",
                data: dataString,
                success: function() {
                    $('#id').text(sum);
                }
            });
        }

        setInterval(update, 3000);
    });*/

$('#link2').click(function(e){
    let id = e.target.id;
    switch (id) {
        case 'crear':

            $.ajax({
                type: "POST",
                url: 'desarrollo/administradorUsuarios.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;
        case 'admin':

            $.ajax({
                type: "POST",
                url: 'desarrollo/administrador.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;

        case 'asignacion':

            $.ajax({
                type: "POST",
                url: 'desarrollo/asignacion.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;

        case 'instalar':

        $.ajax({
            type: "POST",
            url: 'desarrollo/instalar.php',
            success: function(data){
                $('#contenido').fadeIn(1000).html(data);}
        });
        break;

        case 'perfil':

            $.ajax({
                type: "POST",
                url: 'comunes/perfil.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
            break;


        default:
            $.ajax({
                type: "POST",
                url: 'estadisticas/graficos.php',
                success: function(data){
                    $('#contenido').fadeIn(1000).html(data);}
            });
    }
});