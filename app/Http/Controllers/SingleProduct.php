<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class SingleProduct extends Controller
{
    public function single_product($id)
    {
        $product = Product::findOrFail($id);

        $title_page = 'Single Product';

        $product = Product::with('category')->join('authors as a','a.id','authors_id')
        ->select('a.name as author_name','a.last_name as author_last_name',
        'products.*')
        ->where('products.id',$id)
        ->first();


        return view('livewire.single-product',compact('title_page','product'));
    }

    public function addCart(Request $request)
    {
        $product = Product::find($request->id);

        if ( $cartTotalQuantity = Cart::getTotalQuantity() > 0 ) {
           
            $cant = Cart::get($product->id);
            
            if ($cant != null ) {

                if ($cant->quantity > $product->alerts)
                {
        return redirect()->back()->withErrors('Sorry, we have no more '.$product->name);
                    
                } 

            }
        }
       
        $product->quantity = $request->quantity;
        $added =  Cart::add(
            $product->id,
            $product->name,
            $product->price,
            $product->quantity,
             array("url" => $product->imagen)
            
        );

        return redirect()->back()->with('status', $product->name. "has been added to cart");
    }

}
