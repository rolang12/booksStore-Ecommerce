<?php

namespace App\Http\Livewire\Graphics;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Table extends Component
{
    public  $toDate, $fromDate;

    public function render()
    {

        $title_page = 'Products Graphics';

        $id = Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
        //final Date
        $fd = Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';


        $saleDetails = DB::select("SELECT created_at, COUNT(id) AS ventas FROM sale_details
            WHERE created_at BETWEEN '$id' AND '$fd' GROUP BY created_at
        ");
        // dd($saleDetails);
        if($saleDetails == null){
            $labels = "";
            $saleDetails = "";
            $dots_saleDetail = "";

        } else {
            // dd($this->fromDate);
            $dots_saleDetail = [];

            foreach ($saleDetails as $sale) {
                $dots_saleDetail[] = ['labels' => $sale->created_at, 'y' => $sale->ventas];
            }

            foreach ($saleDetails as $sale) {
                $labels[] = $sale->created_at;
                $y[] = $sale->ventas;
            }

        }

        // $this->labels = $labels;
        // $this->dots_saleDetail = $dots_saleDetail;

        return view('livewire.graphics.table', [
        'sales' => json_encode($dots_saleDetail),
        'labels' => json_encode($labels),
        
        ])->extends('layouts.theme.app', compact('title_page'))
          ->section('content');


    }

    //  public function Consultar()
    // {  
       

    // }
}
