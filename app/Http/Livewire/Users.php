<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;
    use WithFileUploads;
 

    public $name, $last_name, $phone, $email, $status, $image, $selected_id,
    $fileLoaded, $profile, $address, $password, $componentName, $pageTitle,
    $search, $sortColumn = 'name', $sortDirection = 'asc',
    $columns = [ 'name', 'profile', 'status'];

    private $pagination = 10;

    public function mount()
    {
        $this->componentName = 'Users';
        $this->pageTitle = 'List';
        $this->status = 'Choose';
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection =  $this->sortDirection == 'asc' ? 'desc' : 'asc'; 
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    } 

   //resetea la página por si encuentro un resultado en otra pagina y no me aparezca vacio
    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {

        if (strlen($this->search) > 0 ) {

            $data = User::where('name', 'like', "%$this->search%")
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->pagination);

        } else {

            $data = User::select('*')->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->pagination);
        }

        return view('livewire.users.component',[

           'data' => $data,
           $title_page = 'Users Crud',

        ])
        ->extends('layouts.theme.app',compact('title_page'))
        ->section('content')  ;
    }

    public function resetUI()
    {
        $this->name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->image = null;
        $this->search = '';
        $this->status = 'Choose';
        $this->profile = 'Choose';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->status = $user->status;
        $this->profile = $user->profile;

        $this->emit('show-modal', 'open');
    }

    protected $listeners = ['deleteRow' => 'destroy', 'resetUI' => 'resetUI' ];

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|indisposable|unique:users,email',
            'phone' => 'required|min:10|max:10',
            'status' => 'required|not_in:Choose',
            'profile' => 'required|not_in:Choose',
            'address' => 'required',
            'password' => 'required|min:8',
        ];

        $messages = [

            'name.required' => 'The name is required',
            'name.min' => 'The last name must be least 3 characters',
            'last_name.required' => 'The last name is required',
            'last_name.min' => 'The name must be least 3 characters',
            'email.required' => 'The email is required',
            'email.indisposable' => 'The email must be real',
            'email.email' => 'The email must be a right address',
            'email.unique' => 'The email must be unique',
            'status.required' => 'The status is required',
            'status.not_in' => 'select a valid option',
            'profile.required' => 'The profile is required',
            'profile.not_in' => 'select a valid option',
            'address.required' => 'The address is required',
            'password.required' => 'The password is required',
            'password.min' => 'The password must be least 8 characters',
            'phone.min' => 'The phone must be of 10 characters',
            'phone.max' => 'The phone must be of 10 characters',
           
        ];

        $this->validate($rules, $messages);

        $user = User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password),
        ]);

        if ($this->image) 
        {
            $customFileName = uniqid() .'_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();
        }

        $this-> resetUI();
        $this->emit('user-added', 'User registered successfully!');


    }

    public function Update()
    {
        $rules = [
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => "required|email|indisposable|unique:users,email,{$this->selected_id}",
            'status' => 'required|not_in:Choose',
            'profile' => 'required|not_in:Choose',
            'phone' => 'required|min:10|max:10|starts_with:3',
            'address' => 'required',
        ];

        $messages = [

            'name.required' => 'The name is required',
            'name.min' => 'The name must be least 3 characters',
             'last_name.required' => 'The last name is required',
            'last_name.min' => 'The name must be least 3 characters',
            'email.required' => 'The email is required',
            'email.unique' => 'The email must be unique',
            'email.indisposable' => 'The email must be real',
            'email.email' => 'The email must be a right address',
            'status.required' => 'The status is required',
            'status.not_in' => 'select a valid option',
            'profile.required' => 'The profile is required',
            'profile.not_in' => 'select a valid option',
            'address.required' => 'The address is required',
            'phone.min' => 'The phone must be of 10 characters',
            'phone.max' => 'The phone must be of 10 characters',
            'phone.starts_with' => 'The phone must be start with 3',
           
           
        ];

        
        $this->validate($rules, $messages);
        $user = User::find($this->selected_id);

        $user->update([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
            'profile' => $this->profile,
        ]);

        if ($this->image) 
        {
            $customFileName = uniqid() .'_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $imageTemp = $user->image;

            $user->image = $customFileName;
            $user->save();

            if ($imageTemp != null) {
                if (file_exists('storage/users/'. $imageTemp)) {
                    unlink('storage/users/'. $imageTemp);
                }
            }


        }
        // $user->assignRole($this->profile);
        $this-> resetUI();
        $this->emit('user-updated', "User $user->name updated successfully!");

    }

   


}
