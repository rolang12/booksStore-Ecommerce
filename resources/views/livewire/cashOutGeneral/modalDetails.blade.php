<div wire:ignore.self id="modal-details" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>Sale Detail</b>
                </h5>
                <button class="close" data-dismiss="modal" type="button" aria-label="close">
                    <span class="text-white">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                            <tr>
                                <th class="table-th text-center text-white">Product</th>
                                <th class="table-th text-center text-white">Quantity</th>
                                <th class="table-th text-center text-white">Price</th>
                                <th class="table-th text-center text-white">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($details as $detail)
                                <tr>
                                    <td class="text-center">
                                        <h6>{{ $detail->product }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ $detail->quantity }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>${{ number_format($detail->price, 2) }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{ number_format($detail->quantity * $detail->price, 2) }}</h6>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <td class="text-right">
                                <h6 class="text-info">Totals:</h6>
                            </td>
                            <td class="text-center">

                                @if ($details)
                                    <h6 class="text-info">{{ $details->sum('quantity') }}</h6>
                                @endif

                            </td>

                            @if ($details)
                                @php
                                    $myTotal = 0;
                                @endphp
                                @foreach ($details as $item)
                                    @php
                                        $myTotal += $item->quantity * $item->price;
                                    @endphp
                                @endforeach
                                <td></td>
                                <td class="text-center">
                                    <h6 class="text-info"> ${{ number_format($myTotal, 2) }}</h6>
                                </td>
                            @endif

                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
