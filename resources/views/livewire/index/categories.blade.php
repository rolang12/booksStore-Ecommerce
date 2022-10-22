<div>
    <!-- ***** Main Banner Area Start ***** -->

    <style>
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4rem;
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
        <img src="{{ asset('storage/categories/' . $category->imagen) }}" style="width: 100%; height:100%">
        <div class="centered fs-1 ">{{ $category->name }}</div>
    </div>


    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading badge-warning">
                        <h2>The search bar bellow will help you find the right book</h2>
                        <span>Check out all of our products.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            @include('common.searchbox')
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
                                <h4>{{ $p->name }}</h4>
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
                @if ($products->count())
                    {{ $products->links() }}
                @else
                    <h5>Sorry, There are not books for this search</h5>
                @endif

            </div>

        </div>
    </section>
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
