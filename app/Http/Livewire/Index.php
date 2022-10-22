<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
   

    public function render()
    {
       

        $title_page = 'Home';
        return view('livewire.index',[
            
        ])
        ->extends('layouts.theme.app', compact('title_page'))->section('content') ;
    }


}
