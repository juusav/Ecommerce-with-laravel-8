<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemSize extends Component
{
    public $product, $sizes;
    public $color_id = "";
    public $qty = 1;
    public $quantity = 0;
    public $size_id = "";

    public $colors = [];
    public $options = [];
    

    public function mount(){
        $this->sizes = $this->product->sizes;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function updatedSizeId($value){
        $size = Size::find($value);
        $this->colors = $size->colors;
        $this->options['size'] = $size->name;
    }

    public function updatedColorId($value){
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = $color->pivot->quantity;
        $this->options['color'] = $color->name;
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }
    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem(){
        Cart::add(['id' => $this->product->id,
                    'name' => $this->product->name,
                    'qty' => $this->qty,
                    'price' => $this->product->price,
                    'weight' => 550,
                    'options' => $this->options
                ]);
        $this->emitTo('dropdown-cart', 'render'); //  Para un componente el evento será emitto. Se envia al componente Dropdown
    }

    public function render(){
        return view('livewire.add-cart-item-size');
    }
}
