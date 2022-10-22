@if (Auth()->user()->profile == 'ADMIN')

    <div class="row sales layout-top-spacing">

        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-heading">
                    <h4 class="card-title text-center">
                        <b>{{ $componentName }}</b>
                    </h4>
                </div>
                <div class="widget-content">
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>Choose the user</h6>
                                    <div class="form-group">
                                        <select wire_model="userId" class="form-control">
                                            <option value="0">All</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <h6>Choose report type</h6>
                                    <div class="form-group">
                                        <select wire:model="reportType" class="form-control">
                                            <option value="0">Daily Report</option>
                                            <option value="1">Purchases by Date</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-2">
                                    <h6>From Date</h6>
                                    <div class="form-group">
                                        <input type="date" wire:model="dateFrom" class="form-control flatpickr"
                                            placeholder="Click to choose">
                                    </div>

                                </div>
                                <div class="col-sm-12 mt-2">
                                    <h6>To Date</h6>
                                    <div class="form-group">
                                        <input type="date" wire:model="dateTo" class="form-control flatpickr"
                                            placeholder="Click to choose">
                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <button wire:click="$refresh" class="btn btn-dark btn-block">
                                        Consult
                                    </button>
                                    <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disable' : '' }} "
                                        href="{{ url('report/pdf' . '/' . $userId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
                                        target="_blank">Export
                                        to PDF</a>


                                    <a class="btn btn-dark btn-block {{ count($data) < 1 ? 'disable' : '' }} "
                                        href="{{ url('report/excel' . '/' . $userId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
                                        target="_blank">Export
                                        to Excel</a>


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <div class="table-responsive ">
                                <table class="table table-bordered table striped mt-1">
                                    <thead class="text-white" style="background: #3b3c5c;">
                                        <tr>
                                            <th class="table-th text-white text-center">Invoice</th>
                                            <th class="table-th text-white text-center">Total</th>
                                            <th class="table-th text-white text-center">Items</th>
                                            <th class="table-th text-white text-center">Status</th>
                                            <th class="table-th text-white text-center">User</th>
                                            <th class="table-th text-white text-center">Fecha</th>
                                            <th class="table-th text-white text-center" widht="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($data) < 1)
                                            <tr>
                                                <td colspan="7">
                                                    <h5>There are not records</h5>
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach ($data as $d)
                                            <tr>
                                                <td class="text-center">
                                                    <h6>{{ $d->id }}</h6>
                                                </td>
                                                <td class="text-center">
                                                    <h6>${{ number_format($d->total, 2) }}</h6>
                                                </td>
                                                <td class="text-center">
                                                    <h6>{{ $d->items }}</h6>
                                                </td>
                                                <td class="text-center">
                                                    <h6>{{ $d->status }}</h6>
                                                </td>
                                                <td class="text-center">
                                                    <h6>{{ $d->user }}</h6>
                                                </td>
                                                <td class="text-center">
                                                    <h6>{{ \Carbon\Carbon::parse($id->created_at)->format('d-m-Y') }}
                                                    </h6>
                                                </td>
                                                <td class="text-center" widht="50px">
                                                    <button wire:click.prevent="getDetails({{ $d->id }})"
                                                        class="btn btn-dark btn-sm">
                                                        <i class="as fa-list"></i>
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
        </div>
        @include('livewire.reports.sales-detail')
    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(document.getElementsByClassName('flatpickr'), {
            enableTime = false,
            dateFormat = 'Y-m-d',
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    longhand: [
                        "Domingo",
                        "Lunes",
                        "Martes",
                        "Miércoles",
                        "Jueves",
                        "Viernes",
                        "Sábado",
                    ],
                },

                months: {
                    shorthand: [
                        "Ene",
                        "Feb",
                        "Mar",
                        "Abr",
                        "May",
                        "Jun",
                        "Jul",
                        "Ago",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dic",
                    ],
                    longhand: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                    ],
                },

            }
        })

        window.livewire.on('show-modal', Msg => {
            $('#modalDetails').modal('show')
        })

    })
</script>
