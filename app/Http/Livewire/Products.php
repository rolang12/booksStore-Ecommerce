<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;
    use WithFileUploads;
    
    public $name, $description, $price, $stock, $alerts, $editorial,$presentation,
    $edition, $language, $n_pages, $height, $width, $year, $image, $category_id,
    $search, $selected_id, $pageTitle, $componentName, $barcode, $authors_id,
    $sortColumn = 'name', $sortDirection = 'asc',
    $columns = [ 'name', 'price', 'stock', 'year' ];
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor/livewire/bootstrap';
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection =  $this->sortDirection == 'asc' ? 'desc' : 'asc'; 
    }

    public function mount()
    {
        $this->pageTitle = 'List';
        $this->componentName = 'Products';
        $this->category_id = 'Choose';
    }

     public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (strlen($this->search) > 0 ) 
        {
            $products = Product::join('categories as c', 'c.id', 'products.category_id')
                                ->select('products.*', 'c.name as category')
                                ->where('products.name', 'like', '%'.$this->search. '%')
                                ->Orwhere('products.editorial', 'like', '%'.$this->search. '%')
                                ->Orwhere('c.name', 'like', '%'.$this->search. '%')
                                ->orderBy($this->sortColumn, $this->sortDirection)
                                ->paginate($this->pagination);
        } else {
        //si no, solo traigo los datos
             $products = Product::join('categories as c', 'c.id', 'products.category_id')
                                ->select('products.*', 'c.name as category')
                                ->orderBy($this->sortColumn, $this->sortDirection)
                                ->paginate($this->pagination);

        }

        return view('livewire.products.component',[
            'data' => $products,
            'categories' => Category::orderBy('name', 'asc')->get(),
            'authors' => Author::orderBy('name','asc')->get(),
            $title_page = 'Products CRUD',
        ])
        ->extends('layouts.theme.app',compact('title_page'))
        ->section('content');
    }


    public function Store()
    {
        $rules = ['name' =>         'required|unique:products|min:3',
                  'description' =>  'required|min:10', 'barcode' => 'unique:products|min:10',
                  'price' =>        'required','stock' =>      'required|gt:alerts',
                  'alerts' =>       'required','editorial' =>  'required',
                  'presentation' => 'required|not_in:Choose','edition' => 'required',
                  'language' =>     'required|not_in:Choose','n_pages' =>'required',
                  'height' =>       'required','width' =>'required',
                  'year' => 'required|min:4|max:4','category_id' =>'required|not_in:Choose'
                ,'authors_id' =>'required|not_in:Choose'
        ];
                // Mensajes personalizados de validación  de errores
        $messages = [
            'name.required' =>          'The name is required',
            'name.unique' =>            'The name must be unique',
            'name.min' =>               'The name must have least 3 characters',
            'description.required' =>   'The description is required',
            'price.required' =>         'The price is required',
            'stock.required' =>         'The stock is required',
            'stock.gt' =>               'The stock must be greater than Stock Min',
            'alerts.required' =>        'The alerts number is required',
            'editorial.required' =>     'The editorial is required',
            'presentation.required' =>  'The presentation is required',
            'presentation.not_in' =>    'Choose a different option',
            'edition.required' =>       'The edition is required',
            'language.required' =>      'The language is required',
            'language.not_in' =>      'Choose a different option',
            'n_pages.required' =>       'The number of pages is required',
            'height.required' =>        'The height is required',
            'width.required' =>         'The width is required',
            'year.required' =>          'The year is required',
            'year.min' =>               'The year must be 4 characters',
            'year.max' => '             The year must be 4 characters',
            'category_id.required' =>   'The category is required',
            'category_id.not_in' =>     'Choose a different option',
            'authors_id.required' =>   'The author is required',
            'authors_id.not_in' =>     'Choose a different option',
        ];

        $this->validate($rules, $messages);
    // $customFileName;
  
        $product = Product::create([
            'name' =>         $this->name,         'description' => $this->description,
            'price' =>        $this->price,        'stock' =>       $this->stock,
            'alerts' =>       $this->alerts,       'editorial' =>   $this->editorial,
            'presentation' => $this->presentation, 'edition' =>     $this->edition,
            'language' =>     $this->language,     'n_pages' =>     $this->n_pages,
            'height' =>       $this->height,       'width' =>       $this->width,
            'barcode' =>      $this->barcode,       'authors_id' => $this->authors_id, 
            'year' =>         $this->year,         'category_id' => $this->category_id, 

        ]);
        $customFileName;
          if ($this->image) 
        {
            // dd($this->image);
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/products', $customFileName);
            $product->image = $customFileName;
            $product->save();
        }

        $this->resetUI();
        $this->emit('product-added','product added');

    }

    public function resetUI()
    {
        $this->name = '';        $this->image = null;
        $this->description = ''; $this->price = '';
        $this->stock = 0;        $this->alerts = 0;
        $this->editorial = '';   $this->presentation = 'Choose';
        $this->edition = '';     $this->language = 'Choose';
        $this->n_pages = 0;      $this->height = '';
        $this->width = '';       $this->year = ''; $this->barcode = '';
        $this->category_id = 'Choose'; $this->selected_id = 0;
        $this->authors_id = 'Choose';
    }


    public function Edit(Product $product)
    {
        $this->name =        $product->name;        $this->image    = null;
        $this->description = $product->description; $this->price    = $product->price;
        $this->stock =       $product->stock;       $this->alerts   = $product->alerts;
        $this->editorial =   $product->editorial;   $this->presentation = $product->presentation;
        $this->edition =     $product->edition;     $this->language = $product->language;
        $this->n_pages =     $product->n_pages;     $this->height   = $product->height;
        $this->width =       $product->width;       $this->year     = $product->year;
        $this->category_id = $product->category_id; $this->selected_id = $product->id;
        $this->barcode = $product->barcode;

        $this->emit('modal-show', 'Show Modal');
    }

    public function Update()
    {
        $rules = ['name' =>         "required|min:3|unique:products,name, {$this->selected_id}",
                  'description' =>  'required|min:10', 'barcode' => 'min:10',
                  'price' =>        'required',         'stock' =>         'required|gt:alerts',
                  'alerts' =>       'required',         'editorial' =>     'required',
                  'presentation' => 'required|not_in:Choose', 'edition' => 'required',
                  'language' =>     'required|not_in:Choose',         'n_pages' => '      required',
                  'height' =>       'required',         'width' =>          'required',
                  'year' => 'required|min:4|max:4','category_id' =>  'required|not_in:Choose'
        ];

        $messages = [
            'name.required' =>          'The name is required',
            'name.unique' =>            'The name must be unique',
            'name.min' =>               'The name must have least 3 characters',
            'description.required' =>   'The description is required',
            'price.required' =>         'The price is required',
            'stock.required' =>         'The stock is required',
            'stock.gt' =>               'The stock must be greater than Stock Min',
            'alerts.required' =>        'The alerts number is required',
            'editorial.required' =>     'The editorial is required',
            'presentation.required' =>  'The presentation is required',
            'presentation.not_in' =>    'Choose a different option',
            'edition.required' =>       'The edition is required',
            'language.required' =>      'The language is required',
            'language.not_in' =>      'Choose a different option',
            'n_pages.required' =>       'The number of pages is required',
            'height.required' =>        'The height is required',
            'width.required' =>         'The width is required',
            'year.required' =>          'The year is required',
            'barcode.unique' =>         'Barcode must be Unique',
            'barcode.min' =>         'Barcode must be 10 characters',
            'year.min' =>               'The year must be 4 characters',
            'year.max' => '             The year must be 4 characters',
            'category_id.required' =>   'The category is required',
            'category_id.not_in' =>     'Choose a different option',
        ];

        $this->validate($rules, $messages);

        $product  = Product::find($this->selected_id);

        $product->update([
            'name' =>         $this->name,         'description' => $this->description,
            'price' =>        $this->price,        'stock' =>       $this->stock,
            'alerts' =>       $this->alerts,       'editorial' =>   $this->editorial,
            'presentation' => $this->presentation, 'edition' =>     $this->edition,
            'language' =>     $this->language,     'n_pages' =>     $this->n_pages,
            'height' =>       $this->height,       'width' =>       $this->width,
            'barcode' =>      $this->barcode,
            'year' =>         $this->year,         'category_id' => $this->category_id, 
        ]);

        $this->validate($rules, $messages);

        $customFileName;
        if ($this->image) 
        {
            $customFileName = uniqid() .'_.' . $this->image->extension();
            $this->image->storeAs('public/products', $customFileName);
            $imageTemp = $product->image; //imagen temporal porque necesitamos borrarla del disco
            $product->image = $customFileName;
            $product->save();

            if($imageTemp != null){
                if(file_exists('storage/products/'. $imageTemp)){
                    unlink('storage/products/'. $imageTemp);
                }
            }

        }

        $this->resetUI();
        $this->emit('product-updated',"Product $product->name has been updated");
        

    }

    
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Product $product)
    {
        $imageTemp = $product->image;
        $product->delete();

        if($imageTemp != null){ //si existe una imagen la eliminamos
             if(file_exists('storage/products/'. $imageTemp)){
                    unlink('storage/products/'. $imageTemp);
                }
        }

        $this->resetUI();
        $this->emit('product-deleted', "Product $product->name has been deleted");
    }


}
