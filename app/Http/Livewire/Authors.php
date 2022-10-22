<?php

namespace App\Http\Livewire;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;

class Authors extends Component
{
    use WithPagination;
    private $pagination = 5;
    public $name, $last_name,$search, $selected_id, $sortColumn = 'name', $columns = ['name','last_name'],$sortDirection = 'asc';
    
    public function mount()
    {
        $this->pageTitle = 'List';
        $this->componentName = 'Authors';
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $title_page = 'Authors';
        //si la longitud de la busqueda es mayor a cero, busco esa información
        if (strlen($this->search) > 0 ) {
            $data = Author::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('last_name', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->pagination);

        } else {
        //si no, solo traigo los datos
            $data = Author::orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->pagination);

        }

        return view('livewire.authors.component',[
            'authors' => $data,
        ])->extends('layouts.theme.app',compact('title_page'))
        ->section('content');
    }


      public function Edit($id)
    {
        $record = Author::find($id,['id','name','last_name']);
        $this->name = $record->name;
        $this->last_name = $record->last_name;
        $this->selected_id = $record->id;


        $this->emit('show-modal', 'Show Modal');
    }


    public function Store()
    {
        $rules = ['name' => 'required|regex:/^[\pL\s\-]+$/u|unique:authors,name|min:3',
                  'last_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:authors,last_name|min:3'    ];

        $messages = [
            'name.required' => 'Author name cannot be null',
            'name.unique' => 'Author name must be Unique',
            'name.min' => 'Author name require least 3 characters',
            'last_name.required' => 'Author name cannot be null',
            'last_name.unique' => 'Author name must be Unique',
            'last_name.min' => 'Author name require least 3 characters',
            'name.regex' => 'Type a valid name',
            'last_name.regex' => 'Type a valid last name',
        ];

        $this->validate($rules, $messages);

        $category = Author::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
        ]);

      
        //envio a la función que me resetee toda la info
        $this->resetUI();

        //envio un evento para que sea escuchado en la vista
        $this->emit('author-added', 'author added');

    }

    public function resetUI()
    {
        //reseteo toda la información
        $this->last_name = '';
        $this->name = '';
        $this->search = '';
        
    }

    public function Update()
    {
        //reglas y mensajes 
        $rules = ['name' => "required|min:3|regex:/^[\pL\s\-]+$/u|unique:authors,name, {$this->selected_id}",
                      'last_name' => "required|min:3|regex:/^[\pL\s\-]+$/u|unique:authors,last_name, {$this->selected_id} "];
        $messages = [
            'name.required' => 'Author name cannot be null',
            'name.unique' => 'Author name must be Unique',
            'name.min' => 'Author name require least 3 characters',
            'last_name.required' => 'Author name cannot be null',
            'last_name.unique' => 'Author name must be Unique',
            'last_name.min' => 'Author name require least 3 characters',
            'name.regex' => 'Type a valid name',
            'last_name.regex' => 'Type a valid last name',
        ];
        //valido la información
        $this->validate($rules, $messages);

        //encuentro el id que le envié por el wire:model y actualizo el nombre
        $author = Author::find($this->selected_id);
        $author->update([
            'name' => $this->name,
            'last_name' => $this->last_name
        ]);

        $this->resetUI();
        $this->emit('author-updated', 'Author updated');

    }

}
