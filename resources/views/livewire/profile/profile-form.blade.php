@auth


    <div class="h-70 mt-5">

    </div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    @if ($errors->any())
        <div class="mt-28 -mb-11">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3 class="text-center">Update Your Profile</h3>



    <div class="row mt-5 ">

        <div class="col-md-4 text-center">
            <img src="{{ asset('storage/users/' . Auth()->user()->imagen) }}" alt="Imagen" width="170" height="180">
            <div class="form-group custom-file ">
                <input name="image" id="input-file-max-fs" class="custom-file-input form-control " placeholder="Selecion"
                    type="file" wire:model="image" accept="image/png, image/jpg, image/gif">
                <label class="custom-file-label container-fluid col-md-7 mt-2"></label>
                @error('image')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>

            <div class="as-footer-container justify-content-end ">

                <button wire:submit="updateImageProfile()" type="submit" class="btn btn-primary mt-4">Update Image</button>

            </div>


        </div>

        <div class="col-md-8">

            <div class="row">

                <div class="col-md-5">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" disabled value="{{ Auth()->user()->name }}" class="form-control mb-4"
                            name="name" placeholder="Name" value="New York">

                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" disabled value="{{ Auth()->user()->last_name }}" class=" form-control mb-4"
                            name="last_name" placeholder="Last Name" value="New York">

                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('users.profile-update') }}">
                @csrf
                <div class="row">

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Phone</label>
                            <input maxlength="10" type="text" value="{{ Auth()->user()->phone }}"
                                class="form-control mb-4" name="phone">
                            @error('phone')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="location">Address</label>
                            <input type="text" value="{{ Auth()->user()->address }}" class="form-control mb-4"
                                name="address">
                            @error('address')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ Auth()->user()->email }}" class="form-control mb-4"
                                name="email">
                            @error('email')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="">
                            <div class="as-footer-container justify-content-end ">

                                <button type="submit" class="btn btn-primary">Save
                                    Changes</button>

                            </div>

                        </div>
                    </div>
                </div>

            </form>


            <form action="{{ route('users.profile-update-password') }}" method="post">
                @csrf
                <h5 class="mt-5 card-title">Update Password</h5>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control " name="current_password"
                                autocomplete="current_password" placeholder="Current Password">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control " name="password" autocomplete="new-password"
                                placeholder="Password">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input name="confirm_password" type="password" class="form-control mb-4"
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

            </form>

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
@endauth
