<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permisos extends Component
{
    use WithPagination;

    public $permissionName, $search,  $selected_id, $pageTitle, $componentName;
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'List';
        $this->componentName = 'Permissions';
    }
        
    public function render()
    {

        if (strlen($this->search) > 0) {
            $permisos = Permission::where('name', 'like', "%$this->search%")->paginate($this->pagination);
        } else {
            $permisos = Permission::orderBy('name', 'desc')->paginate($this->pagination);

        }

        return view('livewire.permisos.component',[

            'permisos' => $permisos

        ])
        ->extends('layouts.theme.app')->section('content');
    }

    public function CreatePermission(){
        $rules = ['permissionName' => 'required|min:2|unique:permissions,name'];

        $messages = ['permissionName.required' => 'Name is required',
                    'permissionName.unique' => 'Name must be unique',
                    'permissionName.min' => 'Name must be least 2 characters'];

        $this->validate($rules, $messages);
        Permission::create(['name' => $this->permissionName]);
        $this->emit('permiso-added', 'permiso added');
        $this->resetUI();

    }

    public function Edit(Permission $permiso){
        
        $this->selected_id = $permiso->id;
        $this->permissionName = $permiso->name;

        $this->emit('show-modal', 'Show modal');
    }

    public function UpdatePermission(){

        $rules = ['permissionName' => "required|min:2|unique:permissions,name, {$this->selected_id}"];

        $messages = ['permissionName.required' => 'Name is required',
            'permissionName.unique' => 'Name must be unique',
            'permissionName.min' => 'Name must be least 2 characters'
        ];

        $this->validate($rules, $messages);

        $permiso = Permission::find($this->selected_id);
        $permiso->name = $this->permissionName;
        $permiso->save();

        $this->emit('permiso-updated', 'permiso updated');
        $this->resetUI();

    } 
    
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        $rolesCount = Permission::find($id)->getRoleNames()->count();

        if ($rolesCount > 0) {
            $this->emit('permiso-error', 'error, permiso has roles associated');
            return;
        }

        Permission::find($id)->delete();
        $this->emit('permiso-deleted', 'permiso deleted');

    }

    public function resetUI()
    {
        $this->permissionName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

}
