@include('layouts.theme.header')
<div>
    @if ($data->count() < 1)
        @if (Cart::isEmpty())
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
                                <div class="table-responsive">
                                    <table class="table">
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
                                            @foreach (Cart::getContent() as $d)
                                                <tr>

                                                    <td class="text-center">{{ $d->product }}</td>
                                                    <td class="text-center">{{ $d->quantity }}</td>
                                                    <td>${{ number_format($d->price, 2) }}</td>
                                                    <td>${{ number_format($d->quantity * $d->price, 2) }}</td>
                                                </tr>
                                                <div class="d-none">
                                                    {{ $total = $total + $d->quantity * $d->price }}</div>
                                            @endforeach

                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="badge-danger btn-block text-right btn-lg">Total:
                                                        ${{ number_format($total = Cart::getTotal(), 2) }} </button>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <a href="{{ route('sales.ticket') }} "></a>
                                                    <div class="card-body">
                                                        <button type="button"
                                                            class="btn btn-warning btn-block btn-lg">Proceed to
                                                            Pay</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>



<div class="container" ng-app="app">
    <div class="row" ng-controller="ctrl">
        <div>
            <div class="form-group ">
                <label class="control-label text-black-50 ">Select Payment Method</label>
                <select name="option" class="form-control" ng-model="selectOption"
                    ng-options="o.value as o.name for o in opciones"></select>
            </div>

            <div class="form-group col-md-12" ng-if="selectOption == 3 || selectOption == 2 " ng-cloak> <img
                    class="img-fluid" src="{{ asset('/storage/tarjetas.jpg') }}" alt="" srcset="">
                </ng-cloak>
            </div>

            <div class="form-group " ng-if="selectOption == 0 " ng-cloak>
                <label class="control-label text-black-50">Selected</label>
                <input required type="number" name="card_number" class="form-control">
            </div>


            <div class="form-group " ng-if="selectOption == 3 || selectOption == 2 " ng-cloak>
                <label class="control-label text-black-50">Card Number</label>
                <input required placeholder="XXXX-XXXX-XXXX-XXXX" type="number" name="card_number"
                    class="form-control">
            </div>

            <div class="form-group " ng-if="selectOption == 3 || selectOption == 2" ng-cloak>
                <label class="control-label text-black-50">Card Owner</label>
                <input required placeholder="Enter the owner Card" type="text" name="card_owner" class="form-control">
            </div>

            <div class="form-group" ng-if="selectOption == 3 || selectOption == 2" ng-cloak>
                <label class="control-label text-black-50">CVV</label>
                <input required placeholder="Enter CVV Number" type="number" name="cvv" class="form-control">
            </div>

            <hr>

            @auth

                <div class="total form-group ">

                    <input id="Sendform" class="rounded px-3 py-1 form-control bg-secondary text-white " value="Buy"
                        type="submit">
                    </input>

                </div>

            @endauth

            <input type="hidden" name="id" value="{{ $product->id }}">

        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.2/angular.min.js"></script>

<script src="{{ asset('assets2/js/quantity.js') }}"></script>
<script type="">
    var app = angular.module('app', []);
    app.controller('ctrl', ['$scope', function($scope){
    $scope.opciones = [
        { value: 1, name: 'Cash' },
        { value: 2, name: 'Credit Card' },
        { value: 3, name: 'Debit Card' },
    ]
    $scope.selectOption = {};
    }])

    $(document).ready(function(){
    //Validación del formulario al ser llenado
    $("input[type=text], select").change(function(){
                    
        $("input[type=submit]").prop('disabled', false).attr('title','Available to buy');
           document.getElementById('Sendform').disabled=false;
        });
        document.getElementById('Sendform').disabled=true;

    });

</script>
