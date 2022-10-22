<?php

namespace App\Http\Livewire\Index;

use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class Products extends Component
{

    use WithPagination;

    public $search = '', $category, $author;
 
    protected $paginationTheme = 'bootstrap';
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        
        $title_page = 'All Products';

        if (strlen($this->search) > 0 ) {
            $products = Product::join('authors as a','a.id','authors_id')
            ->select('a.name as author_name','a.last_name as author_last_name
                    ','price','products.name','products.image','products.id')
                        ->where('products.name','like', '%'.$this->search.'%')
                        ->orWhere('a.name','like','%'.$this->search.'%')
                        ->orWhere('a.last_name','like','%'.$this->search.'%')
                        ->orWhere('price','like','%'.$this->search.'%')
                        ->paginate(15);
 
        } elseif ($this->category != '') {
            
            $products = Product::join('authors as a','a.id','authors_id')
            ->select('a.name as author_name','a.last_name as author_last_name
                    ','price','products.name','products.image','products.id')
                    ->where('category_id',$this->category)
                    ->paginate(15);

        } elseif ($this->author != '') {
            
            $products = Product::join('authors as a','a.id','authors_id')
            ->select('a.name as author_name','a.last_name as author_last_name
                    ','price','products.name','products.image','products.id')
                    ->where('authors_id',$this->author)
                    ->paginate(15);
        } else {
            $products = Product::join('authors as a','a.id','authors_id')
            ->select('a.name as author_name','a.last_name as author_last_name
                    ','price','products.name','products.image','products.id')
                     ->where('products.name','like', '%'.$this->search.'%')
                    ->paginate(15);
        }
        return view('livewire.index.products',[

            'products' => $products,
            'categories' => Category::all(),
            'authors' => Author::all(),
            
        ])->extends('layouts.theme.app', compact('title_page'))->section('content');
    }

     public function addCart(Product $product)
    {
        $this->productId = $product->id;

        if ( $cartTotalQuantity = Cart::getTotalQuantity() > 0 ) {
           
            $cant = Cart::get($product->id);
            
            if ($cant != null ) {

                if ($cant->quantity > $product->alerts)
                {
                    $this->emit('product-error', 'Sorry, we have no more '.$product->name);
                    return;
                } 

            }
        }
       
        $product->quantity = 1;
        $added =  Cart::add(
            $product->id,
            $product->name,
            $product->price,
            $product->quantity,
             array("url" => $product->imagen)
            
        );

      
        $this->emit('product-added', $product->name.' Added to cart (RELOAD PAGE)');
    }



}
