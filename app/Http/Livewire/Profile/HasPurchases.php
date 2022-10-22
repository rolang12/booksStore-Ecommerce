<?php

namespace App\Http\Livewire\Profile;

use App\Models\Sale;
use Livewire\Component;

class HasPurchases extends Component
{
    
    public function render()
    {
        $title_page = 'Historial';
    
        $purchases = Sale::where('user_id',Auth()->user()->id)->get('id');
    
        $data  = Sale::join('sale_details as d', 'd.sale_id', 'sales.id')
                             ->join('products as p', 'p.id','d.product_id')
                            ->select('d.created_at','d.sale_id','p.name as product', 'd.quantity','d.price')
                            ->where('sales.status', 'PAID')
                            ->where('sales.user_id', Auth()->user()->id)
                            ->whereIn('sales.id', $purchases)
                            ->get();
            
        return view('livewire.profile.has-purchases',[
            'data' => $data
        ])->extends('layouts.theme.app', compact('title_page'))->section('content');
    }
}
