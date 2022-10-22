@if (Auth()->user()->profile == 'ADMIN')

    <div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h4 class="cart-title text-center">
                        <b>Cash Out</b>
                    </h4>
                </div>
                <div class="widget-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 ">
                            <div class="form-group">
                                <label>User</label>
                                <select wire:model="userid" class="form-control">
                                    <option value="0" disabled>Choose</option>
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                                @error('userid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">

                            <div class="form-group">
                                <label>Initial Date</label>
                                <input class="form-control" type="date" wire:model.lazy="fromDate">
                                @error('fromDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>Final Date</label>
                                <input class="form-control" type="date" wire:model.lazy="toDate">
                                @error('toDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-3 align-self-center d-flex justify-content-around">
                            {{-- Validación para que se muestren los botones unicamente despues de que se hayan seleccionado usuario y fechas --}}
                            @if ($userid > 0 && $fromDate != null && $toDate != null)
                                <button wire:click.prevent="Consultar" type="button"
                                    class="btn btn-dark">Consult</button>
                            @endif
                            {{-- Si el total de la consulta es mayor a cero, se puede imprimir --}}
                            @if ($total > 0)
                                <button wire:click.prevent="Print()" type="button"
                                    class="btn btn-dark">Impress</button>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-sm-12 col-md-4 mbmobile ">
                        <div class="connect-sorting bg-dark">
                            <h5 class="text-white">Total Sales: ${{ number_format($total, 2) }} </h5>
                            <h5 class="text-white">Articles: {{ $items }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mt-1">
                                <thead class="text-white" style="background: #3b3f5c">
                                    <tr>
                                        <th class="table-th text-center text-white">Sale ID</th>
                                        <th class="table-th text-center text-white">Total</th>
                                        <th class="table-th text-center text-white">Items</th>
                                        <th class="table-th text-center text-white">Date</th>
                                        <th class="table-th text-center text-white"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($total <= 0)
                                        <tr>
                                            <td colspan="5">
                                                <h6 class="text-center">No sales on the selected date</h6>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td class="text-center">
                                                <h6>{{ $sale->id }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>${{ number_format($sale->total, 2) }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $sale->items }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{ $sale->created_at }}</h6>
                                            </td>
                                            <td class="text-center">

                                                <button wire:click.prevent="viewDetails({{ $sale }})"
                                                    class="btn btn-dark btn-sm ">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('livewire.cashout.modalDetails')
    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', Msg => {
            $('#modal-details').modal('show')
        })
    })
</script>
