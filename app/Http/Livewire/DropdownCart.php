<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DropdownCart extends Component
{
    protected $listeners = ['render']; //Está a la escucha de lo que sucede en el evento AddCartItem
    public function render(){
        return view('livewire.dropdown-cart');
    }
}
