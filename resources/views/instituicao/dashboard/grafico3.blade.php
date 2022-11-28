<script>
    Highcharts.chart('grafico3', {

        title: {
            text: 'QUANTIDADE DE VISITAS NO ÚLTIMO ANO'
        },

        yAxis: {
            title: {
                text: 'QUANTIDADE DE VISITAS'
            }
        },

        xAxis: {
            categories: [
                @foreach($graficos['grafico3'] as $categoria => $valor)
                    '{{ $categoria }}',
                @endforeach
            ]
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
            }
        },

        series: [{
            name: 'QUANTIDADE',
            data: [
                @foreach($graficos['grafico3'] as $valor)
                    {{ $valor }},
                @endforeach
            ]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
</script>
