<div>
    <!-- ***** Main Banner Area Start ***** -->

    <style>
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            font-weight: 800;
        }

        .container2 {
            position: relative;
            text-align: center;
            color: white;
            height: 20rem;
        }

    </style>

    <div class="container2">
        <img src="{{ asset('assets/img/productsall.jpg') }}" style="width: 100%; height:100%">
        <div class="centered fs-1 ">¡See all Our Products!</div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading badge-info ">
                        <h2 class="text-white">Find great books or discover something new. Use the search bar below.
                        </h2>
                        <span class="text-white-50">You'll enjoy, for sure!.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            @include('common.filters')
            <div class="row">
                @foreach ($products as $p)
                    <div class="col-md-4 col-lg-4 col-sm-2 ">
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="{{ route('products.single-product', ['id' => $p->id]) }}"><i
                                                    class="fa fa-eye"></i>
                                            </a></li>
                                        <li>

                                            <a wire:click="addCart({{ $p->id }})"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <img src="{{ asset('storage/products/' . $p->imagen) }}" alt="">
                            </div>
                            <div class="down-content">
                                <h4 wire:click="aeio()">{{ $p->name }}</h4>
                                <span>${{ number_format($p->price, 2) }}</span>
                                <span>
                                    <ul>
                                        <b class="font-weight-light fs-6 ">
                                            Author: {{ $p->author_name . $p->author_last_name }}</b>

                                    </ul>
                                </span>
                            </div>
                        </div>

                    </div>
                @endforeach
                <hr>
                @if ($products->count())
                    <div class="w-100">
                        {{ $products->links() }}
                    </div>
                @else
                    <h5>Sorry, There are not books for this search</h5>
                @endif
            </div>

        </div>
    </section>
    <!-- ***** Products Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
</div>
<script>
    function noty(msg, option = 1) {
        Snackbar.show({
            text: msg.toUpperCase(),
            actionText: 'CERRAR',
            actionTextColor: '#fff',
            backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
            pos: 'top-right'
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('product-added', Msg => {
            noty(Msg)
        })
    });
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('product-error', Msg => {
            noty(Msg)
        })
    });
</script>
