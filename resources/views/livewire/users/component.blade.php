@if (Auth()->user()->profile == 'ADMIN')

    <div class="row sales layout-top-spacing ">

        <div class="col-sm-12">

            <div class="widget widget-chart-one mt-5">
                <div class="widget-heading">
                    <h4 class="cart-title">
                        <b>{{ $componentName }} | {{ $pageTitle }}</b>
                    </h4>
                    <ul class="tabs tab-pills">
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-dark p-2 text-white " data-toggle="modal"
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
                                                {{ strtoupper($c) }}
                                            </button>
                                            @if ($sortColumn == $c)
                                                @if ($sortDirection == 'asc')
                                                    <button class="text-white"
                                                        style="background-color: transparent; border:none">&uarr;</button>
                                                @else
                                                    <button class="text-white"
                                                        style="background-color: transparent; border:none">&darr;</button>
                                                @endif
                                            @endif
                                        </th>
                                    @endforeach

                                    <th class="table-th text-white">Phone</th>
                                    <th class="table-th text-center text-white">Email</th>

                                    <th class="table-th text-center text-white">Image</th>
                                    <th class="table-th text-center text-white">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $r)
                                    <tr>
                                        <td>
                                            <h6>{{ $r->name }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6>{{ $r->profile }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class=" text-uppercase badge {{ $r->status == 'ACTIVE' ? 'badge-success' : 'badge-danger' }} ">{{ $r->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            <h6>{{ $r->phone }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6>{{ $r->email }}</h6>
                                        </td>

                                        <td class="text-center">
                                            <img src=" {{ asset('storage/users/' . $r->imagen) }} " alt="imagen"
                                                height="70" width="80">
                                        </td>


                                        <td class="text-center">
                                            <a wire:click="edit({{ $r->id }})" href="javascript:void(0)"
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-3">
                                                    <path d="M12 20h9"></path>
                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                    </path>
                                                </svg> </a>


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

        @include('livewire.users.form')

    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('user-added', Msg => {
            noty(Msg)
            $('#theModal').modal('hide')

        })

        window.livewire.on('user-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })

        window.livewire.on('user-deleted', Msg => {
            noty(Msg)
        })

        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })

        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })

        window.livewire.on('user-withsales', Msg => {
            noty(Msg)
        })

    });
</script>
