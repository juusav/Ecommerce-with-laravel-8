<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;

class AddCartItemSize extends Component
{
    public $product, $sizes;

    public $color_id = "";
    public $qty = 1;
    public $quantity = 0;
    public $size_id = "";


    public $colors = [];

    public function updatedSizeId($value){
        $size = Size::find($value);
        $this->colors = $size->colors;
    }
    public function updatedColorId($value){
        $size = Size::find($this->size_id);
        $this->quantiy = $size->colors->find($value)->pivot->quantity;
    }
    
    public function mount(){
        $this->sizes = $this->product->sizes;
    }

    public function render(){
        return view('livewire.add-cart-item-size');
    }
}
