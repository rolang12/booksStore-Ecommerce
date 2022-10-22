<div>
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 200 px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

    </style>
    @if ($data->count() < 1)
    @else
        {{ $total = 0 }}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css"
            rel="stylesheet" />

        <div class=" mt-5" style="height: 3rem;">

        </div>
        <div class="container ">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="p-3 bg-white rounded">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="text-uppercase badge-warning">Historial</h1>
                                <div class="billed mb-2 mt-5 "><span
                                        class="font-weight-bold text-uppercase">Client:</span><span
                                        class="ml-1">{{ Auth()->user()->name . ' ' . Auth()->user()->last_name }}</span>
                                </div>
                                <div class="billed"><span
                                        class="font-weight-bold text-uppercase">Date:</span><span
                                        class="ml-1">{{ \Carbon\Carbon::now() }}</span></div>
                            </div>
                            <div class="col-md-6 text-right mt-3">
                                <h4 class="text-primary mb-0">Books Shop</h4><span>Phone: xxx-xxxx-xxx</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="table-responsive" style="width:100%;overflow:auto; max-height:400px;">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Sale ID</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Product</th>
                                            <th class="text-center">Unit</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $d->sale_id }}</td>
                                                <td class="text-center">{{ substr($d->created_at, 0, -9) }}</td>
                                                <td class="text-center">{{ $d->product }}</td>
                                                <td class="text-center">{{ $d->quantity }}</td>
                                                <td>${{ number_format($d->price, 2) }}</td>
                                                <td>${{ number_format($d->quantity * $d->price, 2) }}</td>
                                            </tr>
                                            <div class="d-none">
                                                {{ $total = $total + $d->quantity * $d->price }}</div>
                                        @endforeach
                                        <tr>
                                            <td colspan="6"
                                                class="text-right font-weight-bold badge-secondary text-white">Total:
                                                ${{ number_format($total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
