<?php

namespace App\Http\Livewire\Graphics;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sales extends Component
{
    public $fromDate = "", $toDate = "";

    public function mount(){
        $this->fromDate = null;
        $this->toDate = null;
    }

    public function render()
    {
        $title_page = 'Sales Graphics';

        //    initial Date
        $id = Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
        //final Date
        $fd = Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';

        // Iban las fechas dinámicas, pero tuve inconvenientes
        $saleDetails = DB::select("SELECT created_at, COUNT(id) AS ventas FROM sale_details
            WHERE created_at BETWEEN '$id' AND '$fd' GROUP BY created_at");

        if($saleDetails == null){
            $labels = array();
            $saleDetails = "";
            $dots_saleDetail = "";
        } else {
            
            $dots_saleDetail = [];
            foreach ($saleDetails as $sale) {
                $dots_saleDetail[] = ['labels' => $sale->created_at, 'y' => $sale->ventas];
                $labels[] = $sale->created_at;

            }
 
        }
        return view('livewire.graphics.purchases', [
            'sales' => json_encode($dots_saleDetail),
            'labels' => json_encode($labels),
           
        ])->extends('layouts.theme.app', compact('title_page'))
        ->section('content');
    }
}
