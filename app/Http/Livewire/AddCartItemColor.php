<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCartItemColor extends Component
{
    public $product, $colors;

    public $color_id = "";
    public $qty = 1;
    public $quantity = 0;

    public function mount(){
        $this->colors = $this->product->colors;
    }
    public function decrement(){
        $this->qty = $this->qty - 1;
    }
    public function increment(){
        $this->qty = $this->qty + 1;
    }
    public function render(){
        return view('livewire.add-cart-item-color');
    }

    // updated + el nombre de alguna propiedad Este trozo se ejecutará cada vez que se cambie el valor de la propiedad

    public function updatedColorId($value){
        $this->quantity = $this->product->colors->find($value)->pivot->quantity;
    }
}
