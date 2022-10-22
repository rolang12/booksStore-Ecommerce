<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use Livewire\Component;
use Livewire\WithPagination;

class Coins extends Component
{
    use WithPagination;

    //pageTitle y component name se envian a la plantilla para que sea dinámica
    public $type, $search, $value, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;
    protected $listeners = ['deleteRow' => 'Destroy'];


    //inicializo las variables
    public function mount()
    {
        $this->pageTitle = 'List';
        $this->componentName = 'Denominations';
        $this->type = 'Choose';
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
        //si la longitud de la busqueda es mayor a cero, busco esa información
        if (strlen($this->search) > 0 ) {
            $data = Denomination::where('type', 'like', '%'.$this->search.'%')->paginate($this->pagination);

        } else {
        //si no, solo traigo los datos
            $data = Denomination::orderBy('id','asc')->paginate($this->pagination);

        }

        
        return view('livewire.denominations.component', ['data' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id)
    {
        $record = Denomination::find($id,['id','type','value']);
        $this->type = $record->type;
        $this->value = $record->value;
        $this->selected_id = $record->id;

        $this->emit('modal-show', 'Show Modal');
    }


    public function Store()
    {
        $rules = ['value' => 'required|unique:denominations',
                   'type' => 'required|not_in:Choose' ];
        $messages = [
            'value.required' => 'Value is required',
            'value.unique' => 'Value must be unique',
            'type.required' => 'Type is required',
            'type.not_in' => 'Choose a different option',
        ];

        $this->validate($rules, $messages);

        $denomination = Denomination::create([
            'type' => $this->type,
            'value' => $this->value,
        ]);

        //envio a la función que me resetee toda la info
        $this->resetUI();

        //envio un evento para que sea escuchado en la vista
        $this->emit('item-added', 'item added');

    }

    public function resetUI()
    {
        //reseteo toda la información
        $this->value = '';
        $this->type = '';
        $this->search = '';
        $this->selected_id = 0;
    }

    public function Update()
    {
        //reglas y mensajes 
        $rules = ['type' => 'required|not_in:Choose', 'value' => "required|unique:denominations,value,{$this->selected_id}" ];
        $messages = [
            'type.required' => 'Type is required',
            'type.not_in' => 'Choose a different option',
            'value.required' => 'Value is required',
            'value.unique' => 'Value must be unique'
        ];

        //valido la información
        $this->validate($rules, $messages);

        //encuentro el id que le envié por el wire:model y actualizo el nombre
        $category = Denomination::find($this->selected_id);
        $category->update([
            'type' => $this->type,
            'value' => $this->value
        ]);

        //limpiar caja de texto
        $this->resetUI();
        $this->emit('item-updated', 'item updated');

    }

   
    public function Destroy(Denomination $denomination)
    {
        $denomination->delete();

        $this->resetUI();
        $this->emit('item-deleted', 'item deleted');
        
    }
}
