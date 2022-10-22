@auth
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">

    {{-- @include('layouts.theme.header') --}}
    @if (Auth()->user()->profile == 'ADMIN')
        <div class="">
            <div class="h-100 mt-50 " style="margin-top: 20rem;">

            </div>
            <style>
                .mt-100 {
                    margin-top: 50rem;
                }

            </style>
            <div class="row h-100 col-md-6 widget widget-chart-one mt-5" style="margin-top: 10rem; height:20rem">
                <div id="container" style="width:100%; height:300px; margin-top:20rem; "></div>

            </div>
            <div>
                Users with purchases
            </div>
        </div>
    @endif
@endauth
<script>
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Users with purchases'
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
            name: 'Purchases',
            colorByPoint: true,
            data: <?= $users ?>
        }]
    });
</script>
