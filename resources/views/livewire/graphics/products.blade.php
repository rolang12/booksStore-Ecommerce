@if (Auth()->user()->profile == 'ADMIN')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style>
        .mt-50 {
            margin: 90%;
        }

        .z-in {
            z-index: 50;
        }

    </style>

    <div class="container">

        <div id="container" class="row z-index mt-50 col-md-6" style="margin-top: 20rem;">



        </div>
        <div class="col-sm-12 col-md-3">

            <div class="form-group">
                <label>Initial Date</label>
                <input class="form-control" type="date" wire:model.lazy="fromDate">
                @error('fromDate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-sm-12 col-md-3">
            <div class="form-group">
                <label>Final Date</label>
                <input class="form-control" type="date" wire:model.lazy="toDate">
                @error('toDate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
@endif

<script>
    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: ' Browser market shares. January, 2018'
        },
        subtitle: {
            text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'More bought products'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f}</b> of total<br />'
        },

        series: [{
            name: "Sales",
            colorByPoint: true,
            data: <?= $products ?>
        }],

    });
</script>
