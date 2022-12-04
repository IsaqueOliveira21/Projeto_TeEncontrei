<script>
    Highcharts.chart('grafico2', {

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
                @foreach($categorias as $categoria)
                    '{{$categoria}}',
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

        series: [
            @foreach($graficos['grafico2'] as $serie => $valor)
                {
                    name: '{{$serie}}',
                    data: [
                        @foreach($valor as $qtd)
                            {{$qtd}},
                        @endforeach
                    ]
                },
            @endforeach
        ],

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
