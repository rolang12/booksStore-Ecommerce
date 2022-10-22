@auth

    <div>
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
            <section class="h-100" style="background-color: #eee;">
                <div class="container h-100 py-5">
                    @if (session('status-danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status-danger') }}
                        </div>
                    @endif
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-10">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                                {{-- <div>
                            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                    class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                        </div> --}}
                            </div>

                            @foreach ($items as $item)
                                <div class="card rounded-3 mb-4">
                                    <div class="card-body p-4">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img src="{{ asset('storage/products/' . $item->attributes->url) }}"
                                                    class="img-fluid rounded-3" alt="Image">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <span class="text-black-50">Product:</span>
                                                <p class="lead fw-normal mb-2"> {{ $item->name }}</p>

                                            </div>

                                            <div class="col-md-1 col-lg-3 col-xl-2 d-flex">
                                                <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i wire:click.lazy="updateItemQtity({{ $item->id }}, {{ -1 }} )"
                                                        class="fas fa-minus"></i>
                                                </button>

                                                <input disabled id="form1" min="0" name="quantity2"
                                                    value="{{ $item->quantity }}" type="number"
                                                    class="form-control px-lg-2 form-control-sm" />

                                                <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i wire:click.lazy="updateItemQtity({{ $item->id }}, {{ 1 }} )"
                                                        class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <div class="text-black-50  text-center">Price:</div>

                                                <h6 class="mb-0 text-center">${{ number_format($item->price, 2) }}</h6>
                                            </div>

                                            <div class="col-md-2 col-lg-2 col-xl-2 ">
                                                <div class="text-black-50 text-center">Quantity:</div>

                                                <h6 class="mt-1 text-center">{{ $item->quantity }}</h6>
                                            </div>

                                            <div class="col-md-1 col-lg-1 col-xl-1 text-center">

                                                <a href="#!" class="text-danger">
                                                    <div class="text-danger">X</div>
                                                    {{-- wire:click="removeItem({{ $item->id }})" --}}
                                                    <i onclick="Confirm('{{ $item->id }}')"
                                                        class="fas fa-trash fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="card">
                                <div class="card-body">
                                    <div class="badge-danger btn-block text-right btn-lg">Total:
                                        ${{ number_format($total = Cart::getTotal(), 2) }} </button>
                                    </div>
                                </div>
                                <a href="{{ route('users.checkout') }}">
                                    <div class="card">

                                        <div class="card-body">
                                            <button type="submit" class="btn btn-warning btn-block btn-lg">Proceed to
                                                Pay</button>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
            </section>
        @endif
    </div>

@endauth
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

    function Confirm(id) {


        swal({
            title: 'Confirm',
            text: 'Are you Sure?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Close',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Acept'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        })
    }

    function noty(msg, option = 1) {
        Snackbar.show({
            text: msg.toUpperCase(),
            actionText: 'CERRAR',
            actionTextColor: '#fff',
            backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
            pos: 'top-right'
        });
    }
    window.livewire.on('show-modal', msg => {
        $('#theModal').modal('show')
    });
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
