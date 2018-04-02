<?php
session_start();
?>
<div id="procesoso">
<div class="row">
    <div  class="col-sm-8 col-lg-8 col-md-8 col-xl-8">
        <canvas id="fallos" width="480" height="200"></canvas>
    </div>
</div>
    <div class="row">
        <div  class="col-sm-2 col-lg-2 col-md-2 col-xl-2">
            <div class="card-link text-muted black-text">
                <input onclick="procesoInformeTiempografico(<?php echo $_SESSION["backInformesDetalle"]; ?>)" class="btn btn-outline-default btn-rounded waves-effect" type="button"  value="Volver">
            </div>
        </div>
    </div>

</div>
<script type="application/javascript">
    $.ajax({
        type: "POST",
        dataType: "json",
        data:{id_rpa: <?php echo $_POST['id']; ?>,modo:'informeGraficoEstadoTiempo'},
        url: "class/rpaGraficos.php",

        success: function (dataR)
        {
            var fallos = document.getElementById("fallos");

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 12;

            var dataFirst = {
                label: "Linea en el tiempo",
                data: dataR.b,
                lineTension: 0.2,
                fill: true,
                borderColor: 'green',
                backgroundColor: 'lightgreen'
            };

            var speedData = {
                labels: dataR.a,
                datasets: [dataFirst]
            };


            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 20,
                        fontColor: 'black'
                    }
                },

                scales: {
                    yAxes: [{
                        ticks: {
                            stacked: true,
                            beginAtZero: true,
                            stepSize: 2
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            offsetGridLines: true
                        },
                        stacked: true
                    }]

                },
                responsive: true,
                title: {
                    display: true,
                    text: ' [ '+dataR.c+' ] '+' Gráfica de estados en el tiempo '
                }

            };



            var lineChart = new Chart(fallos, {
                type: 'bar',
                data: speedData,
                options: chartOptions
            });
        }
    });
</script>
