<div>
    <div>
        <section class="section" id="men">
            <div class="container">
                <div class="row badge-info rounded mb-4">
                    <div class="col-lg-6 shadow card">
                        <div class="section-heading">
                            <h2>Romance</h2>
                            <span>Details to details is what makes Hexashop different from the other themes.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="men-item-carousel">
                            <div class="owl-men-item owl-carousel">

                                @foreach ($p_romance as $p)
                                    <div class="item">
                                        <div class="thumb">
                                            <div class="hover-content">
                                                <ul>
                                                    <li><a
                                                            href="{{ route('products.single-product', ['id' => $p->id]) }}"><i
                                                                class="fa fa-eye"></i></a>
                                                    </li>
                                                    <li>

                                                        <a wire:click="addCart({{ $p->id }})"><i
                                                                class="fa fa-shopping-cart"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <img src="{{ asset('storage/products/' . $p->imagen) }}" alt="">
                                        </div>
                                        <div class=" down-content">
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

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
