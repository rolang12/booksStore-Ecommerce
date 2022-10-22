@include('common.modalHead')



<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Name</label>
            <input wire:model.lazy="name" type="text" class="form-control">
            @error('name')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Last Name</label>
            <input wire:model.lazy="last_name" type="text" class="form-control">
            @error('last_name')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>



</div>




@include('common.modalFooter')
