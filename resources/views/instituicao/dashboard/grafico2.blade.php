<script>
    Highcharts.chart('grafico2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'DESABRIGADOS COM E SEM DOCUMENTAÇÃO COMPLETA'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'DOCUMENTAÇÃO',
            colorByPoint: true,
            colors: ['#ED561B','#058DC7'],
            data: [
                @foreach($graficos['graficos2'] as $categoria => $valor)
                    {
                        name: '{{$categoria}}',
                        y: {{$valor}},
                    },
                @endforeach
            ]
        }]
    });
</script>
