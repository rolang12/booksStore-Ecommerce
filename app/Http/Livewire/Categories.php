<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Categories extends Component
{
    use WithFileUploads;
    use WithPagination;

    //pageTitle y component name se envian a la plantilla para que sea dinámica
    public $name, $search, $image, $selected_id, $pageTitle, $componentName, $sortColumn = 'name', $sortDirection = 'asc',
    $columns = ['name'];
    private $pagination = 5;
    protected $listeners = ['deleteRow' => 'Destroy'];


    //inicializo las variables
    public function mount()
    {
        $this->pageTitle = 'List';
        $this->componentName = 'Categories';
    }

    //sort column
    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection =  $this->sortDirection == 'asc' ? 'desc' : 'asc'; 
    }

    //paginación personalizada de bootstrap
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
         $title_page = 'Categories';
        //si la longitud de la busqueda es mayor a cero, busco esa información
        if (strlen($this->search) > 0 ) {
            $data = Category::where('name', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->pagination);

        } else {
        //si no, solo traigo los datos
            $data = Category::orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->pagination);

        }

        
        return view('livewire.category.categories', [
            'categories' => $data,
            
        ])->extends('layouts.theme.app',compact('title_page'))
        ->section('content');
    }

    public function Edit($id)
    {
        $record = Category::find($id,['id','name','image']);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'Show Modal');
    }


    public function Store()
    {
        $rules = ['name' => 'required|unique:categories,name|min:3'];
        $messages = [
            'name.required' => 'Category cannot be null',
            'name.unique' => 'Category must be Unique',
            'name.min' => 'Category require least 3 characters',
        ];

        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name,
        ]);

        $customFileName;
        if ($this->image) 
        {
            $customFileName = uniqid() .'_.' . $this->image->extension();
            $this->image->storeAs('public/categories', $customFileName);
            $category->image = $customFileName;
            $category->save();
        }

        //envio a la función que me resetee toda la info
        $this->resetUI();

        //envio un evento para que sea escuchado en la vista
        $this->emit('category-added', 'category added');

    }

    public function resetUI()
    {
        //reseteo toda la información
        $this->image = null;
        $this->name = '';
        $this->search = '';
        $this->selected_id = 0;
    }

    public function Update()
    {
        //reglas y mensajes 
        $rules = ['name' => "required|min:3|unique:categories,name, {$this->selected_id}"];
        $messages = [
            'name.required' => 'Category name cannot be null',
            'name.unique' => 'Category name must be Unique',
            'name.min' => 'Category name require least 3 characters',
        ];
        //valido la información
        $this->validate($rules, $messages);

        //encuentro el id que le envié por el wire:model y actualizo el nombre
        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name
        ]);

        //Pregunto si se guardó una imagen, le asigno un id unico y la guardo
        if ($this->image) {
            $customFileName = uniqid() . '_.'. $this->image->extension();
            $this->image->storeAs('public/categories', $customFileName);
            $imageName = $category->image;
        //actualizo
            $category->image = $customFileName;
            $category->save();

        //si la imagen existe, entonces que me la elimine
            if ($imageName != null) {
                if (file_exists('storage/categories'.$imageName)) {
                    unlink('storage/categories'.$imageName);
                }
            }
        }
        //limpiar caja de texto
        $this->resetUI();
        $this->emit('category-updated', 'category updated');

    }

   
    public function Destroy($id)
    {
        $category = Category::find($id);
        $imageName = $category->image; //imagen temportal para despue eliminarla
        $category->delete();

        if ($imageName != null) {
                unlink('storage/categories/'. $imageName);
        }

        $this->resetUI();
        $this->emit('category-deleted', 'category deleted');
        
    }
}
