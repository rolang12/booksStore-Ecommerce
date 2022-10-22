<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class SingleProduct extends Component
{
  
    public $id;
  public $productId = 0;


    public function render()
    {
       
        $title_page = 'Single Product';
        return view('livewire.single-product',[

             'p_fantasy' => Product::join('authors as a','a.id','authors_id')
            ->select('a.name as author_name','a.last_name as author_last_name
                    ','price','products.name','products.image','products.id')
            ->where('products.id',$this->id)
            ->first(),


        ])->extends('layouts.theme.app',compact('title_page'))
        ->section('content');
    }

     public function addCart(Product $product)
    {
        dd($product);
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

      
        $this->emit('product-added', $product->name.' Added to cart');
    }


}
