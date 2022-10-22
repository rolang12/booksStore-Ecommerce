<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Redirect extends Controller
{
    public function index()
    {
        return view('livewire.users.order-ticket');
    }
}
