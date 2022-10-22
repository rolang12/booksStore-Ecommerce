@include('common.modalHead')

<div class="row">


    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Name</label>
            <input wire:model.lazy="name" type="text" class="form-control">
            @error('name')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Last Name</label>
            <input wire:model.lazy="last_name" type="text" class="form-control">
            @error('last_name')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Phone</label>
            <input maxlength="10" wire:model.lazy="phone" type="text" class="form-control">
            @error('phone')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Address</label>
            <input wire:model.lazy="address" type="text" class="form-control">
            @error('address')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Email</label>
            <input wire:model.lazy="email" type="email" class="form-control">
            @error('email')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Password</label>
            <input wire:model.lazy="password" type="text" class="form-control">
            @error('password')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Status</label>

            <select wire:model.lazy="status" class="form-control">
                <option value="Choose" selected>Choose</option>
                <option value="ACTIVE">Active</option>
                <option value="LOCKED">Locked</option>

            </select>
            @error('status')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Assign Role</label>
            <select wire:model.lazy="profile" class="form-control">
                <option value="Choose" selected>Choose</option>
                <option value="ADMIN">ADMIN</option>
                <option value="CLIENT">CLIENT</option>
            </select>
            @error('profile')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Profile Image</label>
            <input class=" form-control" type="file" wire:model="image" accept="image/png, image/jpg, image/gif">
            @error('image')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>

@include('common.modalFooter')
