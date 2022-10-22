<div class="row ">
    <div class="col-sm-12">
        <div>
            <div class="connect-sorting">
                <h5 class="text-center mb-3">
                    Sale Resume
                </h5>
                <div class="connet-sorting-content">
                    <div class="card simple-normal-title-task ui-sortable-handle">
                        <div class="card-body ">
                            <div class="task-header">
                                <div>
                                    <h2>Total: ${{number_format($total,2)}}</h2>
                                    <input type="hidden" value="{{$total}}" id="hiddenTotal">
                                </div>
                                <div><h4 class="mt-2">Articles: {{$itemsQuantity}}</h4></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>