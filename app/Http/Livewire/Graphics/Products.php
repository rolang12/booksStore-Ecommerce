<?php

namespace App\Http\Livewire\Graphics;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
       $title_page = 'Products Graphics';

      
        $saleDetails = DB::select('SELECT products.name product_id,  COUNT(sale_id) AS canti 
                        FROM sale_details
                        JOIN products ON products.id = product_id
                        GROUP BY products.name
        ');
       
        
        $dots_saleDetail = [];

        foreach ($saleDetails as $sale) {
           $dots_saleDetail[] = [ 'name' => $sale->product_id, 'y' => $sale->canti];
        }

        return view('livewire.graphics.products',[
            "products" => json_encode($dots_saleDetail)
        ])->extends('layouts.theme.app',compact('title_page'))
          ->section('content');
    }
}
