<?php

namespace App\Http\Livewire\Graphics;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
       $title_page = 'Users Graphics';

        $sales = DB::select('  SELECT users.name user_id, COUNT(sales.`status`) AS canti
                            FROM sales
                            JOIN users ON users.id = user_id
                            WHERE sales.`status` = "PAID"
                            GROUP BY users.name
                    ');
        $dots = [];


        foreach ($sales as $sale) {
           $dots[] = [ 'name' => $sale->user_id, 'y' => $sale->canti];
        }


        return view('livewire.graphics.users',[
            "users" => json_encode($dots),
        ])->extends('layouts.theme.app',compact('title_page'))
          ->section('content');
    }
}
