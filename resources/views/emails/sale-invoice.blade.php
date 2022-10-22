<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


</head>

<body>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #070a36;
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #070a36;
            color: white;
            text-align: center;
            line-height: 35px;
        }

    </style>
    <div>
        <header>
            <h1>Thanks For Your Purchase!</h1>
        </header>
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" {
            rel="stylesheet" /> --}}

        <div class=" mt-5" style="height: 3rem;">

        </div>
        <div class="container ">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="p-3 bg-white rounded">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="text-uppercase badge-warning">Invoice</h1>
                                <div class="billed mb-2 mt-5 "><span
                                        class="font-weight-bold text-uppercase">Client:</span><span
                                        class="ml-1">{{ Auth()->user()->name . ' ' . Auth()->user()->last_name }}</span>
                                </div>
                                <div class="billed"><span
                                        class="font-weight-bold text-uppercase">Date:</span><span
                                        class="ml-1">{{ \Carbon\Carbon::now() }}</span></div>
                                <div class="billed mb-2"><span
                                        class="font-weight-bold text-uppercase">Email:</span><span
                                        class="ml-1">{{ Auth()->user()->email }}</span>
                                </div>
                                <div class="billed mb-2"><span
                                        class="font-weight-bold text-uppercase">Address:</span><span
                                        class="ml-1">{{ Auth()->user()->address }}</span>
                                </div>


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

                                            <th class="text-center">Product</th>
                                            <th class="text-center">Unit</th>
                                            <th>Price</th>
                                            <th>Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::getContent() as $d)
                                            <tr>

                                                <td class="text-center">{{ $d->name }}</td>
                                                <td class="text-center">{{ $d->quantity }}</td>
                                                <td>{{ number_format($d->price, 2) }}</td>
                                                <td>{{ number_format($d->price * $d->quantity, 2) }}</td>
                                            </tr>
                                        @endforeach

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="badge-danger btn-block text-right btn-lg">Total:
                                                    {{ Cart::getTotal() }} </button>
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

    </div>
    <footer>
        <h1>www.bookStore.com</h1>
    </footer>

</body>

</html>
