<div>
    @if (Auth()->user()->profile == 'ADMIN')

        <div class="row sales layout-top-spacing">

            <div class="col-sm-12">

                <div class="widget widget-chart-one mt-5">
                    <div class="widget-heading">
                        <h4 class="cart-title">
                            <b>{{ $componentName }} | {{ $pageTitle }}</b>
                        </h4>
                        <ul class="tabs tab-pills">
                            <li>
                                <a href="javascript:void(0)" class="tabmenu bg-dark text-white p-2" data-toggle="modal"
                                    data-target="#theModal">Add</a>
                            </li>

                        </ul>
                    </div>
                    @include('common.searchbox')

                    <div class="widget-content">
                        <div class="table-responsive ">
                            <table class="table table-bordered table striped mt-1">
                                <thead class="text-white" style="background: #3b3c5c;">

                                    <tr>

                                        @foreach ($columns as $c)
                                            <th wire:click="sort('{{ $c }}')"
                                                class="table-th text-white text-center">
                                                <button class=" text-white text-center"
                                                    style="background-color: transparent; border:none; font-weight:bold ">
                                                    {{ strtoupper($c) }} &uarr;
                                                </button>
                                                @if ($sortColumn == $c)
                                                    @if ($sortDirection == 'asc')
                                                        <button class="text-white"
                                                            style="background-color: transparent; border:none"></button>
                                                    @else
                                                        <button class="text-white"
                                                            style="background-color: transparent; border:none">&darr;</button>
                                                    @endif
                                                @endif
                                            </th>
                                        @endforeach

                                        <th class="table-th text-white text-center">Editorial</th>
                                        <th class="table-th  text-white text-center">Language</th>
                                        <th class="table-th col-md-1 text-white text-center">Category</th>
                                        {{-- <th class="table-th text-white text-center">Image</th> --}}
                                        <th class="table-th text-white text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $product)
                                        <tr>
                                            <td>
                                                <h6>{{ $product->name }}</h6>
                                            </td>
                                            <td>
                                                <h6>${{ number_format($product->price, 2) }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="badge p-2 {{ $product->stock > 5 ? 'badge-success' : 'badge-danger' }}">{{ $product->stock }}</span>

                                            </td>
                                            <td>
                                                <h6>{{ $product->year }}</h6>
                                            </td>

                                            <td class="text-center">

                                                <h6>{{ $product->editorial }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $product->language }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $product->category }}</h6>
                                            </td>

                                            {{-- <td class="text-center">
                                            <span><img src="{{ asset('storage/products/' . $product->imagen) }}"
                                                    alt="" height="70" width="80" class="rounded">
                                            </span>
                                        </td> --}}

                                            <td class="text-center">
                                                <a href="javascript:void(0)"
                                                    wire:click.prevent="Edit({{ $product->id }})"
                                                    class="btn btn-dark mtmobile" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-3">
                                                        <path d="M12 20h9"></path>
                                                        <path
                                                            d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a onclick="Confirm('{{ $product->id }}')" class="btn btn-dark "
                                                    title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </a>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($data->count())
                                {{ $data->links() }}
                            @else
                                <h5>There are not records for this search</h5>
                            @endif

                        </div>
                    </div>

                </div>

            </div>

            @include('livewire.products.form')
        </div>

    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('product-added', msg => {
            $('#theModal').modal('hide')
        });

        window.livewire.on('product-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });

        window.livewire.on('product-deleted', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });

        window.livewire.on('product-error', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });

        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });

        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')

        });

        window.livewire.on('hidden.bs.modal', msg => {
            $('#theModal').modal('hide')
            $('.er').css('display', 'none') //busca la clase er y los oculta cuando le de cerrar

        });

    });


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
</script>
