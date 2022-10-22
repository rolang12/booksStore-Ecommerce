<div>
<div>
    
<div class="row sales layout-top-spacing"  >

    <div class="col-sm-12" >

    <div class="widget widget-chart-one">
        <div class="widget-heading" >
            <h4 class="cart-title">
                <b>{{$componentName}} | {{$pageTitle}}</b>
            </h4>
            <ul class="tabs tab-pills" >
                <li>
                    <a href="javascript:void(0)" class="tabmenu bg-dark text-white p-2" data-toggle="modal" data-target="#theModal" >Add</a>
                </li>

            </ul>
        </div>
        @include('common.searchbox')

        <div class="widget-content" >
            <div class="table-responsive " >
                <table class="table table-bordered table striped mt-1" >
                    <thead class="text-white" style="background: #3b3c5c;" >
                        <tr> 
                            <th class="table-th text-white">Type</th>
                            <th class="table-th text-white">Value</th>
                            <th class="table-th text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $coin)
    
                        <tr>
                            <td><h6>{{$coin->type}}</h6></td>
                            <td><h6>${{number_format($coin->value,2)}}</h6></td>
                            
                            <td class="text-center" >
                                <a wire:click="Edit({{$coin->id}})" href="javascript:void(0)" class="btn btn-dark mtmobile" title="Edit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                </a>

                                <a onclick="Confirm('{{$coin->id}}}}')" href="javascript:void(0)"  class="btn btn-dark " title="Delete" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </a>
                             
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$data->links()}}
            </div>
        </div>

    </div>

    </div>

    @include('livewire.denominations.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){

        window.livewire.on('item-added', msg => {
            $('#theModal').modal('hide')
        });

        window.livewire.on('item-updated', msg => {
            $('#theModal').modal('hide')
        });

        window.livewire.on('item-deleted', msg => {
            //noty
        });

        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });

        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')

        });

        $('#theModal').on('hidden.bs.modal', function(e) {
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
</div>
</div>
