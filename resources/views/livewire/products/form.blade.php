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
            <label>Description</label>
            <input wire:model.lazy="description" type="text" class="form-control">
            @error('description')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Price</label>
            <input wire:model.lazy="price" type="number" min="1" class="form-control">
            @error('price')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Stock</label>
            <input wire:model.lazy="stock" type="number" min="1" class="form-control">
            @error('stock')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Stock Min.</label>
            <input wire:model.lazy="alerts" type="number" class="form-control">
            @error('alerts')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Editorial</label>
            <input wire:model.lazy="editorial" type="text" class="form-control">
            @error('editorial')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Presentation</label>
            <select wire:model="presentation" class="form-control">
                <option selected value="Choose" class="form-control">Choose</option>
                <option value="Tapa Blanda" class="form-control">Tapa Blanda</option>
                <option value="Tapa Dura" class="form-control">Tapa Dura</option>
            </select>
            @error('presentation')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            {{-- <input wire:model.lazy="presentation" type="text" class="form-control"> --}}
            {{-- @error('presen')<span class="text-danger er">{{$message}}</span>@enderror --}}
        </div>
    </div>

    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>Edition</label>
            <input wire:model.lazy="edition" type="number" class="form-control">
            @error('edition')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Language</label>
            <select wire:model="language" class="form-control">
                <option selected value="Choose" class="form-control">Choose</option>
                <option value="Spanish" class="form-control">Spanish</option>
                <option value="English" class="form-control">English</option>
                <option value="French" class="form-control">French</option>
                <option value="Italian" class="form-control">Italian</option>
            </select>
            {{-- <input wire:model.lazy="presentation" type="text" class="form-control"> --}}
            @error('language')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <label>N° Pages</label>
            <input wire:model.lazy="n_pages" type="number" class="form-control">
            @error('n_pages')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label>Barcode</label>
            <input wire:model.lazy="barcode" type="number" class="form-control">
            @error('barcode')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label>Height</label>
            <input wire:model.lazy="height" type="number" class="form-control">
            @error('height')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label>Width</label>
            <input wire:model.lazy="width" type="number" class="form-control">
            @error('width')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-3">
        <div class="form-group ">
            <label>Year</label>
            <input wire:model.lazy="year" type="text" class="form-control">
            @error('year')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group custom-file">
            <label class="custom-file-label">Image{{ $image }}</label>

            <input type="file" class="custom-file-input form-control" wire:model="image"
                accept="image/png, image/gif, image/jpeg">
            @error('image')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group ">
            <label>Category</label>
            <select wire:model='category_id' class="form-control">
                <option value="Choose" selected>Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach

            </select>
            @error('category_id')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group ">
            <label>Author</label>
            <select wire:model='authors_id' class="form-control">
                <option value="Choose" selected>Select Author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach

            </select>
            @error('authors_id')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>



</div>




@include('common.modalFooter')
