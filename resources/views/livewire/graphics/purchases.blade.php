<div>
    @if (Auth()->user()->profile == 'ADMIN')
        <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
        <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

        <div class="row col-md-6" style="margin-top: 13rem">
            <div class="ct-chart ct-perfect-fourth"></div>
        </div>
    @endif
</div>

<div class="h-100%" >
<label for="">From</label>
    <input wire:model='fromDate' type="date" name="" id="">From
    <input wire:model='toDate' type="date" name="" id="">To


</div>

<script>
    $(document).ready(function() {

        var labels = JSON.parse(`<?php echo $labels; ?>`)

        var data = {
            // A labels array that can contain any sort of values
            labels: labels,
            // Our series array that contains series objects or in this case series data arrays
            series: [
                <?= $sales ?>
            ]
        };

        // As options we currently only set a static size of 300x200 px. We can also omit this and use aspect ratio containers
        // as you saw in the previous example
        var options = {
            width: 300,
            height: 100
        };

        // Create a new line chart object where as first parameter we pass in a selector
        // that is resolving to our chart container element. The Second parameter
        // is the actual data object. As a third parameter we pass in our custom options.
        new Chartist.Bar('.ct-chart', data, options);

    });
</script>
