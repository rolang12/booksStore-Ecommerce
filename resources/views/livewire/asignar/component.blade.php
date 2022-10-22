<div class="row sales layout-top-spacing">

    <div class="col-sm-12">

        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="cart-title">
                    <b>{{ $componentName }}</b>
                </h4>

            </div>

            <div class="widget-content">
                <div class="form-inline">
                    <div class="form-group mr-5">
                        <select wire:model="role" class="form-control">
                            <option selected value="Choose">Choose a Rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button wire:click.prevent="syncAll" type="button" class="mr-5 btn btn-dark mbmobile inblock">
                        Syncronice All
                    </button>
                    <button onclick="Revocar()" type="button" class="mr-5 btn btn-dark mbmobile ">
                        Revoke All
                    </button>

                </div>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="table-responsive ">
                            <table class="table table-bordered table striped mt-1">
                                <thead class="text-white " style="background: #3b3c5c;">
                                    <tr>
                                        <th class="table-th text-white text-center ">Id</th>
                                        <th class="table-th text-white text-center">Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                        <tr>
                                            <td>
                                                <h6 class="text-center">{{ $permiso->id }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <div class="n-check">
                                                    <label class="new-control new-checkbox checkbox-primary ">
                                                        <input type="checkbox" class="new-control-input"
                                                            {{ $permiso->checked == 1 ? 'checked' : '' }} wire:change="SyncPermiso($('#p' + {{ $permiso->id }} ).is(':checked'),
                                                            '{{ $permiso->name }}')" id="p{{ $permiso->id }}"
                                                            value="{{ $permiso->id }}  ">
                                                        <span class="new-control-indicator"></span>
                                                        <h6>{{ $permiso->name }}</h6>
                                                    </label>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $permisos->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    Include Form
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        window.livewire.on('sync-error', Msg => {
            noty(Msg)
        })

        window.livewire.on('permi', Msg => {
            noty(Msg)
        })

        window.livewire.on('syncall', Msg => {
            noty(Msg)
        })

        window.livewire.on('removeall', Msg => {
            noty(Msg)
        })

    });


    function Revocar() {
        swal({
            title: 'Confirm',
            text: 'Are you Sure revoke all permissions?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Close',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Acept'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('revokeall')
                swal.close()
            }
        })
    }
</script>
