@include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Type</label>
            <select wire:model="type" class="form-control" >
                <option  value="Choose">Choose</option>
                <option value="cash">Cash</option>
                <option value="coin">Coin</option>
                <option value="other">Other</option>
            </select>
            @error('type')<span class="text-danger er">{{$message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Value</label>   
            <input min="100" maxlength="6" max="100000" type="number" wire:model.lazy="value" class="form-control" > <!-- cuando se da click afuera lo que escrib+i se envia al backend -->
            @error('value')<span class="text-danger er">{{$message}}</span>@enderror

        </div>
    </div>

</div>

@include('common.modalFooter')