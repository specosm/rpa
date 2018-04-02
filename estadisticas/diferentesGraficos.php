<div class="row">

    <div  class="col-sm-12 col-lg-12 col-md-12 col-xl-12">
        <canvas id="fallos" width="600" height="200"></canvas>
    </div>
</div>
<script type="application/javascript">
    $.ajax({
        type: "POST",
        dataType: "json",
        data:{id_rpa: <?php echo $_POST['id']; ?>,modo:'estadoTiempo'},
        url: "class/rpaGraficos.php",

        success: function (dataR)
        {
            var fallos = document.getElementById("fallos");

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            var dataFirst = {
                label: "successful",
                data: dataR.b,
                lineTension: 0.3,
                fill: false,
                borderColor: 'green',
                backgroundColor: 'transparent',
                pointBorderColor: 'green',
                pointBackgroundColor: 'lightgreen',
                pointRadius: 5,
                pointHoverRadius: 15,
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'rect'
            };

            var dataSecond = {
                label: "Fail",
                data: dataR.c,
                lineTension: 0.3,
                fill: false,
                borderColor: 'red',
                backgroundColor: 'transparent',
                pointBorderColor: 'red',
                pointBackgroundColor: 'red',
                pointRadius: 5,
                pointHoverRadius: 15,
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'rect'
            };

            var dataThird = {
                label: "Unknown state",
                data: dataR.d,
                lineTension: 0.3,
                fill: false,
                borderColor: 'orange',
                backgroundColor: 'transparent',
                pointBorderColor: 'orange',
                pointBackgroundColor: 'orange',
                pointRadius: 5,
                pointHoverRadius: 15,
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: 'rect'
            };

            var speedData = {
                labels: dataR.a,
                datasets: [dataFirst, dataSecond,dataThird]
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
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                },
                responsive: true,
                title: {
                    display: true,
                    text: ' [ '+dataR.e+' ] '+' Gráfica de estados en el tiempo'
                }

            };



            var lineChart = new Chart(fallos, {
                type: 'line',
                data: speedData,
                options: chartOptions
            });
        }
    });
</script>
