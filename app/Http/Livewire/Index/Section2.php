<?php

namespace App\Http\Livewire\Index;

use App\Models\Product;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class Section2 extends Component
{
        public $productId = 0;


    public function render()
    {
        return view('livewire.index.section2',[


            'p_adventure' => Product::join('authors as a','a.id','authors_id')
            ->select('a.name as author_name','a.last_name as author_last_name
                    ','price','products.name','products.image','products.id')
            ->where('category_id','2')
            ->take(4)
            ->get(),

        ]);
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
