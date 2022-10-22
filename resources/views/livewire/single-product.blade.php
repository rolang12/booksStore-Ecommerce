@extends('layouts.theme.app')
@section('content')

    <head>
        <title>Books | Single Product</title>
    </head>
    {{-- @include('layouts.theme.header') --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" />
    <div class="page-heading" id="top">

    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Product Area Starts ***** -->
    <section class="section mt-5 " id="product">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mt-28 -mb-11">

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <img class="w-75" src="{{ asset('storage/products/' . $product->imagen) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4>{{ $product->name }}</h4>
                        <span class="price">${{ number_format($product->price, 2) }}</span>
                        <ul class="stars">
                            <li class="text-black-50">Category: {{ $product->category->name }}</li>

                        </ul>
                        <span>{{ $product->description }}</span>
                        <div>

                            <p>Author: {{ $product->author_name . ' ' . $product->author_last_name }}</p>

                        </div>

                        <form action="{{ route('products.add-product') }}" method="post">

                            <div class="quantity-content">
                                <div class="left-content">
                                    <h6>No. of Books</h6>
                                </div>
                                <div class="right-content">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus">
                                        <input type="number" step="1" min="1" max="15" name="quantity" value="1" title="Qty"
                                            class="input-text qty text" size="4" pattern="" inputmode="">
                                        <input type="button" value="+" class="plus">
                                    </div>
                                </div>
                            </div>


                            @csrf


                            @auth

                                <div class="total form-group ">

                                    <input id="Sendform" class="rounded px-3 py-1 form-control bg-secondary text-white "
                                        value="Add To Cart" type="submit">
                                    </input>

                                </div>

                            @endauth

                            <input type="hidden" name="id" value="{{ $product->id }}">

                        </form>

                    </div>
                </div>
            </div>
            <h2 class="text-center font-weight-bold ">Characteristics</h2>
            <div class="row justify-content-around mt-5">

                <div class="col-md-2 font-weight-bold">
                    <p class="fs-5">Dimensions: </p>
                    <p class="fs-5">Presentation</p>
                    <p class="fs-5">Editorial</p>
                    <p class="fs-5">Language</p>
                    <p class="fs-5">Publishing</p>
                    <p class="fs-5">Pages</p>
                    <p class="fs-5">Published</p>
                </div>
                <div class="col-md-2">
                    <p class="fs-4">{{ $product->height . 'x' . $product->width }}cm </p>
                    <p class="fs-4">{{ $product->presentation }} </p>
                    <p class="fs-4">{{ $product->editorial }} </p>
                    <p class="fs-4">{{ $product->language }} </p>
                    <p class="fs-4">{{ $product->edition }} </p>
                    <p class="fs-4">{{ $product->n_pages }} </p>
                    <p class="fs-4">{{ $product->year }} </p>
                </div>


            </div>
        </div>

    </section>
    <!-- ***** Product Area Ends ***** -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.2/angular.min.js"></script>
    <script src="{{ asset('assets2/js/quantity.js') }}"></script>
    {{-- <script type="">
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

</script> --}}
@endsection
<!-- ***** Footer Start ***** -->
{{-- @include('livewire.layouts.footer') --}}
