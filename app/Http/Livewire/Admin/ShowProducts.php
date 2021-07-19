<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ShowProducts extends Component
{
    public function render()
    {
        return view('livewire.admin.show-products')->layout('layouts.admin');
    }
}
