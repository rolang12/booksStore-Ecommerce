<?php

namespace App\Http\Livewire\Users;

use App\Models\Product;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Component
{
    protected $listeners = ['deleteRow' => 'removeItem'];

   
    public function render()
    {
        $items = Cart::getContent();
    
        $title_page = 'Shopping Cart';
        return view('livewire.users.cart',[
            'items' => $items
        ])->extends('layouts.theme.app'
        ,compact('title_page'))->section('content');
    }

    public function removeItem(Product $product) {
        
        Cart::remove(
            $product->id,
        );
        $this->emit('product-added', $product->name.' removed to cart');
    }

    public function updateItemQtity($id, $quantity)
    {

        $cant = Cart::get($id);

        $product = Product::find($id);

        if ($quantity > 0) {
            
            if ($cant->quantity == $product->stock ) {
                return redirect()->route('users.cart-items')->with('status-danger','Sorry, we have no more stock for this product');

            }

            Cart::add(
            $product->id,
            $product->name,
            $product->price,
            $product->quantity + 1,
             array("url" => $product->imagen)
            );

        } else {
            // $product->quantity = $cant->quantity - 1;
            if ($cant->quantity  < 1  ) {
                
               return $this->removeItem($product);
            } 

            Cart::add(
            $product->id,
            $product->name,
            $product->price,
            $product->quantity - 1,
             array("url" => $product->imagen)
            );

        }
            
            if ($cant != null ) {

                if ($cant->quantity > $product->alerts)
                {
                    $this->emit('product-error', 'Sorry, we have no more '.$product->name);
                    return;
                } 

            }

        $this->emit('product-added', 'quantity updated');

    }

}