@if (Auth()->user()->profile == 'ADMIN')

    <div>

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

                                        <th class="table-th text-white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($authors as $author)
                                        <tr>
                                            <td>
                                                <h6>{{ $author->name }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $author->last_name }}</h6>
                                            </td>

                                            <td class="text-center">
                                                <a wire:click="Edit({{ $author->id }})" href="javascript:void(0)"
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



                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($authors->count())
                                {{ $authors->links() }}
                            @else
                                <h5>There are not records for this search</h5>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

            @include('livewire.authors.form')
        </div>
@endif

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide')
        });

        window.livewire.on('author-added', msg => {
            $('#theModal').modal('hide')
            noty($msg)
        });

        window.livewire.on('author-updated', msg => {
            $('#theModal').modal('hide')
            noty($msg)
        });

    });
</script>
