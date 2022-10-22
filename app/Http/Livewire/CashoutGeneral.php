<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\SaleDetail;
use Livewire\Component;
use Carbon\Carbon;

class CashoutGeneral extends Component
{
    public $fromDate, $toDate, $total, $items, $sales, $details;
    

    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->total = 0;
        $this->sales = [];
        $this->details = [];

    }

    public function render()
    {
        return view('livewire.cashOutGeneral.component',[
            $title_page = 'General Cashout',            
        ])->extends('layouts.theme.app',compact('title_page'))->section('content') ;
    }

    //metodo para consultar
    public function Consultar()
    {
        //initial Date
        $id = Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
        //final Date
        $fd = Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';

        //query between dates
        $this->sales = Sale::whereBetween('created_at', [$id, $fd])
                        ->where('status', 'PAID')
                        ->get();
        // $this->sales = Sale::whereBetween('created_at', [$id, $fd])
        //                 ->where('status', 'PAID')
        //                 ->get();


    // $this->sales = Sale::join('sale_details as d', 'd.sale_id', 'sales.id')
    //                         ->select('d.sale_id as id','d.created_at as created_at', 'd.quantity as items','d.price as total')
    //                         ->whereBetween('sales.created_at', [$id, $fd])
    //                         ->where('sales.status', 'PAID')
    //                         ->get();
        


        //traigo la suma total de lo que tengo en la coleccion de ventas
        //en el caso de que hayan hago la sumatorio, si no es igual a 0

        $this->total =  $this->sales ?  $this->sales->sum('total') : 0;
        $this->items =  $this->sales ?  $this->sales->sum('items') : 0;

    }

    public function viewDetails(Sale $sale)
    {
         //initial Date
        $id = Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
        //final Date
        $fd = Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';

        // $this->details = SaleDetail::with('sale');
        $this->details = Sale::join('sale_details as d', 'd.sale_id', 'sales.id')
                             ->join('products as p', 'p.id','d.product_id')
                            ->select('d.sale_id','p.name as product', 'd.quantity','d.price')
                            ->whereBetween('sales.created_at', [$id, $fd])
                            ->where('sales.status', 'PAID')
                            ->where('sales.id', $sale->id)->get();
        
        $this->emit('show-modal', 'open modal');

    }

    public function Print()
    {
        //
    }


}
