<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Component
{
    use WithPagination;

    public $roleName, $search,  $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'List';
        $this->componentName = 'Roles';
    }
        
    public function render()
    {

        $title_page = 'Roles';

        if (strlen($this->search) > 0) {
            $role = Role::where('name', 'like', "%$this->search%")->paginate($this->pagination);
        } else {
            $role = Role::orderBy('name', 'desc')->paginate($this->pagination);

        }

        return view('livewire.roles.component',[

            'roles' => $role,
            'title_page' => $title_page

        ])
        ->extends('layouts.theme.app',compact('title_page'))->section('content');
    }

    public function CreateRole(){
        $rules = ['roleName' => 'required|min:2|unique:roles,name'];

        $messages = ['roleName.required' => 'Name is required',
                    'roleName.unique' => 'Name must be unique',
                    'roleName.min' => 'Name must be least 2 characters'];

        $this->validate($rules, $messages);
        Role::create(['name' => $this->roleName]);
        $this->emit('role-added', 'role added');
        $this->resetUI();

    }

    public function Edit(Role $role){
        
        // $role = Role::find($id);
        $this->selected_id = $role->id;
        $this->roleName = $role->name;

        $this->emit('show-modal', 'Show modal');
    }

    public function UpdateRole(Role $role){

        $rules = ['roleName' => "required|min:2|unique:roles,name, {$this->selected_id}"];

        $messages = ['roleName.required' => 'Name is required',
            'roleName.unique' => 'Name must be unique',
            'roleName.min' => 'Name must be least 2 characters'
        ];

        $this->validate($rules, $messages);

        $role = Role::find($this->selected_id);
        $role->name = $this->roleName;
        $role->save();

        $this->emit('role-updated', 'role updated');
        $this->resetUI();

    } 
    
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        $permissionsCount = Role::find($id)->permissions->count();
        if ($permissionsCount > 0) {
            $this->emit('role-error', 'error, role has permissions associated');
            return;
        }

        Role::find($id)->delete();
        $this->emit('role-deleted', 'role deleted');

    }

    public function resetUI()
    {
        $this->roleName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

}
