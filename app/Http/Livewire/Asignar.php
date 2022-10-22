<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class Asignar extends Component
{
    use WithPagination;

    public $role, $componentName, $permisosSelected = [], $old_permissions = [];   
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->role = 'Choose';
        $this->componentName = 'Assign permission';
    }

    public function render()
    {
        $permisos = Permission::select('name', 'id', DB::raw("0 as checked"))
        ->orderBy('name', 'asc')->paginate($this->pagination);

        if ($this->role != 'Choose') {
            $list = Permission::join('role_has_permissions as rp', 
            'rp.permission_id', 'permissions.id')->where('role_id',$this->role)
            ->pluck('permissions.id')->toArray();

            $this->old_permissions = $list;

        }

        if ($this->role != 'Choose') {
            foreach ($permisos as $permiso) {
                $role = Role::find($this->role);
                $haspermission = $role->hasPermissionTo($permiso->name);
                if ($haspermission) {
                    $permiso->checked = 1;
                }

            }
        }

        return view('livewire.asignar.component',[
            'roles' => Role::orderBy('name', 'asc')->get(),
            'permisos' => $permisos,
            $title_page = 'Assign',
        ])->extends('layouts.theme.app', compact('title_page'))->section('content');
    }

    public $listeners = ['revokeall' => 'RemoveAll'];

    public function RemoveAll()
    {
        if ($this->role == 'Choose') {
            $this->emit('sync-error', 'choose a valid role');
            return;
            
        }

        $role = Role::find($this->role);
        $role->syncPermissions([0]);

        $this->emit('removeall',"All permissions has been revoked in rol  $role->name");

    }

    public function syncAll()
    {
        if ($this->role == 'Choose') {
            $this->emit('sync-error', 'choose a valid role');
            return;
            
        }

        $role = Role::find($this->role);
        $permisos = Permission::pluck('id')->toArray();
        $role->syncPermissions($permisos);

        $this->emit('syncall',"All permissions has been assigned in rol  $role->name");


    }
    public function SyncPermiso($state, $permisoName)
    {
        if ($this->role !='Choose') {
           $roleName = Role::find($this->role);

           if ($state) {
               $roleName->givePermissionTo($permisoName);
               $this->emit('permi', 'permiso asigend correctamente');

           } else {
               $roleName->revokePermissionTo($permisoName);
                $this->emit('permi', 'permiso revoked correctamente');

           }

        } else {
            $this->emit('permi', 'Choose a valid rol');

        }

    }

}
