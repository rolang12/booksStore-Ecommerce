<h5 class="mt-5 card-title">Update Password</h5>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            <label>Password</label>
            <input type="password" wire:model="current_password" class="form-control " name="current_password"
                autocomplete="current_password" placeholder="Current Password">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label>Password</label>
            <input type="password" wire:model="password" class="form-control " name="password"
                autocomplete="new-password" placeholder="Password">
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" wire:model="confirm_password" class="form-control mb-4"
                placeholder="Confirm Password">
            @error('confirm_password')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-10">
        <div class="">
            <div class="as-footer-container justify-content-end ">

                <button type="submit" class="btn btn-primary">Update
                    Password</button>

            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('user-updated', Msg => {
            noty(Msg)
        })

        window.livewire.on('update-error', Msg => {
            noty(Msg)
        })

        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })

        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })


    });
</script>
