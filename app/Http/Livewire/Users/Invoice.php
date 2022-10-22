<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

class Invoice extends Component
{
    protected $listeners = ['reload', 'reloadRedirect'];

    public function reloadRedirect()
    {
        return view('home');
    }

}
