@include('layouts.theme.header')
@auth

    <div>
        @if ($cartCollection->isEmpty())
            <div class=" mt-5" style="height: 12rem;">

            </div>
            <div class="container">
                <div class="card text-white bg-dark mb-3 text-center">
                    <div class="card-header">Add Products in you Cart!</div>
                    <div class="card-body">
                        <h4 class="card-title">Card Empty</h4>
                        <p class="card-text text-white ">Be sure that you Shop Cart has products!.
                        </p>
                        <a class="mt-2 btn btn-warning text-black-50 " href="{{ route('home') }}">Back Home</a>
                    </div>
                </div>
            </div>
        @else
            {{ $subtotal = 0 }}
            {{ $total = 0 }}
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css"
                rel="stylesheet" />

            <div class=" mt-5" style="height: 3rem;">

            </div>
            <div class="container ">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="d-flex justify-content-center row">
                    <div class="col-md-8">
                        <div class="p-3 bg-white rounded">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="text-uppercase badge-warning">Invoice Data</h1>
                                    <div class="billed mb-2 mt-5 "><span
                                            class="font-weight-bold text-uppercase">Client:</span><span
                                            class="ml-1">{{ Auth()->user()->name . ' ' . Auth()->user()->last_name }}</span>
                                    </div>
                                    <div class="billed mb-2"><span
                                            class="font-weight-bold text-uppercase">Date:</span><span
                                            class="ml-1">{{ \Carbon\Carbon::now() }}</span>
                                    </div>
                                    <div class="billed mb-2"><span
                                            class="font-weight-bold text-uppercase">Email:</span><span
                                            class="ml-1">{{ Auth()->user()->email }}</span>
                                    </div>
                                    <div class="billed mb-2"><span
                                            class="font-weight-bold text-uppercase">Address:</span><span
                                            class="ml-1">{{ Auth()->user()->address }}</span>
                                    </div>
                                    <div class="billed mb-2"><span class="font-weight-bold text-uppercase">Payment
                                            Method:</span><span class="ml-1">{{ $methodPayment }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right mt-3">
                                    <h4 class="text-primary mb-0">Books Shop</h4><span>Phone: xxx-xxxx-xxx</span>
                                </div>
                            </div>

                            <div> <a class="btn btn-warning text-black-50 font-weight-bold w-25"
                                    href="{{ route('home') }}">Back</a> </div>

                            <div class="mt-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sale ID</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Product</th>
                                                <th class="text-center">Unit</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cartCollection as $d)
                                                <tr>

                                                    <td class="text-center">{{ $saleId }}</td>
                                                    <td class="text-center">{{ \Carbon\Carbon::now() }}</td>
                                                    <td>{{ $d->name }}</td>
                                                    <td>{{ $d->quantity }}</td>
                                                    <td>${{ number_format($d->price, 2) }}</td>
                                                    <td>${{ number_format($d->quantity * $d->price, 2) }}</td>
                                                </tr>
                                                <div class="d-none">
                                                    Sub-Total: ${{ $subtotal = $subtotal + $d->quantity * $d->price }}
                                                </div>
                                            @endforeach
                                            <tr>
                                                <td colspan="6" class="font-weight-bold">
                                                    Total: ${{ number_format($subtotal, 2) }}
                                                </td>
                                            </tr>

                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="badge-success btn-block text-center btn-lg">
                                                        ¡Thanks For Your Purchase!
                                                    </div>
                                                </div>
                                            </div>


                                        </tbody>
                                    </table>
                                    <div> <a class="btn btn-warning text-black-50 font-weight-bold w-100"
                                            href="{{ route('home') }}">Back</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>

    <script>
        if (window.performance.navigation.type == 1) {
            if (confirm('Desea Actualizar ? ')) {
                window.livewire.emit('reload')
                swal.close()
            } else {
                alert('Correcto');
            }
        }
    </script>

@endauth

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.2/angular.min.js"></script>
